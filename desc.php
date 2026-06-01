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
    'pedreiro' => 'Pedreiro',
    'servente' => 'Servente'
];

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/desc.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>Funcionário | LM</title>
</head>

<body>
    <?php
    require_once "partials/header.php";
    ?>

    <div class="perfil-page">

        <a href="funcionarios.php" class="voltar">← Voltar aos profissionais</a>

        <div class="perfil-container">

            <div class="coluna-esq">

                <div class="card-foto">
                    <?php


                    $avalia = "id_profissional = '" . $profissional['id_profissional'] . "'";
                    $avaliacao_filtrada = readAll($pdo, 'avaliacoes', $avalia);


                    if (($total_avaliacoes = count($avaliacao_filtrada)) > 0) {
                        count($avaliacao_filtrada);
                    }

                    $avaliacoesDoFuncionario = $avaliacao_filtrada;

                    if (!empty($avaliacoesDoFuncionario)):
                        $mediaNota = array_sum(array_column($avaliacoesDoFuncionario, 'nota')) / count($avaliacoesDoFuncionario);
                    else:
                        $mediaNota = 0;
                    endif;
                    $mediaArredondada = round($mediaNota, 0);


                    $estrelas = '';

                    if ($mediaArredondada == 0) {
                        $estrelas = '☆☆☆☆☆';
                    } else if ($mediaArredondada == 1) {
                        $estrelas = '⭐☆☆☆☆';
                    } else if ($mediaArredondada == 2) {
                        $estrelas = '⭐⭐☆☆☆';
                    } else if ($mediaArredondada == 3) {
                        $estrelas = '⭐⭐⭐☆☆';
                    } else if ($mediaArredondada == 4) {
                        $estrelas = '⭐⭐⭐⭐☆';
                    } else if ($mediaArredondada == 5) {
                        $estrelas = '⭐⭐⭐⭐⭐';
                    }
                    ;

                    ?>

                    <?php

                    $avaliacaos = '';
                    if ($total_avaliacoes = count($avaliacao_filtrada) > 0) {
                        $avaliacaos = count($avaliacao_filtrada);
                    } else {
                        $avaliacaos = 0;
                    }


                    echo '
                    <img src="uploads/' . $profissional['foto'] . '" alt="' . $profissional['nome_profissional'] . '">
                    <h2>' . $profissional['nome_profissional'] . '</h2>
                    <span class="badge-categoria">' . (isset($categorias[$profissional['funcao']]) ? $categorias[$profissional['funcao']] : $profissional['funcao']) . '</span>
                    <div class="estrelas-perfil">' . $estrelas . '</div>
                    <p class="nota-texto">' . $mediaArredondada . ' · ' . $avaliacaos . ' Avaliações</p>
                    <a href="testeagenda.php?id_profissional=' . $profissional['id_profissional'] . '">
                        <button type="button" class="btn-solicitar">Agendar Horário</button>
                    </a>
                </div>';

                    ?>

                    <div class="card-stats">
                        <div class="stat-item">
                            <span class="stat-label">Experiência</span>
                            <span class="stat-valor"><?php echo ($profissional['experiencia']); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Especialidade</span>
                            <span class="stat-valor"><?php echo ($categorias[$profissional['funcao']]); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Projetos concluídos</span>
                            <span class="stat-valor"><?php echo ($profissional['projetos_concluidos']); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Disponibilidade</span>
                            <span class="stat-valor disponivel"><?php
                            if ($profissional['disponibilidade'] == 1) {
                                echo "<p style='color: green;'>Disponível</p>";
                            } else {
                                echo "<p style='color: red;'>Indisponível</p>";
                            }
                            ?></span>
                        </div>
                    </div>

                </div>

                <div class="coluna-dir">

                    <div class="card-info">
                        <h3>Sobre</h3>
                        <p><?php echo ($profissional['sobre']); ?></p>
                    </div>

                    <div class="card-info">
                        <h3>Serviços que realiza</h3>
                        <div class="servicos-lista">
                            <span class="tag-servico"><?= $profissional['servico'] ?></span>
                        </div>
                        <div class="card-info">
                            <h3>Avaliações dos clientes</h3>
                            <div class="avaliacoes-lista">

                                <div class="avaliacao-item">
                                    <div class="avaliacao-header">

                                        <?php
                                        if ($avaliacao_filtrada) {
                                            foreach ($avaliacao_filtrada as $avaliacoes) {
                                                $dataHora = new DateTime($avaliacoes['data_avaliacao']);


                                                $tabelaComJoin = "avaliacoes INNER JOIN cliente ON avaliacoes.id_cliente = cliente.id_cliente";

                                                $condicao = "avaliacoes.id_profissional = '" . $profissional['id_profissional'] . "' AND avaliacoes.id_cliente = '" . $avaliacoes['id_cliente'] . "' ORDER BY avaliacoes.nota DESC";

                                                $avaliacoesDocliente = readALL($pdo, $tabelaComJoin, $condicao);

                                                if (!empty($avaliacoesDocliente)):
                                                    $mediaNota = array_sum(array_column($avaliacoesDocliente, 'nota')) / count($avaliacoesDocliente);
                                                else:
                                                    $mediaNota = 0;
                                                endif;
                                                $mediaArredondada = round($mediaNota, 0);

                                                $nomeDoClienteBuscado = !empty($avaliacoesDocliente) ? $avaliacoesDocliente[0]['nome_cliente'] : 'Cliente Desconecido';



                                                echo '<div class="avaliacao-item">
                                                <div class="avaliacao-header">
                                                <span class="avaliacao-nome">' . $nomeDoClienteBuscado . '</span>
                                                <span>Data da Avaliação: ' . $dataHora->format('d/m/Y à\s H:i') . '</span>
                                                <p class="avaliacao-servico">' . $avaliacoes['nome_servico'] . '</p>
                                                <p>Nota:' . $avaliacoes['nota'] . '</p>
                                                <span class="avaliacao-texto">' . $avaliacoes['texto_avaliacao'] . '</span>
                                                </div>
                                                </div>';
                                            }
                                        } else {
                                            echo '<p>Não há avaliações para este profissional.</p>';
                                        }
                                        ;
                                        ?>


                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <?php require_once "partials/footer.php"; ?>
</body>

</html>
