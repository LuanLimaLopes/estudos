/*
    Objetos em JavaScript são estruturas que armazenam dados em pares chave-valor (como um dicionário).
    É uma das estruturas mais importantes da linguagem!
*/

// OBJ == DICT do py só que com mudanças
// OBJ == CHAVE-VALOR
// OBJ == {nome: "LUAN", idade: 18}


// Literal (mais comum)
const pessoa = {
    nome: "João",
    idade: 25,
    cidade: "São Paulo"
};

// Com construtor
const carro = new Object();
carro.marca = "Toyota";
carro.modelo = "Corolla";


// ACESSANDO PROPRIEDADES  

const usuario = {
    nome: "Ana",
    email: "ana@email.com",
    ativo: true
};

// Notação de ponto
console.log(usuario.nome);    // "Ana"
console.log(usuario.email);   // "ana@email.com"

// Notação de colchetes
console.log(usuario["nome"]); // "Ana"
console.log(usuario["email"]); // "ana@email.com"



// MODIFICANDO OBJETOS


const produto = {
    nome: "Notebook",
    preco: 2500
};

// Alterar propriedade existente
produto.preco = 2300;

// Adicionar nova propriedade
produto.categoria = "Eletrônicos";

// Remover propriedade
delete produto.categoria;

console.log(produto); // { nome: "Notebook", preco: 2300 }


// OBJETOS COM FUNÇÕES


const calculadora = {
    somar: function (a, b) {
        return a + b;
    },

    // Sintaxe mais curta (ES6+)
    subtrair(a, b) {
        return a - b;
    },

    // Arrow function
    multiplicar: (a, b) => a * b
};

console.log(calculadora.somar(5, 3));      // 8
console.log(calculadora.subtrair(10, 4));  // 6
console.log(calculadora.multiplicar(2, 5)) // 10


// OBJETOS ANINHADOS


const empresa = {
    nome: "Tech Corp",
    endereco: {
        rua: "Rua das Flores, 123",
        cidade: "São Paulo",
        cep: "01234-567"
    },
    funcionarios: [
        { nome: "João", cargo: "Dev" },
        { nome: "Maria", cargo: "Designer" }
    ]
};

console.log(empresa.endereco.cidade);           // "São Paulo"
console.log(empresa.funcionarios[0].nome);      // "João"
console.log(empresa.endereco)                   // { rua: 'Rua das Flores, 123', cidade: 'São Paulo', cep: '01234-567' }



// METODOS UTEIS PARA OBJETOS

const config = {
    tema: "dark",
    idioma: "pt-br",
    notificacoes: true
};

// Obter chaves
console.log(Object.keys(config));     // ["tema", "idioma", "notificacoes"]

// Obter valores
console.log(Object.values(config));   // ["dark", "pt-br", true]

// Obter pares chave-valor
console.log(Object.entries(config));  // [["tema", "dark"], ...]




