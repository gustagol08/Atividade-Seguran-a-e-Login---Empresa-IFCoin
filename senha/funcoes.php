<?php

require_once("dadosConexao.php");

function verificaUsuario($conexao, $usuario, $senha): bool
{
    $sql = "select nomeUsuario, senha from usuario where nomeUsuario = '" . $usuario . "' and senha = '" . $senha . "'";
    $resultado = mysqli_query($conexao, $sql);

    while ($linha = mysqli_fetch_assoc($resultado)) {
        if ($linha['nomeUsuario'] == $usuario && $linha['senha'] == $senha) {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function verificaDiasSenha($conexao, $usuario, $senha): bool
{
    $sql = "SELECT TIMESTAMPDIFF(DAY, dataCriacao, NOW()) AS dias_passados
    FROM usuario where nomeUsuario = '" . $usuario . "' and senha = '" . $senha . "'";
    $resultado = mysqli_query($conexao, $sql);

    while ($linha = mysqli_fetch_assoc($resultado)) {
        if ($linha['dias_passados'] >= 45) {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

// function atualizacaoDaSenha($conexao, $usuario, $senha): bool
// {
//     verificaExistenciaUsuario($conexao, $usuario);
//     verificaPadraoSenha($senha);
//     verificaUltimas7Senhas($conexao, $senha);
//     gravaSenhaAntiga($conexao, $usuario);
//     atualizaSenha($conexao, $usuario, $senha);
// }

function verificaExistenciaUsuario($conexao, $usuarioDigitado): bool
{

    $selectNomeUsuario = "select nomeUsuario from usuario";
    $resultadoNomeUsuario = mysqli_query($conexao, $selectNomeUsuario);

    while ($linha = mysqli_fetch_assoc($resultadoNomeUsuario)) {
        if ($linha['nomeUsuario'] == $usuarioDigitado) {
            return true;
        } 
    }
    return false;
}

function verificaPadraoSenha($senhaDigitada): bool
{
    if (strlen($senhaDigitada) < 8) {
        return false;
    } else {
        // Verifica se tem pelo menos uma letra maiúscula
        if (!preg_match('/[A-Z]/', $senhaDigitada)) {
            return false;
        } else {
            // Verifica se tem pelo menos uma letra minúscula
            if (!preg_match('/[a-z]/', $senhaDigitada)) {
                return false;
            } else {
                // Verifica se tem pelo menos um número
                if (!preg_match('/[0-9]/', $senhaDigitada)) {
                    return false;
                } else {
                    // Verifica se tem pelo menos um caractere especial
                    if (!preg_match('/[\W_]/', $senhaDigitada)) {
                        return false;
                    } else {
                        return true;
                    }
                }
            }
        }
    }
}
function verificaUltimas7Senhas($conexao, $usuarioDigitado, $senhaDigitada): bool
{
    $sql = "select senhaAntiga from historicosenha 
    inner join usuario on historicosenha.idUsuario = usuario.IdUsuario
    where usuario.nomeUsuario = '" . $usuarioDigitado . "' order by idHistorico desc limit 7;";
    $resultado = mysqli_query($conexao, $sql);

    while ($linha = mysqli_fetch_assoc($resultado)) {
        if ($linha['senhaAntiga'] == $senhaDigitada) {
            return true;
        }
    }
    return false;
}
// function gravaSenhaAntiga($conexao, $usuarioDigitado) : bool {
//     $selectSenhaAtual = "select idUsuario, senha from usuario where nomeUsuario = '" . $usuarioDigitado . "'";
//     $resultado = mysqli_query($conexao, $selectSenhaAtual);

//     while ($linha = mysqli_fetch_assoc($resultado)) {
//         $usuarioAlteracaoId = $linha['idUsuario'];
//         $usuarioAlteracaoSenha = $linha['senha'];

//         $insertSenhaAntiga = "INSERT INTO HistoricoSenha (idUsuario, senhaAntiga) 
//             VALUES (" . $usuarioAlteracaoId . " , '" . $usuarioAlteracaoSenha . "')";
//         $resultado = mysqli_query($conexao, $insertSenhaAntiga);
//         return $resultado;
//     }
//     return false;
// }

function atualizaSenha($conexao, $usuarioDigitado, $senhaDigitada) : bool {
    
    // $gravaSenhaAntiga = gravaSenhaAntiga($conexao, $usuarioDigitado);

    $update = "update usuario set senha = '" . $senhaDigitada . "', dataCriacao = CURRENT_TIMESTAMP where 
    nomeUsuario = '" . $usuarioDigitado . "'";
    $resultadoUpdate = mysqli_query($conexao, $update);
    
    $gravaNovaSenhaHistorico = gravaSenhaNovaHistorico ($conexao, $usuarioDigitado, $senhaDigitada);
    //if ($gravaSenhaAntiga && $resultadoUpdate && $gravaNovaSenhaHistorico) {
    if ($resultadoUpdate && $gravaNovaSenhaHistorico) {
        return true;
    } else {
        return false;
    }
}
function gravaSenhaNovaHistorico ($conexao, $usuarioDigitado, $senhaDigitada) : bool {

    $sql = "select idUsuario from usuario where nomeUsuario = '". $usuarioDigitado ."'";
    $resultado = mysqli_query($conexao, $sql);

    while ($linha = mysqli_fetch_assoc($resultado)) {
        $idUsuario = $linha['idUsuario'];
        
        $insertHistorico = "insert into historicosenha (idUsuario, senhaAntiga) values (".
        $idUsuario ." , '". $senhaDigitada . "')";
        $resultadoInsert = mysqli_query($conexao, $insertHistorico);
        return $resultadoInsert;
    }
    return false;
}
function cadastro ($conexao, $usuarioDigitado, $senhaDigitada) : bool {

    $sql = "insert into usuario (nomeUsuario, senha) values ('" . $usuarioDigitado . "' , '". $senhaDigitada ."')";
    $resultado = mysqli_query($conexao, $sql);
    $iDCadastroNovo = mysqli_insert_id($conexao);
     if($resultado){
        $insertHistorico = "insert into historicosenha (idUsuario, senhaAntiga) values (".
        $iDCadastroNovo ." , '". $senhaDigitada . "')";
        $resultadoInsert = mysqli_query($conexao, $insertHistorico);
        return $resultadoInsert;
     } else {
        return false;
     }
}