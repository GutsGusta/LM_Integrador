<?php
    // require_once 'crud.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/servicos.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>Serviços</title>
</head>
<body>
    <?php
        require_once 'partials/header.php';
    ?>    
    <main>
        <div class="pagina-completa">
            <h1 class="titulo">Conheça os Serviços Populares</h1>

            <div class="produtos">
                <article class="card">
                    <img src="uploads/exemplo.jpeg">
                    <h2>Nome Serviço</h2>
                    <details>
                        <summary>Ver Valores</summary>
                        <div class="valores">
                            <table>
                                <tr>
                                    <th>Serviço</th>
                                    <th>Preço /Hora</th>
                                </tr>
                                <tr>
                                    <td>Servente</td>
                                    <td>R$11,00</td>
                                </tr>
                                <tr>
                                    <td>Pedreiros</td>
                                    <td>R$25,00</td>
                                </tr>
                                <tr>
                                    <td>Mestre de Obras</td>
                                    <td>R$40,00</td>
                                </tr>
                            </table>
                        </div>
                    </details>
                    <a href="" class="card-botao">Ver Profissionais Qualificados</a>   <!--TER COMANDO PARA ENVIAR PARA A PÁGINA DE PROFISSIONAIS QUALIFICADOS PARA O SERVIÇO -->
                </article>

                <article class="card">
                    <img src="uploads/exemplo.jpeg">
                    <h2>Nome Serviço</h2>
                    <details>
                        <summary>Ver Valores</summary>
                        <div class="valores">
                            <table>
                                <tr>
                                    <th>Serviço</th>
                                    <th>Preço /Hora</th>
                                </tr>
                                <tr>
                                    <td>Servente</td>
                                    <td>R$11,00</td>
                                </tr>
                                <tr>
                                    <td>Pedreiros</td>
                                    <td>R$25,00</td>
                                </tr>
                                <tr>
                                    <td>Mestre de Obras</td>
                                    <td>R$40,00</td>
                                </tr>
                            </table>
                        </div>
                    </details>
                    <a href="" class="card-botao">Ver Profissionais Qualificados</a>
                </article>

                <article class="card">
                    <img src="uploads/exemplo.jpeg">
                    <h2>Nome Serviço</h2>
                    <details>
                        <summary>Ver Valores</summary>
                        <div class="valores">
                            <table>
                                <tr>
                                    <th>Serviço</th>
                                    <th>Preço /Hora</th>
                                </tr>
                                <tr>
                                    <td>Servente</td>
                                    <td>R$11,00</td>
                                </tr>
                                <tr>
                                    <td>Pedreiros</td>
                                    <td>R$25,00</td>
                                </tr>
                                <tr>
                                    <td>Mestre de Obras</td>
                                    <td>R$40,00</td>
                                </tr>
                            </table>
                        </div>
                    </details>
                    <a href="" class="card-botao">Ver Profissionais Qualificados</a>
                </article>

                <article class="card">
                    <img src="uploads/exemplo.jpeg">
                    <h2>Nome Serviço</h2>
                    <details>
                        <summary>Ver Valores</summary>
                        <div class="valores">
                            <table>
                                <tr>
                                    <th>Serviço</th>
                                    <th>Preço /Hora</th>
                                </tr>
                                <tr>
                                    <td>Servente</td>
                                    <td>R$11,00</td>
                                </tr>
                                <tr>
                                    <td>Pedreiros</td>
                                    <td>R$25,00</td>
                                </tr>
                                <tr>
                                    <td>Mestre de Obras</td>
                                    <td>R$40,00</td>
                                </tr>
                            </table>
                        </div>
                    </details>
                    <a href="" class="card-botao">Ver Profissionais Qualificados</a>
                </article>

                <article class="card">
                    <img src="uploads/exemplo.jpeg">
                    <h2>Nome Serviço</h2>
                    <details>
                        <summary>Ver Valores</summary>
                        <div class="valores">
                            <table>
                                <tr>
                                    <th>Serviço</th>
                                    <th>Preço /Hora</th>
                                </tr>
                                <tr>
                                    <td>Servente</td>
                                    <td>R$11,00</td>
                                </tr>
                                <tr>
                                    <td>Pedreiros</td>
                                    <td>R$25,00</td>
                                </tr>
                                <tr>
                                    <td>Mestre de Obras</td>
                                    <td>R$40,00</td>
                                </tr>
                            </table>
                        </div>
                    </details>
                    <a href="" class="card-botao">Ver Profissionais Qualificados</a>
                </article>
            </div>
        </div>
        <div class="parte-final">
            <img src="uploads/moca-sorrindo.png">
            <div class="parte-final-txt">
                <h1>Não Encontrou o Que Deseja?</h1>
                <p>Envie sua situação e iremos te ajudar!</p>
                <a href="">Solicitar Orçamento</a>
            </div>
        </div>
    </main>
    <?php
        require_once 'partials/footer.php';
    ?>
</body>
</html>