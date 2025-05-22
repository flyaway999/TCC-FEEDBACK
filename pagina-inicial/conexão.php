<?php
session_start();

// Conectar ao banco
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'meu_banco';

$conn = new mysqli($host, $usuario, $senha, $banco);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_usuario = $_POST['nome_usuario'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT id, senha_hash FROM usuarios WHERE nome_usuario = ?");
    $stmt->bind_param("s", $nome_usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $senha_hash);
        $stmt->fetch();

        if (password_verify($senha, $senha_hash)) {
            $_SESSION['usuario_id'] = $id;
            $_SESSION['nome_usuario'] = $nome_usuario;
            header("Location: ../pagina-inicial/teladeinicio.html");
            exit();
        } else {
            $erro = "Senha incorreta.";
        }
    } else {
        $erro = "Usuário não encontrado.";
    }
}
?>

<!-- HTML do formulário -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
    <form method="post">
        <input type="text" name="nome_usuario" placeholder="Nome de usuário" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>

