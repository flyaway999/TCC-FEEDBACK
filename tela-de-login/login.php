<?php
// Conectar ao banco de dados MySQL
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'meu_banco';

$conn = new mysqli($host, $usuario, $senha);

// Criar o banco se não existir
$conn->query("CREATE DATABASE IF NOT EXISTS $banco");
$conn->select_db($banco);

// Criar tabela de usuários
$conn->query("
    CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome_usuario VARCHAR(50) NOT NULL UNIQUE,
        senha_hash VARCHAR(255) NOT NULL,
        criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
");

// Simulando um cadastro de usuário
$nome_usuario = 'usuario123';
$senha = 'senha_segura123';
$senha_hash = password_hash($senha, PASSWORD_BCRYPT);

// Inserir usuário
$stmt = $conn->prepare("INSERT INTO usuarios (nome_usuario, senha_hash) VALUES (?, ?)");
$stmt->bind_param("ss", $nome_usuario, $senha_hash);

if ($stmt->execute()) {
    echo "Usuário registrado com sucesso.<br>";
} else {
    echo "Erro ao registrar: " . $conn->error . "<br>";
}
$stmt->close();

// Simulando login
$login_usuario = 'usuario123';
$login_senha = 'senha_segura123';

// Buscar usuário no banco
$stmt = $conn->prepare("SELECT senha_hash FROM usuarios WHERE nome_usuario = ?");
$stmt->bind_param("s", $login_usuario);
$stmt->execute();
$stmt->bind_result($hash_salvo);

if ($stmt->fetch()) {
    if (password_verify($login_senha, $hash_salvo)) {
        echo "Login bem-sucedido.";
    } else {
        echo "Senha incorreta.";
    }
} else {
    echo "Usuário não encontrado.";
}

$stmt->close();
$conn->close();
?>
