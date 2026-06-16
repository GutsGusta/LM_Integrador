<?php
require_once './data/crud.php';
session_start();

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nome     = $_POST['nome_cliente'] ?? '';
    $email    = $_POST['email'] ?? '';
    $telefone = $_POST['telefone_cliente'] ?? '';
    $cpf      = $_POST['cpf'] ?? '';
    $senha    = $_POST['senha'] ?? ''; 

    $nome_foto = 'default.png';

    if (!empty($_FILES['foto']['name'])) {
    $nome_foto = $_FILES['foto']['name'];
} else {
    $nome_foto = 'default.png';
}

    if (empty($erro)) {

    $salvou = create($pdo, 'cliente', [
            'nome_cliente'        => $nome,
            'email'               => $email,
            'telefone_cliente'    => $telefone,
            'cpf'                 => $cpf,
            'senha'               => $senha,
            'foto'                => $nome_foto,
        ]);

        if ($salvou) {
            $sucesso = "Cadastro realizado com sucesso! Redirecionando para o login...";
            header("Refresh: 3; url=login.php");
        } else {
            $erro = "Erro ao cadastrar no banco de dados.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | LM</title>
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
</head>
<body>

<?php require_once 'partials/header.php'; ?> 

<h1 class="titulo">Venha ser nosso cliente!!</h1>

<div class="cadastro">
    <form class="formulario-cadastro" action="" method="POST" enctype="multipart/form-data">
        <h2>Cadastro</h2>   

        <?php if (!empty($erro)): ?>
            <p style="color: red; text-align: center; font-weight: bold;"><?= $erro ?></p>
        <?php endif; ?>
        <?php if (!empty($sucesso)): ?>
            <p style="color: lime; text-align: center; font-weight: bold;"><?= $sucesso ?></p>
        <?php endif; ?>

        <input type="text" id="nome_cliente" name="nome_cliente" placeholder="Nome" required>
        <input type="email" id="email" name="email" placeholder="Email" required>
        <input type="text" id="telefone_cliente" name="telefone_cliente" placeholder="Telefone" required>
        <input type="text" id="cpf" name="cpf" placeholder="CPF" required>
        <input type="password" id="senha" name="senha" placeholder="Senha" required>
        
        <div class="enviar-foto">
            <p>Escolha sua Foto de Perfil:</p>
            <label for="foto" class="select-foto">
                <i class="fa-solid fa-cloud-arrow-up"></i> Escolha uma foto
            </label>
            <input type="file" id="foto" name="foto" accept="image/*" style="display:none;">
        </div>

        <a href="cadastro_func.php">Deseja se tornar um Profissional? Clique aqui!</a>

        <button type="submit">Criar conta</button>
    </form>
</div>   

</body>
</html>