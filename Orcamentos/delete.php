<?php
require 'crud.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $deleted = delete($pdo, 'orcamento', "id_orcamento = $id");

    if ($deleted) {
        header("Location: orcamentos.php?status=excluido");
    } else {
        echo "Erro ao excluir o orçamento.";
    }
} else {
    header("Location: orcamentos.php");
}
exit;