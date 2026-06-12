<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orçamento | LM</title>
    <link rel="stylesheet" href="css/orcamento.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
</head>
<body>
<?php
    require_once 'partials/header.php';
?> 

<h1 class="titulo">Venha ser nosso cliente!!</h1>
<div class="orcamento">
<form class="formulario-orcamento" action="salvar_orcamento.php" method="POST">
    <h2>Orçamento</h2>

    <input type="text" id="nome" name="Nome" placeholder="Nome Completo" required>

    <input type="email" id="email" name="email" placeholder="Email" required>

    <input type="text" id="telefone" name="Telefone" placeholder="Telefone">

    <input type="text" id="endereco" name="Endereco" placeholder="Endereço">

    <textarea class="mensagem" name="mensagem" placeholder="Mensagem"></textarea>

    <button type="submit">Enviar</button>
</form>
</div>   
</body>
</html>