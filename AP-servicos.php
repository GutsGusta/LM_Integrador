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

$profissional = read(
    $pdo,
    'profissional',
    'id_profissional = ' . (int) $_SESSION['user_id']
);

if (!$profissional) {
    die('Profissional não encontrado.');
}

/* Serviços em andamento */
$sql = "
SELECT
    a.id,
    a.data_agenda,
    a.horario,
    a.preco,
    a.status,
    c.nome_cliente,
    c.telefone_cliente,
    c.endereco,
    s.nome_servico
FROM agendamento a
INNER JOIN cliente c
    ON a.id_cliente = c.id_cliente
LEFT JOIN orcamentos o
    ON a.id_orcamento = o.id_orcamento
LEFT JOIN servicos s
    ON o.id_servico = s.id_servico
WHERE a.id_profissional = ?
AND a.status = 'Em andamento'
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);

$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* Serviços pendentes */
$sqlPendentes = "
SELECT
    a.id,
    a.data_agenda,
    a.horario,
    a.preco,
    a.status,
    c.nome_cliente,
    c.telefone_cliente,
    c.endereco,
    s.nome_servico
FROM agendamento a
INNER JOIN cliente c
    ON a.id_cliente = c.id_cliente
LEFT JOIN orcamentos o
    ON a.id_orcamento = o.id_orcamento
LEFT JOIN servicos s
    ON o.id_servico = s.id_servico
WHERE a.id_profissional = ?
AND a.status = 'Pendente'
";

$stmtPendentes = $pdo->prepare($sqlPendentes);
$stmtPendentes->execute([$_SESSION['user_id']]);

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
    <?php
    require_once 'partials/header.php';
    ?>
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

                <a href="AP-dashbord.php" class="nav-item">
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

                <form method="POST" action="" class="form-sair">
                    <button type="submit" name="logout" class="nav-sair">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Sair
                    </button>
                </form>
            </div>

            <div class="pagina-servicos">

                <div class="servicos">
                    <h3>Serviços em Andamento:</h3>
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

                        <?php if (!empty($pendentes)): ?>

                            <?php foreach ($pendentes as $item): ?>

                                <tr>
                                    <td><?= htmlspecialchars($item['nome_cliente']) ?></td>
                                    <td><?= htmlspecialchars($item['telefone_cliente']) ?></td>
                                    <td><?= htmlspecialchars($item['nome_servico'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($item['endereco']) ?></td>
                                    <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>

                                    <td>
                                        <a href="aprovar.php?id=<?= $item['id'] ?>">
                                            <img src="uploads/certo-botao.png" alt="Aprovar">
                                        </a>

                                        <a href="recusar.php?id=<?= $item['id'] ?>">
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