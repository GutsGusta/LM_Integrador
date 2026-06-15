<?php
session_start();
require_once './data/crud.php';

if (isset($_GET['id'])) {
    $id_profissional = (int)$_GET['id'];

    try {
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");

        delete($pdo, 'avaliacoes', 'id_profissional = ' . $id_profissional);
        delete($pdo, 'agendamento', 'id_profissional = ' . $id_profissional);
        delete($pdo, 'servicos', 'id_profissional = ' . $id_profissional);
        
        delete($pdo, 'profissional', 'id_profissional = ' . $id_profissional);

        $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");
        
        header('Location: AD_funcionarios.php?sucesso=deletado');
        exit();

    } catch (PDOException $e) {
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");
        die("Erro crítico ao deletar: " . $e->getMessage());
    }
} else {
    header('Location: AD_funcionarios.php');
    exit();
}