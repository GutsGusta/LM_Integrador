<?php
session_start();
require_once 'data/crud.php';
$clientes = readAll($pdo, 'cliente');




?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AD_usuarios.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Admin | LM</title>
</head>

<body>
    <?php
    require_once "partials/header.php";
    ?>

    <div class="cliente-wrapper">

        <div class="sidebar">
            <div class="sidebar-perfil">
                <img src="uploads/icone_usuario.png" alt="Cliente">
                <div class="sidebar-perfil-info">
                    <strong><?= $_SESSION['user_name'] ?? 'Admin' ?></strong>
                    <span>Admin</span>
                </div>
            </div>

            <a href="AD_dashboard.php" class="nav-item">
                <i class="fa-solid fa-house"></i>
                Meu Dashboard
            </a>

            <a href="AD_usuarios.php" class="nav-item ativo">
                <i class="fa-solid fa-users"></i>
                Usuarios
            </a>

            <a href="AD_servicos.php" class="nav-item">
                <i class="fa-solid fa-briefcase"></i>
                Serviços
            </a>

            <a href="AD_funcionarios.php" class="nav-item">
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

        <h2 class="content-titulo">Dashboard ADM</h2>

        <div class="admin-content">
            <p class="content-titulo">Gerenciar Usuários</p>

            <div class="tabela-card">
                <div class="tabela-header">
                    <h3>Clientes</h3>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Nome do Cliente</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Endereço</th>
                            <th>CPF</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($clientes)): ?>

                            <?php foreach ($clientes as $cliente): ?>

                                <tr>

                                    <td>
                                        <div class="func-nome">
                                            <img src="uploads/icone_usuario.png" alt="">
                                            <?= htmlspecialchars($cliente['nome_cliente']) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($cliente['email']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($cliente['telefone_cliente']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($cliente['endereco']) ?>
                                    </td>



                                    <td>
                                        <?= htmlspecialchars($cliente['cpf']) ?>
                                    </td>


                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="7">
                                    Nenhum cliente encontrado.
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