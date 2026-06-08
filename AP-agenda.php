<?php
require_once('crud.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

$profissional = read(
    $pdo,
    'profissional',
    'id_profissional = ' . (int) $_SESSION['user_id']
);

if (!$profissional) {
    die('Profissional não encontrado.');
}

// LÓGICA DA NAVEGAÇÃO DO CALENDÁRIO

$mes = isset($_GET['mes']) ? (int)$_GET['mes'] : (int)date('m');
$ano = isset($_GET['ano']) ? (int)$_GET['ano'] : (int)date('Y');

$antes_mes = ($mes == 1) ? 12 : $mes - 1;
$antes_ano = ($mes == 1) ? $ano - 1 : $ano;
$prox_mes = ($mes == 12) ? 1 : $mes + 1;
$prox_ano = ($mes == 12) ? $ano + 1 : $ano;

$meses_nomes = [
    1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril', 5 => 'Maio', 6 => 'Junho',
    7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
];

$primeiro_dia_timestamp = mktime(0, 0, 0, $mes, 1, $ano);
$total_dias_mes = date('t', $primeiro_dia_timestamp);
$dia_semana_inicio = date('w', $primeiro_dia_timestamp);

$mes_anterior = ($mes == 1) ? 12 : $mes - 1;
$ano_anterior = ($mes == 1) ? $ano - 1 : $ano;
$total_dias_mes_anterior = date('t', mktime(0, 0, 0, $mes_anterior, 1, $ano_anterior));

// AQUI BUSCA OS AGENDAMENTOS
$mes_formatado = str_pad($mes, 2, "0", STR_PAD_LEFT); 
$data_inicio_busca = "$ano-$mes_formatado-01";
$data_fim_busca = "$ano-$mes_formatado-$total_dias_mes";

$sql = "SELECT a.data_agenda, a.horario, a.status, c.nome_cliente, s.nome_servico 
        FROM agendamento a 
        JOIN cliente c ON a.id_cliente = c.id_cliente
        JOIN servicos s ON a.id_servico = s.id_servico
        WHERE a.id_profissional = :id_prof 
          AND a.data_agenda BETWEEN :data_ini AND :data_fim
        ORDER BY a.horario ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':id_prof' => $id_profissional,
    ':data_ini' => $data_inicio_busca,
    ':data_fim' => $data_fim_busca
]);
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$agenda_organizada = [];
foreach ($agendamentos as $agendamento) {
    $dia_do_compromisso = (int)date('d', strtotime($agendamento['data_agenda']));
    $agenda_organizada[$dia_do_compromisso][] = $agendamento;
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AP-agenda.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>Agenda</title>
</head>

<body>
    <?php
    require_once 'partials/header.php';
    ?>
    <main>
        <div class="pagina-principal">
           <div class="sidebar">
                <div class="sidebar-perfil">
                    <img src="uploads/<?php echo $profissional['foto']; ?>" alt="Foto">
                    <div class="sidebar-perfil-info">
                        <strong><?php echo $profissional['nome_profissional']; ?></strong>
                        <span><?php echo $profissional['cidade_estado']; ?></span>
                        <span><?php echo $profissional['funcao']; ?></span>
                    </div>

                </div>

                <a href="AP-dashbord.php" class="nav-item">
                    <i class="fa-solid fa-house"></i>
                    Meu Dashboard
                </a>

                <a href="AP-servicos.php" class="nav-item">
                    <i class="fa-solid fa-file-lines"></i>
                    Meus Serviços
                </a>

                <a href="AP-agenda.php" class="nav-item ativo">
                    <i class="fa-solid fa-calendar"></i>
                    Meus Agendamentos
                </a>

                <a href="AP-dados.php" class="nav-item">
                    <i class="fa-solid fa-user"></i>
                    Meus Dados
                </a>

                <form method="POST" action="" class="form-sair">                                                   
                    <button type="submit" name="logout" class="nav-sair">
                        <i class="fa-solid fa-user"></i>
                        Sair
                    </button>
                </form>
            </div>    

            <div class="agenda">

                <div class="agenda-txt">
                    <a href="?mes=<?= $antes_mes ?>&ano=<?= $antes_ano ?>" class="btn-nav">< Mês Anterior</a>
                        <h2><?=$meses_nomes[$mes]?> de <?= $ano ?></h2>
                    <a href="?mes=<?= $prox_mes ?>&ano=<?= $prox_ano ?>"class="btn-nav">Próximo Mês ></a>
                </div>

                <div class="dias-semana">
                    <p>Dom</p>
                    <p>Seg</p>
                    <p>Ter</p>
                    <p>Qua</p>
                    <p>Qui</p>
                    <p>Sex</p>
                    <p>Sáb</p>
                </div>

                <div class="calendario">
                    <?php
                        for ($i = $dia_semana_inicio - 1; $i >= 0; $i--){
                            $num_dia_ant = $total_dias_mes_anterior - $i;
                            echo '<div class="dia fora-do-mes"><p class="numero-dia">'. $num_dia_ant .'</p></div>';
                        }

                        for ($dia_atual = 1; $dia_atual <= $total_dias_mes; $dia_atual++){
                            $hoje_classe = ($dia_atual == (int)date('d') && $mes == (int)date('m') && $ano == (int)date('Y')) ? 'dia-hoje' : '';

                            echo '<div class="dia '.$hoje_classe.'">';
                            echo '<p class="numero-dia">'.$dia_atual.'</p>';

                            if (isset($agenda_organizada[$dia_atual])){
                                foreach ($agenda_organizada[$dia_atual] as $key => $servico) {
                                    $hora_formatada = date('H:i', strtotime($servico['horario']));

                                    echo "<p class='servico-aviso'><strong>{$hora_formatada}</strong> - {$servico['nome_servico']}</p>";
                                }
                            }
                            echo '</div>';
                        }

                        $total_dias_calendario = $dia_semana_inicio + $total_dias_mes;
                        $resto_calendario = 42 - $total_dias_calendario;
                        if ($resto_calendario >= 7) {$resto_calendario -= 7; }

                        for ($prox_dia = 1; $prox_dia <= $resto_calendario; $prox_dia++) {
                            echo '<div class="dia fora-do-mes"><p class="numero-dia">'.$prox_dia.'</p></div>';
                        }
                    ?>


                    <!-- <div class="dia">
                        <p class="numero-dia">1</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">2</p>
                    </div>

                    <div class="dia tem-servico">
                        <p class="numero-dia">3</p>
                        <p class="servico primeiro-servico">08:00 - Contrapiso</p>
                    </div>

                    <div class="dia">
                        <p class="numero-dia">4</p>
                    </div>

                    <div class="dia dia-hoje">
                        <p class="numero-dia">5</p>
                    </div>

                    <div class="dia">
                        <p class="numero-dia">6</p>
                    </div>

                    <div class="dia tem-servico">
                        <p class="numero-dia">7</p>
                        <p class="servico primeiro-servico">07:30 - Reboco Muro</p>
                        <p class="servico segundo-servico">14:00 - Orçamento</p>
                    </div>

                    <div class="dia">
                        <p class="numero-dia">8</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">9</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">10</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">11</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">12</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">13</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">14</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">15</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">16</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">17</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">18</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">19</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">20</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">21</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">22</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">23</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">24</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">25</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">26</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">27</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">28</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">29</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">30</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">31</p>
                    </div>
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">1</p>
                    </div>
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">2</p>
                    </div>
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">3</p>
                    </div>
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">4</p>
                    </div>
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">5</p>
                    </div>
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">6</p>
                    </div> -->
                </div>
            </div>
        </div>
    </main>
</body>

</html>