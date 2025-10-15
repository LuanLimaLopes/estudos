// js/login.js - Script para página de login
const formLogin = document.getElementById('form-login');

// Função para gerar hash SHA-256
async function gerarHash(texto) {
    const encoder = new TextEncoder();
    const data = encoder.encode(texto);
    const hashBuffer = await crypto.subtle.digest('SHA-256', data);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
    return hashHex;
}

formLogin.addEventListener('submit', async function (event) {
    event.preventDefault();

    const email = document.getElementById('login-email').value.trim();
    const senha = document.getElementById('login-password').value;

    // Validação básica
    if (!email || !senha) {
        alert('⚠️ Por favor, preencha todos os campos!');
        return;
    }

    try {
        // Gera hash da senha
        const senhaHash = await gerarHash(senha);

        console.log('🔐 Tentando fazer login...');
        console.log('Hash da senha:', senhaHash);

        // Envia dados para o backend PHP (ajustado para nova estrutura)
        const response = await fetch('../server/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email,
                senhaHash
            })
        });

        const resultado = await response.json();

        if (resultado.sucesso) {
            alert('✅ ' + resultado.mensagem);
            console.log('👤 Usuário logado:', resultado.usuario);

            // Salvar dados do usuário na sessão
            sessionStorage.setItem('usuario', JSON.stringify(resultado.usuario));

            // Redirecionar para dashboard
            window.location.href = 'dashboard.html';

        } else {
            alert('❌ ' + resultado.mensagem);
        }

    } catch (erro) {
        console.error('❌ Erro:', erro);
        alert('❌ Erro ao conectar com o servidor. Verifique se o Apache está rodando!');
    }
});