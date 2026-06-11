<?php
session_start();
require_once 'data/crud.php';

/* CARDS */
$totalProfissionais = $pdo->query("
    SELECT COUNT(*) FROM profissional
")->fetchColumn();

$totalClientes = $pdo->query("
    SELECT COUNT(*) FROM cliente
")->fetchColumn();

$totalOrcamentos = $pdo->query("
    SELECT COUNT(*) FROM orcamentos
")->fetchColumn();

$orcamentosPendentes = $pdo->query("
    SELECT COUNT(*)
    FROM orcamentos
    WHERE status = 'Pendente'
")->fetchColumn();


$ultimosOrcamentos = $pdo->query("
    SELECT *
    FROM orcamentos
    ORDER BY id_orcamento DESC
    LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);


$melhoresProfissionais = $pdo->query("
    SELECT *
    FROM profissional
    ORDER BY projetos_concluidos DESC
    LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AD_dashboard.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Admin | LM</title>
</head>

<body>

    <?php require_once "partials/header.php"; ?>

    <div style="display:flex;">

        <div class="sidebar">

            <div class="sidebar-perfil">
                <img src="uploads/ricardo_almeida.png" alt="Cliente">
                <div class="sidebar-perfil-info">
                    <strong><?php echo $_SESSION['user_name']; ?></strong>
                    <span>Admin</span>
                </div>
            </div>

            <a href="AD_dashboard.php" class="nav-item ativo">
                <i class="fa-solid fa-house"></i>
                Meu Dashboard
            </a>

            <a href="AD_usuarios.php" class="nav-item">
                <i class="fa-solid fa-users"></i>
                Usuários
            </a>

            <a href="AD_servicos.php" class="nav-item">
                <i class="fa-solid fa-briefcase"></i>
                Serviços
            </a>

            <a href="AD_funcionarios.php" class="nav-item">
                <i class="fa-solid fa-helmet-safety"></i>
                Funcionários
            </a>
<<<<<<< HEAD

             <form method="POST" action="AC_agenda.php">
                <button type="submit" name="logout" class="nav-item nav-sair">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Sair
                </button>
            </form>
=======
            
            <form method="POST" action="AD_usuarios.php">
                <button type="submit" name="logout" class="nav-item nav-sair">
                    <i class="fa-solid fa-right-from-bracket">Sair</i>
                </button>
            </form>
        </div>
>>>>>>> 90948bb68782dbbbe59e5368151c2273fe1359ae

        </div>

        <div class="admin-content">

            <div class="dashboard-content">

                <h2 class="content-titulo">Dashboard</h2>

                <p class="boas-vindas">
                    Visão geral da plataforma LM hoje.
                </p>

                <div class="dashboard-grid">

                    <div class="dash-card">
                        <i class="fa-solid fa-helmet-safety dash-icon"></i>
                        <div class="dash-info">
                            <h3><?= $totalProfissionais ?></h3>
                            <span>Profissionais Ativos</span>
                        </div>
                    </div>

                    <div class="dash-card">
                        <i class="fa-solid fa-users dash-icon"></i>
                        <div class="dash-info">
                            <h3><?= $totalClientes ?></h3>
                            <span>Clientes Cadastrados</span>
                        </div>
                    </div>

                    <div class="dash-card">
                        <i class="fa-solid fa-file-lines dash-icon"></i>
                        <div class="dash-info">
                            <h3><?= $orcamentosPendentes ?></h3>
                            <span>Orçamentos Pendentes</span>
                        </div>
                    </div>

                    <div class="dash-card">
                        <i class="fa-solid fa-calendar-check dash-icon"></i>
                        <div class="dash-info">
                            <h3><?= $totalOrcamentos ?></h3>
                            <span>Total de Orçamentos</span>
                        </div>
                    </div>

                </div>

                <div class="cards-baixo">

                    <div class="orcamento-card">

                        <h3 class="card-titulo">
                            Últimos Orçamentos
                        </h3>

                        <?php foreach ($ultimosOrcamentos as $orcamento): ?>

                            <div class="orcamento-linha">

                                <div class="orcamento-info">

                                    <strong>
                                        <?= htmlspecialchars($orcamento['nome']) ?>
                                    </strong>

                                    <span>
                                        <?= htmlspecialchars($orcamento['email']) ?>
                                    </span>
                                    <span>
                                        <?= htmlspecialchars($orcamento['nome_cliente'] ?? 'Cliente') ?>
                                        ·
                                        <?= htmlspecialchars($orcamento['nome_profissional'] ?? 'Sem profissional') ?>
                                    </span>

                                </div>

                                <span class="orcamento-status">
                                    <?= htmlspecialchars($orcamento['status']) ?>
                                </span>

                            </div>

                        <?php endforeach; ?>

                    </div>

                    <div class="orcamento-card">

                        <h3 class="card-titulo">
                            Melhores Profissionais
                        </h3>

                        <div class="profs-lista">

                            <?php foreach ($melhoresProfissionais as $prof): ?>

                                <div class="prof-linha">

                                    <div class="prof-info">

                                        <img src="uploads/icone_usuario.png" alt="">

                                        <div>

                                            <strong>
                                                <?= htmlspecialchars($prof['nome_profissional']) ?>
                                            </strong>

                                            <span>
                                                <?= htmlspecialchars($prof['funcao']) ?>
                                            </span>

                                        </div>

                                    </div>

                                    <span class="estrelas-mini">
                                        <?= $prof['projetos_concluidos'] ?> serviços
                                    </span>

                                </div>

                            <?php endforeach; ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>