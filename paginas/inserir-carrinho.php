<?php

    $cookie = "login";

    $host = "localhost";
    $user = "root";
    $password = "";
    $banco = "banco";
    $charset = "utf8";

    $conexao = @mysqli_connect($host,$user,$password,$banco) or die ("Erro na conexao");

    if(isset($_COOKIE[$cookie])){
        if (@mysqli_num_rows(@mysqli_query($conexao,"select * from pedidos where id_cliente = (select id from clientes where email = '$_COOKIE[$cookie]')")) == 0) { 
                @mysqli_query($conexao,"insert into pedidos values (default,(select id from clientes where email = '$_COOKIE[$cookie]'),default,default)");
                $id_pedido_query = @mysqli_query($conexao,"select id from pedidos where id_cliente = (select id from clientes where email = '$_COOKIE[$cookie]')");
                $id_pedido_array = @mysqli_fetch_assoc($id_pedido_query);
                $id_pedido = $id_pedido_array['id'];
        } else { 
                $id_pedido_query = @mysqli_query($conexao,"select id from pedidos where id_cliente = (select id from clientes where email = '$_COOKIE[$cookie]')");
                $id_pedido_array = @mysqli_fetch_assoc($id_pedido_query);
                $id_pedido = $id_pedido_array['id'];
        }
        $id_pizza = $_REQUEST["id-pizza"];
        $quantidade_pizza = $_REQUEST["quantidade"];
    
        $insert = "INSERT INTO pedido_produtos VALUES ('$id_pedido','$id_pizza','$quantidade_pizza')";
        
        if ($conexao->query($insert) === TRUE) {
           header("Location: /paginas/carrinho.php");
        }
    } else {
        header("Location: ./login.php");
    }


?>