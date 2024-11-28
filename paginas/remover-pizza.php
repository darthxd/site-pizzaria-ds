<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $banco = "banco";
    $charset = "utf8";

    $conexao = @mysqli_connect($host,$user,$password,$banco) or die ("Erro na conexao");

    $id_pizza = $_REQUEST["id-pizza"];

    $insert = "DELETE FROM pizzas WHERE id = $id_pizza";
    
    if ($conexao->query($insert) === TRUE) {
        header("Location: ../index.php#pizzas");
    }


?>