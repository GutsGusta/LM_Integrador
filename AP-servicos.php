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
    <?php
        require_once 'partials/header.php';
    ?>
    <main>
        <div class="pagina-principal">
            <div class="sidebar">
            <div class="sidebar-perfil">
                <img src="uploads/marcos_santos.png" alt="Cliente">
                <div class="sidebar-perfil-info">
                    <strong>Marcos Santos</strong>
                    <span>Cliente</span>
                </div>
            </div>

            <a href="AP-dashboard.php" class="nav-item">
                <i class="fa-solid fa-house"></i>
                Meu Dashboard
            </a>

            <a href="AP-servicos.php" class="nav-item">
                <i class="fa-solid fa-file-lines"></i>
                Meus Serviços
            </a>

            <a href="AP-agenda.php" class="nav-item ativo">
                <i class="fa-solid fa-calendar"></i>
                Meus Agendamentos
            </a>

            <a href="AP-dados.php" class="nav-item">
                <i class="fa-solid fa-user"></i>
                Meus Dados
            </a>

            <a href="logout.php" class="nav-item nav-sair">
                <i class="fa-solid fa-right-from-bracket"></i>
                Sair
            </a>
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
                    </tr>
                    <tr>
                        <td>Neymar Junior</td>
                        <td>(11) 91234-5678</td>
                        <td>Construção de Calçada</td>
                        <td>R. Brasil do Impiranga, 88 - Santo André</td>
                        <td>R$600,00</td>
                    </tr>
                    <tr>
                        <td>Neymar Junior</td>
                        <td>(11) 91234-5678</td>
                        <td>Construção de Calçada</td>
                        <td>R. Brasil do Impiranga, 88 - Santo André</td>
                        <td>R$600,00</td>
                    </tr>
                    <tr>
                        <td>Neymar Junior</td>
                        <td>(11) 91234-5678</td>
                        <td>Construção de Calçada</td>
                        <td>R. Brasil do Impiranga, 88 - Santo André</td>
                        <td>R$600,00</td>
                    </tr>
                    <tr>
                        <td>Neymar Junior</td>
                        <td>(11) 91234-5678</td>
                        <td>Construção de Calçada</td>
                        <td>R. Brasil do Impiranga, 88 - Santo André</td>
                        <td>R$600,00</td>
                    </tr>
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
                        <td>Rogério Alcantra</td>
                        <td>(11) 98765-4321</td>
                        <td>Levantamento de Casa</td>
                        <td>R. Recebaby da Silva, 71 - São Paulo</td>
                        <td>R$2400,00</td>
                        <td><a href=""><img src="uploads/certo-botao.png"></a><a href=""><img src="uploads/errado.png"></a></td>
                    </tr>
                    <tr>
                        <td>Rogério Alcantra</td>
                        <td>(11) 98765-4321</td>
                        <td>Levantamento de Casa</td>
                        <td>R. Recebaby da Silva, 71 - São Paulo</td>
                        <td>R$2400,00</td>
                        <td><a href=""><img src="uploads/certo-botao.png"></a><a href=""><img src="uploads/errado.png"></a></td>
                    </tr>
                    <tr>
                        <td>Rogério Alcantra</td>
                        <td>(11) 98765-4321</td>
                        <td>Levantamento de Casa</td>
                        <td>R. Recebaby da Silva, 71 - São Paulo</td>
                        <td>R$2400,00</td>
                        <td><a href=""><img src="uploads/certo-botao.png"></a><a href=""><img src="uploads/errado.png"></a></td>
                    </tr>
                    <tr>
                        <td>Rogério Alcantra</td>
                        <td>(11) 98765-4321</td>
                        <td>Levantamento de Casa</td>
                        <td>R. Recebaby da Silva, 71 - São Paulo</td>
                        <td>R$2400,00</td>
                        <td><a href=""><img src="uploads/certo-botao.png"></a><a href=""><img src="uploads/errado.png"></a></td>
                    </tr>
                </table>
            </div>
        </div>
    </main>
</body>
</html>