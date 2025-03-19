<?php
include('conexao.php');
session_start();

$mensagem = $_SESSION['mensagem'] ?? '';
unset($_SESSION['mensagem']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST['usuario'])) {
        $_SESSION['mensagem'] = "Usuário não informado";
    } else if (empty($_POST['senha'])) {
        $_SESSION['mensagem'] = "Preencha sua senha";
    } else if (empty($_POST['confsenha'])) {
        $_SESSION['mensagem'] = "Confirme sua senha";
    } else if ($_POST['senha'] !== $_POST['confsenha']) {
        $_SESSION['mensagem'] = "As senhas não coincidem";
    } else {
        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_verifica = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $resultado = $mysqli->query($sql_verifica);

        if ($resultado->num_rows > 0) {
            $_SESSION['mensagem'] = "Usuário já existe. Escolha outro nome!";
        } else {
            $sql_code = "INSERT INTO usuarios (usuario, senha) VALUES ('$usuario', '$senha')";
            if ($mysqli->query($sql_code)) {
                $_SESSION['mensagem'] = "Usuário cadastrado com sucesso!";
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['mensagem'] = "Erro ao cadastrar usuário!";
            }
        }
    }
    header("Location: cadastro.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Cadastro</title>
</head>
<body>
    <div class="tela-login">
        <h1>Cadastro</h1>
        <?php if (!empty($mensagem)): ?>
            <p style="color: red;"><?= htmlspecialchars($mensagem) ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <br>
            <input type="text" name="usuario" placeholder="Usuário">
            <br><br>      
            <input type="password" name="senha" placeholder="Senha">
            <br><br>   
            <input type="password" name="confsenha" placeholder="Confirmar Senha">
            <br><br>
            <button type="submit" style="margin-top:30px">Cadastrar</button>
            <br><br> 
            <a href="index.php">Já tem uma conta? Fazer login</a>
        </form>
    </div>
</body>
</html>
