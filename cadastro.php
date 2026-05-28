<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
</head>
<body>
 <?php
    require_once 'partials/header.php';
?> 

<h1 class="titulo">Venha ser nosso cliente!!</h1>
<div class="cadastro">
    <form class="formulario-cadastro">
        <h2>Cadastro</h2>   
        <input type="text" id="nome" name="Nome" placeholder="Nome">
        <input type="email" id="email" name="email" placeholder="Email">
        <input type="text" id="tefone" name="Telefone" placeholder="Telefone">
        <input type="password" id="Senha" name="Senha" placeholder="Senha">
        <p>Escolha sua Foto de Perfil:</p>
        <input type="file">
        <button type="submit">Criar conta</button>
    </form>
</div>   
</body>
</html>