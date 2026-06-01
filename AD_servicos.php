<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AD_servicos.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Admin | LM</title>
</head>

<body>
    <?php
    require_once "partials/header.php";
    ?>

    <div style="display: flex;">

        <div class="sidebar">
            <div class="sidebar-perfil">
                <img src="uploads/ricardo_almeida.png" alt="Cliente">
                <div class="sidebar-perfil-info">
                    <strong>Ricardo Almeida</strong>
                    <span>Admin</span>
                </div>
            </div>

            <a href="AD_dashboard.php" class="nav-item">
                <i class="fa-solid fa-house"></i>
                Meu Dashboard
            </a>

            <a href="AD_usuarios.php" class="nav-item">
                <i class="fa-solid fa-users"></i>
                Usuarios
            </a>

            <a href="AD_servicos.php" class="nav-item ativo">
                <i class="fa-solid fa-briefcase"></i>
                Serviços
            </a>

            <a href="AD_funcionarios.php" class="nav-item">
                <i class="fa-solid fa-helmet-safety"></i>
                Funcionários
            </a>


            <a href="logout.php" class="nav-item nav-sair">
                <i class="fa-solid fa-right-from-bracket"></i>
                Sair
            </a>
        </div>

        <h2 class="content-titulo">Dashboard ADM</h2>

        <div class="admin-content">
            <p class="content-titulo">Gerenciar Serviços</p>

            <div class="tabela-card">
                <div class="tabela-header">
                    <h3>Tabela de Serviços</h3>
                    <button class="btn-add">
                        <i class="fa-solid fa-plus"></i> Novo Serviço
                    </button>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Serviço</th>
                            <th>Total de Demanda</th>
                            <th>Profissionais Qualificados</th>
                            <th>R$/Hora Servente</th>
                            <th>R$/Hora Pedreiro</th>
                            <th>R$/Hora Mestre de Obra</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Reboque de Paredes</td>
                            <td><span class="badge-demanda">42</span></td>
                            <td><span class="badge-prof">50</span></td>
                            <td class="preco">R$11,00</td>
                            <td class="preco">R$28,00</td>
                            <td class="preco">R$40,00</td>
                            <td>
                                <div class="acoes">
                                    <button class="btn-acao btn-editar">Editar</button>
                                    <button class="btn-acao btn-excluir">Excluir</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Concentragem de Laje</td>
                            <td><span class="badge-demanda">11</span></td>
                            <td><span class="badge-prof">48</span></td>
                            <td class="preco">R$12,00</td>
                            <td class="preco">R$25,00</td>
                            <td class="preco">R$45,00</td>
                            <td>
                                <div class="acoes">
                                    <button class="btn-acao btn-editar">Editar</button>
                                    <button class="btn-acao btn-excluir">Excluir</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Levantamento de Alvenaria</td>
                            <td><span class="badge-demanda">65</span></td>
                            <td><span class="badge-prof">34</span></td>
                            <td class="preco">R$11,00</td>
                            <td class="preco">R$22,00</td>
                            <td class="preco">R$40,00</td>
                            <td>
                                <div class="acoes">
                                    <button class="btn-acao btn-editar">Editar</button>
                                    <button class="btn-acao btn-excluir">Excluir</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Assentamento de Piso</td>
                            <td><span class="badge-demanda">25</span></td>
                            <td><span class="badge-prof">29</span></td>
                            <td class="preco">R$12,00</td>
                            <td class="preco">R$35,00</td>
                            <td class="preco">R$50,00</td>
                            <td>
                                <div class="acoes">
                                    <button class="btn-acao btn-editar">Editar</button>
                                    <button class="btn-acao btn-excluir">Excluir</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>



</body>

</html>