<?php

require_once './data/crud.php';

$usuarios = readAll($pdo, 'usuarios');

$categoria_get = isset($_GET['categoria']) ? trim($_GET['categoria']) : '';


$categorias = [
    'usuario' => 'Usuários',
    'profissional' => 'Profissionais',
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>teste</title>
</head>

<body>

    <ul>
        <li><a href="teste.php">Todos</a></li>
        <?php
        foreach ($categorias as $kcat => $vcat) {
            echo '<li><a href="teste.php?categoria=' . $kcat . '">' . $vcat . '</a></li>';
        }
        ?>
    </ul>

    <table style="border: 1px solid black; border-collapse: collapse;">
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>PREÇO</th>
            <th>CATEGORIA</th>
            <th>DATA DA AGENDA</th>
            <th>HORÁRIO</th>
        </tr>


        <?php
       foreach ($usuarios as $usuario) {
        if ($categoria_get === '' || $usuario['categorias'] === $categoria_get) {
             echo '<tr>';
            echo '<td style="border: 1px solid black; padding: 8px;">' . $usuario['id'] . '</td>';
            echo '<td style="border: 1px solid black; padding: 8px;">' . $usuario['nome_cliente']  . ' ' . $usuario['nome_profissional'] . '</td>';
            echo '<td style="border: 1px solid black; padding: 8px;">' . $usuario['preco'] . '</td>';
            echo '<td style="border: 1px solid black; padding: 8px;">' . $usuario['categorias']. '</td>';
            echo '<td style="border: 1px solid black; padding: 8px;">' . $usuario['data_agenda']  . '</td>';
            echo '<td style="border: 1px solid black; padding: 8px;">' . $usuario['horario'] . '</td>';
            echo '</tr>';
        }
        }
        ?>
</body>

</html>