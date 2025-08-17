# Modelo E/R
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