<?php

require_once('data/crud.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_tipo'])) {
    header('Location: login.php');
    exit;
}

$tipoUsuario = $_SESSION['user_tipo'];
$error = 'Entre como usuario cliente';

if ($tipoUsuario === 'cliente') {
    $id_cliente = $_SESSION['user_id'];
    $nome_cliente = $_SESSION['user_name'];

} elseif ($tipoUsuario === 'profissional' || $tipoUsuario === 'admin') {
    echo '<p style="color: red;">' . $error . '</p>';
    echo '<p><a href="login.php">Voltar para o Login</a></p>';
    exit;
}

$profissionalag = readAll($pdo, 'profissional');

$data_selecionada = $_GET['data_agenda'] ?? $_POST['data_agenda'] ?? date('Y-m-d');

$id_profissional_selecionado = $_GET['id_profissional'] ?? $_POST['id_profissional'] ?? '';


$tabelaJoin = "orcamentos INNER JOIN profissional ON orcamentos.id_profissional = profissional.id_profissional";
$condicaoJoin = "orcamentos.id_cliente = '" . $_SESSION['user_id'] . "' ORDER BY orcamentos.id_orcamento DESC";
$buscaUsuarios = readAll($pdo, $tabelaJoin, $condicaoJoin);
$usuarios = is_array($buscaUsuarios) ? $buscaUsuarios : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cliente'])) {

    $id_orcamento_selecionado = $_POST['id_orcamento'];
    $preco_real = 0;

    foreach ($usuarios as $usuario) {
        if ($usuario['id_orcamento'] == $id_orcamento_selecionado) {
            $preco_real = $usuario['preco'];
            break;
        }
    }

    $novoAgendamento = [
        'id_cliente' => $_POST['id_cliente'],
        'id_profissional' => $_POST['id_profissional'],
        'data_agenda' => $_POST['data_agenda'],
        'horario' => $_POST['horario'],
        'preco' => $preco_real,
        'id_orcamento' => $id_orcamento_selecionado,
        'tipo_responsavel' => $_POST['tipo_responsavel'],
        'nome_responsavel' => $_POST['nome_responsavel'] ?? '',
        'contato_responsavel' => $_POST['contato_responsavel'] ?? '',
        'cpf_responsavel' => $_POST['cpf_responsavel'] ?? '',
        'tipo_pagamento' => $_POST['tipo_pagamento'],
    ];

    create($pdo, 'agendamento', $novoAgendamento);

    header('Location: agendahorario.php?sucesso=1&id_profissional=' . $_POST['id_profissional'] . '&data_agenda=' . $_POST['data_agenda']);
    exit;
}

$horario_ocupado = [];
$orcamentos_ocupados = [];

