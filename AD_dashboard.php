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
    if ($usuarioLogado !== 'admin') {
        header('Location: login.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
};



$orcamentos   = readAll($pdo, 'orcamentos');
$profissionais = readAll($pdo, 'profissional');
$servicos      = readAll($pdo, 'servicos');
$clientes      = readAll($pdo, 'cliente');
$agendamentos  = readAll($pdo, 'agendamento');

$total_orcamentos_pendentes = 0;
if (is_array($orcamentos)) {
    foreach ($orcamentos as $orcamento) {
        if ($orcamento['status'] == 'Pendente') {
            $total_orcamentos_pendentes++;
        }
    }
} else {
    $total_orcamentos_pendentes = 0;
}

$servicos = readAll($pdo, 'servicos');
$total_servicos_concluidos = 0;

if (is_array($servicos)) {
    foreach ($servicos as $servico) {
        if (($servico['status'] ?? '') == 'concluido') {
            $total_servicos_concluidos++;
        }
    }
} else {
    $total_servicos_concluidos = 0;
}


if (is_array($profissionais)) {
    $total_profissionais = count($profissionais);
} else {
    $total_profissionais = 0;
}

if (is_array($clientes)) {
    $total_clientes = count($clientes);
} else {
    $total_clientes = 0;
}

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
    <?php
    require_once "partials/header.php";
    ?>

    <div style="display: flex;">

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
                Usuarios
            </a>

            <a href="AD_servicos.php" class="nav-item">
                <i class="fa-solid fa-briefcase"></i>
                Serviços
            </a>

            <a href="AD_funcionarios.php" class="nav-item">
                <i class="fa-solid fa-helmet-safety"></i>
                Funcionários
            </a>


            <form method="POST" action="AD_dashboard.php">
                <button type="submit" name="logout" class="nav-item nav-sair">
                    <i class="fa-solid fa-right-from-bracket">Sair</i>
                    Sair
                </button>
            </form>
        </div>


        <div class="admin-content">
            <div class="dashboard-content">
                <h2 class="content-titulo">Dashboard</h2>
                <p class="boas-vindas">Visão geral da plataforma LM hoje.</p>

                <div class="dashboard-grid">
                    <div class="dash-card">
                        <i class="fa-solid fa-helmet-safety dash-icon"></i>
                        <div class="dash-info">
                            <h3><?php echo $total_profissionais; ?></h3>
                            <span>Profissionais Ativos</span>
                        </div>
                    </div>
                    <div class="dash-card">
                        <i class="fa-solid fa-users dash-icon"></i>
                        <div class="dash-info">
                            <h3><?php echo $total_clientes; ?></h3>
                            <span>Clientes Cadastrados</span>
                        </div>
                    </div>
                    <div class="dash-card">
                        <i class="fa-solid fa-file-lines dash-icon"></i>
                        <div class="dash-info">
                            <h3><?php echo $total_orcamentos_pendentes; ?></h3>
                            <span>Orçamentos Pendentes</span>
                        </div>
                    </div>
                    <div class="dash-card">
                        <i class="fa-solid fa-calendar-check dash-icon"></i>
                        <div class="dash-info">
                            <h3>7</h3>
                            <span>Agendamentos Hoje</span>
                        </div>
                    </div>
                </div>

                <div class="cards-baixo">

                    <div class="orcamento-card">
                        <h3 class="card-titulo">Últimos Orçamentos</h3>
                        <?php 
                        foreach ($orcamentos as $orcamento) {
                            echo '
                            <div class="orcamento-linha">
                                <div class="orcamento-info">
                                    <strong class="destaque">' . $orcamento['titulo'] . '</strong>
                                    <span> ' . $orcamento['nome_profissional'] . ' -  ' . $orcamento['funcao'] . '</span>
                                </div>
                                <span class="orcamento-status status-' . ($orcamento['status']) . '">' . $orcamento['status'] . '</span>
                            </div>';
                        }
                        ?>
                        <!-- <div class="orcamento-linha">
                            <div class="orcamento-info">
                                <strong>Reforma Banheiro</strong>
                                <span>João Pereira · Pedreiro</span>
                            </div>
                            <span class="orcamento-status status-pendente">Pendente</span>
                        </div>
                        <div class="orcamento-linha">
                            <div class="orcamento-info">
                                <strong>Levantamento Alvenaria</strong>
                                <span>Mariana Costa · Mestre de Obra</span>
                            </div>
                            <span class="orcamento-status status-concluido">Concluído</span>
                        </div>
                        <div class="orcamento-linha">
                            <div class="orcamento-info">
                                <strong>Assentamento de Piso</strong>
                                <span>Felipe Rodrigues · Servente</span>
                            </div>
                            <span class="orcamento-status status-cancelado">Cancelado</span>
                        </div>
                        <div class="orcamento-linha">
                            <div class="orcamento-info">
                                <strong>Reboque de Paredes</strong>
                                <span>Eduardo Lima · Pedreiro</span>
                            </div>
                            <span class="orcamento-status status-pendente">Pendente</span>
                        </div> -->
                    </div>

                    <div class="orcamento-card">
                        <h3 class="card-titulo">Melhores Profissionais</h3>
                        <div class="profs-lista">

                            <div class="prof-linha">
                                <div class="prof-info">
                                    <img src="https://pravatar.cc/150?img=47" alt="Ana">
                                    <div>
                                        <strong>Ana Pereira</strong>
                                        <span><span class="badge-tipo badge-mestre">Mestre de Obra</span></span>
                                    </div>
                                </div>
                                <span class="estrelas-mini">★★★★★ 4.9</span>
                            </div>

                            <div class="prof-linha">
                                <div class="prof-info">
                                    <img src="https://pravatar.cc/150?img=12" alt="Ricardo">
                                    <div>
                                        <strong>Ricardo Martins</strong>
                                        <span><span class="badge-tipo badge-pedreiro">Pedreiro</span></span>
                                    </div>
                                </div>
                                <span class="estrelas-mini">★★★★★ 4.8</span>
                            </div>

                            <div class="prof-linha">
                                <div class="prof-info">
                                    <img src="https://pravatar.cc/150?img=3" alt="Fernando">
                                    <div>
                                        <strong>Fernando Lopes</strong>
                                        <span><span class="badge-tipo badge-servente">Servente</span></span>
                                    </div>
                                </div>
                                <span class="estrelas-mini">★★★★☆ 4.6</span>
                            </div>

                            <div class="prof-linha">
                                <div class="prof-info">
                                    <img src="https://pravatar.cc/150?img=22" alt="Paulo">
                                    <div>
                                        <strong>Paulo Rocha</strong>
                                        <span><span class="badge-tipo badge-servente">Servente</span></span>
                                    </div>
                                </div>
                                <span class="estrelas-mini">★★★★☆ 4.5</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</body>

</html>