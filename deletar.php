<?php 
    include('conexao.php');
    include('protect.php');
    
    if(isset($_POST['usuario']) && isset($_POST['senha'])) {
    
        if(strlen($_POST['usuario']) == 0) {
            echo "Usuario não informado";
        } else if(strlen($_POST['senha']) == 0) {
            echo "Preencha a senha";
        } else {
    
            $usuario = $mysqli->real_escape_string($_POST['usuario']);
            $senha = $mysqli->real_escape_string($_POST['senha']);
            $sql_code = "UPDATE usuarios SET usuario = '$usuario', senha = '$senha' WHERE id = " . $_SESSION['id'];
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
            echo("Usuário editado com sucesso!");
            header("Location: painel.php");
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
    <title>Deletar Usuário</title>
</head>
<body>
    <div class="tela-login">
        <h1>Deletar Usuário</h1>
        <form id="form-deletar" action="" method="POST">
        <br>
            <input type="text" name="usuario" placeholder="Usuário à deletar">
            <br><br>      
            <input type="password" name="senha" placeholder="Senha do Usuario">
            <br><br>   

            
            <button type="button" style="margin-top:30px" onclick="confirmarDelecao()">Deletar</button>
            <br><br> 
        </form>
        <p><a href="painel.php">Voltar ao painel</a></p>
    </div>
    <script>
        function confirmarDelecao() {
            
            const confirmacao = confirm("Você tem certeza de que deseja deletar este usuário?");
            
          
            if (confirmacao) {
                document.getElementById('form-deletar').submit();  
            }
        }
    </script>
</body>
</html>
