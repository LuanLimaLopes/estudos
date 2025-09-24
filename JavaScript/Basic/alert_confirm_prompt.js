// 1. ALERT - Apenas mostra uma mensagem:

javascriptalert("Olá! Esta é uma mensagem de alerta");
alert("Seu cadastro foi realizado com sucesso!");

// Não retorna nada (undefined)
const resultado = alert("Teste");
console.log(resultado); // undefined


// 2. CONFIRM - Pergunta sim / não(OK / Cancelar):

const resposta = confirm("Você tem certeza que deseja sair?");

if (resposta === true) {
    console.log("Usuário clicou OK");
} else {
    console.log("Usuário clicou Cancelar");
}

// Exemplo prático
function sairDoSistema() {
    if (confirm("Deseja realmente sair?")) {
        window.location.href = "login.html";
    }
}


// 3. PROMPT - Solicita uma entrada do usuário:

const nome = prompt("Digite seu nome:");
console.log(nome); // O que o usuário digitou ou null se cancelou

// Com valor padrão
const idade = prompt("Digite sua idade:", "18");


// Exemplo prático
const email = prompt("Digite seu email:");
if (email === null) {
    console.log("Usuário cancelou");
} else if (email === "") {
    console.log("Email vazio");
} else {
    console.log("Email:", email);
}
// Exemplos práticos combinados:
// Calculadora simples
function calculadora() {
    const num1 = parseFloat(prompt("Digite o primeiro número:"));
    const num2 = parseFloat(prompt("Digite o segundo número:"));
    const operacao = prompt("Digite a operação (+, -, *, /):");

    let resultado;

    if (operacao === "+") {
        resultado = num1 + num2;
    } else if (operacao === "-") {
        resultado = num1 - num2;
    } else if (operacao === "*") {
        resultado = num1 * num2;
    } else if (operacao === "/") {
        resultado = num1 / num2;
    } else {
        alert("Operação inválida!");
        return;
    }

    alert(`Resultado: ${resultado}`);
}

// Sistema de login simples
function login() {
    const usuario = prompt("Digite seu usuário:");

    if (usuario === null) {
        alert("Login inválido!");
        return;
    }

    const senha = prompt("Digite sua senha:");

    if (senha === null) {
        alert("Login inválido!");
        return;
    }

    if (usuario === "admin" && senha === "123") {
        alert("Login realizado com sucesso!");
    } else {
        alert("Usuário ou senha incorretos");
    }
}

//Valores de retorno:
// ALERT
alert("Mensagem"); // → undefined

// CONFIRM  
confirm("Pergunta?"); // → true (OK) ou false (Cancelar)

// PROMPT
prompt("Digite algo:");           // → string digitada ou null (Cancelar)
prompt("Digite algo:", "padrão"); // → string digitada ou null (Cancelar)


/*

Limitações e considerações:
Bloqueiam a execução - O código para até o usuário responder
Design feio - Aparência padrão do navegador
Não personalizáveis - Não dá para mudar cores, fontes, etc.
UX ruim - Usuários modernos não gostam dessas caixas

Alternativas modernas:
Em vez de alert/confirm/prompt, use:
 - Modais customizados
 - SweetAlert2
 - Toasts/Notifications
- Formulários inline
Resumo: São úteis para testes rápidos e aprendizado, mas para projetos reais, prefira soluções mais modernas!

*/