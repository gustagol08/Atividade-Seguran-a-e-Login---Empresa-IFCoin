<?php
    require_once("dadosConexao.php");
    require_once("funcoes.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginStyle.css">
    <title>Login</title>
</head>

<body>
    <form action="validaLogin.php" method="post">
        <div id="div">
            <h2>Login</h2>
            <label>Usuário:</label>
            <input type="text" name="Usuario" placeholder="Nome" name="txtUsuario" required>
        </div>
        <div id="div">
            <label>Senha:</label>
            <input type="password" name="Senha" placeholder="Senha" name="txtSenha" required>
        </div>
        <div id="div">
            <input type="submit" value="Login">
            <a href="cadastro.php">Cadastrar</a>
        </div>
    </form>
</body>

</html>