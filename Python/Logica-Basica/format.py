nome = 'luan'
idade = 20
altura = 1.80

print('Meu nome é {}, minha idade é {}, minha altura é {:.2f}'.format(nome, idade, altura))

string = 'nome: {let1}, idade: {let2}, altura: {let3:.2f}'
formato = string.format(
    let1='Luan', let2=20, let3=1.80
)

print(formato)