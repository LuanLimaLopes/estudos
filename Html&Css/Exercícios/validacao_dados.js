function inicializarFoco() {
    document.frm_clientes.txtnome.focus();
}

function LengthName() {
    var nome = document.frm_clientes.txtnome.value;
    tamanho = nome.length;
    if (tamanho < 9) {
        alert("O nome informado possui menos de 9 caracteres!");
        inicializarFoco();
    }
}

function CampoName() {
    var nome = document.frm_clientes.txtnome.value;
    document.frm_clientes.txtnome.value = nome.toUpperCase();
}

function VerificaNumeros(event) {
    // Pega o código da tecla pressionada
    var tecla = event.keyCode || event.which;

    // Permite teclas especiais (backspace, delete, tab, etc.)
    if (tecla == 8 || tecla == 9 || tecla == 46 || tecla == 37 || tecla == 39) {
        return true;
    }

    // Verifica se é número (ASCII 48-57 = 0-9)
    if (tecla < 48 || tecla > 57) {
        // Mostra erro visual também
        document.getElementById('erro-cpf').innerHTML = 'Caractere inválido! Digite somente números.';

        // Remove a mensagem após 3 segundos
        setTimeout(function () {
            document.getElementById('erro-cpf').innerHTML = '';
        }, 3000);

        alert("Caractere inválido! Digite somente números.");
        return false;
    }

    // Limpa mensagem de erro se estava mostrando
    document.getElementById('erro-cpf').innerHTML = '';
    return true;
}