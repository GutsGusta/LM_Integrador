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
    if ($usuarioLogado !== 'admin') {
        header('Location: login.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
</head>

<body>
    <h1>Admin Page</h1>
    <p>Welcome to the admin page. Here you can manage your website.</p>

<?php
    echo "<p>Logged in as: " . $_SESSION['user_name'] . " (" . $_SESSION['user_tipo'] . ")</p>";

?>

    <form method="POST" action="admin.php">
       <a href="login.php"><button type="submit" name="logout">Logout</button></a>
    </form>

</body>

</html>