<?php
require_once './data/crud.php';

date_default_timezone_set('America/Sao_Paulo');

$avaliacao = readAll($pdo, 'avaliacoes', '1 ORDER BY id DESC LIMIT 1'); //Se quiser ler tudo coloque allread ou se quiser ler do primeiro ao ultimo colocar ASC

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>avaliacoes</title>
</head>

<body>

    <?php

    foreach ($avaliacao as $avaliacoes) {
        $dataHora = new DateTime($avaliacoes['data_avaliacao']);


    echo '
    <p>ID:' . $avaliacoes['id'] . '</p>
    <p>Título:' . $avaliacoes['titulo'] . '</p>';

        echo '
    <p>Data da Avaliação: ' . $dataHora->format('d/m/Y à\s H:i') . '</p>
    
    <p>Nota:' . $avaliacoes['nota'] . '</p>
    <p>Texto da Avaliação:<br>' . $avaliacoes['texto_avaliacao'] . '</p>';
    }
    ?>


</body>

</html>