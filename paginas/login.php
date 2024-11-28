<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Entrar</title>
</head>
<body>
<header>
        <nav class="menu">
            <a href="../index.php"><img class="icon" src="../img/logo.webp"></a>
            <ul>
                <li><a href="../index.php#pizzas">Pizzas</a></li>
                <?php
                    $cookie = 'login';

                    if(isset($_COOKIE[$cookie])){
                        echo '<li><a href="./carrinho.php">Carrinho de compras</a></li>';
                    }else{
                        echo '<li><a href="./login.php">Carrinho de compras</a></li>';
                    }
                ?>
                <li><a href="../paginas/usuario.php">Cadastrar-se</a></li>
                <li><a href="#">Entrar</a></li>
            </ul>
        </nav>
    </header>
    <section class="container login" id="login">
        <form class="formulario-login" action="./entrar-usuario.php" method="POST">
            <h1>Entre na sua conta</h1>
            <div class="input input-email"><label for="email">Email:</label><input type="email" name="email" id="email" placeholder="Seu e-mail"></div>
            <div class="input input-senha"><label for="senha">Senha:</label><input type="password" name="senha" id="senha" placeholder="Sua senha" ></div>
            <div class="botoes">
                <input type="submit" id="login" name="login" value="Entrar">
            </div>
        </form>
    </section>
</body>
</html>