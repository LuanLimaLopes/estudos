# 🗄️ SQL – Structured Query Language

SQL é dividido em subconjuntos de linguagens, cada um com um propósito específico:

---

## 📌 DML – Data Manipulation Language
Usada para **manipular dados** dentro das tabelas (CRUD).  
- **INSERT** → insere registros.  
- **SELECT** → consulta registros.  
- **UPDATE** → atualiza registros existentes.  
- **DELETE** → exclui registros.  

---

## 📌 DDL – Data Definition Language
Usada para **definir a estrutura** do banco de dados.  
- **CREATE** → cria objetos (tabelas, índices, views, schemas).  
- **ALTER** → altera a estrutura de objetos.  
- **DROP** → remove objetos do banco.  
- **TRUNCATE** → apaga todos os registros de uma tabela (sem log de transação detalhado).  
- **RENAME** → renomeia objetos.  

---

## 📌 DCL – Data Control Language
Usada para **controle de permissões e segurança**.  
- **GRANT** → concede privilégios.  
- **REVOKE** → revoga privilégios.  
- **DENY** (SQL Server) → nega explicitamente acesso.  

---

## 📌 TCL – Transaction Control Language
Usada para **gerenciar transações** (consistência ACID).  
- **BEGIN / START TRANSACTION** → inicia uma transação.  
- **COMMIT** → confirma (grava) as alterações.  
- **ROLLBACK** → desfaz alterações.  
- **SAVEPOINT** → cria pontos de recuperação dentro de uma transação.  

---

## 📌 Tabela comparativa
| Categoria | Exemplos de Comandos                  |
| --------- | ------------------------------------- |
| **DML**   | INSERT, SELECT, UPDATE, DELETE        |
| **DDL**   | CREATE, ALTER, DROP, TRUNCATE, RENAME |
| **DCL**   | GRANT, REVOKE, DENY                   |
| **TCL**   | BEGIN, COMMIT, ROLLBACK, SAVEPOINT    |

---

# 📊 Modelo Entidade-Relacionamento (E/R)
Representa graficamente as entidades (tabelas) e seus relacionamentos.

### Exemplo de Tupla (Linha da Tabela)
| marca | modelo | ano  | chassi |
| ----- | ------ | ---- | ------ |
| Fiat  | Uno    | 2018 | ...    | ← **Tupla (registro)** |

---

## 📌 Tipos de Dados
- **VARCHAR(n)** → Cadeia de caracteres de tamanho variável.  
- **CHAR(n)** → Cadeia de caracteres de tamanho fixo.  
- **BLOB (Binary Large Object)** → Dados binários (imagens, arquivos).  
- **CLOB (Character Large Object)** → Texto de grande volume.  

> Bancos SQL costumam ter limite em torno de **8000 caracteres** para campos comuns (pode variar conforme o SGBD).

---

## 📌 Exemplo de Relacionamento
### Entidade Mãe – Filho (1:N)
| cod (PK) | mae |      | cod (PK) | filho | mae_cod (FK) |
| -------- | --- | ---- | -------- | ----- | ------------ |
| 1        | Ana | ---> | 1        | João  | 1            |
| 2        | Bia | ---> | 2        | Gui   | 2            |

- Cada **mãe** pode ter **vários filhos**.  
- A chave estrangeira (**FK**) referencia a chave primária da entidade mãe.  

---

# 🔗 Relacionamentos (Cardinalidade)

## 1. **1:N (Um para Muitos)**
- Uma entidade se relaciona com **várias instâncias** de outra.  
- Exemplo:  
  - **Estados 1–N Cidades** → um estado possui várias cidades.  

---

## 2. **1:1 (Um para Um)**
- Uma entidade só se relaciona com **uma instância** de outra.  
- Exemplo:  
  - **Cidade 1–1 Prefeito** → cada cidade tem apenas um prefeito.  

---

## 3. **N:N (Muitos para Muitos)**
- Uma entidade pode se relacionar com **muitas instâncias** da outra e vice-versa.  
- Exige **tabela mediadora** contendo as FKs.  
- Exemplo:  
  - **Empresas N–N Cidades** →  
    Criamos a tabela `empresas_cidades` com `empresa_id (FK)` e `cidade_id (FK)`.

---

## 📌 Resumindo
- **DML** → Manipulação de dados.  
- **DDL** → Estrutura do banco.  
- **DCL** → Controle de acesso.  
- **TCL** → Transações.  
- **E/R** → Modela entidades e relacionamentos (1:1, 1:N, N:N).  
- **PK / FK** → Garantem integridade relacional.  