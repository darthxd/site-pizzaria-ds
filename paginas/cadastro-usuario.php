<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $banco = "banco";
    $charset = "utf8";

    $conexao = @mysqli_connect($host,$user,$password,$banco) or die ("Erro na conexao");

    $nome = $_REQUEST['nome'];
    $telefone = $_REQUEST['telefone'];
    $email = $_REQUEST['email'];
    $senha = $_REQUEST['senha'];
    $cpf = $_REQUEST['cpf'];
    $endereco = $_REQUEST['endereco'];
    $numero = $_REQUEST['numero'];
    $cep = $_REQUEST['cep'];

    $insert = "INSERT INTO clientes VALUES ('default','$nome','$telefone','$email','$senha','$cpf','$endereco','$numero','$cep',false)";
    
    if ($conexao->query($insert) === TRUE) {
        header("Location: ../index.php");
    }


?>