// 1. Function declaration (Mais tradicional).
//

function saudacao(nome) {
    return "Olá, " + nome + "!";
}

// Chamar a função
console.log(saudacao("João"));  // "Olá, João!"


// 2. Function expression.
//


const saudacao = function (nome) {
    return "Olá, " + nome + "!";
};


// 3. Arrow Function (Mais moderno).
//

const saudacao = (nome) => {
    return "Olá, " + nome + "!";
};

// Versão mais curta (quando tem só uma linha)
const saudacao = nome => "Olá, " + nome + "!";


// Anatomia de uma função.


function calcular(a, b) {    // ← nome e parâmetros
    const resultado = a + b; // ← corpo da função
    return resultado;        // ← retorna um valor
}

const soma = calcular(5, 3); // ← chamada da função
console.log(soma);           // 8



// Funções sem retorno.

function mostrarMensagem(texto) {
    console.log(texto);
    // Sem return - retorna undefined automaticamente
}

mostrarMensagem("Hello World!");


// Parametros e argumentos.


function apresentar(nome, idade = 18) {  // idade tem valor padrão
    console.log(`Meu nome é ${nome} e tenho ${idade} anos`);
}

apresentar("Ana");        // "Meu nome é Ana e tenho 18 anos"
apresentar("Bruno", 25);  // "Meu nome é Bruno e tenho 25 anos"