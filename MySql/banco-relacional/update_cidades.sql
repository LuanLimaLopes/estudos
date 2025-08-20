select * from cidades;
select * from prefeitos;

-- Tive que deletar os prefeitos para alterar os IDS das cidade
-- Foi feito isso pq campinas tinha o id 1 e 2.

delete from prefeitos
where id = 2


update cidades
set id = 4
where id = 5;

UPDATE prefeitos
SET cidade_id = 2
WHERE cidade_id = 3;