-- usando where para filtar e from com as 2 tabelas
select 
    e.nome as estado,
    c.nome as cidade,
    regiao as Região
from estados e, cidades c 
where e.id = c.estado_id;

-- usando inner join para juntar colunas
select 
    c.nome as cidade,
    e.nome as estado,
    regiao as região
from estados e 
inner join cidades c on e.id = c.estado_id