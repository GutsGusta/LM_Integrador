<?php
require 'data/crud.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: AD_usuarios.php");
    exit;
}

$id_profissional = (int) $_GET['id'];
$profissional = read($pdo, 'profissional', "id_profissional = $id_profissional");

if (!$profissional) {
    echo "Funcionário não encontrado!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/orcamento.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
</head>

<body>
    <?php
    require_once 'partials/header.php';
    ?>

    <h1 class="titulo">Editar Funcionário</h1>
    <div class="orcamento">
        <form class="formulario-orcamento" action="updatefuncionario.php" method="POST">
            <h2>Funcionário</h2>

            <input type="hidden" id="id" name="id" value="<?= $profissional['id_profissional'] ?>">

            <input type="text" id="nome" name="Nome" placeholder="Nome Completo" >
            <value="<?= htmlspecialchars($profissional['nome_profissional']) ?>" >
                </value>

                <input type="email" id="email" name="email" placeholder="Email" >
                <value="<?= htmlspecialchars($profissional['email']) ?>" >
        </value>
        <br>

        <input type="text" id="telefone" name="Telefone" placeholder="Telefone">
        <value="<?= htmlspecialchars($profissional['telefone']) ?>" ></value>

            <br>
            <input type="text" id="endereco" name="Endereco" placeholder="Endereço">
            <value="<?= htmlspecialchars($profissional['cidade_estado']) ?>" ></value>

                <br>


                <button type="submit">Enviar</button>
                </form>
    </div>
</body>

</html>