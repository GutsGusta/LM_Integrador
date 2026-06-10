<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/cadastro_func.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">  
</head>
<body>
 <?php
    require_once 'partials/header.php';
?> 

<h1 class="titulo">Seja parte da Família LM!</h1>
<div class="cadastro">
    <form class="formulario-cadastro">
        <h2>Cadastro</h2>   
        <input type="text" id="nome" name="Nome" placeholder="Nome Completo">
        <input type="email" id="email" name="email" placeholder="Email">
        <input type="text" id="tefone" name="Telefone" placeholder="Telefone">
        <input type="text" id="cpf" name="cpf" placeholder="CPF">
        <p>Qual sua Função?</p>
        <select name="" id="">
            <option value="text">Selecione uma das Opções</option>
            <option value="text">Pedreiro</option>
            <option value="text">Servente</option>
            <option value="text">Mestre de Obra</option>
        </select>
        <input type="password" id="Senha" name="Senha" placeholder="Senha">
        <div class="enviar-foto">
        <p>Escolha sua Foto de Perfil:</p>
        <label for="foto" class="select-foto">
            <i  class="fa-solid fa-cloud-arrow-up"></i> Escolha uma foto
        </label>
        <input type="file">
        </div>
        <button type="submit">Criar conta</button>
    </form>
</div>   
</body>
</html>