if (!empty($id_profissional_selecionado)) {


    $stmt = $pdo->prepare('
    SELECT horario 
    FROM agendamento
    WHERE data_agenda = ?
    AND id_profissional = ?');

    $stmt->execute([
        $data_selecionada,
        $id_profissional_selecionado
    ]);

    $todos_agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($todos_agendamentos as $agenda) {
        if (isset($agenda['horario'])) {
            $horario_ocupado[] = trim($agenda['horario']);
        }
    }

    $stmtOrcamento = $pdo->prepare('SELECT id_orcamento FROM agendamento WHERE id_cliente = ? AND id_orcamento IS NOT NULL');
    $stmtOrcamento->execute([$id_cliente]);
    $agendamentos_cliente = $stmtOrcamento->fetchAll(PDO::FETCH_ASSOC);

    foreach ($agendamentos_cliente as $agendado) {
        $orcamentos_ocupados[] = $agendado['id_orcamento'];
    }
}

$horario_sistema = [
    '10:00:00' => '10:00',
    '11:00:00' => '11:00',
    '13:00:00' => '13:00',
    '14:00:00' => '14:00',
    '15:00:00' => '15:00',
    '16:00:00' => '16:00',
    '17:00:00' => '17:00',
    '19:00:00' => '19:00',
    '20:00:00' => '20:00',
];


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Minha Agenda</title>
</head>

<body>
    <h1>Bem-vindo à Agenda, <?php echo ($_SESSION['user_name']); ?>!</h1>

    <?php if (isset($_GET['sucesso'])): ?>
        <p style="color: green; font-weight: bold;">🎉 Agendamento realizado com sucesso!</p>
    <?php endif; ?>

    <form action="agendahorario.php" method="GET">

        <input type="hidden" name="id_profissional"
            value="<?php echo htmlspecialchars($id_profissional_selecionado); ?>">

        <label for="data">Data do Agendamento:</label>
        <input type="date" name="data_agenda" value="<?php echo $data_selecionada; ?>" required>

        <button type="submit">Filtrar horário</button>
    </form>

    <br>
    <hr><br>

    <?php if (!empty($id_profissional_selecionado)): ?>

        <?php if (empty($usuarios)): ?>
            <p><a href="orcamentos.php" style="color: red; font-weight: bold;">⚠️ Realize um orçamento antes de agendar</a></p>
        <?php endif; ?>

        <form action="agendahorario.php" method="POST">

            <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
            <input type="hidden" name="id_profissional" value="<?php echo $id_profissional_selecionado; ?>">
            <input type="hidden" name="data_agenda" value="<?php echo $data_selecionada; ?>">
            <label for="preco">Orçamento:</label>
            <select name="id_orcamento" required>
                <option value="">Selecione um orçamento</option>
                <?php
                foreach ($usuarios as $usuario) {

                    $ja_agendado = in_array(intval($usuario['id_orcamento']), $orcamentos_ocupados);
                    $cancelado = ($usuario['status'] === 'Cancelado');
                    $pendente = ($usuario['status'] === 'Pendente');

                    $desativado = ($cancelado || $ja_agendado || $pendente) ? 'disabled' : '';
                    $texto_status = $ja_agendado ? ' (Já Agendado)' : ($cancelado ? ' (Cancelado)' : ($pendente ? ' (Pendente)' : ''));

                    echo '<option value="' . $usuario['id_orcamento'] . '" ' . $desativado . '>
            ' . ($usuario['titulo']) . ' — R$ ' . $usuario['preco'] . $texto_status . '
        </option>';
                }
                ?>
            </select>
            <label for="Horário">Horário:</label>
            <select name="horario" required>
                <option value="">Selecione um horário</option>

                <?php
                foreach ($horario_sistema as $horario => $texto_tela) {
                    $ocupado = in_array($horario, $horario_ocupado);

                    $desativado = $ocupado ? 'disabled' : '';

                    $texto_status = $ocupado ? ' (Ocupado)' : ' (Disponível)';

                    echo '<option value="' . $horario . '" ' . $desativado . '>
                            ' . $texto_tela . $texto_status . '
                          </option> ';
                }
                ?>
            </select>

<h3>Quem irá receber o profissional?</h3>
            
            <div class="grupo-opcao">
                <input type="radio" name="tipo_responsavel" id="marcou_proprio" value="proprio" checked>
                <label for="marcou_proprio">Eu mesmo</label>
            </div>

            <br>

            <div class="grupo-opcao">
                <input type="radio" name="tipo_responsavel" id="marcou_outro" value="outro">
                <label for="marcou_outro">Outro responsável</label>
                
                <div class="campo-escondido">
                    <label for="nome_responsavel">Nome de quem vai receber o profissional:</label>
                    <input type="text" name="nome_responsavel" placeholder="EX:Marcelo">
                    <label for="contato_responsavel">Contato do responsável:</label>
                    <input type="text" name="contato_responsavel">
                    <label for="cpf_responsavel">CPF do responsável:</label>
                    <input type="text" name="cpf_responsavel" placeholder="EX: 123.456.789-00">
                </div>
            </div>

            <h3>Formas de pagamento</h3>

            <div class="grupo-opcao">
                <input type="radio" name="tipo_pagamento" id="marcou_pix" value="pix" checked>
                <label for="marcou_pix">Pix</label>

                <div class="campo-escondido">
                    <img src="uploads/">
                </div>
            </div>
            
            <br>

            <div class="grupo-opcao">
                <input type="radio" name="tipo_pagamento" id="marcou_cartao" value="cartao">
                <label for="marcou_cartao">Cartão de Crédito</label>

                <div class="campo-escondido">
                    <label for="nome_cartao">Nome no cartão:</label>
                    <input type="text" name="nome_cartao" placeholder="EX: Marcelo Silva">

                    <label for="numero_cartao">Número do cartão:</label>
                    <input type="text" name="numero_cartao" placeholder="EX: 1234 5678 9012 3456">

                    <label for="validade_cartao">Validade do cartão:</label>
                    <input type="text" name="validade_cartao" placeholder="EX: 12/25">

                    <label for="cvv_cartao">CVV do cartão:</label>
                    <input type="text" name="cvv_cartao" placeholder="EX: 123">
                </div>
            </div>

            <br>

            <br>
            <button type="submit">Agendar Horário</button>

        </form>

    <?php else:
        echo '
        <p style="color: #666;">⚠️ Nenhum profissional selecionado. Volte à página anterior e escolha um profissional.</p>';
    endif;
    ?>

    <style>
        /* Esconde o campo por padrão */
        .campo-escondido {
            display: none;
            margin-top: 10px;
        }

        /* Quando o botão "Outro responsável" for marcado, exibe a div logo em seguida */
        #marcou_outro:checked~.campo-escondido {
            display: block;
        }

        #marcou_cartao:checked~.campo-escondido {
            display: block;

        }

        #marcou_pix:checked~.campo-escondido {
            display: block;
        }

        .grupo-opcao {
            margin-bottom: 10px;
        }
    </style>

</body>

</html>