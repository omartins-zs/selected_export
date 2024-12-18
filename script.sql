CREATE DATABASE selected_export;

USE selected_export;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    telefone VARCHAR(15),
    data_nascimento DATE,
    endereco VARCHAR(255),
    cidade VARCHAR(100),
    status INT
);


INSERT INTO usuarios (nome, email, telefone, data_nascimento, endereco, cidade, status)
VALUES
    ('Ana Costa', 'ana@exemplo.com', '334455667', '1988-05-25', 'Rua D, 101', 'Curitiba', 1),
    ('Paulo Pereira', 'paulo@exemplo.com', '556677889', '1992-11-12', 'Rua E, 202', 'Porto Alegre', 1),
    ('Juliana Martins', 'juliana@exemplo.com', '667788990', '1995-04-09', 'Rua F, 303', 'Florianópolis', 0),
    ('Ricardo Oliveira', 'ricardo@exemplo.com', '778899001', '1980-01-20', 'Rua G, 404', 'São Paulo', 1),
    ('Fernanda Alves', 'fernanda@exemplo.com', '889900112', '1994-07-15', 'Rua H, 505', 'Rio de Janeiro', 0);
    ('João Silva', 'joao@exemplo.com', '123456789', '1985-06-15', 'Rua A, 123', 'São Paulo', 1),
    ('Maria Oliveira', 'maria@exemplo.com', '987654321', '1990-02-20', 'Rua B, 456', 'Rio de Janeiro', 0),
    ('Carlos Souza', 'carlos@exemplo.com', '112233445', '1982-10-30', 'Rua C, 789', 'Belo Horizonte', 1);