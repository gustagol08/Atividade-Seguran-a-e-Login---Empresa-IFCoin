<?php
$usuarioRecebido = $_POST['Usuario'];
$senhaRecebido = $_POST['Senha'];

require_once("dadosConexao.php");
require_once("funcoes.php");

$existenciaUsuario = verificaExistenciaUsuario($conexao, $usuarioRecebido);
$padraoSenha = verificaPadraoSenha($senhaRecebido);
$usandoUltimas7Senha = verificaUltimas7Senhas($conexao, $usuarioRecebido, $senhaRecebido);
// $gravaSenhaAntiga = gravaSenhaAntiga($conexao, $usuarioRecebido);
// $atualizouSenha = atualizaSenha($conexao, $usuarioRecebido, $senhaRecebido);

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
        if (!$existenciaUsuario) {
            echo "<h2>Usuário inválido!</h2>";
        } elseif (!$padraoSenha) {
            echo "<h2>Senha fora dos padrões!</h2>";
        } elseif ($usandoUltimas7Senha) {
            echo "<h2>Senha digitada utilizado nas ultimas 7 senhas!</h2>";
        } else {
            $atualizouSenha = atualizaSenha($conexao, $usuarioRecebido, $senhaRecebido);
            if($atualizouSenha){
                echo "<h2>Senha Atualizada!</h2>";
            } else {
                echo "<h2>Problemas ao atualizar senha!</h2>";
            }
        }
        ?>
        <a href="login.php">
            <button>Tela Inicial</button>
        </a>
    </div>
</body>

</html>