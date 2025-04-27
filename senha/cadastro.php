<?php

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginStyle.css">
    <title>Cadastro</title>
</head>

<body>
    <form action="validaCadastro.php" method="post">
        <div id="div">
            <h2>Cadastro</h2>
            <label>Usuário:</label>
            <input type="text" name="Usuario" placeholder="Nome" required>
        </div>
        <div id="div">
            <label>Senha:</label>
            <input type="password" name="Senha" placeholder="Senha" required>
        </div>
        <div id="div">
            <input type="submit" value="Cadastrar">
            <a href="login.php">
                <button>Tela Inicial</button>
            </a>
        </div>
        <div id="div">
            <h2>Critérios para senha:</h2>
            <p>A senha deve conter no mínimo 8 caracteres;</p>
            <p>Letras maiúsculas;</p>
            <p>Letras minúsculas;</p>
            <p>Números;</p>
            <p>Pelo menos um caractere especial (ex: !, @, #, $, %, etc.);</p>
            <p>Não poderá reutilizar nenhuma das últimas 7 senhas.</p>
        </div>
    </form>

</body>

</html>