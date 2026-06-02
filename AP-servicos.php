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



$profissional = read(
    $pdo,
    'profissional',
    'id_profissional = ' . (int) $_SESSION['user_id']
);

$sql = "
SELECT
    a.*,
    c.nome_cliente,
    c.telefone,
    c.endereco,
    s.nome_servico
FROM agendamento a
INNER JOIN cliente c
    ON a.id_cliente = c.id_cliente
INNER JOIN servicos s
    ON a.id_servico = s.id_servico
WHERE a.id_profissional = ?
";
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AP-servicos.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>Serviços Requeridos</title>
</head>

<body>
    <?php
    require_once 'partials/header.php';
    ?>
    <main>
        <div class="pagina-principal">
<<<<<<< HEAD
            <div class="funcoes">
                <div class="pessoal">
                    <img src="uploads/ricardo_martins.png">
                    <div class="pessoal-txt">
                        <h2><?php echo $profissional['nome_profissional']; ?></h2>
                        <p><?php echo $profissional['email']; ?></p>
                        <p><?php echo $profissional['cidade_estado']; ?></p>
                    </div>
                </div>

                <div class="linha"></div>

                <div class="area-botoes">
                    <div class="botoes"><img src="uploads/quadrados.png"><a href="AP-dashbord.php">Meu Dashbord</a>
                    </div>
                    <div class="botoes"><img src="uploads/notas.png"><a href="AP-servicos.php">Serviços Requeridos</a>
                    </div>
                    <div class="botoes"><img src="uploads/calendario.png"><a href="AP-agenda.php">Meus Agendamentos</a>
                    </div>
                    <div class="botoes"><img src="uploads/dados.png"><a href="AP-dados.php">Meus Dados</a></div>
                    <div class="botoes"><img src="uploads/sair.png"><a href="logout.php">Sair</a></div>
=======
            <div class="sidebar">
            <div class="sidebar-perfil">
                <img src="uploads/marcos_santos.png" alt="Cliente">
                <div class="sidebar-perfil-info">
                    <strong>Marcos Santos</strong>
                    <span>Cliente</span>
>>>>>>> f30575121fefc2dc0b372820b681441f3d4e15a7
                </div>
            </div>

            <a href="AP-dashboard.php" class="nav-item">
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

            <div class="servicos">
                <h3>Serviços em Andamento:</h3>
                <table class="servicos-tabela">
                   <table class="servicos-tabela">
    <tr>
        <th>Nome do Cliente</th>
        <th>Contato</th>
        <th>Serviço</th>
        <th>Endereço</th>
        <th>Valor Total</th>
    </tr>

    <?php if (!empty($agendamentos)): ?>

        <?php foreach ($agendamentos as $agendamento): ?>

            <tr>
                <td><?= $agendamento['nome_cliente'] ?></td>
                <td><?= $agendamento['telefone'] ?></td>
                <td><?= $agendamento['nome_servico'] ?></td>
                <td><?= $agendamento['endereco'] ?></td>
                <td>R$ <?= number_format($agendamento['preco'], 2, ',', '.') ?></td>
            </tr>

        <?php endforeach; ?>

    <?php else: ?>

        <tr>
            <td colspan="5">Nenhum serviço encontrado.</td>
        </tr>

    <?php endif; ?>

</table>
                </table>
            </div>

            <div class="servicos">
                <h3>Respostas Pendentes:</h3>
                <table class="servicos-tabela">
                    <tr>
                        <th>Nome do Cliente</th>
                        <th>Contato</th>
                        <th>Serviço</th>
                        <th>Endereço</th>
                        <th>Valor Total</th>
                        <th>Resposta</th>
                    </tr>
                    <tr>
                        <td>Rogério Alcantra</td>
                        <td>(11) 98765-4321</td>
                        <td>Levantamento de Casa</td>
                        <td>R. Recebaby da Silva, 71 - São Paulo</td>
                        <td>R$2400,00</td>
                        <td><a href=""><img src="uploads/certo-botao.png"></a><a href=""><img
                                    src="uploads/errado.png"></a></td>
                    </tr>
                    <tr>
                        <td>Rogério Alcantra</td>
                        <td>(11) 98765-4321</td>
                        <td>Levantamento de Casa</td>
                        <td>R. Recebaby da Silva, 71 - São Paulo</td>
                        <td>R$2400,00</td>
                        <td><a href=""><img src="uploads/certo-botao.png"></a><a href=""><img
                                    src="uploads/errado.png"></a></td>
                    </tr>
                    <tr>
                        <td>Rogério Alcantra</td>
                        <td>(11) 98765-4321</td>
                        <td>Levantamento de Casa</td>
                        <td>R. Recebaby da Silva, 71 - São Paulo</td>
                        <td>R$2400,00</td>
                        <td><a href=""><img src="uploads/certo-botao.png"></a><a href=""><img
                                    src="uploads/errado.png"></a></td>
                    </tr>
                    <tr>
                        <td>Rogério Alcantra</td>
                        <td>(11) 98765-4321</td>
                        <td>Levantamento de Casa</td>
                        <td>R. Recebaby da Silva, 71 - São Paulo</td>
                        <td>R$2400,00</td>
                        <td><a href=""><img src="uploads/certo-botao.png"></a><a href=""><img
                                    src="uploads/errado.png"></a></td>
                    </tr>
                </table>
            </div>
        </div>
    </main>
</body>

</html>