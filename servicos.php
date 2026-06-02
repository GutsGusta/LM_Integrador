
<?php
    require_once 'crud.php';
    
    $servicos = readAll($pdo, 'servicos');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/servicos.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>Serviços</title>
</head>
<body>
    <?php
        require_once 'partials/header.php';
    ?>    

<main>
        <div class="pagina-completa">
            <h1 class="titulo">Conheça os Serviços Populares</h1>

            <div class="produtos">
                <?php 
                foreach ($servicos as $servico): 
                    $imagem = !empty($servico['imagem_servico']) ? $servico['imagem_servico'] : 'exemplo.jpeg';
                ?>
                    <article class="card">
                        <img src="uploads/<?= $imagem; ?>" alt="<?= htmlspecialchars($servico['imagem_servico']); ?>">
                        <h2><?= htmlspecialchars($servico['nome_servico']); ?></h2>
                        <p style="text-align: center; color: #666; font-style: italic;"><?= htmlspecialchars($servico['tipo_servico']); ?></p>
                        
                        <details>
                            <summary>Ver Valores</summary>
                            <div class="valores">
                                <table>
                                    <tr>
                                        <th>Profissional</th>
                                        <th>Preço /Hora</th>
                                    </tr>
                                    <tr>
                                        <td>Servente</td>
                                        <td>R$ <?= number_format($servico['valor_servente'], 2, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pedreiro</td>
                                        <td>R$ <?= number_format($servico['valor_pedreiro'], 2, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mestre de Obras</td>
                                        <td>R$ <?= number_format($servico['valor_mestre'], 2, ',', '.'); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </details>
                        
                        <a href="funcionarios.php?id_servico=<?= $servico['id_servico']; ?>" class="card-botao">
                            Ver Profissionais Qualificados
                        </a> 
                    </article>
                <?php 
          
                endforeach; 
                ?>
            </div>
        </div>

        <div class="parte-final">
            <img src="uploads/moca-sorrindo.png">
            <div class="parte-final-txt">
                <h1>Não Encontrou o Que Deseja?</h1>
                <p>Envie sua situação e iremos te ajudar!</p>
                <a href="">Solicitar Orçamento</a>
            </div>
        </div>
    </main>

    <?php
        require_once 'partials/footer.php';
    ?>
</body>
</html>


