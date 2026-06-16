<?php
require_once './data/crud.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}


$id_profissional = $_GET['id'] ?? '';

$stmt = $pdo->prepare('SELECT * FROM profissional WHERE id_profissional = ?');
$stmt->execute([$id_profissional]);
$profissional = $stmt->fetch(PDO::FETCH_ASSOC);


$profissional = read(
    $pdo,
    'profissional',
    'id_profissional = ' . (int) $_SESSION['user_id']
);

if (!$profissional) {
    die('Profissional não encontrado.');
}

$meses_nomes_curtos = [
    1=>'Jan', 2=>'Fev', 3=>'Mar', 4=>'Abr', 5=>'Mai', 6=>'Jun',
    7=>'Jul', 8=>'Ago', 9=>'Set', 10=>'Out', 11=>'Nov', 12=>'Dez'
];

$sql_ganhos = "SELECT a.data_agenda, a.preco, s.nome_servico 
               FROM agendamento a
               INNER JOIN servicos s ON a.id_servico = s.id_servico
               WHERE a.id_profissional = ? AND a.status = 'Concluído'
               ORDER BY a.data_agenda DESC, a.horario_inicial DESC 
               LIMIT 3";
$stmt_ganhos = $pdo->prepare($sql_ganhos);
$stmt_ganhos->execute([$id_profissional]);
$ultimos_ganhos = $stmt_ganhos->fetchAll(PDO::FETCH_ASSOC);

$sql_proximos = "SELECT a.data_agenda, a.horario_inicial, a.horario_final, a.endereco, a.status, s.nome_servico 
                 FROM agendamento a
                 INNER JOIN servicos s ON a.id_servico = s.id_servico
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

<<<<<<< HEAD:AP-dashbord.php
                <form method="POST" action="AP-dashbord.php">
                    <button type="submit" name="logout" class="nav-item nav-sair">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Sair
=======
                <form method="POST" action="AP-dashboard.php">
                <button type="submit" name="logout" class="nav-item nav-sair">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Sair
>>>>>>> 2b8b6bcfba7ad72960d0d3541208b518d88a22cf:AP-dashboard.php
                    </button>
                </form>
            </div>

            <div class="dashbord">

                <div class="estatisticas">

                    <div class="estatisticas-indv">
                        <img src="uploads/fatura.png">

                        <div class="estatisticas-txt">
                            <h4>Experiência</h4>
                            <h1><?php echo htmlspecialchars($profissional['experiencia']); ?></h1>
                            <p>Tempo de atuação</p>
                        </div>
                    </div>

                    <div class="estatisticas-indv">
                        <img src="uploads/relogio.png">

                        <div class="estatisticas-txt">
                            <h4>Disponibilidade</h4>
                            <h1>
                                <?php
                                echo $profissional['disponibilidade']
                                    ? 'Sim'
                                    : 'Não';
                                ?>
                            </h1>
                            <p>Status atual</p>
                        </div>
                    </div>

                    <div class="estatisticas-indv">
                        <img src="uploads/Certo.png">

                        <div class="estatisticas-txt">
                            <h4>Projetos</h4>
                            <h1><?php echo htmlspecialchars($profissional['projetos_concluidos']); ?></h1>
                            <p>Projetos concluídos</p>
                        </div>
                    </div>

                </div>

                <div class="quadrados">

<<<<<<< HEAD:AP-dashbord.php
                    <?php

                    $orcamento_filtrado = readAll($pdo, 'orcamento', $orcament);




                    if ($avaliacao_filtrada) {
                        foreach ($avaliacao_filtrada as $avaliacoes) {
                            $dataHora = new DateTime($avaliacoes['data_avaliacao']);

                            echo '
    <p>ID:' . $avaliacoes['id'] . '</p>
    <p>Título:' . $avaliacoes['titulo'] . '</p>';

                            echo '
    <p>Data da Avaliação: ' . $dataHora->format('d/m/Y à\s H:i') . '</p>
    
    <p>Nota:' . $avaliacoes['nota'] . '</p>
    <p>Texto da Avaliação:<br>' . $avaliacoes['texto_avaliacao'] . '</p>
    <p>Profissional avaliado: ' . $avaliacoes['nome_profissional'] . '</p>';
                        }

                    } else {
                        echo '<p>Não há avaliações para este profissional.</p>';
                    }
                    ;

                    ?>
                    <div class="quadrados-indv">
                        <h2>Últimos Ganhos</h2>
                        <div class="linha"></div>
                        <div class="campo-servico">
                            <div class="ganhos">
                                <h4>Revestimento</h4>
                                <p>Quarto 10m²</p>
                            </div>
                            <div class="ganhos">
                                <h4>R$6700,69</h4>
                                <p>18/05/2026</p>
                            </div>
                            <h4>Alguma Coisa</h4>
                        </div>
                        <div class="campo-servico">
                            <div class="ganhos">
                                <h4>Revestimento</h4>
                                <p>Quarto 10m²</p>
                            </div>
                            <div class="ganhos">
                                <h4>R$6700,69</h4>
                                <p>18/05/2026</p>
                            </div>
                            <h4>Alguma Coisa</h4>
                        </div>
                        <div class="campo-servico">
                            <div class="ganhos">
                                <h4>Revestimento</h4>
                                <p>Quarto 10m²</p>
                            </div>
                            <div class="ganhos">
                                <h4>R$6700,69</h4>
                                <p>18/05/2026</p>
                            </div>
                            <h4>Alguma Coisa</h4>
                        </div>
=======
                    <div class="quadrados-indv">
                        <h2>Últimos Ganhos</h2>
                        <div class="linha"></div>
                        
                        <?php if (empty($ultimos_ganhos)): ?>
                            <p class="nenhum-servico">Nenhum serviço concluído até o momento.</p>
                        <?php else: ?>
                            <?php foreach ($ultimos_ganhos as $ganho): ?>
                                <div class="campo-servico">                          
                                    <div class="ganhos">
                                        <h4><?php echo htmlspecialchars($ganho['nome_servico']); ?></h4>
                                    </div>
                                    <div class="ganhos">
                                        <h4>R$ <?php echo number_format((float)$ganho['preco'], 2, ',', '.'); ?></h4>
                                        <p><?php echo date('d/m/Y', strtotime($ganho['data_agenda'])); ?></p>
                                    </div>                                     
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
>>>>>>> 2b8b6bcfba7ad72960d0d3541208b518d88a22cf:AP-dashboard.php
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
                                        <h4><?php echo htmlspecialchars($servico['nome_servico']); ?></h4>
                                        <p><?php echo "{$hora_i} - {$hora_f}"; ?></p>
                                        <h5><?php echo htmlspecialchars($servico['endereco']); ?></h5>
                                    </div>
                                    
                                    <?php if ($servico['status'] === 'Em andamento'): ?>
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