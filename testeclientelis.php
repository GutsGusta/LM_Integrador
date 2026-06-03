<?php
require_once './data/crud.php';

$cliente = readAll($pdo, 'cliente');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

    header('Location: teste.php?testeadd=1');
    exit;

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <table>
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Senha</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Telefone</th>
        </tr>

        <?php foreach ($cliente as $clientes) {
            echo '
            <tr>
            <td>' . $clientes['id_cliente'] . '</td>
            <td> <img src="' . $clientes['foto'] . '" width="40" height="40"> </td>
            <td>' . $clientes['nome_cliente'] . '</td>
            <td>' . $clientes['endereco'] . '</td>
            <td>' . $clientes['senha'] . '</td>
            <td>' . $clientes['cpf'] . '</td>
            <td>' . $clientes['email'] . '</td>
            <td>' . $clientes['telefone'] . '</td>
        </tr>';
        }
        ?>
    </table>

</body>

</html>