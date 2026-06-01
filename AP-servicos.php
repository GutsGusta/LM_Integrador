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
            <div class="funcoes">
                <div class="pessoal">
                    <img src="uploads/ricardo_martins.png">
                    <div class="pessoal-txt">
                        <h2>José Ribeiro</h2>
                        <p>joseribeiro@yahoo.com.br</p>
                        <p>Ribeirão Pires, SP</p>
                    </div>
                </div>

                <div class="linha"></div>

                <div class="area-botoes">
                    <div class="botoes"><img src="uploads/quadrados.png"><a href="">Meu Dashbord</a></div>
                    <div class="botoes"><img src="uploads/notas.png"><a href="">Serviços Requeridos</a></div>
                    <div class="botoes"><img src="uploads/calendario.png"><a href="">Meus Agendamentos</a></div>
                    <div class="botoes"><img src="uploads/dados.png"><a href="">Meus Dados</a></div>
                    <div class="botoes"><img src="uploads/sair.png"><a href="">Sair</a></div>
                </div>
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