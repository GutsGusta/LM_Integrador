<?php
<<<<<<< HEAD
require_once './data/crud.php';

$profissional = readAll($pdo, 'profissional');

$categoria_get = isset($_GET['categoria']) ? trim($_GET['categoria']) : '';

$categorias = [
    'mestre_de_obra' => 'Mestre de Obra',
    'pedreiro' => 'Pedreiro',
    'servente' => 'Servente'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoProfissional = [
        'nome_profissional' => $_POST['nome_profissional'],
        'email' => $_POST['email'],
        'telefone' => $_POST['telefone'],
        'cidade_estado' => $_POST['cidade_estado'],
        'senha' => $_POST['senha'],
        'funcao' => $_POST['funcao'],
        'foto' => ''
    ];

    $idProfissionalNovo = create($pdo, 'profissional', $novoProfissional);

    header('Location: funcionarios.php?funcionariosadd=1');
    exit;
}

?>


<!DOCTYPE html>
<html lang="pt-br">
=======
require_once('data/crud.php');


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$stmt_profissionais = $pdo->query('SELECT * FROM profissional');
$lista_funcionarios = $stmt_profissionais->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
>>>>>>> adfc705 (Enviado os dados da Bia)

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/funcionarios.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>LM | Funcionários</title>
</head>

<body>
<<<<<<< HEAD
    <?php
    require_once "partials/header.php";
    ?>
=======
    <?php require_once "partials/header.php"; ?>
>>>>>>> adfc705 (Enviado os dados da Bia)

    <section class="funcionarios-section">
        <h2>Nossos Profissionais</h2>

<<<<<<< HEAD
        <ul class="abas">
            <li class="aba ativa"><a href="funcionarios.php">Todos</a></li>
            <?php
            foreach ($categorias as $kcat => $vcat) {
                echo '<li class="aba"><a href="funcionarios.php?categoria=' . $kcat . '">' . $vcat . '</a></li>';
            }
            ?>
        </ul>
=======
        <div class="abas">
            <button class="aba ativa">Todos</button>
            <button class="aba">Pedreiros</button>
            <button class="aba">Serventes</button>
            <button class="aba">Mestres de Obra</button>
        </div>
>>>>>>> adfc705 (Enviado os dados da Bia)

        <div class="cards-funcionarios">

            <?php
<<<<<<< HEAD
            foreach ($profissional as $funcionario) {
                if ($categoria_get === '' || $funcionario['funcao'] === $categoria_get) {

                    $avalia = "id_profissional = '" . $funcionario['id_profissional'] . "'";
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

                    echo '
            <a href="desc.php?id=' . $funcionario['id_profissional'] . '">
                <div class="card-funcionario">
                <img src="' . $funcionario['foto'] . '" alt="' . $funcionario['nome_profissional'] . '">
                    <h3>' . $funcionario['nome_profissional'] . '</h3>
                    <div class="estrelas">' . $estrelas . '</div>
                    <span class="especialidade">' . $categorias[$funcionario['funcao']] . '</span>
                </div>
            </a>';
                }
                ;
            }
            ;

            ?>

        </div>
    </section>

    <?php
    require_once "partials/footer.php";
    ?>
</body>

</html>
=======
            foreach ($lista_funcionarios as $funcionarios) {
                echo '
            <a href="desc.php?id=' . $funcionarios['id_profissional'] . '">
                <div class="card-funcionario">
                    <img src="' . $funcionarios['foto'] . '" alt="' . $funcionarios['nome_profissional'] . '">
                    <h3>' . $funcionarios['nome_profissional'] . '</h3>
                    <div class="estrelas">★★★★★</div>
                    <span class="especialidade">' . $funcionarios['funcao'] . '</span>
                </div>
            </a>';
            };
            ?>


        </div>
    </section>

    </section>

    <?php require_once "partials/footer.php"; ?>
</body>

</html>
>>>>>>> adfc705 (Enviado os dados da Bia)
