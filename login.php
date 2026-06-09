
<?php
require_once 'data/crud.php';

session_start();

if (isset($_SESSION['user_tipo'])) {
    if ($_SESSION['user_tipo'] === 'profissional') {
        header('Location: AP-dashbord.php');
        exit;
    } elseif ($_SESSION['user_tipo'] === 'cliente') {
        header('Location: AC_dashboard.php');
        exit;
    } elseif ($_SESSION['user_tipo'] === 'admin') {
        header('Location: AD_dashboard.php');
        exit;
    }
}

$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    $usuarioencontrado = null;
    $tipoUsuario = null;

    $usuario = read($pdo, 'profissional', "email = " . $pdo->quote($email));

    if ($usuario) {
        $usuarioencontrado = $usuario;
        $tipoUsuario = 'profissional';
    }

    if (!$usuarioencontrado) {
        $usuario = read($pdo, 'cliente', "email = " . $pdo->quote($email));

        if ($usuario) {
            $usuarioencontrado = $usuario;
            $tipoUsuario = 'cliente';
        }
    }

    if (!$usuarioencontrado) {
        $usuario = read($pdo, 'admin', "email = " . $pdo->quote($email));

        if ($usuario) {
            $usuarioencontrado = $usuario;
            $tipoUsuario = 'admin';
        }
    }

    // Verifica senha
    if ($usuarioencontrado && $usuarioencontrado['senha'] === $senha) {

        if ($tipoUsuario === 'profissional') {

            $_SESSION['user_id'] = $usuarioencontrado['id_profissional'];
            $_SESSION['user_name'] = $usuarioencontrado['nome_profissional'];
            $_SESSION['user_tipo'] = 'profissional';

            header('Location: AP-dashbord.php');
            exit;

        } elseif ($tipoUsuario === 'cliente') {

            $_SESSION['user_id'] = $usuarioencontrado['id_cliente'];
            $_SESSION['user_name'] = $usuarioencontrado['nome_cliente'];
            $_SESSION['user_tipo'] = 'cliente';

            header('Location: AC_dashboard.php');
            exit;

        } elseif ($tipoUsuario === 'admin') {

            $_SESSION['user_id'] = $usuarioencontrado['id_admin'];
            $_SESSION['user_name'] = $usuarioencontrado['nome_admin'];
            $_SESSION['user_tipo'] = 'admin';

            header('Location: AD_dashboard.php');
            exit;
        }

    } else {
        $erro = 'Email ou senha incorretos.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="image/png" href="uploads/Logo-LM.png">
</head>

<body>

    <?php require_once 'partials/header.php'; ?>

    <h1 class="titulo">Bem Vindo de Volta!</h1>

    <div class="login">
        <form class="formulario-login" method="POST">

            <img src="uploads/icone_usuario.png" alt="Usuário">

            <?php if ($erro): ?>
                <p style="color:red; text-align:center;">
                    <?= $erro ?>
                </p>
            <?php endif; ?>

            <input type="email" name="email" placeholder="Email" required>

            <input type="password" name="senha" placeholder="Senha" required>

            <a href="cadastro.php">
                Não tem conta ainda? Cadastre-se aqui
            </a>

            <button type="submit">
                Entrar
            </button>

        </form>
    </div>

</body>

</html>
