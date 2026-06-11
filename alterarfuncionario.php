<?php
require 'data/crud.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: AD_usuarios.php");
    exit;
}

$id_profissional = (int) $_GET['id'];
$profissional = read($pdo, 'profissional', "id_profissional = $id_profissional");

if (!$profissional) {
    echo "Funcionário não encontrado!";
    exit;
}
?>

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

    <h1 class="titulo">Editar Funcionário</h1>
<div class="orcamento">
    <form class="formulario-orcamento" action="updatefuncionario.php" method="POST">
        <h2>Funcionário</h2>

        <input type="hidden" id="id_profissional" name="id_profissional"
            value="<?= $profissional['id_profissional'] ?>">

        <input type="text" id="nome_profissional" name="nome_profissional"
            placeholder="Nome Completo"
            value="<?= htmlspecialchars($profissional['nome_profissional']) ?>">

        <input type="email" id="email" name="email"
            value="<?= htmlspecialchars($profissional['email']) ?>">

        <input type="text" id="telefone" name="telefone"
            placeholder="Telefone"
            value="<?= htmlspecialchars($profissional['telefone']) ?>">

        <input type="text" id="cidade_estado" name="cidade_estado"
            placeholder="Cidade/Estado"
            value="<?= htmlspecialchars($profissional['cidade_estado']) ?>">

            <input type="text" id="experiencia" name="experiencia"
            placeholder="Experiência"
            value="<?= htmlspecialchars($profissional['experiencia']) ?>">

            <input type="text" id="disponibilidade" name="disponibilidade"
            placeholder="Disponibilidade"
            value="<?= htmlspecialchars($profissional['disponibilidade']) ?>">

        <button type="submit">Enviar</button>
    </form>
</div>
</body>

</html>

