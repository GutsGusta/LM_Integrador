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

if ($tipoUsuario === 'profissional' || $tipoUsuario === 'admin') {
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/agendahorario.css">
        <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
        <title>Acesso Negado — LM</title>
    </head>
    <body>
        <?php require_once 'partials/header.php'; ?>
        <div class="pagina-agenda">
            <p class="alerta-aviso"> Acesso negado. Esta área é exclusiva para clientes.</p>
            <p style="color: rgba(255,255,255,0.6); font-size:14px;"><a href="login.php" style="color:#e79128;">Voltar para o Login</a></p>
        </div>
    </body>
    </html>
    <?php
    exit;
}

$id_cliente   = $_SESSION['user_id'];
$nome_cliente = $_SESSION['user_name'];

$profissionalag = readAll($pdo, 'profissional');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data_selecionada            = $_POST['data_agenda']     ?? date('Y-m-d');
    $id_profissional_selecionado = $_POST['id_profissional'] ?? '';
} else {
    $data_selecionada            = $_GET['data_agenda']     ?? date('Y-m-d');
    $id_profissional_selecionado = $_GET['id_profissional'] ?? '';
}

// Busca todos os serviços do profissional selecionado
$todos_servicos = [];

if (!empty($id_profissional_selecionado)) {
    $stmt_servicos = $pdo->prepare('SELECT * FROM servicos WHERE id_profissional = ?');
    $stmt_servicos->execute([$id_profissional_selecionado]);
    $todos_servicos = $stmt_servicos->fetchAll(PDO::FETCH_ASSOC);
}

// Retorna o preço conforme a função do profissional
function valorPorFuncao(array $servico, string $funcao = ''): float
{
    switch ($funcao) {
        case 'servente':
            return (float) $servico['valor_servente'];
        case 'pedreiro':
            return (float) $servico['valor_pedreiro'];
        case 'mestre_de_obra':
            return (float) $servico['valor_mestre'];
        default:
            return (float) $servico['preco'];
    }
}

// PROCESSAMENTO DO FORMULÁRIO DE AGENDAMENTO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cliente'])) {
    $id_servico_selecionado = (int) $_POST['id_servico'];
    $preco_por_hora = 0;

    $stmt_preco = $pdo->prepare('
        SELECT s.*, p.funcao
        FROM servicos s
        INNER JOIN profissional p ON p.id_profissional = s.id_profissional
        WHERE s.id_servico = ?
    ');
    $stmt_preco->execute([$id_servico_selecionado]);
    $servico_selecionado = $stmt_preco->fetch(PDO::FETCH_ASSOC);

    if ($servico_selecionado) {
        $preco_por_hora = valorPorFuncao($servico_selecionado, $servico_selecionado['funcao']);
    }

    $horario_inicio = $_POST['horario'];
    $horario_fim    = $_POST['horario_fim'];

    $tempo_inicio = new DateTime($horario_inicio);
    $tempo_fim    = new DateTime($horario_fim);

    if ($tempo_inicio >= $tempo_fim) {
        header('Location: agendahorario.php?erro=horario_invalido&id_profissional=' . $id_profissional_selecionado . '&data_agenda=' . $data_selecionada);
        exit;
    }

    // --- CÁLCULO DAS HORAS TRABALHADAS ---
    $intervalo = $tempo_inicio->diff($tempo_fim);
    $total_horas = $intervalo->h + ($intervalo->days * 24); 
    $valor_total_final = $total_horas * $preco_por_hora;

    $novoAgendamento = [
        'id_cliente'          => $_POST['id_cliente'],
        'id_profissional'     => $id_profissional_selecionado,
        'id_orcamento'        => null,
        'id_servico'          => $id_servico_selecionado, 
        'data_agenda'         => $data_selecionada,
        'horario_inicial'     => $tempo_inicio->format('H:i:s'), 
        'horario_final'       => $tempo_fim->format('H:i:s'),    
        'preco'               => $valor_total_final,             
        'endereco'            => $_POST['endereco'] ?? '',       // MUDANÇA: Salvando o endereço enviado pelo formulário
        'tipo_responsavel'    => $_POST['tipo_responsavel'],
        'nome_responsavel'    => $_POST['nome_responsavel']    ?? '',
        'contato_responsavel' => $_POST['contato_responsavel'] ?? '',
        'cpf_responsavel'     => $_POST['cpf_responsavel']     ?? '',
        'tipo_pagamento'      => $_POST['tipo_pagamento'],
    ];

    create($pdo, 'agendamento', $novoAgendamento);

    header('Location: agendahorario.php?sucesso=1&horas=' . $total_horas . '&total=' . $valor_total_final . '&id_profissional=' . $id_profissional_selecionado . '&data_agenda=' . $data_selecionada);
    exit;
}

