<?php
require_once('crud.php');
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
    <title>Meus Dados</title>
</head>

<body>
    <?php
    require_once 'partials/header.php';
    ?>

    <main>
        <div class="pagina-principal">
            <div class="funcoes">
                <div class="pessoal">
                    <img src="uploads/<?php echo $profissional['foto']; ?>" alt="Foto">
                    <div class="pessoal-txt">
                        <h2><?php echo $profissional['nome_profissional']; ?></h2>
                        <p><?php echo $profissional['email']; ?></p>
                        <p><?php echo $profissional['cidade_estado']; ?></p>
                        <p><?php echo $profissional['funcao']; ?></p>
                    </div>
                </div>

                <div class="linha"></div>

                <div class="area-botoes">
                    <div class="botoes"><img src="uploads/quadrados.png"><a href="AP-dashbord.php">Meu Dashbord</a>
                    </div>
                    <div class="botoes"><img src="uploads/notas.png"><a href="AP-servicos.php">Serviços Requeridos</a>
                    </div>
                    <div class="botoes"><img src="uploads/calendario.png"><a href="AP-agenda.php">Meus Agendamentos</a>
                    </div>
                    <div class="botoes"><img src="uploads/dados.png"><a href="AP-dados.php">Meus Dados</a></div>

                    <form method="POST" action="" style="display: flex; align-items: center; margin: 0;">
                        <div class="botoes"
                            style="border: none; background: none; padding: 0; display: flex; align-items: center;">
                            <img src="uploads/sair.png" alt="Sair">
                            <button type="submit" name="logout"
                                style="background: none; border: none; color: inherit; font: inherit; cursor: pointer; padding-left: 8px;">Logout</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nome_profissional = $_POST['nome_profissional'];
                $email = $_POST['email'];
                $telefone = $_POST['telefone'];
                $cidade_estado = $_POST['cidade_estado'];
                $funcao = $_POST['funcao'];

                update(
                    $pdo,
                    'profissional',
                    [
                        'nome_profissional' => $nome_profissional,
                        'email' => $email,
                        'telefone' => $telefone,
                        'cidade_estado' => $cidade_estado,
                        'funcao' => $funcao
                    ],
                    'id_profissional = ' . (int) $_SESSION['user_id']
                );

                header('Location: AP-dados.php');
                exit;
            }
            ?>
            <div class="dados-principais">
                <h4>Meus Dados:</h4>
                <form action="" method="POST" class="nome">
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
                            <input type="text" name="funcao"
                                value="<?php echo htmlspecialchars($profissional['funcao']); ?>" required>
                        </div>
                    </div>
                    <div class="botoes">
                    <button type="submit">Salvar</button>
                </div>
                </form>
            </div>
            <div class="dados-principais">
                <h4>Serviços Qualificados:</h4>
                <form action="" method="POST" class="servicos">
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <button type="submit">Salvar</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>