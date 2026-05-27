<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AP.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>Área de Trabalho</title>
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
                        <h2>Nome Profissional</h2>
                        <p>Email Profissional</p>
                        <p>Cidade</p>
                    </div>
                </div>

                <div class="linha"></div>

                <div class="area-botoes">
                    <div class="botoes"><img src="uploads/quadrados.png"><a href="">Meu Dashbord</a></div>
                    <div class="botoes"><img src="uploads/notas.png"><a href="">Meus Orçamentos</a></div>
                    <div class="botoes"><img src="uploads/calendario.png"><a href="">Meus Agendamentos</a></div>
                    <div class="botoes"><img src="uploads/dados.png"><a href="">Meus Dados</a></div>
                    <div class="botoes"><img src="uploads/sair.png"><a href="">Sair</a></div>
                </div>
            </div>

            <div class="dashbord">
                <div class="estatisticas">
                    <div class="estatisticas-indv">
                        <img src="uploads/fatura.png">
                        <div class="estatisticas-txt">
                            <h4>Texto</h4>
                            <h1>15</h1>
                            <p>Descrição</p>
                        </div>
                    </div>
                        
                    <div class="estatisticas-indv">
                        <img src="uploads/fatura.png">
                        <div class="estatisticas-txt">
                            <h4>Texto</h4>
                            <h1>15</h1>
                            <p>Descrição</p>
                        </div>
                    </div>
                
                    <div class="estatisticas-indv">
                        <img src="uploads/Certo.png">
                        <div class="estatisticas-txt">
                            <h4>Concluídos</h4>
                            <h1>15</h1>
                            <p>Serviços Concluídos</p>
                        </div>
                    </div>
                </div>

                <div class="quadrados">
                    <div class="quadrados-indv">
                        <h2>Últimos Ganhos</h2>
                        <div class="linha"></div>
                        <table>
                            <tr>
                                <th>Serviço</th>
                                <th>Valor Total</th>
                                <th>Método Pagamento</th>
                            </tr>
                            <tr>
                                <td>Reforma Cozinha</td>
                                <td>R$6700,00</td>
                                <td style="color: #138205;">Pix</td>
                            </tr>
                        </table>
                    </div>
                    <div class="quadrados-indv">
                        <h2>Próximos Serviços</h2>
                        <div class="linha"></div>
                        <table>
                            <tr>
                                <th>Data</th>
                                <th>Serviço</th>
                                <th>Endereço</th>
                                <th>Status</th>
                            </tr>
                            <tr>
                                <td>14/07/2026</td>
                                <td>Reforma no Banheiro</td>
                                <td>R. Boa Vista, 67</td>
                                <td>Aguardando</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>