$horario_ocupado = [];

if (!empty($id_profissional_selecionado)) {
    $stmt = $pdo->prepare('SELECT horario_inicial, horario_final FROM agendamento WHERE data_agenda = ? AND id_profissional = ?');
    $stmt->execute([$data_selecionada, $id_profissional_selecionado]);

    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $agenda) {
        if (isset($agenda['horario_inicial']) && isset($agenda['horario_final'])) {
            $h_ini = new DateTime($agenda['horario_inicial']);
            $h_fim = new DateTime($agenda['horario_final']);
            
            while ($h_ini < $h_fim) {
                $horario_ocupado[] = $h_ini->format('H:i:s');
                $h_ini->modify('+1 hour');
            }
        }
    }
}

$horario_sistema = [
    '08:00:00' => '08:00',
    '09:00:00' => '09:00',
    '10:00:00' => '10:00',
    '11:00:00' => '11:00',
    '13:00:00' => '13:00',
    '14:00:00' => '14:00',
    '15:00:00' => '15:00',
    '16:00:00' => '16:00',
    '17:00:00' => '17:00',
    '19:00:00' => '19:00',
    '20:00:00' => '20:00',
    '21:00:00' => '21:00',
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/agendahorario.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>Agendar Horário — LM</title>
</head>
<body>
    <?php require_once "partials/header.php"; ?>

    <div class="pagina-agenda">
        <h1 class="agenda-titulo">Agendar Horário</h1>
        <p class="agenda-subtitulo">Olá, <?php echo htmlspecialchars($nome_cliente); ?>! Escolha a data e o horário disponível.</p>

        <?php if (isset($_GET['sucesso'])): ?>
            <div class="alerta-sucesso">
                 Agendamento realizado com sucesso! <br>
                <strong>Total de Horas:</strong> <?php echo (int)$_GET['horas']; ?>h | 
                <strong>Valor Total:</strong> R$ <?php echo number_format((float)$_GET['total'], 2, ',', '.'); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['erro']) && $_GET['erro'] === 'horario_invalido'): ?>
            <div class="alerta-aviso"> Horário inválido. O término deve ser após o início.</div>
        <?php endif; ?>

        <div class="card-secao">
            <h3>Data do Agendamento</h3>
            <form action="agendahorario.php" method="GET" class="form-filtro">
                <input type="hidden" name="id_profissional" value="<?php echo htmlspecialchars($id_profissional_selecionado); ?>">
                <div class="campo" style="flex:1; margin:0;">
                    <label for="data_agenda">Selecione a data</label>
                    <input type="date" name="data_agenda" id="data_agenda" value="<?php echo htmlspecialchars($data_selecionada); ?>" required>
                </div>
                <div style="padding-top: 22px;">
                    <button type="submit" class="btn-filtrar">Filtrar</button>
                </div>
            </form>
        </div>

        <?php if (!empty($id_profissional_selecionado)): ?>
            <?php if (empty($todos_servicos)): ?>
                <div class="alerta-aviso">
                    Nenhum serviço disponível para este profissional.
                </div>
            <?php endif; ?>

            <form action="agendahorario.php" method="POST">
                <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
                <input type="hidden" name="id_profissional" value="<?php echo htmlspecialchars($id_profissional_selecionado); ?>">
                <input type="hidden" name="data_agenda" value="<?php echo htmlspecialchars($data_selecionada); ?>">

                <div class="card-secao">
                    <h3>📋 Serviço e Horário</h3>
                    <div class="campos-grid">
                        <div class="campo">
                            <label for="id_servico">Serviço (Preço por Hora)</label>
                            <select name="id_servico" id="id_servico" required>
                                <option value="">Selecione um serviço</option>
                                <?php foreach ($todos_servicos as $servico):
                                    $cancelado     = ($servico['status'] === 'cancelado');
                                    $desativado    = $cancelado ? 'disabled' : '';
                                    $texto_status  = $cancelado ? ' (Cancelado)' : '';
                                    $valor_exibido = (float) $servico['preco'];
                                ?>
                                    <option value="<?php echo $servico['id_servico']; ?>" <?php echo $desativado; ?>>
                                        <?php echo htmlspecialchars($servico['nome_servico']); ?> — R$ <?php echo number_format($valor_exibido, 2, ',', '.'); ?>/h<?php echo $texto_status; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="campo">
                            <label for="horario">Horário de Início</label>
                            <select name="horario" id="horario" required>
                                <option value="">Selecione o início</option>
                                <?php foreach ($horario_sistema as $horario => $texto_tela):
                                    if ($horario === '21:00:00') continue;
                                    $ocupado = in_array($horario, $horario_ocupado);
                                ?>
                                    <option value="<?php echo $horario; ?>" <?php echo $ocupado ? 'disabled' : ''; ?>>
                                        <?php echo $texto_tela . ($ocupado ? ' (Ocupado)' : ' (Disponível)'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="campo">
                            <label for="horario_fim">Horário de Término</label>
                            <select name="horario_fim" id="horario_fim" required>
                                <option value="">Selecione o término</option>
                                <?php foreach ($horario_sistema as $horario => $texto_tela):
                                    if ($horario === '08:00:00') continue;
                                    $tempo_opcao = new DateTime($horario);
                                    $tempo_opcao->modify('-1 hour');
                                    $hora_anterior = $tempo_opcao->format('H:i:s');
                                    $ocupado = in_array($hora_anterior, $horario_ocupado);
                                ?>
                                    <option value="<?php echo $horario; ?>" <?php echo $ocupado ? 'disabled' : ''; ?>>
                                        <?php echo $texto_tela . ($ocupado ? ' (Ocupado)' : ' (Disponível)'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- MUDANÇA: Adicionado o campo de endereço para onde o serviço será prestado -->
                    <div class="campo" style="margin-top: 20px;">
                        <label for="endereco">Endereço de Atendimento</label>
                        <input type="text" name="endereco" id="endereco" placeholder="Ex: Rua das Flores, 123 - Bairro Centro" required style="width: 100%; box-sizing: border-box;">
                    </div>
                </div>

                <div class="card-secao">
                    <h3>Quem vai receber o profissional?</h3>
                    <div class="grupo-radio">
                        <div class="grupo-opcao">
                            <label class="opcao-radio">
                                <input type="radio" name="tipo_responsavel" id="marcou_proprio" value="proprio" checked>
                                Eu mesmo
                            </label>
                        </div>

                        <div class="grupo-opcao">
                            <input type="radio" name="tipo_responsavel" id="marcou_outro" value="outro">
                            <label for="marcou_outro" style="display:inline; margin:0 0 0 8px; cursor:pointer;">Outro responsável</label>

                            <div class="campo-escondido">
                                <div class="campos-grid">
                                    <div class="campo">
                                        <label>Nome do responsável</label>
                                        <input type="text" name="nome_responsavel" placeholder="Ex: Marcelo">
                                    </div>
                                    <div class="campo">
                                        <label>Contato</label>
                                        <input type="text" name="contato_responsavel" placeholder="Ex: (11) 99999-9999">
                                    </div>
                                </div>
                                <div class="campo">
                                    <label>CPF do responsável</label>
                                    <input type="text" name="cpf_responsavel" placeholder="Ex: 123.456.789-00">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-secao">
                    <h3>Forma de Pagamento</h3>
                    <div class="grupo-radio">
                        <div class="grupo-opcao">
                            <input type="radio" name="tipo_pagamento" id="marcou_pix" value="pix" checked>
                            <label for="marcou_pix" style="display:inline; margin:0 0 0 8px; cursor:pointer;">Pix</label>
                            <div class="campo-escondido">
                                <p style="color: rgba(255,255,255,0.6); font-size:13px;">A chave Pix será enviada após a confirmação do agendamento.</p>
                            </div>
                        </div>

                        <div class="grupo-opcao">
                            <input type="radio" name="tipo_pagamento" id="marcou_cartao" value="cartao">
                            <label for="marcou_cartao" style="display:inline; margin:0 0 0 8px; cursor:pointer;">Cartão de Crédito</label>

                            <div class="campo-escondido">
                                <div class="campo">
                                    <label>Nome no cartão</label>
                                    <input type="text" name="nome_cartao" placeholder="Ex: Marcelo Silva">
                                </div>
                                <div class="campo">
                                    <label>Número do cartão</label>
                                    <input type="text" name="numero_cartao" placeholder="1234 5678 9012 3456">
                                </div>
                                <div class="campos-grid">
                                    <div class="campo">
                                        <label>Validade</label>
                                        <input type="text" name="validade_cartao" placeholder="MM/AA">
                                    </div>
                                    <div class="campo">
                                        <label>CVV</label>
                                        <input type="text" name="cvv_cartao" placeholder="123">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-agendar">Confirmar Agendamento</button>
            </form>
        <?php else: ?>
            <div class="card-secao aviso-vazio">
                Nenhum profissional selecionado. Volte à página anterior e escolha um profissional.
            </div>
        <?php endif; ?>
    </div>

    <?php require_once "partials/footer.php"; ?>
</body>
</html>

