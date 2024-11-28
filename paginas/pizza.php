<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Cadastrar pizza</title>
</head>
<body>
<header>
        <nav class="menu">
            <a href="../index.php"><img class="icon" src="../img/logo.webp"></a>
            <ul>
                <li><a href="../index.php#pizzas">Pizzas</a></li>
                <?php
                    $cookie = 'login';

                    echo '<li><a href="#">Cadastrar pizza</a></li>';
                    echo '<li><form method="POST"><input type="submit" name="sair" id="sair" class="btnSair" value="Sair"></form></li>';
                    if(isset($_POST['sair'])){
                        unset($_COOKIE[$cookie]);
                        setcookie($cookie, '', time() - 3600, '/'); 
                        header("Location: ../index.php","Refresh:0");
                    }
                ?>
            </ul>
        </nav>
    </header>
    <section class="container cadastro" id="cadastro">
        <form class="formulario-cadastro" action="cadastro-pizza.php" method="POST">
            <h1>Cadastre uma nova pizza</h1>
            <div class="input input-nome-pizza"><label for="nome-pizza">Nome da pizza:</label><input type="text" name="nome-pizza" id="nome-pizza"></div>
            <div class="input input-descricao-pizza"><label for="descricao-pizza">Ingredientes:</label><textarea id="descricao-pizza" name="descricao-pizza"></textarea></div>
            <div class="input input-valor-pizza"><label for="valor-pizza">Valor:</label><input type="text" name="valor-pizza" id="valor-pizza" placeholder="R$" min="0"></div>
            <div class="botoes">
                <input type="submit" id="cadastrar-pizza" name="cadastrar-pizza" value="Cadastrar pizza">
                <input type="reset" value="Limpar formulário">
            </div>
        </form>
    </section>
    <script>
        const valorPizza = document.getElementById('valor-pizza');

        window.onload = function() {
            valorPizza.addEventListener('input', () => {
                valorPizza.value = valorPizzaMask(valorPizza.value)
            })
        }

        function valorPizzaMask(valor) {
            valor = valor.replace(/\D/g, "");
            valor = (parseInt(valor) / 100).toFixed(2);
            return valor
        }
    </script>
</body>
</html>