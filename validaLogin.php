<?php
$usuarioRecebido = $_POST['Usuario'];
$senhaRecebido = $_POST['Senha'];

require_once("dadosConexao.php");
require_once("funcoes.php");

$retornoValidacao = verificaUsuario($conexao, $usuarioRecebido, $senhaRecebido);
$retornoValidacaoDias = verificaDiasSenha($conexao, $usuarioRecebido, $senhaRecebido);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="container">
        <?php
        if ($retornoValidacao) {
            if ($retornoValidacaoDias) {
                echo "<h2>Senha Expirada! Necessário Atualizar senha!</h2>";
            } else {
                echo "<h2>Bem vindo!</h2>";
            }
        } else {
            echo "<h2>Usuário ou senha inválido!</h2>";
        }
        ?>
        <a href="login.php">
            <button>Tela Inicial</button>
        </a>
        <a href="atualizarSenha.php">
            <button>Atualizar Senha</button>
        </a>
    </div>
</body>

</html>