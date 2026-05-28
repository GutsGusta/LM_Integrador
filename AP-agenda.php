<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AP.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>Agenda</title>
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

            <div class="agenda">
                
                <div class="agenda-txt">
                    <button class="btn-nav">< Mês Anterior</button>
                    <h2>Maio de 2026</h2>
                    <button class="btn-nav">Próximo Mês ></button>
                </div>

                <div class="dias-semana">
                    <p>Dom</p>
                    <p>Seg</p>
                    <p>Ter</p>
                    <p>Qua</p>
                    <p>Qui</p>
                    <p>Sex</p>
                    <p>Sáb</p>
                </div>

                <div class="calendario">
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">26</p>
                    </div>
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">27</p>
                    </div>
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">28</p>
                    </div>
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">29</p>
                    </div>
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">30</p>
                    </div>
                    
                    <div class="dia">
                        <p class="numero-dia">1</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">2</p>
                    </div>
                    
                    <div class="dia tem-servico">
                        <p class="numero-dia">3</p>
                        <p class="servico primeiro-servico">08:00 - Contrapiso</p> 
                    </div>
                    
                    <div class="dia">
                        <p class="numero-dia">4</p>
                    </div>
                    
                    <div class="dia dia-hoje">
                        <p class="numero-dia">5</p>
                    </div>
                    
                    <div class="dia">
                        <p class="numero-dia">6</p>
                    </div>
            
                    <div class="dia tem-servico">
                        <p class="numero-dia">7</p>
                        <p class="servico primeiro-servico">07:30 - Reboco Muro</p> 
                        <p class="servico segundo-servico">14:00 - Orçamento</p> 
                    </div>
                
                    <div class="dia">
                        <p class="numero-dia">8</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">9</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">10</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">11</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">12</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">13</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">14</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">15</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">16</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">17</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">18</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">19</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">20</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">21</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">22</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">23</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">24</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">25</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">26</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">27</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">28</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">29</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">30</p>
                    </div>
                    <div class="dia">
                        <p class="numero-dia">31</p>
                    </div>
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">1</p>
                    </div>
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">2</p>
                    </div>
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">3</p>
                    </div>
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">4</p>
                    </div>
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">5</p>
                    </div>
                    <div class="dia fora-do-mes">
                        <p class="numero-dia">6</p>
                    </div>
                </div>
            </div>
        </div>    
    </main>    
</body>
</html>