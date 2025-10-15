# 🔐 Sistema de Login com PHP + SQLite

Sistema de autenticação completo com registro de usuários, login e hash de senhas usando PHP e SQLite.

---

## 📋 Requisitos

- **XAMPP** (ou qualquer servidor com Apache + PHP 7.0+)
- **Navegador Web** moderno
- **SQLite** habilitado no PHP (geralmente já vem por padrão)

---

## 🚀 Instalação Rápida

### 1️⃣ Clone/Baixe o projeto
Coloque a pasta `php_sqlite` em:
```
C:\xampp\htdocs\php_sqlite\
```

### 2️⃣ Inicie o Apache
- Abra o **XAMPP Control Panel**
- Clique em **Start** no Apache
- ⚠️ **NÃO precisa iniciar o MySQL** (usamos SQLite)

### 3️⃣ Acesse o sistema
```
http://localhost/php_sqlite/teste.php
```

Se tudo estiver ✅ verde, está pronto para usar!

---

## 📁 Estrutura do Projeto

```
php_sqlite/
│
├── 📂 server/              # Backend (APIs PHP)
│   ├── config_sqlite.php   # Configuração do banco
│   ├── registro.php        # API de registro
│   ├── login.php          # API de login
│   └── ver-usuarios.php   # Listar usuários (debug)
│
├── 📂 pages/              # Frontend (páginas HTML)
│   ├── index.html         # Página de registro
│   ├── pagina-login.html  # Página de login
│   └── dashboard.html     # Área logada
│
├── 📂 js/                 # Scripts JavaScript
│   ├── main.js            # Script de registro
│   └── login.js           # Script de login
│
├── 📂 css/                # Estilos
│   └── style.css          # CSS do projeto
│
├── 📂 db/                 # Banco de dados
│   └── hash.db            # SQLite (criado automaticamente)
│
└── 📄 teste.php           # Diagnóstico do sistema
```

---

## 🎯 Como Usar

### 1. Registrar novo usuário
```
http://localhost/php_sqlite/pages/index.html
```
- Preencha: nome, email, senha e número (opcional)
- Clique em **Registrar**
- Será redirecionado para o login

### 2. Fazer login
```
http://localhost/php_sqlite/pages/pagina-login.html
```
- Digite email e senha cadastrados
- Clique em **Entrar**
- Será redirecionado para o dashboard

### 3. Ver área logada
```
http://localhost/php_sqlite/pages/dashboard.html
```
- Visualize seus dados
- Clique em **Sair** para logout

### 4. Ver usuários cadastrados (Debug)
```
http://localhost/php_sqlite/server/ver-usuarios.php
```
- Retorna JSON com todos os usuários (sem senhas)

---

## 🔒 Segurança

✅ **Senhas em hash SHA-256** - Nunca armazenadas em texto plano  
✅ **Prepared Statements** - Proteção contra SQL Injection  
✅ **Validação de email** - No frontend e backend  
✅ **CORS configurado** - Para requisições AJAX  
✅ **SessionStorage** - Gerenciamento de sessão no cliente  

---

## 🐛 Solução de Problemas

### ❌ Apache não inicia (Porta 80 ocupada)
**Solução 1:** Desabilitar IIS
1. `Windows + R` → `services.msc`
2. Procure "World Wide Web Publishing Service"
3. Parar → Desabilitar

**Solução 2:** Mudar porta do Apache
1. Edite `C:\xampp\apache\conf\httpd.conf`
2. Mude `Listen 80` para `Listen 8080`
3. Acesse: `http://localhost:8080/php_sqlite/...`

### ❌ Erro "SQLite not available"
1. Edite `C:\xampp\php\php.ini`
2. Procure `;extension=pdo_sqlite`
3. Remova o `;` → `extension=pdo_sqlite`
4. Reinicie o Apache

### ❌ Erro "is not valid JSON"
Execute o diagnóstico:
```
http://localhost/php_sqlite/teste.php
```
Ele mostrará exatamente qual é o problema.

---

## 🎓 Tecnologias Utilizadas

- **Backend:** PHP 7.0+
- **Banco de Dados:** SQLite 3
- **Frontend:** HTML5, CSS3, JavaScript (ES6+)
- **API:** RESTful JSON
- **Criptografia:** SHA-256 (Web Crypto API)

---

## 📊 Banco de Dados

### Tabela: `usuario`

| Campo           | Tipo     | Descrição                     |
| --------------- | -------- | ----------------------------- |
| `id`            | INTEGER  | ID único (auto-incremento)    |
| `nome`          | TEXT     | Nome do usuário               |
| `email`         | TEXT     | Email (único)                 |
| `senhahash`     | TEXT     | Hash SHA-256 da senha         |
| `numero`        | TEXT     | Número de telefone (opcional) |
| `data_cadastro` | DATETIME | Data/hora do cadastro         |

**Localização:** `php_sqlite/db/hash.db`

---

## 📝 Fluxo do Sistema

```
1. REGISTRO
   └─→ pages/index.html
       └─→ js/main.js (gera hash SHA-256)
           └─→ server/registro.php
               └─→ db/hash.db (salva usuário)

2. LOGIN
   └─→ pages/pagina-login.html
       └─→ js/login.js (gera hash SHA-256)
           └─→ server/login.php
               └─→ db/hash.db (valida credenciais)
                   └─→ sessionStorage (salva sessão)

3. DASHBOARD
   └─→ pages/dashboard.html
       └─→ Verifica sessionStorage
           └─→ Exibe dados do usuário
```

---


**Desenvolvido para fins educacionais** 🎓  
**Versão:** 1.0  
**Data:** 2025