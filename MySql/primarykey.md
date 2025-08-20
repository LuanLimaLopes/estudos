# 🔑 Chaves em Bancos de Dados Relacionais

## 📌 Chave Primária (Primary Key - PK)
- **Identificador único** de cada registro na tabela.  
- **Não pode ser nula** (`NOT NULL`).  
- **Imutável** (não deve sofrer alterações ao longo do tempo).  
- Apenas **uma chave primária por tabela**, mas pode ser **composta** (usando mais de uma coluna).  
- Índice é criado automaticamente pelo SGBD.  

### Exemplo – Tabela Cliente
| cod (PK) | nome | email         | cpf            |
| -------- | ---- | ------------- | -------------- |
| 1        | Ana  | ana@email.com | 111.111.111-11 |
| 2        | Bia  | bia@email.com | 222.222.222-22 |
| 3        | Car  | car@email.com | 333.333.333-33 |
| 4        | Lua  | lua@email.com | 444.444.444-44 |

> Aqui, `cod` é a **chave primária**, garantindo unicidade.

---

## 📌 Surrogate Key vs Natural Key
- **Surrogate Key**  
  - Chave **artificial** criada pelo sistema (ex.: `id AUTO_INCREMENT`).  
  - Não possui significado de negócio.  
  - Exemplo: coluna `id_cliente` numérica.  

- **Natural Key**  
  - Chave formada por um **atributo do próprio negócio**.  
  - Exemplo: CPF, CNPJ, número do RG, matrícula do aluno.  
  - Pode sofrer alterações (risco em alguns cenários).  

---

## 📌 Coluna Única (Unique Constraint)
- Garante que os valores de uma coluna (ou combinação de colunas) sejam **únicos**, mas **permite valores nulos**.  
- Pode haver várias `UNIQUE` em uma tabela, diferente da `PRIMARY KEY`.  

### Exemplo
```sql
CREATE TABLE exemplo (
    c1 INT,
    c2 INT,
    CONSTRAINT uq_exemplo UNIQUE (c1, c2)
);