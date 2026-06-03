<?php
require_once './data/crud.php';

$cliente = readAll($pdo, 'cliente', '1 ORDER BY id_cliente DESC LIMIT 1'); 
$profissional = readAll($pdo, 'profissional', '1 ORDER BY id_profissional DESC LIMIT 1'); 
$avaliacao = readAll($pdo, 'avaliacoes', '1 ORDER BY id DESC LIMIT 1');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>total id</title>
</head>

<body>

 <?php

    if (is_array($avaliacao)) {
        foreach ($avaliacao as $avaliacoes) {

        echo '<p>ID Avaliação: ' . $avaliacoes['id'] . '</p>';
        }
    }

    if (is_array($cliente)) {
        foreach ($cliente as $clientes) {

        echo '<p>ID Cliente: ' . $clientes['id_cliente'] . '</p>';
        }
    }

    if (is_array($profissional)) {
        foreach ($profissional as $profissionais) {

        echo '<p>ID Profissional: ' . $profissionais['id_profissional'] . '</p>';
        }
    }
    ?>
</body>

</html>