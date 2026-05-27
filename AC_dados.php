<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AC_dados.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Meus Dados | LM</title>
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

            <a href="AC_orcamentos.php" class="nav-item">
                <i class="fa-solid fa-file-lines"></i>
                Meus Orçamentos
            </a>

            <a href="AC_agendamentos.php" class="nav-item">
                <i class="fa-solid fa-calendar"></i>
                Meus Agendamentos
            </a>

            <a href="AC_dados.php" class="nav-item ativo">
                <i class="fa-solid fa-user"></i>
                Meus Dados
            </a>

            <a href="logout.php" class="nav-item nav-sair">
                <i class="fa-solid fa-right-from-bracket"></i>
                Sair
            </a>
        </div>


        <div class="cliente-content">
            <p class="content-titulo">Meus Dados</p>

            <div class="dados-card">
                <div class="dados-grid">

                    <div class="campo">
                        <label>Nome Completo</label>
                        <input type="text" name="nome" value="Marcos Santos">
                    </div>

                    <div class="campo">
                        <label>E-mail</label>
                        <input type="email" name="email" value="Ma.santos@email.com">
                    </div>

                    <div class="campo">
                        <label>Telefone</label>
                        <input type="tel" name="telefone" value="(11) 2526-7520">
                    </div>

                    <div class="campo">
                        <label>Endereço</label>
                        <input type="text" name="endereco" value="Av Paulista, 1200, São Paulo, SP">
                    </div>

                    <div class="campo">
                        <label>CPF</label>
                        <input type="text" name="cpf" value="252.190.587-55">
                    </div>

                    <div class="campo">
                        <label>Nova Senha</label>
                        <input type="password" name="senha" placeholder="Digite para alterar">
                    </div>

                </div>

                <button class="btn-salvar">Salvar</button>
            </div>
        </div>

    </div>

</body>

</html>