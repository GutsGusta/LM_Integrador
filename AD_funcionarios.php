<?php
session_start();
require_once './data/crud.php';

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

    <div>

        <div class="sidebar">
            <div class="sidebar-perfil">
                <img src="uploads/ricardo_almeida.png" alt="Cliente">
                <div class="sidebar-perfil-info">
                    <strong>Ricardo Almeida</strong>
                    <span>Admin</span>
                </div>
            </div>

            <a href="AD_dashboard.php" class="nav-item">
                <i class="fa-solid fa-house"></i>
                Meu Dashboard
            </a>

            <a href="AD_usuarios.php" class="nav-item">
                <i class="fa-solid fa-users"></i>
                Usuarios
            </a>

            <a href="AD_servicos.php" class="nav-item">
                <i class="fa-solid fa-briefcase"></i>
                Serviços
            </a>

            <a href="AD_funcionarios.php" class="nav-item ativo">
                <i class="fa-solid fa-helmet-safety"></i>
                Funcionários
            </a>


             <form method="POST" action="AC_agenda.php">
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
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($profissionais)): ?>

                            <?php foreach ($profissionais as $profissional): ?>

                                <tr>

                                    <td>
                                        <div class="func-nome">
                                            <img src="uploads/icone_usuario.png" alt="">
                                            <?= $profissional['nome_profissional'] ?>
                                        </div>
                                    </td>

                                    <td>
                                        <?= $profissional['funcao'] ?>
                                    </td>

                                    <td>
                                        <?= $profissional['telefone'] ?>
                                    </td>

                                    <td>
                                        <?= $profissional['cidade_estado'] ?>
                                    </td>



                                    <td>
                                        <?= $profissional['experiencia'] ?>
                                    </td>
                                    <td>
                                    <div class="acoes">
                                        <button class="btn-acao btn-editar"><a href="alterarfuncionario.php?id=<?= $profissional['id_profissional'] ?>">Editar</a></button>
                                        <button class="btn-acao btn-excluir"><a href="deleteprof.php?id=<?= $profissional['id_profissional'] ?>" onclick="return confirm('Deseja excluir este funcionário?')">Excluir</a></button>
                                    </td>
                                    </div>
                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="7">
                                    Nenhum profissional encontrado.
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>