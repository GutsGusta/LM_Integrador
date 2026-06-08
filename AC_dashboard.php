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

$id_cliente = $_SESSION['user_id'] ?? 0;

$usuarios = readAll($pdo, "orcamentos INNER JOIN profissional ON orcamentos.id_profissional = profissional.id_profissional", "orcamentos.id_cliente = '$id_cliente' ORDER BY orcamentos.data DESC LIMIT 1");

$orcamentos = readAll($pdo, 'orcamentos', "id_cliente = '$id_cliente'");

$id_cliente = $_SESSION['user_id'] ?? 0;


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

$servicos = readAll($pdo, 'servicos', "id_cliente = '$id_cliente'");
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

    <?php
    require_once "partials/header.php";
    ?>

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

           <a href="login.php" class="nav-item nav-sair" name="logout"> <i class="fa-solid fa-right-from-bracket">
                    Sair</i>
            </a>

            </a>
        </div>

        <div class="cliente-wrapper">
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
                                <?php if (is_array($orcamentos)) {
                                    foreach ($orcamentos as $orcamento) {
                                        if ($orcamento['status'] == 'concluido') {
                                            echo '' . $orcamento['id_orcamento'] . '';
                                        }
                                    }
                                }
                                ;
                                ?>
                            </h3>
                            <span>Próximo Agendamento</span>
                        </div>
                    </div>

                    <div class="dash-card">
                        <i class="fa-solid fa-check-double dash-icon"></i>
                        <div class="dash-info">
                            <h3 class="destaque">
                                <?php echo $total_servicos_concluidos; ?>
                            </h3>

                            <span>Serviços Concluídos</span>
                        </div>
                    </div>
                </div>

                <?php
                if (is_array($usuarios)) {
                    foreach ($usuarios as $usuario) {
                        echo '

                <div class="orcamento-card">
                    <h3 class="card-titulo">Última Atividade</h3>

                    <div class="orcamento-linha">
                        <div class="orcamento-info">
<<<<<<< HEAD
                            <strong class="destaque">' . $usuario['titulo'] . '</strong>
                            <span> ' . $usuario['nome_profissional'] . ' -  ' . $usuario['funcao'] . '</span>
                        </div>
                        <div class="orcamento-valores">
                            <strong class="destaque">' . $usuario['preco'] . '</strong>
                            <span>' . $usuario['data'] . '</span>
                        </div>
                        <div class="orcamento-status status-pendente">
                            ' . $usuario['status'] . '
                        </div>
                    </div>

                </div>';
                    }
                    ;
                } else {
                    echo '<div class="orcamento-card"><p class="destaque">Nenhuma atividade recente encontrada.</p></div>';
                }

                ;
                ?>

            </div>
        </div>

</body>

</html>