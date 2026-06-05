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



<?php
require_once('crud.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$profissional = read(
    $pdo,
    'profissional',
    'id_profissional = ' . (int)$_SESSION['user_id']
);

if (!$profissional) {
    die('Profissional não encontrado.');
}

$sql = "
SELECT
    a.id,
    a.data_agenda,
    a.horario,
    a.preco,
    a.status,
    c.nome_cliente,
    c.telefone,.
    c.endereco,
    s.nome_servico
FROM agendamento a
INNER JOIN cliente c
    ON a.id_cliente = c.id_cliente
INNER JOIN servicos s
    ON a.id_servico = s.id_servico
WHERE a.id_profissional = ?
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);

$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
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