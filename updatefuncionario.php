<?php
require 'data/crud.php';
?>
<!DOCTYPE html>
<html lang="en">

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
            $id = (int) $_POST['id_profissional'];

            $dadosAtualizados = [
                'nome_profissional' => trim($_POST['nome_profissional']),
                'email' => trim($_POST['email']),
                'telefone' => trim($_POST['telefone']),
                'cidade_estado' => trim($_POST['cidade_estado']),

            ];

            $linhas = update($pdo, 'profissional', $dadosAtualizados, "id_profissional = $id");

            if ($linhas > 0) {
                header("Location: AD_funcionarios.php?status=atualizado");
            } else {
                ?>
                <h2>Nenhuma alteração realizada ou funcionário não encontrado.</h2>
                <a href="AD_funcionarios.php">Voltar para a lista de profissionais</a>
                <?php
            }
        } else {
            header("Location: AD_funcionarios.php");
        }
        exit;
        ?>
    </div>
</body>

</html>