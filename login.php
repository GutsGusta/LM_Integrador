<<<<<<< HEAD
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>Login</title>
</head>
<body>
<?php
    require_once 'partials/header.php';
?> 
<h1 class="titulo">Bem Vindo de Volta!</h1>
<div class="login">
    <form class="formulario-login">
        <img src="uploads/icone_usuario.png">       
        <input type="email" id="email" name="email" placeholder="Email">
        <input type="password" id="Senha" name="Senha" placeholder="Senha">
        <a href="#">Não tem conta ainda? Cadastre-se aqui</a>
        <button type="submit">Entrar</button>
    </form>
</div>
</body>
</html>
=======
<?php
require_once('data/crud.php');

session_start();

$erro = null;
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

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

if ($usuarioencontrado && $usuarioencontrado['senha'] === $senha) {

       if ($tipoUsuario === 'profissional') {
            $_SESSION['user_id']   = $usuarioencontrado['id_professional'];
            $_SESSION['user_name'] = $usuarioencontrado['nome_profissional'];
        } elseif ($tipoUsuario === 'cliente') {
            $_SESSION['user_id']   = $usuarioencontrado['id_cliente'];
            $_SESSION['user_name'] = $usuarioencontrado['nome_cliente'];
        } elseif ($tipoUsuario === 'admin') {
            $_SESSION['user_id']   = $usuarioencontrado['id_admin'];
            $_SESSION['user_name'] = $usuarioencontrado['nome_admin'];
        }

        $_SESSION['user_tipo'] = $tipoUsuario;

        header('location: ' . $tipoUsuario . '.php');
        exit;
    } else {
         $erro = 'Email ou senha incorretos.';
    }
};

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>

<body>

    <form method="POST" action="login.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>

    <?php if ($erro) {
        echo "<p style='color: red;'>$erro</p>";
    } ?>
        <input type="submit" value="Login">
    </form>

    
</body>

</html>
>>>>>>> adfc705 (Enviado os dados da Bia)
