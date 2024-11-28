<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $banco = "banco";
    $charset = "utf8";
    $conexao = @mysqli_connect($host,$user,$password,$banco) or die ("Erro na conexao");
    $query = @mysqli_query($conexao,"select * from funcionario");
    if(!$query){
        die("Query invalida".@mysqli_error($conexao));
    }
?>