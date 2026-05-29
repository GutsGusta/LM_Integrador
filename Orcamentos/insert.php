<?php
require 'crud.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inserir Orcamento</title>
</head>

<body>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $novoorcamento = [
            'nome_cliente' => trim($_POST['nome_cliente'] ?? ''),
            'valor_orcamento' => trim($_POST['valor_orcamento'] ?? 0),

        ];

        $idnovoorcamento = create($pdo, 'orcamento', $novoorcamento);

        if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
            $arquivo = $_FILES['arquivo'];
            $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];

            if (!in_array($arquivo['type'], $tipos_permitidos)) {
                echo "<div class='mensagem erro'>Tipo de arquivo não permitido.</div>";
                exit;
            }

            $tamanho_maximo = 2 * 1024 * 1024;
            if ($arquivo['size'] > $tamanho_maximo) {
                echo "<div class='mensagem erro'>O arquivo excede o tamanho máximo permitido (2MB).</div>";
                exit;
            }

            $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $novonome = "imagem_" . uniqid() . '.' . $extensao;
            $dir = 'Uploads/';
            $caminho = $dir . $idnovoorcamento;
            $file = $caminho . '/' . $novonome;

            if (!is_dir($caminho)) {
                mkdir($caminho, 0755, true);
            }

            if (move_uploaded_file($arquivo['tmp_name'], $file)) {
                $imagemUrl = $file;
                update($pdo, 'orcamentos', ['imagem' => $imagemUrl], "id_orcamento = $idnovoorcamento");

                echo "<div class='mensagem sucesso'>
                    <h2> Orcamento inserido com sucesso!</h2>
                    ID: " . $idnovoorcamento . "
                    <br><br>
                    <a href='orcamentos.php'>Ver Orcamentos</a>
                  </div>";
            } else {
                echo "<div class='mensagem erro'>Erro ao fazer upload da imagem.</div>";
            }
        } else {
            echo "<div class='mensagem sucesso'>
                <h2> Orcamento inserido com sucesso!</h2>
                ID: " . $idnovoorcamento . "
                <br><br>
                <a href='orcamentos.php' class='box'>Ver Orcamentos</a>
              </div>";
        }
    }
    ?>
</body>

</html>