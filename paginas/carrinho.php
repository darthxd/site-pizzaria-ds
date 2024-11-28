<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Carrinho de compras</title>
</head>
<body>
<header>
        <nav class="menu">
            <a href="../index.php"><img class="icon" src="../img/logo.webp"></a>
            <ul>
                <li><a href="../index.php#pizzas">Pizzas</a></li>
                <li><a href="./carrinho.php">Carrinho de compras</a></li>
                <?php
                    $cookie = 'login';

                    $host = "localhost";
                    $user = "root";
                    $password = "";
                    $banco = "banco";
                    $charset = "utf8";
                    $conexao = @mysqli_connect($host,$user,$password,$banco) or die ("Erro na conexao");

                    if(isset($_COOKIE[$cookie])){
                        echo '<li><form method="POST"><input type="submit" name="sair" id="sair" class="btnSair" value="Sair"></form></li>';
                    }else{
                        echo '<li><a href="../paginas/usuario.php">Cadastrar-se</a></li>';
                        echo '<li><a href="../paginas/login.php">Entrar</a></li>';
                    }
                    
                    if(isset($_POST['sair'])){
                        unset($_COOKIE[$cookie]);
                        setcookie($cookie, '', time() - 3600, '/'); 
                        header("Location: ../index.php","Refresh:0");
                    }
                ?>
            </ul>
        </nav>
    </header>

    <section id="carrinho" class="container carrinho">

    <div class="lista-carrinho">
    
    <?php

        $cookie = "login";

        $host = "localhost";
        $user = "root";
        $password = "";
        $banco = "banco";
        $charset = "utf8";
        $conexao = @mysqli_connect($host,$user,$password,$banco) or die ("Erro na conexao");

        if(isset($_COOKIE[$cookie])){
            $id_cliente_query = @mysqli_query($conexao,"select id from clientes where email = '$_COOKIE[$cookie]'");
            $id_cliente_array = @mysqli_fetch_assoc($id_cliente_query);
            $id_cliente = $id_cliente_array['id'];
        }

        $query = @mysqli_query($conexao,"select * from pedidos inner join pedido_produtos on pedidos.id = pedido_produtos.id_pedido right join pizzas on pizzas.id = pedido_produtos.id_pizza where id_cliente=$id_cliente;");
        if(!$query){
            die("Query invalida".@mysqli_error($conexao));
        }   

        $valor_total = NULL;
        
        if(@mysqli_num_rows($query) != 0){
            echo "<table class='pizzas-table'>";
            echo "<r>";
            echo "<th>Pizza</th>";
            echo "<th>Valor</th>";
            echo "<th>Quantidade</th>";
            echo "</tr>";
        }

        if($nome_usuario = mysqli_fetch_array(@mysqli_query($conexao,"select nome from clientes where email = '$_COOKIE[$cookie]'"))) {
            echo "<label class='nome_cliente'>".htmlspecialchars($nome_usuario['nome'])."</label>";
        }

        while($dados = mysqli_fetch_array($query)){
            echo "<tr>";
            echo "<td>".htmlspecialchars($dados['nome'])."</td>";
            echo "<td>R$".htmlspecialchars($dados['preco'])."</td>";
            echo "<td>".htmlspecialchars($dados['quantidade'])."</td>";
            echo "</tr>";
            if($dados['valor_total'] != $valor_total) {
                echo "<label class='valor-total'>Valor total: R$".htmlspecialchars($dados['valor_total'])."</label>";
                $valor_total = $dados['valor_total'];
            }
        }


        echo "</table>";

        
        if(@mysqli_num_rows($query) != 0){
            echo "<form method='POST'>";
            echo "<input type='submit' name='btnComprar' id='btnComprar' value='Finalizar Pedido'>";
            echo "</form>";
            echo "<form method='POST'>";
            echo "<input type='submit' name='btnLimparCarrinho' id='btnLimparCarrinho' value='Limpar Carrinho'>";
            echo "</form>";
        }else{
            echo "<label class='carrinho-vazio'> Seu carrinho está vazio, <a href='../index.php#pizzas'>adicione alguma pizza!</a></label>";
        }

        if(isset($_POST['btnLimparCarrinho'])){
            if (@mysqli_num_rows(@mysqli_query($conexao,"select id from pedidos where id_cliente = (select id from clientes where email = '$_COOKIE[$cookie]')")) != 0) { 
                $id_pedido_query = @mysqli_query($conexao,"select id from pedidos where id_cliente = (select id from clientes where email = '$_COOKIE[$cookie]')");
                $id_pedido_array = @mysqli_fetch_assoc($id_pedido_query);
                $id_pedido = $id_pedido_array['id'];
                @mysqli_query($conexao,"delete from pedido_produtos where id_pedido = $id_pedido");
                header("Refresh:0");
            }
        }

        if(isset($_POST['btnComprar'])){
            if (@mysqli_num_rows(@mysqli_query($conexao,"select id from pedidos where id_cliente = (select id from clientes where email = '$_COOKIE[$cookie]')")) != 0) { 
                $id_pedido_query = @mysqli_query($conexao,"select id from pedidos where id_cliente = (select id from clientes where email = '$_COOKIE[$cookie]')");
                $id_pedido_array = @mysqli_fetch_assoc($id_pedido_query);
                $id_pedido = $id_pedido_array['id'];
                @mysqli_query($conexao,"delete from pedido_produtos where id_pedido = $id_pedido");
                @mysqli_query($conexao,"delete from pedidos where id = $id_pedido");
                echo "<script>alert('Pedido concluído, obrigado por comprar com a gente!'); window.location.href='../index.php';</script>";
                header("Refresh:0");
            }
        }

    ?>

    </div>

    </section>
</body>
</html>