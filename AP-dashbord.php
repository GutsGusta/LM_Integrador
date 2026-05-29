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

            <div class="dashbord">
                <div class="estatisticas">
                    <div class="estatisticas-indv">
                        <img src="uploads/fatura.png">
                        <div class="estatisticas-txt">
                            <h4>Serviços</h4>
                            <h1>67</h1>
                            <p>Total do Mês</p>
                        </div>
                    </div>
                        
                    <div class="estatisticas-indv">
                        <img src="uploads/relogio.png">
                        <div class="estatisticas-txt">
                            <h4>Em Andamento</h4>
                            <h1>15</h1>
                            <p>Serviços não Concluídos</p>
                        </div>
                    </div>
                
                    <div class="estatisticas-indv">
                        <img src="uploads/Certo.png">
                        <div class="estatisticas-txt">
                            <h4>Concluídos</h4>
                            <h1>42</h1>
                            <p>Serviços Concluídos</p>
                        </div>
                    </div>
                </div>

                <div class="quadrados">
                    <div class="quadrados-indv">
                        <h2>Últimos Ganhos</h2>
                        <div class="linha"></div>
                        <div class="campo-servico">                           
                            <div class="ganhos">
                                <h4>Revestimento</h4>
                                <p>Quarto 10m²</p>
                            </div>
                            <div class="ganhos">
                                <h4>R$6700,69</h4>
                                <p>18/05/2026</p>
                            </div>
                            <h4>Alguma Coisa</h4>           
                        </div>
                        <div class="campo-servico">                           
                            <div class="ganhos">
                                <h4>Revestimento</h4>
                                <p>Quarto 10m²</p>
                            </div>
                            <div class="ganhos">
                                <h4>R$6700,69</h4>
                                <p>18/05/2026</p>
                            </div>
                            <h4>Alguma Coisa</h4>           
                        </div>
                        <div class="campo-servico">                           
                            <div class="ganhos">
                                <h4>Revestimento</h4>
                                <p>Quarto 10m²</p>
                            </div>
                            <div class="ganhos">
                                <h4>R$6700,69</h4>
                                <p>18/05/2026</p>
                            </div>
                            <h4>Alguma Coisa</h4>           
                        </div>
                    </div>
                    <div class="quadrados-indv">
                        <h2>Próximos Serviços</h2>
                        <div class="linha"></div>
                        <div class="campo-servico">
                            <div class="data">
                                <h4>18</h4>
                                <h4>Maio</h4>
                            </div>
                            <div class="info">
                                <h4>Levantamento de Casa</h4>
                                <p>06:00-07:00</p>
                                <h5>R. Boa Vista, 67 - São Caetano</h5>
                            </div>
                            <p class="status-confirmado">Confirmado</p>
                        </div>
                        <div class="campo-servico">
                            <div class="data">
                                <h4>18</h4>
                                <h4>Maio</h4>
                            </div>
                            <div class="info">
                                <h4>Levantamento de Casa</h4>
                                <p>06:00-07:00</p>
                                <h5>R. Boa Vista, 67 - São Caetano</h5>
                            </div>
                            <p class="status-aguardo">Aguardando</p>
                        </div>
                        <div class="campo-servico">
                            <div class="data">
                                <h4>18</h4>
                                <h4>Maio</h4>
                            </div>
                            <div class="info">
                                <h4>Levantamento de Casa</h4>
                                <p>06:00-07:00</p>
                                <h5>R. Boa Vista, 67 - São Caetano</h5>
                            </div>
                            <p class="status-confirmado">Confirmado</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>