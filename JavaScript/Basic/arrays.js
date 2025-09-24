/* 

Array em JavaScript é uma estrutura para armazenar múltiplos valores em uma única variável, como uma "lista"!
Criando arrays:

*/

// Forma literal (mais comum)
const frutas = ["maçã", "banana", "laranja"];
const numeros1 = [1, 2, 3, 4, 5];
const misto = ["texto", 42, true, null];

// Com construtor
const vazio = new Array();
const tamanho = new Array(5); // Array com 5 posições vazias


// Acessando elementos(índice começa em 0):

const cores = ["azul", "verde", "vermelho"];

console.log(cores[0]);  // "azul"
console.log(cores[1]);  // "verde" 
console.log(cores[2]);  // "vermelho"
console.log(cores[3]);  // undefined




const nomes = ["Ana", "Bruno", "Carlos"];

// Tamanho
console.log(nomes.length);  // 3

// Adicionar
nomes.push("Diana");        // Adiciona no final
nomes.unshift("Eduardo");   // Adiciona no início

// Remover
nomes.pop();                // Remove último
nomes.shift();              // Remove primeiro

// Encontrar
console.log(nomes.indexOf("Ana"));     // Posição de "Ana"
console.log(nomes.includes("Bruno"));  // true/false


// Percorrendo Arrays

const numeros2 = [10, 20, 30];

// For tradicional
for (let i = 0; i < numeros2.length; i++) {
    console.log(numeros[i]);
}

// For...of (mais moderno)
for (const numero of numeros2) {
    console.log(numero);
}

// forEach
numeros2.forEach(numero => {
    console.log(numero);
});