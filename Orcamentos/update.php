<?php
require 'data/crud.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Dados Atualizados</title>
</head>

<body>

    <div class='box'>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int) $_POST['id_orcamento'];

            $dadosAtualizados = [
                'nome_cliente' => trim($_POST['nome_cliente']),
                'valor_orcamento' => trim($_POST['orcamento']),

            ];

            $linhas = update($pdo, 'orcamento', $dadosAtualizados, "id_orcamento = $id");

            if ($linhas > 0) {
                header("Location: orcamentos.php?status=atualizado");
            } else {
                ?>
                <h2>Nenhuma alteração realizada ou orçamento não encontrado.</h2>
                <a href="orcamentos.php">Voltar para a lista de orçamentos</a>
                <?php
            }
        } else {
            header("Location: orcamentos.php");
        }
        exit;
        ?>
    </div>
</body>

</html>