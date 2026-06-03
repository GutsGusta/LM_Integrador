<?php
require_once './data/crud.php';

$cliente = readAll($pdo, 'cliente');
$agendamento = readAll($pdo, 'agendamento');
$avaliacao = readAll($pdo, 'avaliacoes');
$profissional = readAll($pdo, 'profissional');

$IDcliente = [];
foreach ($cliente as $idclientes) {
    $IDcliente[$idclientes['id_cliente']] = $idclientes['nome_cliente'];
}

$IDprofissional = [];
foreach ($profissional as $idprofissionais) {
    $IDprofissional[$idprofissionais['id_profissional']] = $idprofissionais['nome_profissional'];
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tabela de visualização</title>
</head>

<body>

    <table>
        <tr>
            <th>Cliente</th>
            <th>Profissional</th>
            <th>Avaliação</th>
            <th>Preço</th>
            <th>Horário</th>
            <th>Agendamento</th>
            <th>Tipo de função</th>
            <th>Status</th>
        </tr>

        <?php

        foreach ($agendamento as $index => $agendamentos) {


            $nome_cliente = isset($IDcliente[$agendamentos['id_cliente']]) ? $IDcliente[$agendamentos['id_cliente']] : 'N/A';

            $nome_profissional = isset($IDprofissional[$agendamentos['id_profissional']]) ? $IDprofissional[$agendamentos['id_profissional']] : 'N/A';


            ?>


            <tr>
                <td><?php echo $nome_cliente; ?></td>
                <td><?php echo $nome_profissional; ?></td>
                <td><?php echo isset($avaliacao[$index]) ? $avaliacao[$index]['nota'] : 'N/A'; ?></td>
                <td><?php echo $agendamentos['preco']; ?></td>
                <td><?php echo $profissional[$index]['funcao']; ?></td>
                <td><?php echo $agendamentos['horario']; ?></td>
                <td><?php echo $agendamentos['data_agenda']; ?></td>
                <td><?php echo $agendamentos['status']; ?></td>
            </tr>

        <?php } ?>
    </table>

</body>

</html>