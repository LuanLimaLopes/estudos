# Interpolação com fstring


nome = 'luan'
idade = '18'
altura = 1.80
var = 'ABC'

print(f'Meu nome é {nome} e minha idade é {idade}')
print(f'Minha altura é {altura:.2f}') 


#Padding
# conversion flags - !r !s !a __repr__ __str__ __ask__

print(f'1- {var}.')
print(f'2- {var: >10}.')
print(f'3- {var: <10}.')
print(f'4- {var: ^10}.')
print(f'5- {100.445455486:.1f}')
print(f'6- O hexadecimal de 1500 é {1500:08X}')
