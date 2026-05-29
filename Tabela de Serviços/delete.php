<?php
require 'crud.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $deleted = delete($pdo, 'servicos', "id_servico = $id");

    if ($deleted) {
        header("Location: serviços.php?status=excluido");
    } else {
        echo "Erro ao excluir o serviços.";
    }
} else {
    header("Location: serviços.php");
}
exit;