<?php
include('conexao.php');
session_start();

$mensagem_erro = $_SESSION['erro'] ?? '';
unset($_SESSION['erro']);

if(isset($_POST['usuario']) && isset($_POST['senha'])) {
    if(strlen($_POST['usuario']) == 0) {
        $_SESSION['erro'] = "Usuário não informado";
        header("Location: index.php");
        exit();
    } else if(strlen($_POST['senha']) == 0) {
        $_SESSION['erro'] = "Preencha sua senha";
        header("Location: index.php");
        exit();
    } else {
        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $senha = $mysqli->real_escape_string($_POST['senha']);
        $sql_code = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            header("Location: painel.php");
            exit();
        } else {
            $_SESSION['erro'] = "Usuário ou senha incorretos!";
            header("Location: index.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>
<body>
    <div class="tela-login">
        <h1>Login</h1>
        <?php if ($mensagem_erro): ?>
            <p style="color: red;"><?= htmlspecialchars($mensagem_erro) ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <br>
            <input type="text" name="usuario" placeholder="Usuário">
            <br><br>      
            <input type="password" name="senha" placeholder="Senha">
            <br><br>   
            <button type="submit" style="margin-top:30px">Entrar</button>
            <br><br> 
            <a href="cadastro.php">Não tem uma conta? Cadastre-se!</a>
        </form>
    </div>
</body>
</html>
