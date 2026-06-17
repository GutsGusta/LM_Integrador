<?php
require_once './data/crud.php';
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

$idProfissional = (int) $_SESSION['user_id'];

$profissional = read(
    $pdo,
    'profissional',
    'id_profissional = ' . $idProfissional
);

if (!$profissional) {
    die('Profissional não encontrado.');
}

if (isset($_GET['id']) && isset($_GET['acao'])) {
    $id_agendamento = (int)$_GET['id'];
    $acao = $_GET['acao'];
    
    if ($acao === 'aceitar') {
        $sqlAlterar = "UPDATE agendamento SET status = 'Em andamento' WHERE id_agendamento = ? AND id_profissional = ?";
        $stmtAlterar = $pdo->prepare($sqlAlterar);
        $stmtAlterar->execute([$id_agendamento, $idProfissional]);
    } elseif ($acao === 'recusar') {
        $sqlAlterar = "UPDATE agendamento SET status = 'Recusado' WHERE id_agendamento = ? AND id_profissional = ?";
        $stmtAlterar = $pdo->prepare($sqlAlterar);
        $stmtAlterar->execute([$id_agendamento, $idProfissional]);
    }
  
    header('Location: ' . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

$sqlAndamento = "
SELECT
    a.id_agendamento,
    a.preco,
    a.endereco,
    a.status,
    c.nome_cliente,
    c.telefone_cliente,
    s.nome_servico
FROM agendamento a
JOIN cliente c ON a.id_cliente = c.id_cliente
LEFT JOIN servicos s ON a.id_servico = s.id_servico
WHERE a.id_profissional = ? AND a.status = 'Em andamento'
";
$stmtAndamento = $pdo->prepare($sqlAndamento);
$stmtAndamento->execute([$idProfissional]);
$agendamentos = $stmtAndamento->fetchAll(PDO::FETCH_ASSOC);

$sqlPendentes = "
SELECT
    a.id_agendamento,
    a.preco,
    a.endereco,
    a.status,
    c.nome_cliente,
    c.telefone_cliente,
    s.nome_servico
FROM agendamento a
JOIN cliente c ON a.id_cliente = c.id_cliente
LEFT JOIN servicos s ON a.id_servico = s.id_servico
WHERE a.id_profissional = ? AND a.status = 'Pendente'
";
$stmtPendentes = $pdo->prepare($sqlPendentes);
$stmtPendentes->execute([$idProfissional]);
$pendentes = $stmtPendentes->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AP-servicos.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Serviços Requeridos</title>
</head>

<body>
    <?php require_once 'partials/header.php'; ?>
    <main>
        <div class="pagina-principal">

            <div class="sidebar">
                <div class="sidebar-perfil">
                    <img src="uploads/<?php echo $profissional['foto']; ?>" alt="Foto">
                    <div class="sidebar-perfil-info">
                        <strong><?php echo htmlspecialchars($profissional['nome_profissional']); ?></strong>
                        <span><?php echo htmlspecialchars($profissional['cidade_estado']); ?></span>
                        <span><?php echo htmlspecialchars($profissional['funcao']); ?></span>
                    </div>
                </div>

                <a href="AP-dashboard.php" class="nav-item">
                    <i class="fa-solid fa-house"></i>
                    Meu Dashboard
                </a>

                <a href="AP-servicos.php" class="nav-item ativo">
                    <i class="fa-solid fa-file-lines"></i>
                    Meus Serviços
                </a>

                <a href="AP-agenda.php" class="nav-item">
                    <i class="fa-solid fa-calendar"></i>
                    Meus Agendamentos
                </a>

                <a href="AP-dados.php" class="nav-item">
                    <i class="fa-solid fa-user"></i>
                    Meus Dados
                </a>

                <form method="POST" action="">
                    <button type="submit" name="logout" class="nav-item nav-sair">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Sair
                    </button>
                </form>
            </div>

            <div class="pagina-servicos">

                <div class="servicos">
                    <h3>Serviços em Andamento</h3>
                    <table class="servicos-tabela">
                        <tr>
                            <th>Nome do Cliente</th>
                            <th>Contato</th>
                            <th>Serviço</th>
                            <th>Endereço</th>
                            <th>Valor Total</th>
                            <th>Status</th>
                        </tr>

                        <?php if (!empty($agendamentos)): ?>
                            <?php foreach ($agendamentos as $agendamento): ?>
                                <tr>
                                    <td><?= htmlspecialchars($agendamento['nome_cliente']) ?></td>
                                    <td><?= htmlspecialchars($agendamento['telefone_cliente']) ?></td>
                                    <td><?= htmlspecialchars($agendamento['nome_servico'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($agendamento['endereco']) ?></td>
                                    <td>R$ <?= number_format($agendamento['preco'], 2, ',', '.') ?></td>
                                    <td><?= htmlspecialchars($agendamento['status']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">Nenhum serviço encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>

                <div class="servicos">
                    <h3>Respostas Pendentes</h3>
                    <table class="servicos-tabela">
                        <tr>
                            <th>Nome do Cliente</th>
                            <th>Contato</th>
                            <th>Serviço</th>
                            <th>Endereço</th>
                            <th>Valor Total</th>
                            <th>Resposta</th>
                        </tr>

                        <?php if (!empty($pendentes)): ?>
                            <?php foreach ($pendentes as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['nome_cliente']) ?></td>
                                    <td><?= htmlspecialchars($item['telefone_cliente']) ?></td>
                                    <td><?= htmlspecialchars($item['nome_servico'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($item['endereco']) ?></td>
                                    <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>

                                    <td>
                                        <a href="?id=<?= $item['id_agendamento'] ?>&acao=aceitar">
                                            <img src="uploads/certo-botao.png" alt="Aprovar">
                                        </a>

                                        <a href="?id=<?= $item['id_agendamento'] ?>&acao=recusar">
                                            <img src="uploads/errado.png" alt="Recusar">
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">Nenhuma solicitação pendente.</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>

            </div>
        </div>
    </main>
</body>

</html>