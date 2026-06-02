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
            <div class="sidebar">
            <div class="sidebar-perfil">
                <img src="uploads/marcos_santos.png" alt="Cliente">
                <div class="sidebar-perfil-info">
                    <strong>Marcos Santos</strong>
                    <span>Cliente</span>
                </div>
            </div>

            <a href="AP-dashbord.php" class="nav-item">
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