<?php
require_once 'data/crud.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_tipo'])) {
    ?>
   <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
        <title>Acesso Negado</title>
    </head>
    <body>
        <?php require_once 'partials/header.php'; ?>

        <main style="display:flex; flex-direction:column; align-items:center; justify-content:center; height:60vh; gap:16px; text-align:center;">
            <img src="uploads/acesso_negado.png" alt="Acesso Negado" style="width:500px; max-width:90%;">
            <p style="color:#ccc;">Você precisa estar logado para deixar uma avaliação.</p>
            <a href="login.php" style="background:#ffd767; color:#1a1a1a; padding:12px 24px; border-radius:8px; font-weight:600; text-decoration:none;">
                Fazer Login
            </a>
        </main>
    </body>
    </html>
    <?php
    exit;
}

?>

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

    <input type="text" id="preco_investir" name="preco_investir" placeholder="Quanto você pretende investir?">

    <textarea class="mensagem" name="mensagem" placeholder="Mensagem"></textarea>

    <button type="submit">Enviar</button>
</form>
</div>   
</body>
</html>