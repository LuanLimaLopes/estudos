-- Por região
SELECT 
    regiao as 'Região',
    sum(populacao) as Total
from estados
GROUP BY regiao
ORDER BY Total desc

-- Menor população
select 
    avg(populacao) as Total
from estados

-- Total
select sum(populacao) as Total
from `estados`