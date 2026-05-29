<?php
require 'crud.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: serviços.php");
    exit;
}

$id_servico = (int) $_GET['id'];
$servico = read($pdo, 'servicos', "id_servico = $id_servico");

if (!$servico) {
    echo "Serviço não encontrado!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Orçamento</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>


    <h1> Editar Informações</h1>


    <form action="update.php" method="POST">
        <input type="hidden" name="id_servico" value="<?= $servico['id_servico'] ?>">

        <input type="text" name="nome_servico" placeholder="Nome Do Servico"
            value="<?= htmlspecialchars($servico['nome_servico']) ?>" required>

        <input type="text" name="tipo_servico" Placeholder="Tipo Do Servico"
            value="<?= htmlspecialchars($servico['tipo_servico']) ?>" required>

        <input type="number" step="0.01" name="valor_pedreiro" placeholder="Valor do Pedreiro"
            value="<?= htmlspecialchars($servico['valor_pedreiro']) ?>" required>

        <input type="number" step="0.01" name="valor_mestre" placeholder="Valor do Mestre"
            value="<?= htmlspecialchars($servico['valor_mestre']) ?>" required>

        <input type="number" step="0.01" name="valor_servente" placeholder="Valor do Servente"
            value="<?= htmlspecialchars($servico['valor_servente']) ?>" required>

        <button type="submit"> Salvar Alterações</button>
        <a href="serviços.php">Cancelar</a>

    </form>


</body>

</html>