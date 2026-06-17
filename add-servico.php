<?php
session_start();
require_once './data/crud.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome_servico   = $_POST['nome_servico'] ?? '';
    $tipo_servico   = $_POST['tipo_servico'] ?? '';
    $valor_servente = $_POST['valor_servente'] ?? 0;
    $valor_pedreiro = $_POST['valor_pedreiro'] ?? 0;
    $valor_mestre   = $_POST['valor_mestre'] ?? 0;
    $descricao      = $_POST['descricao'] ?? '';
    
    $arquivo_imagem = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $arquivo_imagem = uniqid() . '.' . $extensao;
        move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/' . $arquivo_imagem);
    }

    if (!empty($nome_servico) && !empty($tipo_servico)) {
        try {
            
            $stmt = $pdo->prepare("
                INSERT INTO servicos (nome_servico, tipo_servico, valor_servente, valor_pedreiro, valor_mestre, descricao, foto_servico) 
                VALUES (:nome_servico, :tipo_servico, :valor_servente, :valor_pedreiro, :valor_mestre, :descricao, :foto_servico)
            ");

            $stmt->execute([
                ':nome_servico'   => $nome_servico,
                ':tipo_servico'   => $tipo_servico,
                ':valor_servente' => str_replace(',', '.', $valor_servente), 
                ':valor_pedreiro' => str_replace(',', '.', $valor_pedreiro),
                ':valor_mestre'   => str_replace(',', '.', $valor_mestre),
                ':descricao'      => $descricao,
                ':foto_servico'   => $arquivo_imagem 
            ]);

            header('Location: AD_servicos.php?sucesso=1');
            exit();

        } catch (PDOException $e) {
            $erro = "Erro ao cadastrar serviço: " . $e->getMessage();
        }
    } else {
        $erro = "Por favor, preencha todos os campos obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add-servico.css">
    <link rel="icon" type="image/png" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Adicionar Serviços</title>
</head>
<body>
    <?php require_once 'partials/header.php'; ?>

    <main>
        <div class="cadastro-servico">
            
            <?php if (isset($erro)): ?>
                <div style="color: #ff3333;">
                    <?= $erro ?>
                </div>
            <?php endif; ?>

            <form action="add-servico.php" method="POST" enctype="multipart/form-data" class="formulario-servico">
                <h2>Adicionar Serviço</h2>
                
                <input type="text" name="nome_servico" placeholder="Nome do Serviço" required>
                <input type="text" name="tipo_servico" placeholder="Tipo de Serviço" required>
                <input type="text" name="valor_servente" placeholder="Valor Hora do Servente">
                <input type="text" name="valor_pedreiro" placeholder="Valor Hora do Pedreiro">
                <input type="text" name="valor_mestre" placeholder="Valor Hora do Mestre">
                
                <textarea name="descricao" placeholder="Descrição do Serviço" class="descricao"></textarea>
                
                <div class="enviar-foto">
                    <p>Escolha sua Foto pro Serviço:</p>
                    <label for="foto" class="select-foto">
                        <i class="fa-solid fa-cloud-arrow-up"></i> Escolha uma foto
                    </label>
                    <input type="file" name="foto" id="foto">
                </div>
                
                <button type="submit">Criar Serviço</button>
            </form>
        </div>
    </main>
</body>
</html>