<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Cadastrar</title>
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
                <li><a href="#">Cadastrar-se</a></li>
                <li><a href="../paginas/login.php">Entrar</a></li>
            </ul>
        </nav>
    </header>
    <section class="container cadastro" id="cadastro">
        <form class="formulario-cadastro" action="cadastro-usuario.php" method="POST">
            <h1>Cadastre-se</h1>
            <div class="input input-nome"><label for="nome">Nome:</label><input type="text" name="nome" id="nome"></div>
            <div class="input input-telefone"><label for="telefone">Telefone:</label><input type="text" name="telefone" id="telefone" placeholder="(__) _____-____" maxlength="15"></div>
            <div class="input input-email"><label for="email">Email:</label><input type="email" name="email" id="email"></div>
            <div class="input input-senha"><label for="senha">Senha:</label><input type="password" name="senha" id="senha" placeholder="Crie uma senha forte" ></div>
            <div class="input input-cpf"><label for="cpf">CPF:</label><input type="text" name="cpf" id="cpf" placeholder="___.___.___-__" maxlength="14"></div>
            <div class="input input-endereco"><label for="endereco">Endereço:</label><input type="text" name="endereco" id="endereco"></div>
            <div class="double-input">
                <div class="input input-numero"><label for="numero">Número:</label><input type="text" name="numero" id="numero"></div>
                <div class="input input-cep"><label for="cep">CEP:</label><input type="text" name="cep" id="cep" placeholder="_____-___" maxlength="9"></div>
            </div>
            <div class="botoes">
                <input type="submit" id="cadastrar" name="cadastrar" value="Cadastrar">
                <input type="reset" value="Limpar formulário">
            </div>
        </form>
    </section>
    <script>
        const telefone = document.getElementById('telefone');
        const cpf = document.getElementById('cpf');
        const cep = document.getElementById('cep');

        window.onload = function() {

            cpf.addEventListener('input', () => {
                cpf.value = cpfMask(cpf.value)
            })
            telefone.addEventListener('input', () => {
                telefone.value = telefoneMask(telefone.value)
            })
            cep.addEventListener('input', () => {
                cep.value = cepMask(cep.value)
            })
        }

        function cpfMask(cpf){
            cpf = cpf.replace(/\D/g, "")
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
            return cpf
        }

        function telefoneMask(telefone){
            telefone = telefone.replace(/\D/g, "")
            telefone = telefone.replace(/(\d{2})(\d)/, "($1) $2")
            telefone = telefone.replace(/(\d{5})(\d)/, "$1-$2")
            return telefone
        }

        function cepMask(cep){
            cep = cep.replace(/\D/g, "")
            cep = cep.replace(/(\d{5})(\d)/, "$1-$2")
            return cep
        }
    </script>
</body>
</html>