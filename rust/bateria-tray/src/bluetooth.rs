//! Dispositivos Bluetooth (mouse, fone, teclado...) que o Windows já conhece e que
//! expõem bateria via DEVPKEY_Bluetooth_Battery.

use crate::device::Device;
use windows::core::{GUID, PCWSTR};
use windows::Win32::Devices::DeviceAndDriverInstallation::{
    SetupDiDestroyDeviceInfoList, SetupDiEnumDeviceInfo, SetupDiGetClassDevsW,
    SetupDiGetDevicePropertyW, DIGCF_PRESENT, HDEVINFO, SP_DEVINFO_DATA,
};
use windows::Win32::Devices::Properties::{DEVPROPKEY, DEVPROPTYPE};

// GUID_DEVCLASS_BLUETOOTH
const CLASS_BLUETOOTH: GUID = GUID::from_u128(0xe0cbf06c_cd8b_4647_bb8a_263b43f0f974);

// DEVPKEY_Bluetooth_Battery ({104EA319-6EE2-4701-BD47-8DDBF425BBE5}, 2) -> BYTE 0..100
const KEY_BATTERY: DEVPROPKEY = DEVPROPKEY {
    fmtid: GUID::from_u128(0x104ea319_6ee2_4701_bd47_8ddbf425bbe5),
    pid: 2,
};
// DEVPKEY_Device_FriendlyName / DeviceDesc
const KEY_FRIENDLY: DEVPROPKEY = DEVPROPKEY {
    fmtid: GUID::from_u128(0xa45c254e_df1c_4efd_8020_67d146a850e0),
    pid: 14,
};
const KEY_DESC: DEVPROPKEY = DEVPROPKEY {
    fmtid: GUID::from_u128(0xa45c254e_df1c_4efd_8020_67d146a850e0),
    pid: 2,
};

unsafe fn get_prop(set: HDEVINFO, info: &SP_DEVINFO_DATA, key: &DEVPROPKEY) -> Option<Vec<u8>> {
    let mut ptype = DEVPROPTYPE::default();
    let mut buf = vec![0u8; 512];
    let mut needed = 0u32;
    SetupDiGetDevicePropertyW(
        set,
        info,
        key,
        &mut ptype,
        Some(&mut buf),
        Some(&mut needed),
        0,
    )
    .ok()?;
    buf.truncate(needed as usize);
    Some(buf)
}

fn utf16_to_string(bytes: &[u8]) -> String {
    let units: Vec<u16> = bytes
        .chunks_exact(2)
        .map(|c| u16::from_le_bytes([c[0], c[1]]))
        .take_while(|&u| u != 0)
        .collect();
    String::from_utf16_lossy(&units)
}

pub fn read_all() -> Vec<Device> {
    let mut out: Vec<Device> = Vec::new();
    unsafe {
        let set =
            match SetupDiGetClassDevsW(Some(&CLASS_BLUETOOTH), PCWSTR::null(), None, DIGCF_PRESENT)
            {
                Ok(s) => s,
                Err(_) => return out,
            };

        let mut index = 0u32;
        loop {
            let mut info = SP_DEVINFO_DATA {
                cbSize: std::mem::size_of::<SP_DEVINFO_DATA>() as u32,
                ..Default::default()
            };
            if SetupDiEnumDeviceInfo(set, index, &mut info).is_err() {
                break;
            }
            index += 1;

            let Some(b) = get_prop(set, &info, &KEY_BATTERY) else {
                continue;
            };
            let Some(&level) = b.first() else { continue };
            if level > 100 {
                continue;
            }
            let name = get_prop(set, &info, &KEY_FRIENDLY)
                .or_else(|| get_prop(set, &info, &KEY_DESC))
                .map(|v| utf16_to_string(&v))
                .filter(|s| !s.is_empty())
                .unwrap_or_else(|| "Bluetooth".to_string());

            if !out.iter().any(|d| d.name == name) {
                out.push(Device::new(name, level, false));
            }
        }
        let _ = SetupDiDestroyDeviceInfoList(set);
    }
    out
}
