# Chave primária (PK)
- Única
- Não vazia (not null)
- não muda

Tabela Cliente
| cod | nome | email | cpf |
| --- | ---- | ----- | --- |
| 1   | Ana  | ....  | ... |
| 2   | Bia  | ....  | ... |
| 3   | car  | ....  | ... |
| 4   | Lua  | ....  | ... | -> unica |

Surrogate key - natural key
Coluna unica - constragne unique

| c1  | c2  |
| --- | --- |
| 1   | 1   |
| 2   | 1   |
| 1   | 2   |
| 2   | 2   |