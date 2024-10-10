-- Cria o banco de dados
CREATE DATABASE IF NOT EXISTS vendas;
USE vendas;

-- Cria a tabela Produto
CREATE TABLE IF NOT EXISTS Produto (
    Codigo_Produto INT PRIMARY KEY,
    Descricao_Produto VARCHAR(50),
    Preco_Produto FLOAT,
    Peso FLOAT
);

-- Cria a tabela Nota_fiscal
CREATE TABLE IF NOT EXISTS Nota_fiscal (
    Numero_NF INT PRIMARY KEY,
    Valor_NF FLOAT,
    ICMS FLOAT
);

-- Cria a tabela Itens
CREATE TABLE IF NOT EXISTS Itens (
    Produto_Codigo_Produto INT,
    Nota_fiscal_Numero_NF INT,
    Num_Item INT,
    Qtde_Item INT,
    PRIMARY KEY (Num_Item),
    FOREIGN KEY (Produto_Codigo_Produto) REFERENCES Produto(Codigo_Produto),
    FOREIGN KEY (Nota_fiscal_Numero_NF) REFERENCES Nota_fiscal(Numero_NF)
);

-- Insere dados na tabela Produto
INSERT INTO Produto (Codigo_Produto, Descricao_Produto, Preco_Produto, Peso) VALUES
(1, 'Produto A', 10.50, 1.2),
(2, 'Produto B', 20.00, 0.8),
(3, 'Produto C', 15.75, 1.5),
(4, 'Produto D', 30.00, 2.0),
(5, 'Produto E', 12.50, 0.5);

-- Renomeia a tabela Nota_fiscal para Venda
ALTER TABLE Nota_fiscal RENAME TO Venda;

-- Ajusta a tabela Venda, renomeando a coluna Valor_NF para ValorTotal_NF
ALTER TABLE Venda 
CHANGE Valor_NF ValorTotal_NF FLOAT;

-- Caso deseje, você pode criar uma tabela de itens novamente, mas com o nome correto
-- DROP TABLE Itens; -- Remover a tabela Itens se ela já existir (opcional)

-- Caso queira ver todos os produtos cadastrados
SELECT * FROM Produto;
