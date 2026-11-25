//! Iniciar com o Windows (HKCU\...\Run) + preferência do usuário.

use std::io;
use winreg::enums::*;
use winreg::RegKey;

const RUN_KEY: &str = r"Software\Microsoft\Windows\CurrentVersion\Run";
const APP_NAME: &str = "BateriaTray";
const CFG_KEY: &str = r"Software\BateriaTray";

fn hkcu() -> RegKey {
    RegKey::predef(HKEY_CURRENT_USER)
}

pub fn is_enabled() -> bool {
    hkcu()
        .open_subkey(RUN_KEY)
        .and_then(|k| k.get_value::<String, _>(APP_NAME))
        .is_ok()
}

pub fn set_enabled(on: bool) -> io::Result<()> {
    let run = hkcu().open_subkey_with_flags(RUN_KEY, KEY_READ | KEY_WRITE)?;
    if on {
        let exe = std::env::current_exe()?;
        run.set_value(APP_NAME, &format!("\"{}\"", exe.display()))
    } else {
        match run.delete_value(APP_NAME) {
            Err(e) if e.kind() != io::ErrorKind::NotFound => Err(e),
            _ => Ok(()),
        }
    }
}

fn disabled_by_user() -> bool {
    hkcu()
        .open_subkey(CFG_KEY)
        .and_then(|k| k.get_value::<u32, _>("AutostartDisabled"))
        .map_or(false, |v| v == 1)
}

pub fn remember_user_choice(enabled: bool) {
    if let Ok((k, _)) = hkcu().create_subkey(CFG_KEY) {
        let _ = k.set_value("AutostartDisabled", &(if enabled { 0u32 } else { 1u32 }));
    }
}

/// Chamado em toda inicialização: registra (ou atualiza o caminho do .exe) a menos que
/// o usuário tenha desligado a opção pelo menu.
pub fn ensure_on_startup() {
    if !disabled_by_user() {
        let _ = set_enabled(true);
    }
}
