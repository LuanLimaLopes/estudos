# SQL
- DML == data manipulation language > CRUD > insert, select, update e delete

- DDL == data definition language > create, alter, drop, truncate, rename
  
- DCL == data control language > grant, deny, revoke
  
- TCL == transaction control language > commit, rollback, begin

| DML | DDL |
| --- | --- |
| DCL | TCL |
  
## Modelo E/R
- Entidade e relacionamento

## Linha / Tupla
| marc | modelo | ano  | chasi |
| ---- | ------ | ---- | ----- |
| fiat | uno    | 2018 | ...   | <- Tupla |

- varchar (conjunto variado de caracteres)
blob , clob
Bancos normalmente armazenam até 8000 caractêres


| Produto   | --------   | Cliente  |
| --------- | ---------- | -------- |
| PS4       | ---------- | João     |
| --------- | Pedido     | -------- |


Mae                   Filho
| cod(PK) | mae | ------- | cod(PK) | filho | mae_cd(FK) |
| ------- | --- | ------- | ------- | ----- | ---------- |
| 1       | ana | ------> | 1       | joão  | 1          |
| 2       | bia | ------> | 2       | gui   | 2          |

## 1-N, 1-1 e N-N
- 1-n um para muitos
- 1 para 1
- muitos para muitos (Tabela mediadora)
exemplo: tabela tio e sobrinho tabela mediadora tioid e sobrinho id
recebendo id da tabela tio e id da tabela sobrinho


estados 1-n Cidades
cidades 1-1 prefeitos

empresas n-n cidades
 
empresas 1-n cid_emp
cidades 1-n cid emp