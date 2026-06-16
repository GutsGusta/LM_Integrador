<?php
require_once('data/crud.php');

session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: ./login.php');
    exit();
}

if (isset($_SESSION['user_tipo'])) {
    $usuarioLogado = $_SESSION['user_tipo'];
    if ($usuarioLogado !== 'cliente') {
        header('Location: login.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}

$categorias = [
    'mestre_de_obra' => 'Mestre de Obra',
    'pedreiro' => 'Pedreiro',
    'servente' => 'Servente'
];

$id_cliente = $_SESSION['user_id'] ?? 0;

// CORRIGIDO: orcamentos não tem id_profissional — profissional vem via agendamento
$usuarios = readAll(
    $pdo,
    "orcamentos
     LEFT JOIN agendamento  ON agendamento.id_orcamento     = orcamentos.id_orcamento
     LEFT JOIN profissional ON profissional.id_profissional = agendamento.id_profissional
     LEFT JOIN servicos     ON servicos.id_servico          = orcamentos.id_servico",
    "orcamentos.id_cliente = '$id_cliente' ORDER BY orcamentos.data_envio DESC LIMIT 1"
);

$orcamentos = readAll($pdo, 'orcamentos', "id_cliente = '$id_cliente'");

// Contar orçamentos pendentes
$total_orcamentos_pendentes = 0;
if (is_array($orcamentos)) {
    foreach ($orcamentos as $orcamento) {
        if ($orcamento['status'] == 'Pendente') {
            $total_orcamentos_pendentes++;
        }
    }
}

// Buscar próximo agendamento (Em andamento, data futura ou hoje)
$proximo_agendamento = null;
$sql_prox = "SELECT a.*, s.nome_servico
             FROM agendamento a
             LEFT JOIN orcamentos o ON a.id_orcamento = o.id_orcamento
             LEFT JOIN servicos s   ON o.id_servico   = s.id_servico
             WHERE a.id_cliente = ?
               AND a.status = 'Em andamento'
               AND a.data_agenda >= CURDATE()
             ORDER BY a.data_agenda ASC, a.horario_inicial ASC
             LIMIT 1";
$stmt = $pdo->prepare($sql_prox);
$stmt->execute([$id_cliente]);
$proximo_agendamento = $stmt->fetch(PDO::FETCH_ASSOC);

// Contar serviços concluídos
$servicos = readAll($pdo, 'servicos', "id_cliente = '$id_cliente'");
$total_servicos_concluidos = 0;
if (is_array($servicos)) {
    foreach ($servicos as $servico) {
        if (($servico['status'] ?? '') == 'concluido') {
            $total_servicos_concluidos++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AC_dashboard.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Cliente | LM</title>
</head>

<body>

    <?php require_once "partials/header.php"; ?>

    <div class="cliente-wrapper">

        <div class="sidebar">
            <div class="sidebar-perfil">
                <img src="uploads/default.png" alt="Cliente">
                <div class="sidebar-perfil-info">
                    <strong><?php echo $_SESSION['user_name']; ?></strong>
                    <span>Cliente</span>
                </div>
            </div>

            <a href="AC_dashboard.php" class="nav-item ativo">
                <i class="fa-solid fa-house"></i>
                Meu Dashboard
            </a>
            <a href="AC_orcamentos.php" class="nav-item">
                <i class="fa-solid fa-file-lines"></i>
                Meus Orçamentos
            </a>
            <a href="AC_agenda.php" class="nav-item">
                <i class="fa-solid fa-calendar"></i>
                Meus Agendamentos
            </a>
            <a href="AC_dados.php" class="nav-item">
                <i class="fa-solid fa-user"></i>
                Meus Dados
            </a>

            <form method="POST" action="AC_dashboard.php">
                <button type="submit" name="logout" class="nav-item nav-sair">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Sair
                </button>
            </form>
        </div>

        <div class="dashboard-content">
            <h2 class="content-titulo">Meu Dashboard</h2>
            <p class="boas-vindas">Olá, <?php echo $_SESSION['user_name']; ?>! Resumo da sua conta hoje.</p>

            <div class="dashboard-grid">

                <div class="dash-card">
                    <i class="fa-solid fa-file-lines dash-icon"></i>
                    <div class="dash-info">
                        <h3 class="destaque"><?php echo $total_orcamentos_pendentes; ?></h3>
                        <span>Orçamentos Pendentes</span>
                    </div>
                </div>

                <div class="dash-card">
                    <i class="fa-solid fa-calendar-check dash-icon"></i>
                    <div class="dash-info">
                        <h3 class="destaque">
                            <?php
                            // CORRIGIDO: exibe data do próximo agendamento real, não id de orçamento
                            if ($proximo_agendamento) {
                                echo date('d/m/Y', strtotime($proximo_agendamento['data_agenda']));
                            } else {
                                echo '—';
                            }
                            ?>
                        </h3>
                        <span>Próximo Agendamento</span>
                    </div>
                </div>

                <div class="dash-card">
                    <i class="fa-solid fa-check-double dash-icon"></i>
                    <div class="dash-info">
                        <h3 class="destaque"><?php echo $total_servicos_concluidos; ?></h3>
                        <span>Serviços Concluídos</span>
                    </div>
                </div>

            </div>

            <?php if (is_array($usuarios) && !empty($usuarios)): ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <div class="orcamento-card">
                        <h3 class="card-titulo">Última Atividade</h3>
                        <div class="orcamento-linha">

                            <div class="orcamento-info">
                                <!-- CORRIGIDO: campo era 'titulo' (não existe) → nome_servico ou mensagem -->
                                <strong class="destaque">
                                    <?= htmlspecialchars($usuario['nome_servico'] ?? $usuario['mensagem'] ?? 'Serviço') ?>
                                </strong>
                                <span>
                                    <?= htmlspecialchars($usuario['nome_profissional'] ?? 'Aguardando profissional') ?>
                                    <?php if (!empty($usuario['funcao'])): ?>
                                        - <?= htmlspecialchars($categorias[$usuario['funcao']] ?? $usuario['funcao']) ?>
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div class="orcamento-valores">
                                <!-- CORRIGIDO: campo era 'preco' (não existe em orcamentos) → valor_pedreiro -->
                                <strong class="destaque">
                                    R$ <?= number_format(
                                        $usuario['valor_servente'] ??
                                        $usuario['valor_mestre'] ??
                                        $usuario['valor_pedreiro'] ?? 0,
                                        2,
                                        ',',
                                        '.'
                                    ) ?> </strong>
                                <!-- CORRIGIDO: campo era 'data' (não existe) → data_envio -->
                                <span><?= date('d/m/Y', strtotime($usuario['data_envio'])) ?></span>
                            </div>

                            <div class="orcamento-status status-pendente">
                                <?= htmlspecialchars($usuario['status']) ?>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="orcamento-card">
                    <p class="destaque">Nenhuma atividade recente encontrada.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>

</body>

</html>