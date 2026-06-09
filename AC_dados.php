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

$cliente = read(
    $pdo,
    'cliente',
    'id_cliente = ' . (int) $_SESSION['user_id']
);



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

    <?php
    require_once "partials/header.php";
    ?>

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
                    <i class="fa-solid fa-right-from-bracket">Sair</i>
                    Sair
                </button>
            </form>

            </a>
        </div>


        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome_cliente = $_POST['nome_cliente'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $endereco = $_POST['endereco'];
            $cpf = $_POST['cpf'];
            $senha = $_POST['senha'];

            update(
                $pdo,
                'cliente',
                [
                    'nome_cliente' => $nome_cliente,
                    'email' => $email,
                    'telefone' => $telefone,
                    'endereco' => $endereco,
                    'cpf' => $cpf,
                    'senha' => $senha
                ],
                'id_cliente = ' . (int) $_SESSION['user_id']
            );

            $_SESSION['user_name'] = $nome_cliente;

            header('Location: AC_dados.php');
            exit;
        }
        ?>

        <div class="cliente-content">
            <p class="content-titulo">Meus Dados</p>

            <form action="AC_dados.php" method="POST" class="dados-card">
                <div class="dados-grid">

                    <div class="campo">
                        <label>Nome Completo</label>
                        <input type="text" name="nome_cliente" value="<?= ($cliente['nome_cliente']) ?>" required>
                    </div>

                    <div class="campo">
                        <label>E-mail</label>
                        <input type="email" name="email" value="<?= ($cliente['email']) ?>" required>
                    </div>

                    <div class="campo">
                        <label>Telefone</label>
                        <input type="text" name="telefone" value="<?= ($cliente['telefone']) ?>" required>
                    </div>

                    <div class="campo">
                        <label>Endereço</label>
                        <input type="text" name="endereco" value="<?= ($cliente['endereco']) ?>" required>
                    </div>

                    <div class="campo">
                        <label>CPF</label>
                        <input type="text" name="cpf" value="<?= ($cliente['cpf']) ?>" required>
                    </div>

                    <div class="campo">
                        <label>Nova Senha</label>
                        <input type="password" name="senha" value="<?= ($cliente['senha']) ?>"  placeholder="Digite para alterar">
                    </div>


                </div>

                <button type="submit" onclick="return confirm('Tem certeza que deseja salvar as alterações?')"
                    name="salvar_dados" class="btn-salvar">Salvar</button>


            </form>
        </div>
    </div>

    </div>

</body>

</html>