<?php

    $localServidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeBaseDados = "senha";

    $conexao = mysqli_connect($localServidor, $usuario, $senha, $nomeBaseDados);

    if(!$conexao){
        die("Conexão falhou: ".mysqli_connect_errno());
    }
    //echo "Conectado com sucesso!!!<br>";