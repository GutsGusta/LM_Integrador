<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/orcamento.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
</head>
<body>
<?php
    require_once 'partials/header.php';
?> 

<h1 class="titulo">Venha ser nosso cliente!!</h1>
<div class="orcamento">
    <form class="formulario-orcamento">
        <h2>Orçamento</h2>   
        <input type="text" id="nome" name="Nome" placeholder="Nome Completo">
        <input type="email" id="email" name="email" placeholder="Email">
        <input type="text" id="telefone" name="Telefone" placeholder="Telefone">
        <input type="text" id="endereco" name="Endereco" placeholder="Endereço">
        <textarea class="mensagem" placeholder="Mensagem"></textarea>
        <button type="submit">Enviar</button>
    </form>
</div>   
</body>
</html>