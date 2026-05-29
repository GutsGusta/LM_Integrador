<?php require 'crud.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados dos Orçamentos</title>
</head>

<body>
    <h1>ORÇAMENTOS</h1>

    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Valor</th>
            <th>Nome do Cliente</th>
            <th>Excluir</th>
            <th>Editar</th>
        </tr>

        <?php
        $orcamentos = readAll($pdo, 'orcamento');

        foreach ($orcamentos as $orcamento) {
            echo "<tr>
            <td>" . $orcamento['id_orcamento'] . "</td>
            <td>R$ " . number_format($orcamento['valor_orcamento'], 2, ',', '.') . "</td>
            <td>" . htmlspecialchars($orcamento['nome_cliente']) . "</td> 

            <td>
            <a href='delete.php?id=" . $orcamento['id_orcamento'] . "'onclick=\"return confirm('Deseja excluir este orçamento?')\">Excluir</a>
            </td>
            
            <td>
                <a href='alterarorcamento.php?id=" . $orcamento['id_orcamento'] . "'>Editar</a>
            </td>
          </tr>";
        }
        ?>

    </table>
    <a href="form.php">Adicionar Orcamento</a>

</body>

</html>