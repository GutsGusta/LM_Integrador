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
    <?php
        require_once 'partials/header.php';
    ?>

    <main>
        <div class="cadastro-servico">
            <form action="" class="formulario-servico">
                <h2>Adicionar Serviço</h2>
                <input type="text" placeholder="Nome do Serviço">
                <input type="text" placeholder="Tipo de Serviço">
                <input type="text" placeholder="Valor Hora do Servente">
                <input type="text" placeholder="Valor Hora do Pedreiro">
                <input type="text" placeholder="Valor Hora do Mestre">
                <textarea name="" id="" placeholder="Descrição do Serviço" class="descricao"></textarea>
                <div class="enviar-foto">
                    <p>Escolha sua Foto pro Serviço:</p>
                    <label for="foto" class="select-foto">
                        <i  class="fa-solid fa-cloud-arrow-up"></i> Escolha uma foto
                    </label>
                    <input type="file" id="foto">
                </div>
                <button type="submit">Criar Serviço</button>
            </form>
        </div>
    </main>
</body>
</html>