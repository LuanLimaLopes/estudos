'''
Fatiamento de strings

012345678
Olá mundo


fatiamento [i:f:p][::] Inicio, final, passo


'''

var = 'Olá mundo'

print(f'1- {var[0:5]}')
print(f'2- {var[4:6]}')
print(f'3- {var[4:]}')
print(f'4- {var[::-1]}')
print(f'5- {var[0:9:2]}')
print(f'6- {len(var)}')