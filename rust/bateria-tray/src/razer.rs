//! Razer (dongles/mouses sem fio) via protocolo de relatórios de 90 bytes do OpenRazer:
//! classe 0x07, comando 0x80 = nível de bateria (0..255), 0x84 = status de carga.

use crate::device::Device;
use hidapi::{HidApi, HidDevice};
use std::{thread, time::Duration};

const VID: u16 = 0x1532;
// Cada família usa um transaction_id diferente; tentamos os conhecidos.
const TRANSACTION_IDS: [u8; 4] = [0x1F, 0xFF, 0x3F, 0x9F];

fn query(dev: &HidDevice, tid: u8, class: u8, id: u8) -> Option<[u8; 91]> {
    let mut req = [0u8; 91]; // [0] = report id 0; mensagem de 90 bytes a partir de [1]
    req[2] = tid;
    req[6] = 0x02; // data_size
    req[7] = class;
    req[8] = id;
    let mut crc = 0u8;
    for b in &req[3..89] {
        crc ^= *b;
    }
    req[89] = crc;

    dev.send_feature_report(&req).ok()?;
    thread::sleep(Duration::from_millis(45));

    let mut resp = [0u8; 91];
    dev.get_feature_report(&mut resp).ok()?;
    if resp[1] == 0x02 { Some(resp) } else { None } // 0x02 = sucesso
}

pub fn read_all(api: &HidApi) -> Vec<Device> {
    let mut out: Vec<Device> = Vec::new();
    let mut done_pids: Vec<u16> = Vec::new();

    for info in api
        .device_list()
        .filter(|i| i.vendor_id() == VID && i.interface_number() <= 0)
    {
        if done_pids.contains(&info.product_id()) {
            continue;
        }
        let Ok(dev) = info.open_device(api) else { continue };

        for tid in TRANSACTION_IDS {
            let Some(r) = query(&dev, tid, 0x07, 0x80) else { continue };
            let level = ((r[10] as u32 * 100 + 127) / 255) as u8;
            let charging = query(&dev, tid, 0x07, 0x84).map_or(false, |c| c[10] == 1);
            let name = info
                .product_string()
                .map(String::from)
                .unwrap_or_else(|| "Razer".to_string());
            if !out.iter().any(|d| d.name == name) {
                out.push(Device::new(name, level, charging));
            }
            done_pids.push(info.product_id());
            break;
        }
    }
    out
}
