<?php
require_once './data/crud.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id_profissional = (int) $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

$profissional = read(
    $pdo,
    'profissional',
    'id_profissional = ' . $id_profissional
);

if (!$profissional) {
    die('Profissional não encontrado.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar_disponibilidade'])) {
    $nova_disponibilidade = trim($_POST['disponibilidade']);
    $valores_permitidos = ['Disponível', 'Alocado', 'Em serviço', 'Indisponível'];

    if (in_array($nova_disponibilidade, $valores_permitidos)) {
        update($pdo, 'profissional', ['disponibilidade' => $nova_disponibilidade], "id_profissional = " . $id_profissional);
        header('Location: AP-dashboard.php');
        exit;
    }
}

$meses_nomes_curtos = [
    1 => 'Jan', 2 => 'Fev', 3 => 'Mar', 4 => 'Abr', 5 => 'Mai', 6 => 'Jun',
    7 => 'Jul', 8 => 'Ago', 9 => 'Set', 10 => 'Out', 11 => 'Nov', 12 => 'Dez'
];

$sql_ganhos = "SELECT a.data_agenda, a.preco, 
                      COALESCE(s.nome_servico, o.nome, 'Serviço s/ Nome') AS nome_exibicao
               FROM agendamento a
               LEFT JOIN servicos s ON a.id_servico = s.id_servico
               LEFT JOIN orcamentos o ON a.id_orcamento = o.id_orcamento
               WHERE a.id_profissional = ? AND a.status = 'Concluído'
               ORDER BY a.data_agenda DESC, a.horario_inicial DESC 
               LIMIT 3";
$stmt_ganhos = $pdo->prepare($sql_ganhos);
$stmt_ganhos->execute([$id_profissional]);
$ultimos_ganhos = $stmt_ganhos->fetchAll(PDO::FETCH_ASSOC);

$sql_proximos = "SELECT a.data_agenda, a.horario_inicial, a.horario_final, a.endereco, a.status,
                        COALESCE(s.nome_servico, o.nome, 'Agendamento s/ Nome') AS nome_exibicao
                 FROM agendamento a
                 LEFT JOIN servicos s ON a.id_servico = s.id_servico
                 LEFT JOIN orcamentos o ON a.id_orcamento = o.id_orcamento
                 WHERE a.id_profissional = ? 
                   AND a.status = 'Em andamento' 
                   AND a.data_agenda >= CURDATE()
                 ORDER BY a.data_agenda ASC, a.horario_inicial ASC 
                 LIMIT 3";
$stmt_proximos = $pdo->prepare($sql_proximos);
$stmt_proximos->execute([$id_profissional]);
$proximos_servicos = $stmt_proximos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AP.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Área de Trabalho</title>
</head>

