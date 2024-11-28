<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $banco = "banco";
    $charset = "utf8";

    $conexao = @mysqli_connect($host,$user,$password,$banco) or die ("Erro na conexao");

    $email = $_REQUEST['email'];
    $senha = $_REQUEST['senha'];
    $entrar = $_REQUEST['login'];

    if (isset($entrar)) {
        $verifica = @mysqli_query($conexao,"SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'") or die ("erro");
        if(@mysqli_num_rows($verifica) <= 0) {
            echo"<script language='javascript' type='text/javascript'> alert('Login e/ou senha incorretos');window.location.href='login.php';</script>";
            die();
        }else{
            setcookie("login",$email, time()+3600 , '/' );
            header("Location:../index.php");
          }
    }

?>