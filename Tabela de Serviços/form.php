<?php
require 'crud.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Serviço</title>
</head>

<body>



    <form action="insert.php" method="post" enctype="multipart/form-data" class="formulario">

        <h1>Adicionar Serviço</h1>


        <label class="label_form">Nome de serviço:</label>
        <input type="text" placeholder="nome de serviço" name="nome_servico" required>

        <label class="label_form">Tipo do Serviço:</label>
        <input type="text" placeholder="Tipo do Serviço" name="tipo_servico" required>

        <label class="label_form">Preco Do Mestre de obras:</label>
        <input type="text" placeholder="Preço" name="valor_mestre">

        <label class="label_form">Preco Do Pedreiro:</label>
        <input type="text" placeholder="Preço" name="valor_pedreiro">

        <label class="label_form">Preco do Servente:</label>
        <input type="text" placeholder="Preço" name="valor_servente">




        <button type="submit" class="botao_adicionar">Adicionar</button>


        </div>
</body>

</html>