<body>

    <?php require_once 'partials/header.php'; ?>

    <main>
        <div class="pagina-principal">

            <div class="sidebar">
                <div class="sidebar-perfil">
                    <img src="uploads/<?php echo $profissional['foto']; ?>" alt="Foto">
                    <div class="sidebar-perfil-info">
                        <strong><?php echo htmlspecialchars($profissional['nome_profissional']); ?></strong>
                        <span><?php echo htmlspecialchars($profissional['cidade_estado']); ?></span>
                        <span><?php echo htmlspecialchars($profissional['funcao']); ?></span>
                    </div>
                </div>

                <a href="AP-dashboard.php" class="nav-item ativo">
                    <i class="fa-solid fa-house"></i>
                    Meu Dashboard
                </a>

                <a href="AP-servicos.php" class="nav-item">
                    <i class="fa-solid fa-file-lines"></i>
                    Meus Serviços
                </a>

                <a href="AP-agenda.php" class="nav-item">
                    <i class="fa-solid fa-calendar"></i>
                    Meus Agendamentos
                </a>

                <a href="AP-dados.php" class="nav-item">
                    <i class="fa-solid fa-user"></i>
                    Meus Dados
                </a>

                <form method="POST" action="AP-dashboard.php">
                    <button type="submit" name="logout" class="nav-item nav-sair">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Sair
                    </button>
                </form>
            </div>

            <div class="dashbord">

                <div class="estatisticas">

                    <div class="estatisticas-indv">
                        <img src="uploads/fatura.png" alt="Experiência">
                        <div class="estatisticas-txt">
                            <h4>Experiência</h4>
                            <h1><?php echo htmlspecialchars($profissional['experiencia']); ?></h1>
                            <p>Tempo de atuação</p>
                        </div>
                    </div>

                    <div class="estatisticas-indv">
                        <img src="uploads/relogio.png" alt="Relógio">
                        <div class="estatisticas-txt">
                            <h4>Disponibilidade</h4>
                            <form method="POST" action="AP-dashboard.php" style="margin-top: 5px;">
                                <input type="hidden" name="atualizar_disponibilidade" value="1">
                                <select name="disponibilidade" onchange="this.form.submit()" class="disponibilidade">
                                    <option value="Disponível" <?= ($profissional['disponibilidade'] === 'Disponível' ? 'selected' : '') ?>>Disponível</option>
                                    <option value="Alocado" <?= ($profissional['disponibilidade'] === 'Alocado' ? 'selected' : '') ?>>Alocado</option>
                                    <option value="Em serviço" <?= ($profissional['disponibilidade'] === 'Em serviço' ? 'selected' : '') ?>>Em serviço</option>
                                    <option value="Indisponível" <?= ($profissional['disponibilidade'] === 'Indisponível' ? 'selected' : '') ?>>Indisponível</option>
                                </select>
                            </form>
                            <p style="margin-top: 5px;">Status atual</p>
                        </div>
                    </div>

                    <div class="estatisticas-indv">
                        <img src="uploads/Certo.png" alt="Projetos">
                        <div class="estatisticas-txt">
                            <h4>Projetos</h4>
                            <h1><?php echo htmlspecialchars($profissional['projetos_concluidos']); ?></h1>
                            <p>Projetos concluídos</p>
                        </div>
                    </div>

                </div> <div class="quadrados">

                    <div class="quadrados-indv">
                        <h2>Últimos Ganhos</h2>
                        <div class="linha"></div>
                        
                        <?php if (empty($ultimos_ganhos)): ?>
                            <p class="nenhum-servico">Nenhum serviço concluído até o momento.</p>
                        <?php else: ?>
                            <?php foreach ($ultimos_ganhos as $ganho): ?>
                                <div class="campo-servico">                          
                                    <div class="ganhos">
                                        <h4><?php echo htmlspecialchars($ganho['nome_exibicao']); ?></h4>
                                    </div>
                                    <div class="ganhos">
                                        <h4>R$ <?php echo number_format((float)$ganho['preco'], 2, ',', '.'); ?></h4>
                                        <p><?php echo date('d/m/Y', strtotime($ganho['data_agenda'])); ?></p>
                                    </div>                                     
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="quadrados-indv">
                        <h2>Próximos Serviços</h2>
                        <div class="linha"></div>

                        <?php if (empty($proximos_servicos)): ?>
                            <p class="nenhum-servico">Sem serviços agendados para os próximos dias.</p>
                        <?php else: ?>
                            <?php foreach ($proximos_servicos as $servico): 
                                $dia_num = date('d', strtotime($servico['data_agenda']));
                                $mes_num = (int)date('m', strtotime($servico['data_agenda']));
                                $mes_nome = $meses_nomes_curtos[$mes_num] ?? '';

                                $hora_i = date('H:i', strtotime($servico['horario_inicial']));
                                $hora_f = date('H:i', strtotime($servico['horario_final']));
                            ?>
                                <div class="campo-servico">
                                    <div class="data">
                                        <h4><?php echo $dia_num; ?></h4>
                                        <h4><?php echo $mes_nome; ?></h4>
                                    </div>
                                    <div class="info">
                                        <h4><?php echo htmlspecialchars($servico['nome_exibicao']); ?></h4>
                                        <p><?php echo "{$hora_i} - {$hora_f}"; ?></p>
                                        <h5><?php echo htmlspecialchars($servico['endereco']); ?></h5>
                                    </div>
                                    
                                    <?php if (isset($servico['status']) && $servico['status'] === 'Em andamento'): ?>
                                        <p class="status-confirmado">Confirmado</p>
                                    <?php else: ?>
                                        <p class="status-aguardo">Aguardando</p>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>