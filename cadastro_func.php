<?php
require_once './data/crud.php';
session_start();

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
   
    $nome        = $_POST['nome_profissional'] ?? '';
    $email       = $_POST['email'] ?? '';
    $telefone    = $_POST['telefone'] ?? '';
    $cpf         = $_POST['cpf_profissional'] ?? '';
    $senha       = $_POST['senha'] ?? ''; 
    $funcao      = $_POST['funcao'] ?? '';
    $experiencia = $_POST['experiencia'] ?? 'Não informada';

   
    if (empty($nome) || empty($email) || empty($cpf) || empty($senha) || empty($funcao)) {
        $erro = "Por favor, preencha todos os campos obrigatórios.";
    }

    $nome_foto = 'default.png';

    
    if (empty($erro) && !empty($_FILES['foto']['name'])) {
        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        
        $nome_foto = md5(uniqid(rand(), true)) . '.' . $extensao;
        $caminho_destino = 'uploads/' . $nome_foto;

        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_destino)) {
            $nome_foto = 'default.png'; 
        }
    }

    if (empty($erro)) {
      
        $dadosProfissional = [
            'nome_profissional'   => $nome,
            'email'               => $email,
            'telefone'            => $telefone,
            'cidade_estado'       => 'Não Informado', 
            'cpf'                 => $cpf,            
            'senha'               => $senha,
            'funcao'              => $funcao,         
            'foto'                => $nome_foto,
            'servico'             => $funcao,        
            'experiencia'         => !empty($experiencia) ? $experiencia . ' anos' : 'Não informada',
        ];

        $salvou = create($pdo, 'profissional', $dadosProfissional);

        if ($salvou) {
            $sucesso = "Cadastro realizado com sucesso! Redirecionando para o login...";
            header("Refresh: 3; url=login.php");
        } else {
            $erro = "Erro ao cadastrar no banco de dados. Verifique os dados inseridos.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Funcionário | LM</title>
    <link rel="stylesheet" href="css/cadastro_func.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">  
</head>
<body>
<?php
    require_once 'partials/header.php';
?> 

<h1 class="titulo">Seja parte da Família LM!</h1>
<div class="cadastro">
    <form class="formulario-cadastro" method="POST" action="" enctype="multipart/form-data">
        <h2>Cadastro</h2>   

        <?php if (!empty($erro)): ?>
            <p style="color: red; text-align: center; font-weight: bold;"><?= $erro ?></p>
        <?php endif; ?>
        <?php if (!empty($sucesso)): ?>
            <p style="color: lime; text-align: center; font-weight: bold;"><?= $sucesso ?></p>
        <?php endif; ?>

        <input type="text" id="nome" name="nome_profissional" placeholder="Nome Completo" required>
        <input type="email" id="email" name="email" placeholder="Email" required>
        <input type="text" id="telefone" name="telefone" placeholder="Telefone">
        <input type="text" id="cpf" name="cpf_profissional" placeholder="CPF" required>
        
        <p>Qual sua Função?</p>
        <select name="funcao" required>
            <option value="">Selecione uma das Funções</option>
            <option value="servente">Servente</option>
            <option value="pedreiro">Pedreiro</option>
            <option value="mestre_de_obra">Mestre de Obra</option>
        </select>
        
        <input type="number" name="experiencia" placeholder="Tempo de Experiência (Em anos)">
        <input type="password" name="senha" placeholder="Senha" required>
        
        <div class="enviar-foto">
            <p>Escolha sua Foto de Perfil:</p>
            <label for="foto" class="select-foto">
                <i class="fa-solid fa-cloud-arrow-up"></i> Escolha uma foto
            </label>
            <input type="file" id="foto" name="foto" accept="image/*">
        </div>
        <button type="submit">Criar conta</button>
    </form>
</div>   
</body>
</html>