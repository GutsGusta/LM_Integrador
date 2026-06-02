<?php
require_once 'crud.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['titulo'])) {

    $novaAvaliacao = [
        'id_cliente'        => $_POST['id_cliente'],
        'id_profissional'   => $_POST['id_profissional'],
        'nome_profissional' => $_POST['nome_profissional'],
        'titulo'            => $_POST['titulo'],
        'nota'              => $_POST['nota'],
        'texto_avaliacao'   => $_POST['texto_avaliacao']
    ];

    $idAvaliacaoNova = create($pdo, 'avaliacoes', $novaAvaliacao);

    header('Location: ../desc.php?id=' . $_POST['id_profissional']);
    exit;

} elseif (isset($_POST['nome_profissional'])) {
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

  $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];
  if (!in_array($_FILES['arquivo']['type'], $tipos_permitidos)) {
    echo "Tipo de arquivo não permitido. Por favor, envie uma imagem JPEG, PNG ou GIF.";
    exit;
  }

  $tamanho_max = 1 * 1024 * 1024; // 1MB
  if ($_FILES['arquivo']['size'] > $tamanho_max) {
    echo "O arquivo é muito grande. O tamanho máximo permitido é 1MB.";
    exit;
  }

  $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
  $novonome = "foto_" . uniqid() . "." . $extensao;

  $dir = "uploads/";
  $caminho = $dir . "$idProfissionalNovo/";
  $file = $caminho . $novonome;
  if (!is_dir($caminho)) {
    mkdir($caminho, 0755);
  }

  if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $file)) {
    $fotoUrl = $file;
    
    update(
      $pdo,
      'profissional',
      ['foto' => $fotoUrl],
      "id_profissional = $idProfissionalNovo" 
    );
    echo "Profissional inserido com sucesso! ID: $idProfissionalNovo";
    echo "<a href='colecao.php? id=$idProfissionalNovo'>Ver Profissional</a>";
  } else {
    echo "Erro ao enviar a imagem da capa.";
  }

} elseif (isset($_POST['nome_cliente'])) {
  $novoCliente = [
    'nome_cliente' => $_POST['nome_cliente'],
    'email' => $_POST['email'],
    'telefone' => $_POST['telefone'],
    'endereco' => $_POST['endereco'],
    'senha' => $_POST['senha'],
    'cpf' => $_POST['cpf'],
    'foto' => ''
  ];

  $idClienteNovo = create($pdo, 'cliente', $novoCliente);

  $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];
  if (!in_array($_FILES['arquivo']['type'], $tipos_permitidos)) {
    echo "Tipo de arquivo não permitido. Por favor, envie uma imagem JPEG, PNG ou GIF.";
    exit;
  }

  $tamanho_max = 1 * 1024 * 1024; // 1MB
  if ($_FILES['arquivo']['size'] > $tamanho_max) {
    echo "O arquivo é muito grande. O tamanho máximo permitido é 1MB.";
    exit;
  }

  $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
  $novonome = "foto_" . uniqid() . "." . $extensao;

  $dir = "uploads/";
  $caminho = $dir . "$idClienteNovo/";
  $file = $caminho . $novonome;
  if (!is_dir($caminho)) {
    mkdir($caminho, 0755);
  }

  if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $file)) {
    $fotoUrl = $file;
    
    update(
      $pdo,
      'cliente',
      ['foto' => $fotoUrl],
      "id_cliente = $idClienteNovo" 
    );
    echo "Cliente inserido com sucesso! ID: $idClienteNovo";
    echo "<a href='colecao.php? id=$idClienteNovo'>Ver Cliente</a>";
  } else {
    echo "Erro ao enviar a imagem da capa.";
  }
}
?>

?>