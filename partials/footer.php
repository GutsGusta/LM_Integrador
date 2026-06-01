<?php
require_once './data/crud.php';

$profissional = readAll($pdo, 'profissional', '1 ORDER BY id_profissional DESC LIMIT 1');

?>

<footer>
    <div class="parte-cima-footer">
        <div class="parte-cima-indv">
            <img src="uploads/pessoas.png">
            <div class="parte-cima-indv-txt">

                <?php
                if (is_array($profissional)) {
                    foreach ($profissional as $profissionais) {

                        echo '' . $profissionais['id_profissional'] . '';
                    }
                }
                ;
                ?>

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

                <?php
                $totalAvaliacoes = readALL($pdo, 'avaliacoes');
                if (!empty($totalAvaliacoes)):

                    $mediaNota = array_sum(array_column($totalAvaliacoes, 'nota')) / count($totalAvaliacoes);
                else:
                    $mediaNota = 0;
                endif;
                $mediaArredondada = round($mediaNota, 1);

                echo ' ' . $mediaArredondada . ' ';

                ?>


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