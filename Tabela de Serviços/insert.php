<?php
require 'crud.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inserir Serviço</title>
</head>

<body>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $novoservico = [
            'nome_servico' => trim($_POST['nome_servico'] ?? ''),
            'tipo_servico' => trim($_POST['tipo_servico'] ?? ''),
            'valor_servente' => trim($_POST['valor_servente'] ?? 0),
            'valor_mestre' => trim($_POST['valor_mestre'] ?? 0),
            'valor_pedreiro' => trim($_POST['valor_pedreiro'] ?? 0),
        ];

        $idnovoservico = create($pdo, 'servicos', $novoservico);

        if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
            $arquivo = $_FILES['arquivo'];
            $tipos_permitidos = ['image/jpeg', 'image/png', 'image/jpg'];

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
            $caminho = $dir . $idnovoservico;
            $file = $caminho . '/' . $novonome;

            if (!is_dir($caminho)) {
                mkdir($caminho, 0755, true);
            }

            if (move_uploaded_file($arquivo['tmp_name'], $file)) {
                $imagemUrl = $file;
                update($pdo, 'servicos', ['imagem' => $imagemUrl], "id_servico = $idnovoservico");

                echo "<div class='mensagem sucesso'>
                    <h2> Servico inserido com sucesso!</h2>
                    ID: " . $idnovoservico . "
                    <br><br>
                    <a href='servicos.php'>Ver Servicos</a>
                  </div>";
            } else {
                echo "<div class='mensagem erro'>Erro ao fazer upload da imagem.</div>";
            }
        } else {
            echo "<div class='mensagem sucesso'>
                <h2> Servico inserido com sucesso!</h2>
                ID: " . $idnovoservico . "
                <br><br>
                <a href='serviços.php' class='box'>Ver Servicos</a>
              </div>";
        }
    }
    ?>
</body>

</html>