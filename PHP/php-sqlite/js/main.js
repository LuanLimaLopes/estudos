// js/main.js - FRONTEND para registro
const form = document.getElementById('form-hash');

// Função para gerar hash SHA-256
async function gerarHash(texto) {
    const encoder = new TextEncoder();
    const data = encoder.encode(texto);
    const hashBuffer = await crypto.subtle.digest('SHA-256', data);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
    return hashHex;
}

// Só executa se o formulário existir
if (form) {
    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        // Captura os valores dos campos
        const usuario = document.getElementById('input-user').value.trim();
        const email = document.getElementById('input-email').value.trim();
        const senha = document.getElementById('input-password').value;
        const numero = document.getElementById('input-number') ? document.getElementById('input-number').value.trim() : '';

        // Validação básica
        if (!usuario || !email || !senha) {
            alert('⚠️ Por favor, preencha todos os campos obrigatórios!');
            return;
        }

        // Validar email
        if (!email.includes('@')) {
            alert('⚠️ Email inválido!');
            return;
        }

        // Validar senha (mínimo 6 caracteres)
        if (senha.length < 6) {
            alert('⚠️ A senha deve ter no mínimo 6 caracteres!');
            return;
        }

        try {
            // Gera hash da senha
            const senhaHash = await gerarHash(senha);

            console.log('🔐 Hash da senha gerado:', senhaHash);

            // Envia dados para o backend PHP (ajustado para nova estrutura)
            const response = await fetch('../server/registro.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    usuario,
                    email,
                    senhaHash,
                    numero
                })
            });

            const resultado = await response.json();

            if (resultado.sucesso) {
                alert('✅ ' + resultado.mensagem);
                console.log('✅ Usuário cadastrado com ID:', resultado.idUsuario);
                form.reset();

                // Redirecionar para login após 1 segundo
                setTimeout(() => {
                    window.location.href = 'pagina-login.html';
                }, 1000);
            } else {
                alert('❌ ' + resultado.mensagem);
            }

        } catch (erro) {
            console.error('❌ Erro:', erro);
            alert('❌ Erro ao conectar com o servidor. Verifique se o Apache está rodando no XAMPP!');
        }
    });
}