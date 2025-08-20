ALTER TABLE empresas MODIFY cnpj VARCHAR(14);

INSERT INTO empresas (nome, cnpj)
VALUES
    ('Bradesco', 12345678910124 ),
    ('Vale', 12345678910123),
    ('Cielo', 12345678910122);


-- Descreve a tabela 
desc empresas;
desc prefeitos;
select * from empresas;
select * from cidades;


INSERT INTO empresas_unidades
    (empresa_id, cidade_id, sede)
VALUES
    (1, 1, 1),
    (1, 2, 0),
    (2, 1, 0),
    (2, 2, 1);


