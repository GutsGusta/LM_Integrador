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

                <a href="AP-dashbord.php" class="nav-item ativo">
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

                <form method="POST" action="AP-dashbord.php">
                    <button type="submit" name="logout" class="nav-item nav-sair">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Sair
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
                    </div>
                    <div class="quadrados-indv">
                        <h2>Próximos Serviços</h2>
                        <div class="linha"></div>
                        <div class="campo-servico">
                            <div class="data">
                                <h4>18</h4>
                                <h4>Maio</h4>
                            </div>
                            <div class="info">
                                <h4>Levantamento de Casa</h4>
                                <p>06:00-07:00</p>
                                <h5>R. Boa Vista, 67 - São Caetano</h5>
                            </div>
                            <p class="status-confirmado">Confirmado</p>
                        </div>
                        <div class="campo-servico">
                            <div class="data">
                                <h4>18</h4>
                                <h4>Maio</h4>
                            </div>
                            <div class="info">
                                <h4>Levantamento de Casa</h4>
                                <p>06:00-07:00</p>
                                <h5>R. Boa Vista, 67 - São Caetano</h5>
                            </div>
                            <p class="status-aguardo">Aguardando</p>
                        </div>
                        <div class="campo-servico">
                            <div class="data">
                                <h4>18</h4>
                                <h4>Maio</h4>
                            </div>
                            <div class="info">
                                <h4>Levantamento de Casa</h4>
                                <p>06:00-07:00</p>
                                <h5>R. Boa Vista, 67 - São Caetano</h5>
                            </div>
                            <p class="status-confirmado">Confirmado</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </main>

</body>

</html>