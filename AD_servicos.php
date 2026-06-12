<?php
session_start();
require_once './data/crud.php';

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

// CORRIGIDO: 'preco_medio' não existe → usar valor_mestre, valor_pedreiro, valor_servente
$servicos = $pdo->query("
    SELECT id_servico, nome_servico, tipo_servico,
           valor_mestre, valor_pedreiro, valor_servente
    FROM servicos
    ORDER BY nome_servico
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AD_servicos.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Admin | LM</title>
</head>

<body>

    <?php require_once "partials/header.php"; ?>

    <div style="display:flex;">

        <div class="sidebar">
            <div class="sidebar-perfil">
                <img src="uploads/icone_usuario.png" alt="Admin">
                <div class="sidebar-perfil-info">
                    <strong><?= $_SESSION['user_name'] ?? 'Admin' ?></strong>
                    <span>Admin</span>
                </div>
            </div>

            <a href="AD_dashboard.php" class="nav-item">
                <i class="fa-solid fa-house"></i>
                Meu Dashboard
            </a>
            <a href="AD_usuarios.php" class="nav-item">
                <i class="fa-solid fa-users"></i>
                Usuários
            </a>
            <a href="AD_servicos.php" class="nav-item ativo">
                <i class="fa-solid fa-briefcase"></i>
                Serviços
            </a>
            <a href="AD_funcionarios.php" class="nav-item">
                <i class="fa-solid fa-helmet-safety"></i>
                Funcionários
            </a>

            <!-- CORRIGIDO: action era AD_usuarios.php e AC_agenda.php (errados) → AD_servicos.php -->
            <form method="POST" action="AD_servicos.php">
                <button type="submit" name="logout" class="nav-item nav-sair">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Sair
                </button>
            </form>
        </div>

        <div class="admin-content">
            <h2 class="content-titulo">Gerenciar Serviços</h2>

            <div class="tabela-card">
                <div class="tabela-header">
                    <h3>Tabela de Serviços</h3>
                </div>

                <!-- CORRIGIDO: removida tabela duplicada e campo preco_medio inexistente -->
                <table>
                    <thead>
                        <tr>
                            <th>Serviço</th>
                            <th>Tipo</th>
                            <th>Preço Mestre de Obras</th>
                            <th>Preço Pedreiro</th>
                            <th>Preço Servente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($servicos)): ?>
                            <?php foreach ($servicos as $servico): ?>
                                <tr>
                                    <td><?= htmlspecialchars($servico['nome_servico']) ?></td>
                                    <td><?= htmlspecialchars($servico['tipo_servico']) ?></td>
                                    <td>R$ <?= number_format($servico['valor_mestre'],   2, ',', '.') ?></td>
                                    <td>R$ <?= number_format($servico['valor_pedreiro'], 2, ',', '.') ?></td>
                                    <td>R$ <?= number_format($servico['valor_servente'], 2, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">Nenhum serviço encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>