
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <title>Pizzaria</title>
</head>
<body>
    <header class="header-main">
    <nav class="menu">
            <a href="#"><img class="icon" src="./img/logo.webp"></a>
            <ul>
                <li><a href="#pizzas">Pizzas</a></li>

                <?php
                
                    $cookie = 'login';

                    $host = "localhost";
                    $user = "root";
                    $password = "";
                    $banco = "banco";
                    $charset = "utf8";
                    $conexao = @mysqli_connect($host,$user,$password,$banco) or die ("Erro na conexao");

                    if(@mysqli_num_rows(@mysqli_query($conexao,"select adm from clientes where email = '$_COOKIE[$cookie]'")) != 0) {
                        $adm_status_query = @mysqli_query($conexao,"select adm from clientes where email = '$_COOKIE[$cookie]'");
                        $adm_status_array = @mysqli_fetch_assoc($adm_status_query);
                        $adm_status = $adm_status_array['adm'];
                    }

                    if(isset($_COOKIE[$cookie])){
                        if($adm_status == 1) {
                            echo '<li><a href="./paginas/pizza.php">Cadastrar pizza</a></li>';
                        }else{
                            echo '<li><a href="./paginas/carrinho.php">Carrinho de compras</a></li>';
                        }
                        echo '<li><form method="POST"><input type="submit" name="sair" id="sair" class="btnSair" value="Sair"></form></li>';
                    }else{
                        echo '<li><a href="./paginas/login.php">Carrinho de compras</a></li>';
                        echo '<li><a href="./paginas/usuario.php">Cadastrar-se</a></li>';
                        echo '<li><a href="./paginas/login.php">Entrar</a></li>';
                    }
                    
                    if(isset($_POST['sair'])){
                        unset($_COOKIE[$cookie]);
                        setcookie($cookie, '', time() - 3600, '/'); 
                        header("Refresh:0");
                        header("Location: ../index.php#","Refresh:0");
                    }
                ?>
            </ul>
        </nav>
        <h1>Pizzaria Pizzas</h1>
        <h2>Compre já sua pizza aqui!</h2>
    </header>
    <section id="pizzas" class="container">
        <h1>NOSSAS PIZZAS</h1>
        <div class="pizzas">
        <?php
            $query = @mysqli_query($conexao,"select * from pizzas");
            if(!$query){
                die("Query invalida".@mysqli_error($conexao));
            }

            while($dados = mysqli_fetch_array($query)){
                echo "<div class='card-pizza'>";
                if(@mysqli_num_rows(@mysqli_query($conexao,"select adm from clientes where email = '$_COOKIE[$cookie]'")) != 0) {
                    $adm_status_query = @mysqli_query($conexao,"select adm from clientes where email = '$_COOKIE[$cookie]'");
                    $adm_status_array = @mysqli_fetch_assoc($adm_status_query);
                    $adm_status = $adm_status_array['adm'];
                    if($adm_status == 0) {
                        echo "<form method='POST' action='./paginas/inserir-carrinho.php'>";
                    }else{
                        echo "<form method='POST' action='./paginas/remover-pizza.php'>";
                    }
                }else{
                    echo "<form method='POST' action='./paginas/inserir-carrinho.php'>";
                }
                echo "<input style='display: none;' name='id-pizza' id='id-pizza' value='".htmlspecialchars($dados['id'])."'>";
                echo "<h1>".htmlspecialchars($dados['nome'])."</h1>";
                echo "<p>".htmlspecialchars($dados['descricao'])."</p>";
                echo "<div class='quantidade'>";
                echo "<label for='quantidade'>Quantidade:</label>";
                echo "<input type='number' name='quantidade' id='quantidade' min='1'>";
                echo "</div>";
                echo "<label>R$".htmlspecialchars($dados['preco'])."</label>";
                if(@mysqli_num_rows(@mysqli_query($conexao,"select adm from clientes where email = '$_COOKIE[$cookie]'")) != 0) {
                    $adm_status_query = @mysqli_query($conexao,"select adm from clientes where email = '$_COOKIE[$cookie]'");
                    $adm_status_array = @mysqli_fetch_assoc($adm_status_query);
                    $adm_status = $adm_status_array['adm'];
                    if($adm_status == 0) {
                        echo "<input type='submit' name='btnadicionarcarrinho' id='btnadicionarcarrinho' value='Adicionar ao Carrinho'>";
                    }   else{
                        echo "<input type='submit' name='btnRemoverPizza' id='btnRemoverPizza' value='Remover pizza'>";
                    }
                }else{
                    echo "<input type='submit' name='btnadicionarcarrinho' id='btnadicionarcarrinho' value='Adicionar ao Carrinho'>";
                }
                echo "</form>";
                echo "</div>";
            }
        ?>

        </div>
    </section>
    <footer></footer>
</body>
</html>