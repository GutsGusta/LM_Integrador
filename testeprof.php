<?php
require_once './data/crud.php';

$profissional = readAll($pdo, 'profissional');


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

  header('Location: teste.php?testeadd=1');
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profissionais</title>
</head>
<body>
    
  <?php
foreach ($profissional as $profissionais) {
    echo '<a href="./detalhe.php?id=' . $profissionais['id_profissional'] . '">
                <img src="' . $profissionais['foto'] . '" width="100px" height="100px">
                <br><br>
                  <h3>Nome do profissional: ' . $profissionais['nome_profissional'] . '</h3>
                  <h3>Cidade e Estado: ' . $profissionais['cidade_estado'] . '</h3>
                  <h3>Senha: ' . $profissionais['senha'] . '</h3>
                  <h3>Função: ' . $profissionais['funcao'] . '</h3>
                  <h3>Email: ' . $profissionais['email'] . '</h3>
                  <h3>Telefone: ' . $profissionais['telefone'] . '</h3>
          </a>';
}

?>

</body>
</html>