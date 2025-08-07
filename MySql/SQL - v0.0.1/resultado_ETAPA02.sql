Aluno: Luan Lima Lopes, Rodrigo fabene e arthur martins

CREATE DATABASE estabelecimento;
USE estabelecimento;

CREATE TABLE vendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(100),
    data_pedido DATE,
    subtotal DECIMAL(6,2),
    desconto DECIMAL(5,2),
    total DECIMAL (6,2) not null
);

DELIMITER $$

CREATE TRIGGER calcular_total
BEFORE INSERT ON vendas
FOR EACH ROW
BEGIN
    SET NEW.total = NEW.subtotal - NEW.desconto;
END$$

DELIMITER ;

INSERT INTO vendas (nome_cliente, data_pedido, subtotal, desconto) 
VALUES ('Luan', '2025-05-26', 200.00, 30.00);

SELECT * FROM vendas;