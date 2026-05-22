<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>LM</title>
</head>

<body>
    <?php
        require_once "partials/header.php";
    ?> 

    <section id="home" class="hero">
        <div class="texto">
            <h1 class="titulo">Soluções para sua <span>casa</span></h1>
            <p>conectamos você com os melhores profissionais para serviços de construção, reforma e manutenção.</p>
            <button class="btn-solicitar">Solicitar orçamento</button>
        </div>

        <div class="imagem">
            <img src="uploads/image.png" alt="Imagem de construção">
        </div>

    </section>

    <section class="servicos">
        <h2>Nossos Serviços</h2>
        <div class="cards">
            <a href="#">
                <div class="card">
                    <img src="uploads/construcao.png" alt="Construção">
                    <p>Construção</p>
                </div>
            </a>
            <a href="#">
                <div class="card">
                    <img src="uploads/eletrica.png" alt="Elétrica">
                    <p>Elétrica</p>
                </div>
            </a>
            <a href="#">
                <div class="card">
                    <img src="uploads/reforma.png" alt="Reforma">
                    <p>Reforma</p>
                </div>
            </a>
            <a href="#">
                <div class="card">
                    <img src="uploads/instalacao.png" alt="Instalação">
                    <p>Instalação</p>
                </div>
            </a>

            <a href="#">
                <div class="card">
                    <img src="uploads/pintura.png" alt="Pintura">
                    <p>Pintura</p>
                </div>
            </a>

        </div>

    </section>

    <section class="sobre-breve">
        <img src="uploads/pedreiros.jpg" alt="pedreiros" style="width: 50%;">

        <div class="texto-sobre">
            <h2>LM</h2>
            <p>A ponte definitiva entre o seu projeto e os melhores profissionais.
                Esqueça os atrasos e as dores de cabeça. A LM (Liderança em Mão de Obra) é a plataforma que conecta você
                a
                pedreiros, mestres de obra e serventes de forma prática e objetiva. Nós estruturamos e organizamos a mão
                de
                obra do seu projeto de forma estratégica, garantindo qualidade, previsibilidade e o melhor
                custo-benefício.
            </p>
        </div>
    </section>

    <section class="empresas">
        <h2>Empresas Parceiras</h2>
        <div class="empresas-logos" id="logos">
            <img src="uploads/SENAI_logo.png" alt="SENAI">
            <img src="uploads/mrv.png" alt="MRV">
            <img src="uploads/makita.png" alt="Makita">
            <img src="uploads/leroy_logo.png" alt="Leroy">
        </div>
    </section>

    <section class="avaliacoes">
        <h2>O que nossos clientes dizem</h2>

        <div class="cards-avaliacoes">

            <div class="card-avaliacao">
                <div class="cliente-info">
                    <img src="uploads/joao_silva.png" alt="joao silva">
                    <div>
                        <h3>João Silva</h3>
                        <span class="servico">Elétrica</span>
                    </div>
                </div>
                <div class="estrelas">★★★★★</div>
                <p class="comentario">"Serviço impecável, prazo cumprido e equipe muito profissional. Super recomendo!"
                </p>
            </div>

            <div class="card-avaliacao">
                <div class="cliente-info">
                    <img src="uploads/maria_souza.png" alt="Maria Souza">
                    <div>
                        <h3>Maria Souza</h3>
                        <span class="servico">Pintura</span>
                    </div>
                </div>
                <div class="estrelas">★★★★★</div>
                <p class="comentario">"Encontrei os melhores profissionais pela LM. Resultado final superou as
                    expectativas!"</p>
            </div>

            <div class="card-avaliacao">
                <div class="cliente-info">
                    <img src="uploads/carlos_oliveira.jpg" alt="Carlos Oliveira">
                    <div>
                        <h3>Carlos Oliveira</h3>
                        <span class="servico">Reforma</span>
                    </div>
                </div>
                <div class="estrelas">★★★★★</div>
                <p class="comentario">"Organização e qualidade do início ao fim. A plataforma facilitou muito minha
                    vida!"</p>
            </div>

        </div>
    </section>

    <section class="melhores-funcionarios">
        <h2>Melhores Funcionários</h2>

        <div class="cards-funcionarios">

            <div class="card-funcionario">
                <img src="uploads/ana_pereira.png" alt="Ana Pereira">
                <h3>Ana Pereira</h3>
                <div class="estrelas">★★★★★</div>
                <span class="especialidade">Mestre de Obra</span>
            </div>

            <div class="card-funcionario">
                <img src="uploads/ricardo_martins.png" alt="Ricardo Martins">
                <h3>Ricardo Martins</h3>
                <div class="estrelas">★★★★★</div>
                <span class="especialidade">Pedreiro</span>
            </div>

            <div class="card-funcionario">
                <img src="uploads/fernando_lopes.png" alt="Fernando Lopes">
                <h3>Fernando Lopes</h3>
                <div class="estrelas">★★★★★</div>
                <span class="especialidade">Servente</span>
            </div>

        </div>
    </section>

   <?php
        require_once "partials/footer.php";
    ?> 

    <script>
        const faixa = document.getElementById('logos');

        faixa.innerHTML += faixa.innerHTML;
    </script>
</body>

</html>