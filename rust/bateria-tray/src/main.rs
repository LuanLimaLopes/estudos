// Sem janela de console.
#![windows_subsystem = "windows"]

mod autostart;
mod bluetooth;
mod device;
mod logitech;
mod razer;

use std::sync::mpsc::{self, RecvTimeoutError};
use std::{thread, time::Duration};

use hidapi::HidApi;
use tao::event::Event;
use tao::event_loop::{ControlFlow, EventLoopBuilder};
use tray_icon::menu::{CheckMenuItem, Menu, MenuEvent, MenuItem, PredefinedMenuItem};
use tray_icon::{Icon, TrayIconBuilder};
use windows::core::w;
use windows::Win32::Foundation::{GetLastError, ERROR_ALREADY_EXISTS};
use windows::Win32::System::Threading::CreateMutexW;

use device::Device;

enum UserEvent {
    Devices(Vec<Device>),
    Menu(MenuEvent),
}

fn tooltip_text(devs: &[Device]) -> String {
    if devs.is_empty() {
        return "Nenhum dispositivo com bateria encontrado".to_string();
    }
    let mut s = String::new();
    for d in devs {
        if !s.is_empty() {
            s.push('\n');
        }
        s.push_str(&format!(
            "{}: {}%{}",
            d.name,
            d.level,
            if d.charging { " ⚡" } else { "" }
        ));
    }
    // O Windows limita o tooltip a 127 caracteres UTF-16.
    if s.encode_utf16().count() > 125 {
        let cut: String = s.chars().take(122).collect();
        s = format!("{cut}...");
    }
    s
}

fn make_icon(min_level: Option<u8>) -> Icon {
    const W: usize = 32;
    const H: usize = 32;
    let mut px = vec![0u8; W * H * 4];
    let mut put = |x: usize, y: usize, c: [u8; 4]| {
        let i = (y * W + x) * 4;
        px[i..i + 4].copy_from_slice(&c);
    };
    let (fill, pct) = match min_level {
        Some(l) if l <= 20 => ([220, 50, 47, 255], l),
        Some(l) if l <= 50 => ([240, 180, 0, 255], l),
        Some(l) => ([60, 190, 90, 255], l),
        None => ([140, 140, 140, 255], 0),
    };
    let border = [235, 235, 235, 255];
    for y in 8..24 {
        for x in 3..27 {
            if x < 5 || x >= 25 || y < 10 || y >= 22 {
                put(x, y, border);
            }
        }
    }
    for y in 12..20 {
        for x in 27..30 {
            put(x, y, border);
        }
    }
    let filled = (20 * pct as usize) / 100;
    let filled = if min_level.is_some() { filled.max(1) } else { 0 };
    for y in 10..22 {
        for x in 5..(5 + filled) {
            put(x, y, fill);
        }
    }
    Icon::from_rgba(px, W as u32, H as u32).expect("ícone inválido")
}

/// Salva a lista de interfaces HID (VID:PID, usage...) para diagnóstico/suporte a novas marcas.
fn dump_hid_list() {
    let Ok(api) = HidApi::new() else { return };
    let mut txt = String::from("VID:PID  usage_page:usage  interface  fabricante / produto\n");
    for i in api.device_list() {
        txt.push_str(&format!(
            "{:04X}:{:04X}  {:04X}:{:04X}  {}  {} / {}\n",
            i.vendor_id(),
            i.product_id(),
            i.usage_page(),
            i.usage(),
            i.interface_number(),
            i.manufacturer_string().unwrap_or("?"),
            i.product_string().unwrap_or("?"),
        ));
    }
    let dir = std::env::var("USERPROFILE").unwrap_or_else(|_| ".".into());
    let path = format!("{dir}\\bateria-tray-dispositivos.txt");
    if std::fs::write(&path, txt).is_ok() {
        let _ = std::process::Command::new("notepad").arg(&path).spawn();
    }
}

