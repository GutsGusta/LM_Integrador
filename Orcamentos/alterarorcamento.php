<?php
require 'crud.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: orcamentos.php");
    exit;
}

$id_orcamento = (int) $_GET['id'];
$orcamento = read($pdo, 'orcamento', "id_orcamento = $id_orcamento");

if (!$orcamento) {
    echo "Orçamento não encontrado!";
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
        <input type="hidden" name="id_orcamento" value="<?= $orcamento['id_orcamento'] ?>">

        <input type="text" name="nome_cliente" placeholder="Nome do cliente"
            value="<?= htmlspecialchars($orcamento['nome_cliente']) ?>" required>

        <input type="text" name="orcamento" placeholder="Alterar valor"
            value="<?= htmlspecialchars($orcamento['valor_orcamento']) ?>" required>

        <button type="submit"> Salvar Alterações</button>
        <a href="orcamentos.php">Cancelar</a>

    </form>


</body>

</html>