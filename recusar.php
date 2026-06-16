<?php
require_once 'data/crud.php';

$id = $_GET['id'];

$sql = "UPDATE agendamento
        SET status = 'Recusado'
        WHERE id_agendamento = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header('Location: AP-servicos.php');
exit;
?>