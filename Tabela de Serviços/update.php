<?php
require 'crud.php';
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
        $id = (int) $_POST['id_servico'];

        $dadosAtualizados = [
            'nome_servico' => trim($_POST['nome_servico']),
            'valor_pedreiro' => trim($_POST['valor_pedreiro']),
            'valor_mestre' => trim($_POST['valor_mestre']),
            'valor_servente' => trim($_POST['valor_servente']),

        ];

        $linhas = update($pdo, 'servicos', $dadosAtualizados, "id_servico = $id");

        if ($linhas > 0) {
            header("Location: serviços.php?status=atualizado");
        } else {
            ?>
            <h2>Nenhuma alteração realizada ou serviço não encontrado.</h2>
            <a href="serviços.php">Voltar para a lista de serviços</a>
            <?php
        }
    } else {
        header("Location: serviços.php");
    }
    exit;
    ?>

</body>

</html>