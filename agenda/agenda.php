<?php
require_once 'crud.php';

$clientes = readAll($pdo, 'cliente');
$profissionais = readAll($pdo, 'profissional');


$data_selecionada = $_GET['data_agenda'] ?? $_POST['data_agenda'] ?? date('Y-m-d');

$id_profissional_selecionado =
    $_GET['id_profissional'] ??
    $_POST['id_profissional'] ??
    '';



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cliente'])) {

    $novoAgendamento = [
        'id_cliente' => $_POST['id_cliente'] ?? '',
        'id_profissional' => $_POST['id_profissional'] ?? '',
        'data_agenda' => $_POST['data_agenda'] ?? '',
        'horario' => $_POST['horario'] ?? '',
        'preco' => $_POST['preco'] ?? ''
    ];

    create($pdo, 'agenda', $novoAgendamento);

    header('Location: agenda.php?sucesso=1');
    exit;
}



$horarios_ocupados = [];

if (!empty($id_profissional_selecionado)) {

    $stmt = $pdo->prepare("
        SELECT horario 
        FROM agenda 
        WHERE data_agenda = ?
        AND id_profissional = ?
    ");

    $stmt->execute([
        $data_selecionada,
        $id_profissional_selecionado
    ]);

    $todos_agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($todos_agendamentos as $agenda) {
        if (isset($agenda['horario'])) {
            $horarios_ocupados[] = trim($agenda['horario']);
        }
    }
}



$horarios_sistema = [
    '09:00:00' => '09:00',
    '10:00:00' => '10:00',
    '11:00:00' => '11:00',
    '14:00:00' => '14:00',
    '15:00:00' => '15:00',
    '16:00:00' => '16:00',
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Agendamento</title>
</head>

<body>

    <?php if (isset($_GET['sucesso'])): ?>
        <p><strong>Agendamento realizado com sucesso!</strong></p>
    <?php endif; ?>


    <!-- FILTRO -->
    <form action="agenda.php" method="GET">

        <label>Data:</label><br>
        <input type="date" name="data_agenda" value="<?= htmlspecialchars($data_selecionada) ?>" required>

        <br><br>

        <label>Profissional:</label><br>

        <select name="id_profissional" required>

            <option value="">Selecione o profissional</option>

            <?php foreach ($profissionais as $p): ?>

                <option value="<?= $p['id_profissional'] ?>" <?= ($id_profissional_selecionado == $p['id_profissional']) ? 'selected' : '' ?>>

                    <?= htmlspecialchars($p['nome_profissional']) ?>

                </option>

            <?php endforeach; ?>

        </select>

        <br><br>

        <button type="submit">Filtrar horários</button>

    </form>

    <br>
    <hr>
    <br>


    <!-- FORMULÁRIO AGENDAMENTO -->
    <form action="agenda.php" method="POST">

        <input type="hidden" name="data_agenda" value="<?= htmlspecialchars($data_selecionada) ?>">

        <input type="hidden" name="id_profissional" value="<?= htmlspecialchars($id_profissional_selecionado) ?>">


        <label>Cliente:</label><br>

        <select name="id_cliente" required>

            <option value="">Selecione o cliente</option>

            <?php foreach ($clientes as $c): ?>

                <option value="<?= $c['id_cliente'] ?>">

                    <?= htmlspecialchars($c['nome_cliente']) ?>

                </option>

            <?php endforeach; ?>

        </select>

        <br><br>


        <label>Horário:</label><br>

        <select name="horario" required>

            <option value="">Selecione um horário</option>

            <?php
            foreach ($horarios_sistema as $valor_banco => $texto_exibicao) {

                $esta_ocupado = in_array($valor_banco, $horarios_ocupados);

                $disabled = $esta_ocupado ? 'disabled' : '';

                $texto_status = $esta_ocupado
                    ? ' (Ocupado)'
                    : ' (Disponível)';

                echo '
                    <option value="' . $valor_banco . '" ' . $disabled . '>
                        ' . $texto_exibicao . $texto_status . '
                    </option>
                ';
            }
            ?>

        </select>

        <br><br>


        <label>Preço (R$):</label><br>

        <input type="number" name="preco" step="0.01" required>

        <br><br>


        <button type="submit">Agendar</button>

    </form>

</body>

</html>