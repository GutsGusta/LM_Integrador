<?php
require_once('data/crud.php');

session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: ./login.php');
    exit();
}

if (isset($_SESSION['user_tipo'])) {
    $usuarioLogado = $_SESSION['user_tipo'];
    if ($usuarioLogado !== 'cliente') {
        header('Location: login.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}

$categorias = [
    'mestre_de_obra' => 'Mestre de Obra',
    'pedreiro'       => 'Pedreiro',
    'servente'       => 'Servente'
];

// CORRIGIDO: orcamentos não tem id_profissional — profissional vem via agendamento
$tabelaJoin = "orcamentos
    LEFT JOIN agendamento  ON agendamento.id_orcamento     = orcamentos.id_orcamento
    LEFT JOIN profissional ON profissional.id_profissional = agendamento.id_profissional
    LEFT JOIN servicos     ON servicos.id_servico          = orcamentos.id_servico";

$condicaoJoin = "orcamentos.id_cliente = '" . (int)$_SESSION['user_id'] . "' ORDER BY orcamentos.id_orcamento DESC";

$buscaUsuarios = readAll($pdo, $tabelaJoin, $condicaoJoin);
$usuarios = is_array($buscaUsuarios) ? $buscaUsuarios : [];

// Processar cancelamento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_orcamento'])) {
    $id_orcamento = (int) $_POST['id_orcamento'];
    $dadosAtualizados = ['status' => trim($_POST['status'])];
    update($pdo, 'orcamentos', $dadosAtualizados, "id_orcamento = $id_orcamento");
    header('Location: AC_orcamentos.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AC_orcamentos.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Cliente | LM</title>
</head>

<body>

    <?php require_once "partials/header.php"; ?>

    <div class="cliente-wrapper">

        <div class="sidebar">
            <div class="sidebar-perfil">
                <img src="uploads/default.png" alt="Cliente">
                <div class="sidebar-perfil-info">
                    <strong><?php echo $_SESSION['user_name']; ?></strong>
                    <span>Cliente</span>
                </div>
            </div>

            <a href="AC_dashboard.php" class="nav-item">
                <i class="fa-solid fa-house"></i>
                Meu Dashboard
            </a>
            <a href="AC_orcamentos.php" class="nav-item ativo">
                <i class="fa-solid fa-file-lines"></i>
                Meus Orçamentos
            </a>
            <a href="AC_agenda.php" class="nav-item">
                <i class="fa-solid fa-calendar"></i>
                Meus Agendamentos
            </a>
            <a href="AC_dados.php" class="nav-item">
                <i class="fa-solid fa-user"></i>
                Meus Dados
            </a>

            <form method="POST" action="AC_orcamentos.php">
                <button type="submit" name="logout" class="nav-item nav-sair">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Sair
                </button>
            </form>
        </div>

        <div class="orcamentos-content">
            <h2 class="content-titulo">Meus Orçamentos:</h2>

            <div class="orcamento-card">
                <h3 class="card-titulo">Todos os Orçamentos</h3>

                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $usuario): ?>

                        <div class="orcamento-linha">

                            <div class="orcamento-info">
                                <!-- CORRIGIDO: 'titulo' não existe → nome_servico ou mensagem -->
                                <strong class="destaque">
                                    <?= htmlspecialchars($usuario['nome_servico'] ?? $usuario['mensagem'] ?? 'Serviço') ?>
                                </strong>
                                <span>
                                    <?= htmlspecialchars($usuario['nome_profissional'] ?? 'Aguardando profissional') ?>
                                    <?php if (!empty($usuario['funcao'])): ?>
                                        - <?= htmlspecialchars($categorias[$usuario['funcao']] ?? $usuario['funcao']) ?>
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div class="orcamento-valores">
                                <!-- CORRIGIDO: 'preco' não existe em orcamentos → valor_pedreiro -->
                                <strong class="destaque">
                                    R$ <?= number_format($usuario['valor_pedreiro'] ?? 0, 2, ',', '.') ?>
                                </strong>
                                <!-- CORRIGIDO: 'data' não existe → data_envio -->
                                <span><?= date('d/m/Y', strtotime($usuario['data_envio'])) ?></span>
                            </div>

                            <div class="orcamento-status status-pendente">
                                <?= htmlspecialchars($usuario['status']) ?>
                            </div>

                            <!-- CORRIGIDO: form fechada no lugar certo -->
                            <form method="POST" action="AC_orcamentos.php">
                                <input type="hidden" name="id_orcamento" value="<?= $usuario['id_orcamento'] ?>">
                                <select class="orcamento-status" name="status">
                                    <option value="">Selecione uma ação</option>
                                    <option value="cancelado" <?= ($usuario['status'] === 'cancelado' ? 'selected' : '') ?>>
                                        Cancelar
                                    </option>
                                </select>
                                <button type="submit"
                                    onclick="return confirm('Tem certeza que deseja cancelar este orçamento?')"
                                    name="salvar_dados" class="btn-salvar">
                                    Salvar
                                </button>
                            </form>

                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="destaque">Nenhum orçamento encontrado.</p>
                <?php endif; ?>

            </div>
        </div>
    </div>

</body>
</html>