<?php
require_once('data/crud.php');

session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: ./login.php');
    exit();
}

if (isset($_SESSION['user_tipo'])) {
    $usuarioLogado = $_SESSION['user_tipo'];
    if ($usuarioLogado !== 'cliente') {
        header('Location: login.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['logout'])) {
    $nome_cliente = trim($_POST['nome_cliente']);
    $email        = trim($_POST['email']);
    $telefone     = trim($_POST['telefone_cliente']);
    $cpf          = trim($_POST['cpf']);
    $senha        = trim($_POST['senha']);

    $dados = [
        'nome_cliente'    => $nome_cliente,
        'email'           => $email,
        'telefone_cliente'=> $telefone,
        'cpf'             => $cpf,
    ];

    if (!empty($senha)) {
        $dados['senha'] = $senha;
    }

    update($pdo, 'cliente', $dados, 'id_cliente = ' . (int)$_SESSION['user_id']);
    $_SESSION['user_name'] = $nome_cliente;

    header('Location: AC_dados.php');
    exit;
}

$cliente = read($pdo, 'cliente', 'id_cliente = ' . (int)$_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AC_dados.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Cliente | LM</title>
</head>

<body>

    <?php require_once "partials/header.php"; ?>

    <div class="cliente-wrapper">

        <div class="sidebar">
            <div class="sidebar-perfil">
                <img src="uploads/default.png" alt="Cliente">
                <div class="sidebar-perfil-info">
                    <strong><?php echo $_SESSION['user_name']; ?></strong>
                    <span>Cliente</span>
                </div>
            </div>

            <a href="AC_dashboard.php" class="nav-item">
                <i class="fa-solid fa-house"></i>
                Meu Dashboard
            </a>
            <a href="AC_orcamentos.php" class="nav-item">
                <i class="fa-solid fa-file-lines"></i>
                Meus Orçamentos
            </a>
            <a href="AC_agenda.php" class="nav-item">
                <i class="fa-solid fa-calendar"></i>
                Meus Agendamentos
            </a>
            <a href="AC_dados.php" class="nav-item ativo">
                <i class="fa-solid fa-user"></i>
                Meus Dados
            </a>

            <form method="POST" action="AC_dados.php">
                <button type="submit" name="logout" class="nav-item nav-sair">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Sair
                </button>
            </form>
        </div>

        <div class="cliente-content">
            <p class="content-titulo">Meus Dados</p>

            <form action="AC_dados.php" method="POST" class="dados-card">
                <div class="dados-grid">

                    <div class="campo">
                        <label>Nome Completo</label>
                        <input type="text" name="nome_cliente"
                               value="<?= htmlspecialchars($cliente['nome_cliente']) ?>" required>
                    </div>

                    <div class="campo">
                        <label>E-mail</label>
                        <input type="email" name="email"
                               value="<?= htmlspecialchars($cliente['email']) ?>" required>
                    </div>

                    <div class="campo">
                        <label>Telefone</label>
                        <input type="text" name="telefone_cliente"
                               value="<?= htmlspecialchars($cliente['telefone_cliente']) ?>" required>
                    </div>

                    <div class="campo">
                        <label>CPF</label>
                        <input type="text" name="cpf"
                               value="<?= htmlspecialchars($cliente['cpf']) ?>" required>
                    </div>

                    <div class="campo">
                        <label>Nova Senha</label>
                        <input type="password" name="senha" placeholder="Digite para alterar">
                    </div>

                </div>

                <button type="submit"
                        onclick="return confirm('Tem certeza que deseja salvar as alterações?')"
                        name="salvar_dados" class="btn-salvar">
                    Salvar
                </button>
            </form>
        </div>

    </div>

</body>
</html>