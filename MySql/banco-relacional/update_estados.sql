update estados
set nome = 'Maranhão'
WHERE sigla = 'MA'

select nome from estados where sigla = 'MA'

update estados
set nome = 'Paraná', populacao = 11.32
where sigla = 'PR'

select 
    nome, 
    sigla, 
    populacao 
from estados 
where sigla = 'PR'