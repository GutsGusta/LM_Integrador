<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AC_dashboard.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Dashboard | LM</title>
</head>

<body>

    <?php
    require_once "partials/header.php";
    ?>

     <div class="cliente-wrapper">

        <div class="sidebar">
            <div class="sidebar-perfil">
                <img src="uploads/marcos_santos.png" alt="Cliente">
                <div class="sidebar-perfil-info">
                    <strong>Marcos Santos</strong>
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

            <a href="AC_agendamentos.php" class="nav-item">
                <i class="fa-solid fa-calendar"></i>
                Meus Agendamentos
            </a>

            <a href="AC_dados.php" class="nav-item">
                <i class="fa-solid fa-user"></i>
                Meus Dados
            </a>

            <a href="logout.php" class="nav-item nav-sair">
                <i class="fa-solid fa-right-from-bracket"></i>
                Sair
            </a>
        </div>

    <div class="cliente-wrapper">
        <div class="dashboard-content">
            <h2 class="content-titulo">Meu Dashboard</h2>
            <p class="boas-vindas">Olá, Marcos Santos! Resumo da sua conta hoje.</p>

            <div class="dashboard-grid">
                <div class="dash-card">
                    <i class="fa-solid fa-file-lines dash-icon"></i>
                    <div class="dash-info">
                        <h3 class="destaque">2</h3>
                        <span>Orçamentos Pendentes</span>
                    </div>
                </div>

                <div class="dash-card">
                    <i class="fa-solid fa-calendar-check dash-icon"></i>
                    <div class="dash-info">
                        <h3 class="destaque">1</h3>
                        <span>Próximo Agendamento</span>
                    </div>
                </div>

                <div class="dash-card">
                    <i class="fa-solid fa-check-double dash-icon"></i>
                    <div class="dash-info">
                        <h3 class="destaque">5</h3>
                        <span>Serviços Concluídos</span>
                    </div>
                </div>
            </div>

            <div class="orcamento-card">
                <h3 class="card-titulo">Última Atividade</h3>

                <div class="orcamento-linha">
                    <div class="orcamento-info">
                        <strong class="destaque">Reforma Banheiro</strong>
                        <span>João Silva - Pedreiro</span>
                    </div>
                    <div class="orcamento-valores">
                        <strong class="destaque">R$ 3.500 - R$ 4.200</strong>
                        <span>10/05/2026</span>
                    </div>
                    <div class="orcamento-status status-pendente">
                        Pendente
                    </div>
                </div>

                 <div class="orcamento-linha">
                    <div class="orcamento-info">
                        <strong class="destaque">Alvenaria</strong>
                        <span>Fernando Lopes - Servente</span>
                    </div>
                    <div class="orcamento-valores">
                        <strong class="destaque">R$ 3.500 - R$ 4.200</strong>
                        <span>08/05/2026</span>
                    </div>
                    <div class="orcamento-status status-concluido">
                        Concluído
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>