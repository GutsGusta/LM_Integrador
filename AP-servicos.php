<?php
require_once('crud.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$profissional = read(
    $pdo,
    'profissional',
    'id_profissional = ' . (int)$_SESSION['user_id']
);

if (!$profissional) {
    die('Profissional não encontrado.');
}

$sql = "
SELECT
    a.id,
    a.data_agenda,
    a.horario,
    a.preco,
    a.status,
    c.nome_cliente,
    c.telefone,.
    c.endereco,
    s.nome_servico
FROM agendamento a
INNER JOIN cliente c
    ON a.id_cliente = c.id_cliente
INNER JOIN servicos s
    ON a.id_servico = s.id_servico
WHERE a.id_profissional = ?
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);

$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AP-servicos.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>Serviços Requeridos</title>
</head>

<body>

<?php require_once 'partials/header.php'; ?>

<main>
    <div class="pagina-principal">

        <div class="funcoes">
            <div class="pessoal">
                <img src="uploads/<?php echo $profissional['foto']; ?>">

                <div class="pessoal-txt">
                    <h2><?php echo $profissional['nome_profissional']; ?></h2>
                    <p><?php echo $profissional['email']; ?></p>
                    <p><?php echo $profissional['cidade_estado']; ?></p>
                </div>
            </div>

            <div class="linha"></div>

            <div class="area-botoes">
                <div class="botoes">
                    <img src="uploads/quadrados.png">
                    <a href="AP-dashbord.php">Meu Dashboard</a>
                </div>

                <div class="botoes">
                    <img src="uploads/notas.png">
                    <a href="AP-servicos.php">Serviços Requeridos</a>
                </div>

                <div class="botoes">
                    <img src="uploads/calendario.png">
                    <a href="AP-agenda.php">Meus Agendamentos</a>
                </div>

                <div class="botoes">
                    <img src="uploads/dados.png">
                    <a href="AP-dados.php">Meus Dados</a>
                </div>

                <div class="botoes">
                    <img src="uploads/sair.png">
                    <a href="logout.php">Sair</a>
                </div>
            </div>
        </div>

        <div class="servicos">
            <h3>Serviços em Andamento:</h3>

            <table class="servicos-tabela">
                <tr>
                    <th>Nome do Cliente</th>
                    <th>Contato</th>
                    <th>Serviço</th>
                    <th>Endereço</th>
                    <th>Valor Total</th>
                    <th>Status</th>
                </tr>

                <?php if (!empty($agendamentos)): ?>

                    <?php foreach ($agendamentos as $agendamento): ?>

                        <tr>
                            <td><?php echo $agendamento['nome_cliente']; ?></td>

                            <td><?php echo $agendamento['telefone']; ?></td>

                            <td><?php echo $agendamento['nome_servico']; ?></td>

                            <td><?php echo $agendamento['endereco']; ?></td>

                            <td>
                                R$
                                <?php echo number_format(
                                    $agendamento['preco'],
                                    2,
                                    ',',
                                    '.'
                                ); ?>
                            </td>

                            <td><?php echo $agendamento['status']; ?></td>
                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="6">
                            Nenhum serviço encontrado.
                        </td>
                    </tr>

                <?php endif; ?>

            </table>
        </div>

        <div class="servicos">
            <h3>Respostas Pendentes:</h3>

            <table class="servicos-tabela">
                <tr>
                    <th>Nome do Cliente</th>
                    <th>Contato</th>
                    <th>Serviço</th>
                    <th>Endereço</th>
                    <th>Valor Total</th>
                    <th>Resposta</th>
                </tr>

                <tr>
                    <td colspan="6">
                        Área ainda não implementada.
                    </td>
                </tr>

            </table>
        </div>

    </div>
</main>

</body>
</html>