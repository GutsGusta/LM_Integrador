<?php
require_once 'data/crud.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



$id_profissional_avaliado = $_GET['id_profissional'] ?? '';
$nome_profissional_avaliado = $_GET['nome_profissional'] ?? '';

if (empty($id_profissional_avaliado) || empty($nome_profissional_avaliado)) {
    echo "Profissional ou nome não especificado.";
    exit;
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
    <link rel="stylesheet" href="css/avaliar.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>Enviar Avaliação</title>
</head>

<body>
    <?php
        require_once 'partials/header.php';
    ?>

    <main class="pagina-principal">
        <form action="./data/insert.php" method="POST" class="avaliacao">
            <p>Digite o título</p>
            <input type="text" name="titulo" required>
            
            <p>Qual serviço foi realizado?</p>
            <input type="text" name="nome_servico" placeholder="(Ex: Pintura, Troca de torneira)" required>
            
            <p>Nota da Avaliação</p>
            <input type="number" name="nota" min="1" max="5" placeholder="Entre 1 e 5" required>
            
            <p>Comentário sobre o Profissional?</p>
            <textarea name="texto_avaliacao" rows="5" required></textarea>
            
            <input type="hidden" name="id_profissional" value="<?php echo ($id_profissional_avaliado); ?>">
            <input type="hidden" name="id_cliente" value="<?php echo ($_SESSION['user_id']); ?>">
            <input type="hidden" name="nome_profissional" value="<?php echo ($nome_profissional_avaliado); ?>">

            <button type="submit">Enviar Avaliação</button>
        </form>
    </main>
</body>
</html>