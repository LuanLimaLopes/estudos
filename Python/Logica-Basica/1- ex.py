# Exercício 01 - Lógica básica

nome = input('Digite seu nome: ')
idade_str = (input('Digite sua idade: '))

if not nome or not idade_str:
    print('Desculpe, você deixou campos vazios.')
else:
    idade = int(idade_str)
    print(f'Seu nome é {nome}.')
    print(f'Seu nome invertido é {nome[::-1]}')

    if '' in nome:
        print('Seu nome contém espaços')
    else:
        print('Seu nome não contém espaços')

    print(f'A primeira letra do seu nome é {nome[0]}')
    print(f'A ultima letra do seu nome é {nome[-1]}')

