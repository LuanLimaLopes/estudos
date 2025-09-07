nome = 'luan'
idade = 20
altura = 1.84

# Interpolação com Fstring

print(f'1- Meu nome é {nome}, minha idade é {idade} e minha altura é {altura}')


# Interpolação com format



print('2- Meu nome é {}, minha idade é {}, minha altura é {:.2f}'.format(nome, idade, altura))

string = '3- Nome: {let1}, idade: {let2}, altura: {let3:.2f}'
formato = string.format(
    let1='Luan', let2=20, let3=1.80
)

print(formato)

#interpolação básica de strings

# % S - STRING
# % d e i - INT
# % f - FLOAT
# % x e X - HEXADECIMAL
frase = "4- Meu nome é %s, minha idade é %i e minha altura é %f" % (nome, idade, altura)
print(frase)