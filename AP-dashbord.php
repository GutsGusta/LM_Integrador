<?php
require_once('crud.php');
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
    <title>Área de Trabalho</title>
</head>

<body>

    <?php require_once 'partials/header.php'; ?>

    <main>
        <div class="pagina-principal">

            <div class="funcoes">

                <div class="pessoal">
                    <img src="uploads/<?php echo $profissional['foto']; ?>" alt="Foto">

                    <div class="pessoal-txt">
                        <h2><?php echo $profissional['nome_profissional']; ?></h2>
                        <p><?php echo $profissional['email']; ?></p>
                        <p><?php echo $profissional['cidade_estado']; ?></p>
                        <p><?php echo $profissional['funcao']; ?></p>
                    </div>
                </div>

                <div class="linha"></div>

                <div class="area-botoes">
                    <div class="botoes">
                        <img src="uploads/quadrados.png">
                        <a href="AP-dashbord.php">Meu Dashboard</a>
                    </div>

                    <div class="botoes">
                        <img src="uploads/notas.png">
                        <a href="AP-servicos.php">Serviços Requeridos</a>
                    </div>

                    <div class="botoes">
                        <img src="uploads/calendario.png">
                        <a href="AP-agenda.php">Meus Agendamentos</a>
                    </div>

                    <div class="botoes">
                        <img src="uploads/dados.png">
                        <a href="AP-dados.php">Meus Dados</a>
                    </div>

                    <form method="POST" action="" style="display: flex; align-items: center; margin: 0;">
                        <div class="botoes"
                            style="border: none; background: none; padding: 0; display: flex; align-items: center;">
                            <img src="uploads/sair.png" alt="Sair">
                            <button type="submit" name="logout"
                                style="background: none; border: none; color: inherit; font: inherit; cursor: pointer; padding-left: 8px;">Logout</button>
                        </div>
                    </form>
                </div>

            </div>

            <a href="AP-dashbord.php" class="nav-item">
                <i class="fa-solid fa-house"></i>
                Meu Dashboard
            </a>

            <a href="AP-servicos.php" class="nav-item">
                <i class="fa-solid fa-file-lines"></i>
                Meus Serviços
            </a>

            <a href="AP-agenda.php" class="nav-item ativo">
                <i class="fa-solid fa-calendar"></i>
                Meus Agendamentos
            </a>

            <a href="AP-dados.php" class="nav-item">
                <i class="fa-solid fa-user"></i>
                Meus Dados
            </a>

            <a href="logout.php" class="nav-item nav-sair">
                <i class="fa-solid fa-right-from-bracket"></i>
                Sair
            </a>
        </div>

            <div class="dashbord">

                <div class="estatisticas">

                    <div class="estatisticas-indv">
                        <img src="uploads/fatura.png">

                        <div class="estatisticas-txt">
                            <h4>Experiência</h4>
                            <h1><?php echo $profissional['experiencia']; ?></h1>
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
                            <h1><?php echo $profissional['projetos_concluidos']; ?></h1>
                            <p>Projetos concluídos</p>
                        </div>
                    </div>

                </div>

                <div class="quadrados">

                    <div class="quadrados-indv">
                        <h2>Informações Profissionais</h2>

                        <div class="linha"></div>

                        <div class="campo-servico">
                            <div class="ganhos">
                                <h4>Serviço</h4>
                                <p><?php echo $profissional['servico']; ?></p>
                            </div>
                        </div>

                        <div class="campo-servico">
                            <div class="ganhos">
                                <h4>Função</h4>
                                <p><?php echo $profissional['funcao']; ?></p>
                            </div>
                        </div>

                        <div class="campo-servico">
                            <div class="ganhos">
                                <h4>Sobre</h4>
                                <p><?php echo $profissional['sobre']; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="quadrados-indv">
                        <h2>Dados de Contato</h2>

                        <div class="linha"></div>

                        <div class="campo-servico">
                            <div class="info">
                                <h4>Email</h4>
                                <p><?php echo $profissional['email']; ?></p>
                            </div>
                        </div>

                        <div class="campo-servico">
                            <div class="info">
                                <h4>Telefone</h4>
                                <p><?php echo $profissional['telefone']; ?></p>
                            </div>
                        </div>

                        <div class="campo-servico">
                            <div class="info">
                                <h4>Cidade</h4>
                                <p><?php echo $profissional['cidade_estado']; ?></p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </main>

</body>

</html>