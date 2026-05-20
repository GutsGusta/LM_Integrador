<?php
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/style.css">
    <title>LM</title>
</head>
<body>
     <header>
        <nav class="header__nav">
            <div class="nav__left">
                <a href="#home"><img src="uploads/Logo-LM.png" alt="LM" class="logo"></a>
                
            </div>
            <div class="nav__center">
                <a class="nav__link" href="#sobre">Sobre nós</a>
                <a class="nav__link" href="#servicos">Serviços</a> 
                <a class="nav__link" href="#equipe">Equipe</a>
            </div>

            <div class="nav__right">
                <a href="#"><button class="icon-btn"><img src="uploads/image (1).png" width="30" height="30"></button></a>
            </div>
        </nav>
    </header>

    <section id="home" class="hero">
        <div class="texto">
            <h1 class="titulo">Soluções para sua <span>casa</span></h1>
            <p>conectamos você com os melhores profissionais para serviços de construção, reforma e manutenção.</p>
            <button>Solicitar orçamento</button>
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

   <section class="empresas">
    <h2>Empresas Parceiras</h2>
    <div class="empresas-logos" id="logos">
        <img src="uploads/SENAI_logo.png" alt="SENAI">
        <img src="uploads/mrv.png" alt="MRV">
        <img src="uploads/makita.png" alt="Makita">
        <img src="uploads/leroy_logo.png" alt="Leroy">
    </div>
</section>

       <footer>
        <div class="parte-cima-footer">
            <div class="parte-cima-indv">
                <img src="uploads/pessoas.png">
                <div class="parte-cima-indv-txt">
                    <p>67</p>
                    <p>Profissionais</p>
                </div>
            </div>
            <div class="parte-cima-indv">
                <img src="uploads/casa.png">
                <div class="parte-cima-indv-txt">
                    <p>+500</p>
                    <p>Serviços Prestados</p>
                </div>
            </div>
            <div class="parte-cima-indv">
                <img src="uploads/escudo.png">
                <div class="parte-cima-indv-txt">
                    <p>100%</p>
                    <p>Segurança</p>
                </div>
            </div>
            <div class="parte-cima-indv">
                <img src="uploads/estrela.png">
                <div class="parte-cima-indv-txt">
                    <p>4,8</p>
                    <p>Avaliação</p>
                </div>
            </div>
        </div>

        <div class="parte-baixo-footer">
            <div class="parte-baixo-indv">
                <h3>Empresa</h3>
                <p>Endereço:</p>
                <p>R. Santo André, 680 - Boa Vista</p>
                <p>(11) 4002-8922</p>
                <p>Copyright © 2026 LM. Todos os direitos reservados.</p>
            </div>

            <div class="linha-footer"></div>

            <div class="parte-baixo-indv">
                <h3>Suporte</h3>
                <a href="#">Ajuda</a>
                <a href="#">Termos de Uso</a>
                <a href="#">Privacidade</a>
                <a href="#">Contato</a>
            </div>

            <div class="linha-footer"></div>

            <div class="parte-baixo-indv">
                <h3>Redes Sociais</h3>
                <a href="#">Instagram</a>
                <a href="#">TikTok</a>
                <a href="#">Facebook</a>
                <a href="#">Twitter</a>
            </div>
        </div>
    </footer>

   <script>
    const faixa = document.getElementById('logos');

    faixa.innerHTML += faixa.innerHTML;
   </script>
</body>
</html>