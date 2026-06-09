<?php
require 'crud.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Serviço</title>
</head>

<body>



    <form action="insert.php" method="post" enctype="multipart/form-data" class="formulario">

        <h1>Adicionar Orcamento</h1>


        <label class="label_form">Nome do Cliente:</label>
        <input type="text" placeholder="Nome do Cliente" name="nome_cliente" required>


        <label class="label_form">Valor do Orcamento:</label>
        <input type="text" placeholder="Valor" name="valor_orcamento" required>



        <button type="submit" class="botao_adicionar">Adicionar</button>


        </div>
</body>

</html>