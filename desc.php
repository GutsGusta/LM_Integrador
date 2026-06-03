<?php
require_once('data/crud.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id_profissional = $_GET['id'] ?? '';

if (empty($id_profissional)) {
    echo "Profissional não especificado.";
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM profissional WHERE id_profissional = ?');
$stmt->execute([$id_profissional]);
$profissional = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$profissional) {
    echo "Profissional não encontrado no sistema.";
    exit;
}

$categorias = [
    'mestre_de_obra' => 'Mestre de Obra',
    'pedreiro'       => 'Pedreiro',
    'servente'       => 'Servente'
];

$avalia = "id_profissional = '" . $profissional['id_profissional'] . "'";
$avaliacao_filtrada = readAll($pdo, 'avaliacoes', $avalia);
$total_avaliacoes = count($avaliacao_filtrada);

if (!empty($avaliacao_filtrada)) {
    $mediaNota = array_sum(array_column($avaliacao_filtrada, 'nota')) / $total_avaliacoes;
} else {
    $mediaNota = 0;
}
$mediaArredondada = round($mediaNota, 0);

$estrelas = '';
if ($mediaArredondada == 0)      $estrelas = '☆☆☆☆☆';
elseif ($mediaArredondada == 1)  $estrelas = '⭐☆☆☆☆';
elseif ($mediaArredondada == 2)  $estrelas = '⭐⭐☆☆☆';
elseif ($mediaArredondada == 3)  $estrelas = '⭐⭐⭐☆☆';
elseif ($mediaArredondada == 4)  $estrelas = '⭐⭐⭐⭐☆';
elseif ($mediaArredondada == 5)  $estrelas = '⭐⭐⭐⭐⭐';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <link rel="stylesheet" href="css/desc.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>Funcionário | LM</title>
</head>

<body>

    <?php require_once "partials/header.php"; ?>

    <div class="perfil-page">

        <a href="funcionarios.php" class="voltar">← Voltar aos profissionais</a>

        <div class="perfil-container">

            
            <div class="coluna-esq">

                <div class="card-foto">
                    <img src="uploads/<?= $profissional['foto'] ?>" alt="<?= $profissional['nome_profissional'] ?>">
                    <h2><?= $profissional['nome_profissional'] ?></h2>
                    <span class="badge-categoria">
                        <?= isset($categorias[$profissional['funcao']]) ? $categorias[$profissional['funcao']] : $profissional['funcao'] ?>
                    </span>
                    <div class="estrelas-perfil"><?= $estrelas ?></div>
                    <p class="nota-texto"><?= $mediaArredondada ?> · <?= $total_avaliacoes ?> Avaliações</p>
                    <a href="testeagenda.php?id_profissional=<?= $profissional['id_profissional'] ?>">
                        <button type="button" class="btn-solicitar">Agendar Horário</button>
                    </a>
                </div>

                <div class="card-stats">
                    <div class="stat-item">
                        <span class="stat-label">Experiência</span>
                        <span class="stat-valor"><?= $profissional['experiencia'] ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Especialidade</span>
                        <span class="stat-valor"><?= $categorias[$profissional['funcao']] ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Projetos concluídos</span>
                        <span class="stat-valor"><?= $profissional['projetos_concluidos'] ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Disponibilidade</span>
                        <span class="stat-valor disponivel">
                            <?php if ($profissional['disponibilidade'] == 1): ?>
                                <p style="color: green;">Disponível</p>
                            <?php else: ?>
                                <p style="color: red;">Indisponível</p>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>

            </div>
            

    
            <div class="coluna-dir">

                <div class="card-info">
                    <h3>Sobre</h3>
                    <p><?= $profissional['sobre'] ?></p>
                </div>

                <div class="card-info">
                    <h3>Serviços que realiza</h3>
                    <div class="servicos-lista">
                        <span class="tag-servico"><?= $profissional['servico'] ?></span>
                    </div>
                </div>

                <div class="card-info">
                    <h3>Avaliações dos clientes</h3>
                    <div class="avaliacoes-lista">

                        <?php if ($avaliacao_filtrada): ?>
                            <?php foreach ($avaliacao_filtrada as $avaliacao): ?>

                                <?php
                                $dataHora = new DateTime($avaliacao['data_avaliacao']);

                                $tabelaComJoin = "avaliacoes INNER JOIN cliente ON avaliacoes.id_cliente = cliente.id_cliente";
                                $condicao = "avaliacoes.id_profissional = '" . $profissional['id_profissional'] . "'
                                             AND avaliacoes.id_cliente = '" . $avaliacao['id_cliente'] . "'
                                             ORDER BY avaliacoes.nota DESC";

                                $avaliacoesDocliente = readAll($pdo, $tabelaComJoin, $condicao);
                                $nomeDoCliente = !empty($avaliacoesDocliente) ? $avaliacoesDocliente[0]['nome_cliente'] : 'Cliente Desconhecido';
                                ?>

                                <div class="avaliacao-item">
                                    <div class="avaliacao-header">
                                        <span class="avaliacao-nome"><?= $nomeDoCliente ?></span>
                                        <span>Data da Avaliação: <?= $dataHora->format('d/m/Y às H:i') ?></span>
                                        <p class="avaliacao-servico"><?= $avaliacao['nome_servico'] ?></p>
                                        <p>Nota: <?= $avaliacao['nota'] ?></p>
                                        <span class="avaliacao-texto"><?= $avaliacao['texto_avaliacao'] ?></span>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Não há avaliações para este profissional.</p>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
            

        </div>
        

    </div>
    

    <?php require_once "partials/footer.php"; ?>

</body>

</html>
=======
    <link rel="stylesheet" href="css/funcionarios.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>LM | Funcionários</title>
</head>

<body>
<a href="testeagenda.php?id_profissional=<?php echo $profissional['id_profissional']; ?>">
            <button type="submit">Agendar Horário
</button>
    </a>


<h1>avaliação</h1>

<a href="testeenviar.php?id_profissional=<?php echo $profissional['id_profissional']; ?>&nome_profissional=<?php echo urlencode($profissional['nome_profissional']); ?>">
    <button type="submit">Enviar Avaliação</button>
</a>

<?php

$avalia = "id_profissional = '" . $profissional['id_profissional'] . "'";
$avaliacao_filtrada = readAll($pdo, 'avaliacoes', $avalia);


if ($total_avaliacoes = count($avaliacao_filtrada) > 0) {
    echo '<p>Total de Avaliações: ' . count($avaliacao_filtrada) .'';
    } else {
        echo '<p>Total de Avaliações: 0';
    }


    $totalAvaliacoes = readALL($pdo, 'avaliacoes');
    if (!empty($totalAvaliacoes)):

        $mediaNota = array_sum(array_column($totalAvaliacoes, 'nota')) / count($totalAvaliacoes);
    else:
        $mediaNota = 0;
    endif;
    $mediaArredondada = round($mediaNota, 1);
    echo "Média final: " . $mediaArredondada;


    if ($mediaArredondada == 0) {
        echo'⭐'; 
        }
        else if ($mediaArredondada == 1) {
            echo '⭐';
        }
        else if ($mediaArredondada == 2) {
            echo '⭐⭐';
        }
        else if ($mediaArredondada == 3) {
            echo '⭐⭐⭐';
        }
        else if ($mediaArredondada == 4) {
            echo '⭐⭐⭐⭐';
        }
        else if ($mediaArredondada == 5) {
            echo '⭐⭐⭐⭐⭐';
        };


    if ($avaliacao_filtrada) {
    foreach ($avaliacao_filtrada as $avaliacoes) {
        $dataHora = new DateTime($avaliacoes['data_avaliacao']);

    echo '
    <p>ID:' . $avaliacoes['id'] . '</p>
    <p>Título:' . $avaliacoes['titulo'] . '</p>';

        echo '
    <p>Data da Avaliação: ' . $dataHora->format('d/m/Y à\s H:i') . '</p>
    
    <p>Nota:' . $avaliacoes['nota'] . '</p>
    <p>Texto da Avaliação:<br>' . $avaliacoes['texto_avaliacao'] . '</p>
    <p>Profissional avaliado: ' . $avaliacoes['nome_profissional'] . '</p>';
    }
     
    } else {
        echo '<p>Não há avaliações para este profissional.</p>';
    };

?>

</body>
</html>
>>>>>>> adfc705 (Enviado os dados da Bia)
