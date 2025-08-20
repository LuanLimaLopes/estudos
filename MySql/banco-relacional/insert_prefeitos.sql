select * from prefeitos;

-- Tive que atualizar os ids dos prefeitos por conta que eu tive que deletar eles para alterar
-- os Ids das cidades no banco de dados cidades e não foi possível fazer diretamente isso lá na tabela cidades,
-- pq eles estavam relacionados com a tabela prefeitos, por conta do cidade_id.


update prefeitos
set id = 1
where id = 6;

update prefeitos
set id = 2
where id = 7;



INSERT INTO prefeitos (nome, cidade_id)
VALUES
    ('Rodrigo Neves', 2),
    ('Raquel Lyra', 3);

INSERT INTO prefeitos (nome, cidade_id)
VALUES
    ('Rafael Greca', null);

-- ENTRADA DUPLICADA (ERR0)
-- Por quê, cidade_id é unique
INSERT INTO prefeitos(nome, cidade_id)
VALUES
    ('Rodrigo Pinheiro', 3);