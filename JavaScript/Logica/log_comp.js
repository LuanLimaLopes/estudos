/*
    1. OPERADORES DE COMPARAÇÃO
    2. OPERADORES LÓGICOS
    3. VALORES "FALSY" E "TRUTHY"

*/



// 1. OPERADORES DE COMPARAÇÃO

/*
const a = 10;
const b = 20;

if (a == b)   // Igualdade (converte tipos)
if (a === b)  // Igualdade estrita (tipos iguais)
if (a != b)   // Diferente
if (a !== b)  // Diferente estrito
if (a > b)    // Maior que
if (a < b)    // Menor que  
if (a >= b)   // Maior ou igual
if (a <= b)   // Menor ou igual
*/



// 2. OPERADORES LÓGICOS

const idade = 25;
const temCarteira = true;

// AND (&&) - AMBAS devem ser verdadeiras
if (idade >= 18 && temCarteira) {
    console.log("Pode dirigir");
}

// OR (||) - PELO MENOS UMA deve ser verdadeira
if (idade < 18 || !temCarteira) {
    console.log("Não pode dirigir");
}

// NOT (!) - Inverte o valor
if (!temCarteira) {
    console.log("Precisa tirar carteira");
}


// 3. VALORES TRUTHY

// Valores "falsy" (considerados false)


if (false) { }      // false
if (0) { }          // 0
if ("") { }         // string vazia
if (null) { }       // null
if (undefined) { }  // undefined
if (NaN) { }        // Not a Number


// Valores "truthy" (considerados true)
if (true) { }       // true
if (1) { }          // qualquer número diferente de 0
if ("texto") { }    // string com conteúdo
if ([]) { }         // array (mesmo vazio)
if ({}) { }         // objeto (mesmo vazio)