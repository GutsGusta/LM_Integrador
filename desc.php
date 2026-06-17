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

$nomeCategoria = $categorias[$profissional['funcao']] ?? $profissional['funcao'];


$servicos = [
    'Projetos' => 'Projetos',
    'Colocação de Pisos e Azulejos' => 'Colocação de Pisos e Azulejos',
    'Preparação de massa e auxílio geral' => 'Preparação de massa e auxílio geral',
    'Gestão e leitura de projetos' => 'Gestão e leitura de projetos',
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
if ($mediaArredondada == 0)
    $estrelas = '☆☆☆☆☆';
elseif ($mediaArredondada == 1)
    $estrelas = '⭐☆☆☆☆';
elseif ($mediaArredondada == 2)
    $estrelas = '⭐⭐☆☆☆';
elseif ($mediaArredondada == 3)
    $estrelas = '⭐⭐⭐☆☆';
elseif ($mediaArredondada == 4)
    $estrelas = '⭐⭐⭐⭐☆';
elseif ($mediaArredondada == 5)
    $estrelas = '⭐⭐⭐⭐⭐';


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

    <?php require_once "partials/header.php"; ?>

    <div class="perfil-page">

        <a href="funcionarios.php" class="voltar">← Voltar aos profissionais</a>

        <div class="perfil-container">

            <div class="coluna-esq">

                <div class="card-foto">
                    <img src="uploads/<?= htmlspecialchars($profissional['foto']) ?>"
                        alt="<?= htmlspecialchars($profissional['nome_profissional']) ?>">
                    <h2><?= htmlspecialchars($profissional['nome_profissional']) ?></h2>
                    <span class="badge-categoria">
                        <?= htmlspecialchars($nomeCategoria) ?>
                    </span>
                    <div class="estrelas-perfil"><?= $estrelas ?></div>
                    <p class="nota-texto"><?= $mediaArredondada ?> · <?= $total_avaliacoes ?> Avaliações</p>
                    <?php if (trim($profissional['disponibilidade']) === 'Indisponível'): ?>
                        <button type="button" class="btn-solicitar" disabled
                            style="background-color: #555; color: #aaa; cursor: not-allowed; box-shadow: none;">
                            Agenda Fechada
                        </button>
                    <?php else: ?>
                        <a href="agendahorario.php?id_profissional=<?= $profissional['id_profissional'] ?>">
                            <button type="button" class="btn-solicitar">Agendar Horário</button>
                        </a>
                    <?php endif; ?>

                    <a
                        href="avaliar.php?id_profissional=<?= $profissional['id_profissional'] ?>&nome_profissional=<?= urlencode($profissional['nome_profissional']) ?>">
                        <button type="button" class="btn-avaliar">Avaliar</button>
                    </a>
                </div>

                <div class="card-stats">
                    <div class="stat-item">
                        <span class="stat-label">Experiência</span>
                        <span class="stat-valor"><?= htmlspecialchars($profissional['experiencia']) ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Especialidade</span>
                        <span class="stat-valor"><?= htmlspecialchars($nomeCategoria) ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Projetos concluídos</span>
                        <span class="stat-valor"><?= htmlspecialchars($profissional['projetos_concluidos']) ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Disponibilidade</span>
                        <span class="stat-valor">
                            <?php
                            $status = trim($profissional['disponibilidade'] ?? '');

                            switch ($status) {
                                case 'Disponível':
                                    echo '<p style="color: #2ecc71; font-weight: bold;">Disponível</p>'; // Verde
                                    break;
                                case 'Alocado':
                                    echo '<p style="color: #f1c40f; font-weight: bold;">Alocado</p>'; // Amarelo
                                    break;
                                case 'Em serviço':
                                    echo '<p style="color: #3498db; font-weight: bold;">Em serviço</p>'; // Azul
                                    break;
                                case 'Indisponível':
                                default:
                                    echo '<p style="color: #e74c3c; font-weight: bold;">Indisponível</p>'; // Vermelho
                                    break;
                            }
                            ?>
                        </span>
                        </span>
                    </div>
                </div>

            </div>

            <div class="coluna-dir">

                <div class="card-info">
                    <h3>Sobre</h3>
                    <p><?= htmlspecialchars($profissional['sobre']) ?></p>
                </div>

                <div class="card-info">
                    <h3>Serviços que realiza</h3>
                    <div class="servicos-lista">
                        <span class="tag-servico"><?= htmlspecialchars($profissional['servico']) ?></span>
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
                                        <span class="avaliacao-nome"><?= htmlspecialchars($nomeDoCliente) ?></span>
                                        <span class="avaliacao-data">Data da Avaliação:
                                            <?= $dataHora->format('d/m/Y') . ' às ' . $dataHora->format('H:i') ?></span>
                                        <p class="avaliacao-servico"><?= htmlspecialchars($avaliacao['nome_servico']) ?></p>
                                        <p>Nota: <?= htmlspecialchars($avaliacao['nota']) ?></p>
                                        <span
                                            class="avaliacao-texto"><?= htmlspecialchars($avaliacao['texto_avaliacao']) ?></span>
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