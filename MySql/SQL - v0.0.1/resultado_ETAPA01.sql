
SELECT 
    ano_nascimento,
    count(*) as quantidade
FROM alunos
GROUP BY ano_nascimento;

Mostra quantidade de ano nascimento

SELECT 
    pais,
   count(*) as quantidade
FROM alunos
GROUP BY pais;

mostra a quantidade de pais

SELECT 
    pais,
    count(*) as quantidade
FROM alunos
GROUP BY pais;

mostra a quantidade de cidades > que 3

SELECT 
    cidade,
    count(*) as quantidade
FROM alunos
GROUP BY cidade
having count(cidade) > 3;

Soma os id e mostra os maiores que 10
SELECT 
    cidade,
    sum(id) as soma
FROM alunos
GROUP BY cidade
having sum(id) > 10;