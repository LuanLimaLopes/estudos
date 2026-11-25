//! Logitech via HID++ 2.0 (receptores Unifying, Bolt, Lightspeed e dispositivos diretos).
//! Protocolo baseado na documentação pública/Solaar. Fala com a interface HID++ "long"
//! (relatório 0x11, 20 bytes) e consulta as features de bateria 0x1004, 0x1000 e 0x1001.

use crate::device::Device;
use hidapi::{DeviceInfo, HidApi, HidDevice};
use std::time::{Duration, Instant};

const VID: u16 = 0x046D;
const SW_ID: u8 = 0x0A;
const RECEIVER_PIDS: &[u16] = &[
    0xC52B, 0xC532, 0xC534, 0xC539, 0xC53A, 0xC53D, 0xC53F, 0xC541, 0xC545, 0xC547, 0xC548,
];

#[derive(Debug)]
enum Fail {
    Timeout,
    Error,
}

fn is_long_hidpp(i: &DeviceInfo) -> bool {
    (i.usage_page() == 0xFF00 && i.usage() == 0x0002)
        || (i.usage_page() == 0xFF43 && i.usage() == 0x0202)
}

fn request(dev: &HidDevice, idx: u8, feature: u8, func: u8, params: &[u8]) -> Result<[u8; 20], Fail> {
    let mut buf = [0u8; 20];
    buf[0] = 0x11;
    buf[1] = idx;
    buf[2] = feature;
    buf[3] = (func << 4) | SW_ID;
    for (i, p) in params.iter().take(16).enumerate() {
        buf[4 + i] = *p;
    }
    dev.write(&buf).map_err(|_| Fail::Error)?;

    let deadline = Instant::now() + Duration::from_millis(700);
    loop {
        let left = deadline
            .checked_duration_since(Instant::now())
            .ok_or(Fail::Timeout)?;
        let mut r = [0u8; 32];
        let n = dev
            .read_timeout(&mut r, left.as_millis().max(1) as i32)
            .map_err(|_| Fail::Error)?;
        if n == 0 {
            return Err(Fail::Timeout);
        }
        if n < 7 || r[1] != idx {
            continue;
        }
        // Erro HID++ 2.0 ou HID++ 1.0 (ex.: dispositivo desconhecido no receptor)
        if (r[2] == 0xFF && r[3] == feature && r[4] == buf[3]) || r[2] == 0x8F {
            return Err(Fail::Error);
        }
        if r[2] == feature && r[3] == buf[3] {
            let mut out = [0u8; 20];
            let m = n.min(20);
            out[..m].copy_from_slice(&r[..m]);
            return Ok(out);
        }
        // Qualquer outra coisa é notificação assíncrona: ignora.
    }
}

fn feature_index(dev: &HidDevice, idx: u8, id: u16) -> Result<Option<u8>, Fail> {
    let r = request(dev, idx, 0x00, 1, &[(id >> 8) as u8, (id & 0xFF) as u8])?;
    Ok(if r[4] == 0 { None } else { Some(r[4]) })
}

fn device_name(dev: &HidDevice, idx: u8) -> Option<String> {
    let fi = feature_index(dev, idx, 0x0005).ok()??;
    let len = request(dev, idx, fi, 0, &[]).ok()?[4] as usize;
    let mut name: Vec<u8> = Vec::new();
    while name.len() < len {
        let r = request(dev, idx, fi, 1, &[name.len() as u8]).ok()?;
        let take = (len - name.len()).min(16);
        name.extend_from_slice(&r[4..4 + take]);
    }
    let s = String::from_utf8_lossy(&name)
        .trim_matches('\0')
        .trim()
        .to_string();
    if s.is_empty() { None } else { Some(s) }
}

/// Aproximação (Li-ion) de tensão em mV -> % para a feature 0x1001.
fn voltage_to_percent(mv: u16) -> u8 {
    const T: [(u16, u8); 13] = [
        (4186, 100), (4067, 90), (3989, 80), (3922, 70), (3859, 60), (3811, 50),
        (3778, 40), (3751, 30), (3717, 20), (3671, 10), (3646, 5), (3579, 2), (3500, 0),
    ];
    if mv >= T[0].0 {
        return 100;
    }
    for w in T.windows(2) {
        let (hi_v, hi_p) = w[0];
        let (lo_v, lo_p) = w[1];
        if mv >= lo_v {
            let frac = (mv - lo_v) as f32 / (hi_v - lo_v) as f32;
            return (lo_p as f32 + frac * (hi_p - lo_p) as f32).round() as u8;
        }
    }
    0
}

fn read_battery(dev: &HidDevice, idx: u8) -> Option<(u8, bool)> {
    for id in [0x1004u16, 0x1000, 0x1001] {
        match feature_index(dev, idx, id) {
            Ok(Some(fi)) => {
                return match id {
                    0x1004 => {
                        let r = request(dev, idx, fi, 1, &[]).ok()?;
                        let mut pct = r[4];
                        if pct == 0 {
                            // Só níveis aproximados (bitmask): full/good/low/critical
                            pct = match r[5] {
                                x if x & 0x08 != 0 => 100,
                                x if x & 0x04 != 0 => 60,
                                x if x & 0x02 != 0 => 20,
                                x if x & 0x01 != 0 => 5,
                                _ => 0,
                            };
                        }
                        Some((pct, matches!(r[6], 1 | 2)))
                    }
                    0x1000 => {
                        let r = request(dev, idx, fi, 0, &[]).ok()?;
                        Some((r[4], matches!(r[6], 1 | 2 | 4)))
                    }
                    _ => {
                        let r = request(dev, idx, fi, 0, &[]).ok()?;
                        let mv = u16::from_be_bytes([r[4], r[5]]);
                        Some((voltage_to_percent(mv), r[6] & 0x80 != 0))
                    }
                };
            }
            Ok(None) => continue,
            Err(_) => return None, // offline / índice inexistente
        }
    }
    None
}

pub fn read_all(api: &HidApi) -> Vec<Device> {
    let mut out = Vec::new();
    for info in api
        .device_list()
        .filter(|i| i.vendor_id() == VID && is_long_hidpp(i))
    {
        let Ok(dev) = info.open_device(api) else { continue };
        let is_receiver = RECEIVER_PIDS.contains(&info.product_id())
            || info
                .product_string()
                .map_or(false, |s| s.to_lowercase().contains("receiver"));
        let indexes: Vec<u8> = if is_receiver { (1..=6).collect() } else { vec![0xFF] };

        for idx in indexes {
            if let Some((level, charging)) = read_battery(&dev, idx) {
                let name = device_name(&dev, idx)
                    .or_else(|| info.product_string().map(String::from))
                    .unwrap_or_else(|| "Logitech".to_string());
                if !out.iter().any(|d: &Device| d.name == name) {
                    out.push(Device::new(name, level, charging));
                }
            }
        }
    }
    out
}
