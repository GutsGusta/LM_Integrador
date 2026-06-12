<?php
session_start();
require_once './data/crud.php';

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

$categorias = [
    'mestre_de_obra' => 'Mestre de Obra',
    'pedreiro'       => 'Pedreiro',
    'servente'       => 'Servente'
];

$profissionais = readAll($pdo, 'profissional');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AD_funcionarios.css">
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
            <a href="AD_servicos.php" class="nav-item">
                <i class="fa-solid fa-briefcase"></i>
                Serviços
            </a>
            <a href="AD_funcionarios.php" class="nav-item ativo">
                <i class="fa-solid fa-helmet-safety"></i>
                Funcionários
            </a>

            <!-- CORRIGIDO: action era AC_agenda.php (errado) → AD_funcionarios.php -->
            <form method="POST" action="AD_funcionarios.php">
                <button type="submit" name="logout" class="nav-item nav-sair">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Sair
                </button>
            </form>
        </div>

        <div class="admin-content">
            <h2 class="content-titulo">Gerenciar Funcionários</h2>

            <div class="tabela-card">
                <div class="tabela-header">
                    <h3>Tabela de Funcionários</h3>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Funcionário</th>
                            <th>Função</th>
                            <th>Telefone</th>
                            <th>Cidade</th>
                            <th>Experiência</th>
                            <th>Disponibilidade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($profissionais)): ?>
                            <?php foreach ($profissionais as $profissional): ?>
                                <tr>
                                    <td>
                                        <div class="func-nome">
                                            <img src="uploads/icone_usuario.png" alt="">
                                            <?= htmlspecialchars($profissional['nome_profissional']) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- CORRIGIDO: exibe categoria legível -->
                                        <?= htmlspecialchars($categorias[$profissional['funcao']] ?? $profissional['funcao']) ?>
                                    </td>
                                    <td><?= htmlspecialchars($profissional['telefone']) ?></td>
                                    <td><?= htmlspecialchars($profissional['cidade_estado']) ?></td>
                                    <td><?= htmlspecialchars($profissional['experiencia']) ?></td>
                                    <td>
                                        <!-- CORRIGIDO: exibe Sim/Não em vez de 0/1 -->
                                        <?= $profissional['disponibilidade'] ? 'Sim' : 'Não' ?>
                                    </td>
                                    <td>
                                        <div class="acoes">
                                            <a href="alterarfuncionario.php?id=<?= $profissional['id_profissional'] ?>"
                                               class="btn-acao btn-editar">Editar</a>
                                            <a href="deleteprof.php?id=<?= $profissional['id_profissional'] ?>"
                                               class="btn-acao btn-excluir"
                                               onclick="return confirm('Deseja excluir este funcionário?')">Excluir</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">Nenhum profissional encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>