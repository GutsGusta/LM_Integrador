<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>Login</title>
</head>
<body>
<?php
    require_once 'partials/header.php';
?> 
<h1 class="titulo">Bem Vindo de Volta!</h1>
<div class="login">
    <form class="formulario-login">
        <img src="uploads/icone_usuario.png">       
        <input type="email" id="email" name="email" placeholder="Email">
        <input type="password" id="Senha" name="Senha" placeholder="Senha">
        <a href="#">Não tem conta ainda? Cadastre-se aqui</a>
        <button type="submit">Entrar</button>
    </form>
</div>
</body>
</html>
