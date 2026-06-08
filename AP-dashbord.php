<?php
require_once('./data/crud.php');
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


                <div class="pessoal">
                    
                </div>
<body>

    <?php require_once 'partials/header.php'; ?>

    <main>
        <div class="pagina-principal">

            <div class="sidebar">
                <div class="sidebar-perfil">
                    <img src="uploads/<?php echo $profissional['foto']; ?>" alt="Foto">
                    <div class="sidebar-perfil-info">
                        <strong><?php echo $profissional['nome_profissional']; ?></strong>
                        <span><?php echo $profissional['cidade_estado']; ?></span>
                        <span><?php echo $profissional['funcao']; ?></span>
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

                <form method="POST" action="" class="form-sair">                                                   
                    <button type="submit" name="logout" class="nav-sair">
                        <i class="fa-solid fa-user"></i>
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