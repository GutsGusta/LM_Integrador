<?php
require 'data/crud.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $deleted = delete($pdo, 'profissional', "id_profissional = $id");

    if ($deleted) {
        header("Location: AD_funcionarios.php?status=excluido");
    } else {
        echo "Erro ao excluir o funcionário.";
    }
} else {
    header("Location: AD_funcionarios.php");
}
exit;