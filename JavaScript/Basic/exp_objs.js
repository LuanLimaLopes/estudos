// Exemplo prático - Validação de formulário:
// Resumo: Objetos são estruturas flexíveis que agrupam dados relacionados e comportamentos (métodos). São fundamentais no JavaScript! 

const usuario = {
    nome: "",
    email: "",
    idade: 0,

    validar() {
        if (!this.nome) return "Nome é obrigatório";
        if (!this.email) return "Email é obrigatório";
        if (this.idade < 18) return "Deve ser maior de idade";
        return "Válido";
    },

    salvar() {
        const validacao = this.validar();
        if (validacao === "Válido") {
            console.log("Usuário salvo:", this);
        } else {
            console.log("Erro:", validacao);
        }
    }
};