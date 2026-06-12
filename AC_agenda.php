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

$id_cliente = $_SESSION['user_id'] ?? 0;

// Navegação do calendário
$mes = isset($_GET['mes']) ? (int)$_GET['mes'] : (int)date('m');
$ano = isset($_GET['ano']) ? (int)$_GET['ano'] : (int)date('Y');

$antes_mes = ($mes == 1) ? 12 : $mes - 1;
$antes_ano = ($mes == 1) ? $ano - 1 : $ano;
$prox_mes  = ($mes == 12) ? 1  : $mes + 1;
$prox_ano  = ($mes == 12) ? $ano + 1 : $ano;

$meses_nomes = [
    1=>'Janeiro', 2=>'Fevereiro', 3=>'Março', 4=>'Abril',
    5=>'Maio', 6=>'Junho', 7=>'Julho', 8=>'Agosto',
    9=>'Setembro', 10=>'Outubro', 11=>'Novembro', 12=>'Dezembro'
];

$primeiro_dia_ts       = mktime(0, 0, 0, $mes, 1, $ano);
$total_dias_mes        = date('t', $primeiro_dia_ts);
$dia_semana_inicio     = (int)date('w', $primeiro_dia_ts);
$total_dias_mes_ant    = date('t', mktime(0, 0, 0, $antes_mes, 1, $antes_ano));

// Buscar agendamentos do cliente neste mês
$mes_fmt    = str_pad($mes, 2, "0", STR_PAD_LEFT);
$data_ini   = "$ano-$mes_fmt-01";
$data_fim   = "$ano-$mes_fmt-$total_dias_mes";

$sql = "SELECT a.data_agenda, a.horario, a.status, s.nome_servico
        FROM agendamento a
        LEFT JOIN orcamentos o ON a.id_orcamento = o.id_orcamento
        LEFT JOIN servicos   s ON o.id_servico   = s.id_servico
        WHERE a.id_cliente = ?
          AND a.data_agenda BETWEEN ? AND ?
        ORDER BY a.horario ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id_cliente, $data_ini, $data_fim]);
$agendamentos_raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organizar por dia
$agenda_organizada = [];
foreach ($agendamentos_raw as $ag) {
    $dia = (int)date('d', strtotime($ag['data_agenda']));
    $agenda_organizada[$dia][] = $ag;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AC_agenda.css">
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
            <a href="AC_orcamentos.php" class="nav-item">
                <i class="fa-solid fa-file-lines"></i>
                Meus Orçamentos
            </a>
            <a href="AC_agenda.php" class="nav-item ativo">
                <i class="fa-solid fa-calendar"></i>
                Meus Agendamentos
            </a>
            <a href="AC_dados.php" class="nav-item">
                <i class="fa-solid fa-user"></i>
                Meus Dados
            </a>

            <form method="POST" action="AC_agenda.php">
                <button type="submit" name="logout" class="nav-item nav-sair">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Sair
                </button>
            </form>
        </div>

        <div class="cliente-content">
            <h2 class="agenda-titulo">Minha Agenda</h2>

            <div class="agenda">
                <div class="agenda-txt">
                    <a href="?mes=<?= $antes_mes ?>&ano=<?= $antes_ano ?>" class="btn-nav">&lt; Mês Anterior</a>
                    <h2><?= $meses_nomes[$mes] ?> de <?= $ano ?></h2>
                    <a href="?mes=<?= $prox_mes ?>&ano=<?= $prox_ano ?>" class="btn-nav">Próximo Mês &gt;</a>
                </div>

                <div class="dias-semana">
                    <p>Dom</p><p>Seg</p><p>Ter</p><p>Qua</p><p>Qui</p><p>Sex</p><p>Sáb</p>
                </div>

                <div class="calendario">
                    <?php
                    // Dias do mês anterior
                    for ($i = $dia_semana_inicio - 1; $i >= 0; $i--) {
                        $num = $total_dias_mes_ant - $i;
                        echo "<div class='dia fora-do-mes'><p class='numero-dia'>$num</p></div>";
                    }

                    // Dias do mês atual
                    for ($dia = 1; $dia <= $total_dias_mes; $dia++) {
                        $hoje = ($dia == (int)date('d') && $mes == (int)date('m') && $ano == (int)date('Y'));
                        $tem_servico = isset($agenda_organizada[$dia]);
                        $classes = 'dia' . ($hoje ? ' dia-hoje' : '') . ($tem_servico ? ' tem-servico' : '');

                        echo "<div class='$classes'>";
                        echo "<p class='numero-dia'>$dia</p>";

                        if ($tem_servico) {
                            foreach ($agenda_organizada[$dia] as $ag) {
                                $hora = date('H:i', strtotime($ag['horario']));
                                $servico_nome = htmlspecialchars($ag['nome_servico'] ?? 'Agendamento');
                                echo "<p class='servico-aviso'><strong>$hora</strong> - $servico_nome</p>";
                            }
                        }
                        echo "</div>";
                    }

                    // Completar com dias do próximo mês
                    $total_cal = $dia_semana_inicio + $total_dias_mes;
                    $resto = 42 - $total_cal;
                    if ($resto >= 7) $resto -= 7;
                    for ($prox = 1; $prox <= $resto; $prox++) {
                        echo "<div class='dia fora-do-mes'><p class='numero-dia'>$prox</p></div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>