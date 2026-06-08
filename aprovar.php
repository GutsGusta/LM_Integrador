<?php
require_once './data/crud.php';

if (isset($_GET['id'])) {

    $stmt = $pdo->prepare("
    UPDATE agendamento
SET status = 'Em andamento'
WHERE id = ?
    ");

    $stmt->execute([$_GET['id']]);
}

header('Location: AP-servicos.php');
exit;