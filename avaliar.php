<?php
require_once('data/crud.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id_profissional_avaliado = $_GET['id_profissional'] ?? '';
$nome_profissional_avaliado = $_GET['nome_profissional'] ?? '';

if (empty($id_profissional_avaliado) || empty($nome_profissional_avaliado)) {
    echo "Profissional ou nome não especificado.";
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo "Você precisa estar logado para deixar uma avaliação.
    <br><br>
    <a href='login.php'>Faça login aqui</a>.";
    exit;
}


?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Avaliação</title>
</head>
<body>
    <form action="./data/insert.php" method="POST">
        <input type="text" name="titulo" placeholder="Digite o título" required>
        
        <input type="text" name="nome_servico" placeholder="Qual serviço foi realizado? (Ex: Pintura, Troca de torneira)" required>
        
        <input type="number" name="nota" min="1" max="5" placeholder="Nota (1 a 5)" required>
        
        <textarea name="texto_avaliacao" placeholder="Digite sua avaliação" rows="5" required></textarea>
        
        <input type="hidden" name="id_profissional" value="<?php echo ($id_profissional_avaliado); ?>">
        <input type="hidden" name="id_cliente" value="<?php echo ($_SESSION['user_id']); ?>">
        <input type="hidden" name="nome_profissional" value="<?php echo ($nome_profissional_avaliado); ?>">

        <button type="submit">Enviar Avaliação</button>
    </form>
</body>
</html>