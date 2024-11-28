<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $banco = "banco";
    $charset = "utf8";

    $conexao = @mysqli_connect($host,$user,$password,$banco) or die ("Erro na conexao");

    $nome_pizza = $_REQUEST['nome-pizza'];
    $descricao_pizza = $_REQUEST['descricao-pizza'];
    $valor_pizza = $_REQUEST['valor-pizza'];

    $insert = "INSERT INTO pizzas VALUES ('default','$nome_pizza','Ingredientes: $descricao_pizza','$valor_pizza')";
    
    if ($conexao->query($insert) === TRUE) {
        header("Location: ../index.php#pizzas");
    }


?>