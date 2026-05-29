<?php

require 'crud.php';

$servicos = readAll($pdo, 'servicos');

?>

<table border="1" cellpadding="11" cellspacing="1">
    <h1>Tipos de Serviços</h1>
    <tr>
        <th>ID</th>
        <th>Serviço</th>
        <th>Tipo</th>
        <th>Valor Mestre por M²</th>
        <th>Valor Pedreiro por M²</th>
        <th>Valor Servente por M²</th>
        <th>Editar Serviço</th>
        <th>Excluir Serviço</th>
    </tr>

    <?php foreach ($servicos as $servico): ?>

        <tr>

            <td><?= $servico['id_servico'] ?></td>

            <td><?= htmlspecialchars($servico['nome_servico']) ?></td>

            <td><?= htmlspecialchars($servico['tipo_servico']) ?></td>

            <td>
                R$
                <?= number_format($servico['valor_mestre'], 2, ',', '.') ?>
            </td>

            <td>
                R$
                <?= number_format($servico['valor_pedreiro'], 2, ',', '.') ?>
            </td>

            <td>
                R$
                <?= number_format($servico['valor_servente'], 2, ',', '.') ?>
            </td>

            <td>
                <a href="alterarservico.php?id=<?= $servico['id_servico'] ?>">Editar</a>
            </td>

            <td>
                <a href="delete.php?id=<?= $servico['id_servico'] ?>"
                    onclick="return confirm('Tem certeza que deseja excluir este serviço?')">Excluir</a>

        </tr>

    <?php endforeach; ?>

</table>