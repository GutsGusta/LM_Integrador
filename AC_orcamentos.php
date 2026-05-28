<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AC_orcamentos.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Meus orçamentos | LM</title>
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

            <a href="AC_dashboard.php" class="nav-item">
                <i class="fa-solid fa-house"></i>
                Meu Dashboard
            </a>

            <a href="AC_orcamentos.php" class="nav-item ativo">
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

            <a href="logout.php" class="nav-item nav-sair">
                <i class="fa-solid fa-right-from-bracket"></i>
                Sair
            </a>
        </div>

        <div class="orcamentos-content">
            <h2 class="content-titulo">Meus Orçamentos:</h2>

            <div class="orcamento-card">

                <div class="orcamento-linha">
                    <div class="orcamento-info">
                        <strong>Reforma Banheiro</strong>
                        <span>João Silva - Pedreiro</span>
                    </div>
                    <div class="orcamento-valores">
                        <strong>R$ 3.500 - R$ 4.200</strong>
                        <span>10/05/2026</span>
                    </div>
                    <div class="orcamento-status status-pendente">
                        Pendente
                    </div>
                </div>

                <div class="orcamento-linha">
                    <div class="orcamento-info">
                        <strong>Reforma Banheiro</strong>
                        <span>João Silva - Pedreiro</span>
                    </div>
                    <div class="orcamento-valores">
                        <strong>R$ 3.500 - R$ 4.200</strong>
                        <span>10/05/2026</span>
                    </div>
                    <div class="orcamento-status status-aceito">
                        Aceito
                    </div>
                </div>

                <div class="orcamento-linha">
                    <div class="orcamento-info">
                        <strong>Reforma Banheiro</strong>
                        <span>João Silva - Pedreiro</span>
                    </div>
                    <div class="orcamento-valores">
                        <strong>R$ 3.500 - R$ 4.200</strong>
                        <span>10/05/2026</span>
                    </div>
                    <div class="orcamento-status status-concluido">
                        Concluído
                    </div>
                </div>

                <div class="orcamento-linha">
                    <div class="orcamento-info">
                        <strong>Reforma Banheiro</strong>
                        <span>João Silva - Pedreiro</span>
                    </div>
                    <div class="orcamento-valores">
                        <strong>R$ 3.500 - R$ 4.200</strong>
                        <span>10/05/2026</span>
                    </div>
                    <div class="orcamento-status status-cancelado">
                        Cancelado
                    </div>
                </div>

                <button class="btn-salvar">Salvar</button>
            </div>
        </div>
    </div>
</body>

</html>