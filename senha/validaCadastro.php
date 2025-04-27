<?php
$usuarioRecebido = $_POST['Usuario'];
$senhaRecebido = $_POST['Senha'];

require_once("dadosConexao.php");
require_once("funcoes.php");

$padraoSenha = verificaPadraoSenha($senhaRecebido);

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
        if(!$padraoSenha){
            echo "<h2>Senha fora dos critérios solicitados!</h2>";
        } else {
            $cadastro = cadastro($conexao,$usuarioRecebido, $senhaRecebido);
            if($cadastro){
                echo "<h2>Cadastro realizado com sucesso!</h2>";
            } else {
                echo "<h2>Problemas ao cadastrar!</h2>";
            }
        }
        ?>
        <a href="login.php">
            <button>Tela Inicial</button>
        </a>
    </div>
</body>

</html>