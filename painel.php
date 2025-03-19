<?php
include('conexao.php');
include('protect.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Painel</title>
</head>
<body>
    <div class="tela-login">
        <h1>Painel do usuário</h1>
        <br>
        Bem vindo ao Painel, <?php echo $_SESSION['nome']; ?>.
        <p><a href="logout.php">Sair</a></p>
        <br>
        <p><a href="editar.php">Editar usuário</a></p>
        <br><br>
        <p><a href="deletar.php">Deletar usuário</a></p>
    </div>
</body>
</html>