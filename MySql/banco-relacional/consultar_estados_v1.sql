select * from estados

select sigla, nome from estados 
where regiao = 'SUl'

select nome, regiao from estados
where populacao >= 10
order by populacao desc
-- as - fazer um alias de uma tabela
-- Desc -  ordem decrecente
-- where -  filtrar
-- order by -  para colocar em uma ordem especifica 