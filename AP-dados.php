<?php
require_once './data/crud.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

$profissional = read(
    $pdo,
    'profissional',
    'id_profissional = ' . (int) $_SESSION['user_id']
);

if (!$profissional) {
    die('Profissional não encontrado.');
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AP-dados.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Meus Dados</title>
</head>

<body>
    <?php
    require_once 'partials/header.php';
    ?>

    <main>
        <div class="pagina-principal">
            <div class="sidebar">
                <div class="sidebar-perfil">
                    <img src="uploads/<?php echo $profissional['foto']; ?>" alt="Foto">
                    <div class="sidebar-perfil-info">
                        <strong><?php echo $profissional['nome_profissional']; ?></strong>
                        <span><?php echo $profissional['cidade_estado']; ?></span>
                        <span><?php echo $profissional['funcao']; ?></span>
                    </div>

                </div>

                <a href="AP-dashboard.php" class="nav-item">
                    <i class="fa-solid fa-house"></i>
                    Meu Dashboard
                </a>

                <a href="AP-servicos.php" class="nav-item">
                    <i class="fa-solid fa-file-lines"></i>
                    Meus Serviços
                </a>

                <a href="AP-agenda.php" class="nav-item">
                    <i class="fa-solid fa-calendar"></i>
                    Meus Agendamentos
                </a>

                <a href="AP-dados.php" class="nav-item ativo">
                    <i class="fa-solid fa-user"></i>
                    Meus Dados
                </a>

                <form method="POST" action="AP-dados.php">
                    <button type="submit" name="logout" class="nav-item nav-sair">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Sair
                    </button>
                </form>
            </div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvar_dados'])) {
                $nome_profissional = $_POST['nome_profissional'] ?? '';
                $email = $_POST['email'] ?? '';
                $telefone = $_POST['telefone'] ?? '';
                $cidade_estado = $_POST['cidade_estado'] ?? '';
                $funcao = !empty($_POST['funcao']) ? $_POST['funcao'] : $profissional['funcao'];
                $senha = $_POST['senha'] ?? '';

                update(
                    $pdo,
                    'profissional',
                    [
                        'nome_profissional' => $nome_profissional,
                        'email' => $email,
                        'telefone' => $telefone,
                        'cidade_estado' => $cidade_estado,
                        'funcao' => $funcao,
                        'senha' => $senha
                    ],
                    'id_profissional = ' . (int) $_SESSION['user_id']
                );

                header('Location: AP-dados.php?sucesso=1');
                exit;
            }
            ?>
            <div class="dados-principais">
                <h4>Meus Dados:</h4>
                <form action="" method="POST" class="dados">
                    <div class="campo-horizontal">
                        <div class="campo">
                            <p>Nome Completo:</p>
                            <input type="text" name="nome_profissional"
                                value="<?php echo htmlspecialchars($profissional['nome_profissional']); ?>" required>
                        </div>
                        <div class="campo">
                            <p>E-mail:</p>
                            <input type="email" name="email"
                                value="<?php echo htmlspecialchars($profissional['email']); ?>" required>
                        </div>
                    </div>
                    <div class="campo-horizontal">
                        <div class="campo">
                            <p>Telefone:</p>
                            <input type="text" name="telefone"
                                value="<?php echo htmlspecialchars($profissional['telefone']); ?>" required>
                        </div>
                        <div class="campo">
                            <p>Cidade de Residência:</p>
                            <input type="text" name="cidade_estado"
                                value="<?php echo htmlspecialchars($profissional['cidade_estado']); ?>" required>
                        </div>
                    </div>
                    <div class="campo-horizontal">
                        <div class="campo">
                            <p>Função</p>
                            <select name="funcao" required>
                                <option value="Servente" <?php echo ($profissional['funcao'] == 'Servente') ? 'selected' : ''; ?>>Servente</option>
                                <option value="Pedreiro" <?php echo ($profissional['funcao'] == 'Pedreiro') ? 'selected' : ''; ?>>Pedreiro</option>
                                <option value="Mestre de Obras" <?php echo ($profissional['funcao'] == 'Mestre de Obras') ? 'selected' : ''; ?>>Mestre de Obras</option>
                            </select>
                        </div>
                        <div class="campo">
                            <p>Alterar Senha</p>
                            <input type="password" name="senha"
                                value="<?php echo htmlspecialchars($profissional['senha']); ?>" required>
                        </div>
                    </div>
                    <div class="botoes">
                        <button type="submit">Salvar</button>
                    </div>
            </div>
        </div>
    </main>
</body>

</html>