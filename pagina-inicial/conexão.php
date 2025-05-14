<?php
$servername = "localhost";
$username = "root";  // Usuário padrão do MySQL no XAMPP
$password = "";  // Senha do MySQL (em branco no XAMPP)
$dbname = "meu_banco_de_dados";  // Nome do banco de dados que você criou

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
echo "Conexão bem-sucedida!";
?>
