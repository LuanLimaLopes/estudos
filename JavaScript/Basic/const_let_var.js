const teste = 'Teste';

const pessoa = { nome: "João", idade: 25 };
pessoa.idade = 26;    // ✅ Funciona! (mudou propriedade)
pessoa.nome = "José"; // ✅ Funciona!

// Mas isso não:
pessoa = {};  // ❌ ERRO! Não pode reatribuir

const numeros = [1, 2, 3];
numeros.push(4);     // ✅ Funciona! [1, 2, 3, 4]
numeros = [5, 6, 7]; // ❌ ERRO! Não pode reatribuir


/*
Quando usar:

Valores que não mudam: const PI = 3.14159
Funções: const minhaFuncao = () => {}
Elementos DOM: const botao = document.getElementById('btn')
Arrays/objetos: const lista = [] (conteúdo pode mudar)

*/

var x = 1;    // Escopo global/função, pode reatribuir
let y = 2;    // Escopo de bloco, pode reatribuir  
const z = 3;  // Escopo de bloco, NÃO pode reatribuir

// Boa prática: Use const por padrão, let quando precisar reatribuir, evite var! 