-- Criar a tabela de usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_usuario VARCHAR(50) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserir um novo usuário com senha criptografada usando SHA-256
INSERT INTO usuarios (nome_usuario, senha_hash)
VALUES ('usuario123', SHA2('senha_segura123', 256));

-- Verificar o login comparando nome de usuário e senha criptografada
SELECT * FROM usuarios
WHERE nome_usuario = 'usuario123'
  AND senha_hash = SHA2('senha_segura123', 256);
