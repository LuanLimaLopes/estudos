# Tipos de joins

## Inner Join
```sql
SELECT *
FROM TabelaA
INNER JOIN TabelaB ON TabelaA.id = TabelaB.id;
```
- Retorna apenas os registros que possuem correspondência entre as tabelas (chave primária ↔ chave estrangeira).
- Exclui registros sem relação.

## Left Join (Ou Left Outer Join)
```sql 
SELECT *
FROM TabelaA
LEFT JOIN TabelaB ON TabelaA.id = TabelaB.id;
```
- Retorna todos os registros da Tabela B, mesmo que não tenham correspondência na Tabela A.
- Onde não houver correspondência, os valores da Tabela A serão NULL.


## Right join
```sql
SELECT *
FROM TabelaA
RIGHT JOIN TabelaB ON TabelaA.id = TabelaB.id;
```
- Retorna todos os registros da Tabela B, mesmo que não tenham correspondência na Tabela A. 
- Onde não houver correspondência, os valores da Tabela A serão NULL.
  
## Full join
```sql
SELECT *
FROM TabelaA
FULL JOIN TabelaB ON TabelaA.id = TabelaB.id;
```
- Retorna todos os registros das duas tabelas, sejam eles correspondentes ou não.
- Onde não houver correspondência, os valores da tabela sem relação serão NULL.
- Não suportado nativamente no MySQL.
- Alternativa: usar UNION entre LEFT JOIN e RIGHT JOIN.
