# bateria-tray

Ícone na bandeja do Windows. Passe o mouse para ver a bateria de mouse/fone/teclado.

## Gerar o .exe

**Opção A – no seu PC (precisa do Rust + "Build Tools do Visual Studio" com C++):**

    cargo build --release

O executável fica em `target\release\bateria-tray.exe` (único arquivo, sem instalador, sem dependências).

**Opção B – sem instalar nada:** suba esta pasta para um repositório no GitHub; a aba *Actions*
compila e disponibiliza o `bateria-tray.exe` como artefato.

## Iniciar com o Windows

Automático: na primeira execução ele se registra em `HKCU\...\Run`. Para desligar, botão direito no
ícone → desmarque **Iniciar com o Windows** (a escolha é lembrada). Se mover o .exe de pasta, basta
abri-lo uma vez para atualizar o caminho.

## Fontes de bateria

| Fonte | Como |
|---|---|
| Bluetooth (mouse, fone, teclado) | propriedade de bateria do Windows |
| Logitech (Unifying, Bolt, Lightspeed) | HID++ 2.0 |
| Razer com dongle | protocolo de 90 bytes (OpenRazer) |
| Attack Shark e outras marcas | ainda não — veja abaixo |

Para marcas novas: menu → **Salvar lista de dispositivos HID** gera `bateria-tray-dispositivos.txt`
em `%USERPROFILE%` com VID:PID de tudo que está conectado.
