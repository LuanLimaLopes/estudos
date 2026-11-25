#[derive(Clone, Debug)]
pub struct Device {
    pub name: String,
    pub level: u8,
    pub charging: bool,
}

impl Device {
    pub fn new(name: impl Into<String>, level: u8, charging: bool) -> Self {
        Self {
            name: name.into(),
            level: level.min(100),
            charging,
        }
    }
}
