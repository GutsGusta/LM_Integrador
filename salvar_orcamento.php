<?php

require_once './data/crud.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $dados = [
        'nome' => $_POST['Nome'],
        'email' => $_POST['email'],
        'telefone' => $_POST['Telefone'],
        'endereco' => $_POST['Endereco'],
        'mensagem' => $_POST['mensagem']
    ];

    create($pdo, 'orcamentos', $dados);

    echo "<script>
            alert('Orçamento enviado com sucesso!');
            window.location.href='orcamento.php';
          </script>";
}