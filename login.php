<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
<?php
    require_once 'partials/header.php';
?> 
    <form class="login">
    <img src="./">
    <h1>Login</h1>
    <label>Email:<input type="email" id="email" name="email"> </label><br>
    <label>Senha:<input type="password" id="Senha" name="Senha"></label><br>
    <button type="submit">Entrar</button>
</form>
</body>
</html>