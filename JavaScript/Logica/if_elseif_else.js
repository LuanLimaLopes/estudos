/*
 If, else if, else são estruturas de controle de fluxo que 
 executam código baseado em condições (verdadeiro/falso)!


    1. LÓGICA IF, ELSE IF E ELSE
    2. EXEMPLO PRÁTICO (VALIDAÇÃO DE FORM)
    3. FORMA MAIS CURTA (OPERADOR TERNÁRIO)
*/

// 1. LÓGICA IF, ELSE IF E ELSE

const hora2 = 18;

if (hora2 <= 12) {
    console.log("Bom dia!")
    // Executa se for menor ou igual a 12
}
else if (hora2 >= 13 && hora2 <= 18) {
    console.log("Boa tarde!")
    // Executa se for maior ou igual a 13
    // Executa se for menor ou igual a 18
}
else if (hora2 > 18) {
    console.log("Boa noite!")
    // Executa se for maior que 18
}


// 2. EXEMPLO PRÁTICO


// Validação de formulário
function validarLogin(usuario, senha) {
    if (!usuario) {
        return "Usuário é obrigatório";
    } else if (!senha) {
        return "Senha é obrigatória";
    } else if (senha.length < 6) {
        return "Senha deve ter pelo menos 6 caracteres";
    } else {
        return "Login válido";
    }
}

// Verificação de horário
const hora = new Date().getHours();

if (hora < 12) {
    console.log("Bom dia!");
} else if (hora < 18) {
    console.log("Boa tarde!");
} else {
    console.log("Boa noite!");
}

// 3. OPERADOR TERNÁRIO

// Em vez de if/else simples
const status = idade >= 18 ? "Adulto" : "Menor";

// Equivale a:
let status1;
if (idade >= 18) {
    status1 = "Adulto";
} else {
    status1 = "Menor";
}