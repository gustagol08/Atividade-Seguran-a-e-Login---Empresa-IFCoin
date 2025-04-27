create schema senha;

use senha;

-- Criação da tabela de Usuários
-- Criação da tabela de Usuários com campo de data
CREATE TABLE Usuario (
    idUsuario INT PRIMARY KEY AUTO_INCREMENT, -- Use SERIAL para PostgreSQL
    nomeUsuario VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    dataCriacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Criação da tabela de Histórico de Senhas
CREATE TABLE HistoricoSenha (
    idHistorico INT PRIMARY KEY AUTO_INCREMENT, -- Use SERIAL para PostgreSQL
    idUsuario INT NOT NULL,
    senhaAntiga VARCHAR(255) NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario)
);

-- insert para testar validação de 45 dias da senha


INSERT INTO Usuario (nomeUsuario, senha, dataCriacao) VALUES ('Geison', 'senha123', '2025-03-13');
insert into historicosenha (idUsuario, senhaAntiga) values (1, 'senha123');

select * from usuario;
select * from historicosenha;
