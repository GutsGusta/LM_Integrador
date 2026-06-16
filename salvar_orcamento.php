<?php

require_once './data/crud.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || ($_SESSION['user_tipo'] ?? '') !== 'cliente') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $preco_bruto = $_POST['preco_investir'] ?? '';
    $preco_limpo = str_replace(['.', ','], ['', '.'], $preco_bruto);
    $preco_final = is_numeric($preco_limpo) ? (float)$preco_limpo : 0.00;

    $dados = [
        'id_cliente'     => $_SESSION['user_id'],
        'nome'           => $_POST['Nome'] ?? '',
        'email'          => $_POST['email'] ?? '',
        'telefone'       => $_POST['Telefone'] ?? '',
        'endereco'       => $_POST['Endereco'] ?? '',
        'mensagem'       => $_POST['mensagem'] ?? '',
        'preco_investir' => $preco_final
    ];

    create($pdo, 'orcamentos', $dados);

    echo "<script>
            alert('Orçamento enviado com sucesso!');
            window.location.href='orcamento.php';
          </script>";
}