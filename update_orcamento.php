<?php
require 'data/crud.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados Atualizados</title>
</head>

<body>


    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_orcamentos = (int) $_POST['id_orcamento'];

        $dadosAtualizados = [
            'aceito' => trim($_POST['aceito']),
            'cancelado' => trim($_POST['cancelado']),
            'concluido' => trim($_POST['concluido']),
            'pendente' => trim($_POST['pendente']),
        ];

        $linhas = update($pdo, 'orcamentos', $dadosAtualizados, "id_orcamento = $id_orcamentos");

        if ($linhas > 0) {
            header("Location: AC_orcamentos.php?status=atualizado");
        } else {
            ?>
            <h2>Nenhuma alteração realizada ou serviço não encontrado.</h2>
            <a href="AC_orcamentos.php">Voltar para a lista de serviços</a>
            <?php
        }
    } else {
        header("Location: AC_orcamentos.php");
    }
    exit;
    ?>

</body>

</html>