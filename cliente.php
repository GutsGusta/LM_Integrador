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

?>



//se quiser mostrar o nome do cliente e o tipo de usuario que ele é


<?php
    echo "<p>Logged in as: " . $_SESSION['user_name'] . " (" . $_SESSION['user_tipo'] . ")</p>";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cliente</title>
</head>
<body>
    <h1>Cliente Page</h1>
  
    <form action="cliente.php" method="post">
            <button type="submit" name="logout">Logout</button>
    </form>
    <p>Welcome to the cliente page. Here you can manage your website.</p>
</body>
</html>