fn collect(api: &mut Option<HidApi>) -> Vec<Device> {
    let mut devs = bluetooth::read_all();
    match api {
        Some(a) => {
            let _ = a.refresh_devices();
            devs.extend(logitech::read_all(a));
            devs.extend(razer::read_all(a));
        }
        None => *api = HidApi::new().ok(),
    }
    let mut unique: Vec<Device> = Vec::new();
    for d in devs {
        if !unique.iter().any(|u| u.name.eq_ignore_ascii_case(&d.name)) {
            unique.push(d);
        }
    }
    unique.sort_by(|a, b| a.name.cmp(&b.name));
    unique
}

fn main() {
    // Instância única (evita ícones duplicados se abrir manualmente após o autostart).
    unsafe {
        let m = CreateMutexW(None, true, w!("Local\\BateriaTrayMutex"));
        if m.is_err() || GetLastError() == ERROR_ALREADY_EXISTS {
            return;
        }
    }

    autostart::ensure_on_startup();

    let event_loop = EventLoopBuilder::<UserEvent>::with_user_event().build();
    let proxy = event_loop.create_proxy();

    let refresh_item = MenuItem::new("Atualizar agora", true, None);
    let autostart_item = CheckMenuItem::new("Iniciar com o Windows", true, autostart::is_enabled(), None);
    let hid_item = MenuItem::new("Salvar lista de dispositivos HID", true, None);
    let quit_item = MenuItem::new("Sair", true, None);
    let refresh_id = refresh_item.id().clone();
    let autostart_id = autostart_item.id().clone();
    let hid_id = hid_item.id().clone();
    let quit_id = quit_item.id().clone();

    let menu = Menu::new();
    let _ = menu.append(&refresh_item);
    let _ = menu.append(&autostart_item);
    let _ = menu.append(&hid_item);
    let _ = menu.append(&PredefinedMenuItem::separator());
    let _ = menu.append(&quit_item);

    let tray = TrayIconBuilder::new()
        .with_menu(Box::new(menu))
        .with_tooltip("Lendo baterias...")
        .with_icon(make_icon(None))
        .build()
        .expect("falha ao criar o ícone da bandeja");

    {
        let p = proxy.clone();
        MenuEvent::set_event_handler(Some(move |e| {
            let _ = p.send_event(UserEvent::Menu(e));
        }));
    }

    // Thread de leitura: a sondagem HID pode demorar, então nunca roda na thread da interface.
    let (refresh_tx, refresh_rx) = mpsc::channel::<()>();
    {
        let p = proxy.clone();
        thread::spawn(move || {
            let mut api = HidApi::new().ok();
            loop {
                let devs = collect(&mut api);
                if p.send_event(UserEvent::Devices(devs)).is_err() {
                    break;
                }
                match refresh_rx.recv_timeout(Duration::from_secs(60)) {
                    Ok(_) => while refresh_rx.try_recv().is_ok() {},
                    Err(RecvTimeoutError::Timeout) => {}
                    Err(RecvTimeoutError::Disconnected) => break,
                }
            }
        });
    }

    event_loop.run(move |event, _, control_flow| {
        *control_flow = ControlFlow::Wait;
        match event {
            Event::UserEvent(UserEvent::Devices(devs)) => {
                let _ = tray.set_tooltip(Some(tooltip_text(&devs)));
                let min = devs.iter().map(|d| d.level).min();
                let _ = tray.set_icon(Some(make_icon(min)));
            }
            Event::UserEvent(UserEvent::Menu(e)) => {
                if e.id == quit_id {
                    *control_flow = ControlFlow::Exit;
                } else if e.id == refresh_id {
                    let _ = refresh_tx.send(());
                } else if e.id == autostart_id {
                    let on = autostart_item.is_checked();
                    let _ = autostart::set_enabled(on);
                    autostart::remember_user_choice(on);
                } else if e.id == hid_id {
                    thread::spawn(dump_hid_list);
                }
            }
            _ => {}
        }
    });
}
