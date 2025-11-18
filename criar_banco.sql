-- Cria banco de dados
CREATE DATABASE IF NOT EXISTS cafeteria
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE cafeteria;

-- Tabela de pedidos
CREATE TABLE IF NOT EXISTS pedidos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    total DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de itens do pedido
CREATE TABLE IF NOT EXISTS itens_pedido (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    pedido_id INT UNSIGNED NOT NULL,
    produto VARCHAR(255) NOT NULL,
    preco DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    opcao VARCHAR(150) DEFAULT NULL,
    PRIMARY KEY (id),
    INDEX idx_pedido_id (pedido_id),
    CONSTRAINT fk_itens_pedido_pedidos FOREIGN KEY (pedido_id)
        REFERENCES pedidos(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (Opcional) Tabela de produtos para facilitar manutenção do menu
CREATE TABLE IF NOT EXISTS produtos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    preco DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    descricao TEXT DEFAULT NULL,
    disponivel TINYINT(1) NOT NULL DEFAULT 1,
    PRIMARY KEY (id),
    UNIQUE KEY uq_nome (nome)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dados de exemplo (produtos do seu menu)
INSERT IGNORE INTO produtos (nome, preco, descricao) VALUES
('Café Americano', 12.00, 'Café coado, servido quente.'),
('Café Macchiato', 25.00, 'Espresso com um toque de espuma.'),
('Café Latte', 22.00, 'Espresso com leite vaporizado.'),
('Café Mocha', 19.00, 'Café com chocolate e chantilly.'),
('Café Cortado', 11.00, 'Café pequeno com pouco leite.'),
('Café Frappé', 19.00, 'Bebida gelada batida.'),
('Dalgona Coffee', 28.50, 'Creme batido sobre leite.'),
('Café com Panna', 13.00, 'Café com chantilly.'),
('Muffin', 2.00, 'Muffin caseiro.'),
('Cookies', 0.50, 'Cookie crocante.'),
('Pão de Queijo', 19.00, 'Pão de queijo tradicional.');

-- Exemplo de índices adicionais (se precisar fazer pesquisa por nome)
CREATE INDEX IF NOT EXISTS idx_produtos_nome ON produtos (nome(50));
