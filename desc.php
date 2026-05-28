<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/desc.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>Funcionário | LM</title>
</head>

<body>
    <?php
    require_once "partials/header.php";
    ?>

    <div class="perfil-page">

        <a href="funcionarios.php" class="voltar">← Voltar aos profissionais</a>

        <div class="perfil-container">

            <div class="coluna-esq">

                <div class="card-foto">
                    <img src="uploads/ana_pereira.png" alt="Ana Pereira">
                    <h2>Ana Pereira</h2>
                    <span class="badge-categoria">Mestre de Obra</span>
                    <div class="estrelas-perfil">★★★★★</div>
                    <p class="nota-texto">4.9 · 38 avaliações</p>
                    <button class="btn-solicitar">Solicitar Orçamento</button>
                </div>

                <div class="card-stats">
                    <div class="stat-item">
                        <span class="stat-label">Experiência</span>
                        <span class="stat-valor">12 anos</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Especialidade</span>
                        <span class="stat-valor">Mestre de Obra</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Projetos concluídos</span>
                        <span class="stat-valor">74</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Disponibilidade</span>
                        <span class="stat-valor disponivel">Disponível</span>
                    </div>
                </div>

            </div>

            <div class="coluna-dir">

                <div class="card-info">
                    <h3>Sobre</h3>
                    <p>Ana Pereira tem mais de 12 anos de experiência na coordenação de obras residenciais e comerciais.
                        Reconhecida pela organização, pontualidade e capacidade de liderança de equipes, já atuou em
                        projetos de pequeno a grande porte em toda a região. Comprometida com a qualidade e a satisfação
                        do cliente em cada etapa da obra.</p>
                </div>

                <div class="card-info">
                    <h3>Serviços que realiza</h3>
                    <div class="servicos-lista">
                        <span class="tag-servico">Planejamento e organização</span>
                        <span class="tag-servico">Gestão da equipe</span>
                        <span class="tag-servico">Acompanhamento da obra</span>
                        <span class="tag-servico">Controle de materiais e custos</span>
                        <span class="tag-servico">Comunicação</span>
                        <span class="tag-servico">Alvenaria</span>
                        <span class="tag-servico">Reboco</span>
                        <span class="tag-servico">Assentamento de Tijolos</span>
                        <span class="tag-servico">Fundação</span>
                        <span class="tag-servico">Contrapiso</span>
                        <span class="tag-servico">Muros</span>
                    </div>
                    <div class="card-info">
                        <h3>Avaliações dos clientes</h3>
                        <div class="avaliacoes-lista">

                            <div class="avaliacao-item">
                                <div class="avaliacao-header">
                                    <span class="avaliacao-nome">João Silva</span>
                                    <span class="avaliacao-estrelas">★★★★★</span>
                                </div>
                                <p class="avaliacao-servico">Reforma Geral</p>
                                <p class="avaliacao-texto">"Profissional exemplar. Coordenou toda a obra com muita
                                    responsabilidade e entregou no prazo."</p>
                            </div>

                            <div class="avaliacao-item">
                                <div class="avaliacao-header">
                                    <span class="avaliacao-nome">Maria Souza</span>
                                    <span class="avaliacao-estrelas">★★★★★</span>
                                </div>
                                <p class="avaliacao-servico">Alvenaria</p>
                                <p class="avaliacao-texto">"Superou todas as expectativas. Equipe bem organizada e
                                    resultado
                                    final impecável."</p>
                            </div>

                            <div class="avaliacao-item">
                                <div class="avaliacao-header">
                                    <span class="avaliacao-nome">Carlos Oliveira</span>
                                    <span class="avaliacao-estrelas">★★★★☆</span>
                                </div>
                                <p class="avaliacao-servico">Acabamento</p>
                                <p class="avaliacao-texto">"Ótimo trabalho, comunicação clara durante todo o processo.
                                    Recomendo muito!"</p>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php
    require_once "partials/footer.php";
    ?>

</body>

</html>