<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AD_funcionarios.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Admin | LM</title>
</head>

<body>
    <?php
    require_once "partials/header.php";
    ?>

    <div>

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

            <a href="AD_servicos.php" class="nav-item">
                <i class="fa-solid fa-briefcase"></i>
                Serviços
            </a>

            <a href="AD_funcionarios.php" class="nav-item ativo">
                <i class="fa-solid fa-helmet-safety"></i>
                Funcionários
            </a>


            <form method="POST" action="AD_funcionarios.php">
                <button type="submit" name="logout" class="nav-item nav-sair">
                    <i class="fa-solid fa-right-from-bracket">Sair</i>
                    Sair
                </button>
            </form>
        </div>

        <div class="admin-content">
 
            <h2 class="content-titulo">Gerenciar Funcionários</h2>
 
            <div class="tabela-card">
                <div class="tabela-header">
                    <h3>Tabela de Funcionários</h3>
                    <button class="btn-add">
                        <i class="fa-solid fa-plus"></i> Novo Funcionário
                    </button>
                </div>
 
                <table>
                    <thead>
                        <tr>
                            <th>Funcionário</th>
                            <th>Tipo</th>
                            <th>Telefone</th>
                            <th>Avaliação</th>
                            <th>Serviços Feitos</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="func-nome">
                                    <img src="https://pravatar.cc/150?img=47" alt="Ana">
                                    Ana Pereira
                                </div>
                            </td>
                            <td><span class="badge-tipo badge-mestre">Mestre de Obra</span></td>
                            <td class="td-muted">(11) 91234-5678</td>
                            <td><span class="estrelas">★★★★★</span> <span class="nota">4.9</span></td>
                            <td class="td-destaque">38</td>
                            <td><span class="badge-status status-ativo">Ativo</span></td>
                            <td>
                                <div class="acoes">
                                    <button class="btn-acao btn-editar">Editar</button>
                                    <button class="btn-acao btn-excluir">Excluir</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="func-nome">
                                    <img src="https://pravatar.cc/150?img=12" alt="Ricardo">
                                    Ricardo Martins
                                </div>
                            </td>
                            <td><span class="badge-tipo badge-pedreiro">Pedreiro</span></td>
                            <td class="td-muted">(11) 98765-4321</td>
                            <td><span class="estrelas">★★★★★</span> <span class="nota">4.8</span></td>
                            <td class="td-destaque">52</td>
                            <td><span class="badge-status status-ativo">Ativo</span></td>
                            <td>
                                <div class="acoes">
                                    <button class="btn-acao btn-editar">Editar</button>
                                    <button class="btn-acao btn-excluir">Excluir</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="func-nome">
                                    <img src="https://pravatar.cc/150?img=3" alt="Fernando">
                                    Fernando Lopes
                                </div>
                            </td>
                            <td><span class="badge-tipo badge-servente">Servente</span></td>
                            <td class="td-muted">(11) 97654-3210</td>
                            <td><span class="estrelas">★★★★☆</span> <span class="nota">4.6</span></td>
                            <td class="td-destaque">29</td>
                            <td><span class="badge-status status-ativo">Ativo</span></td>
                            <td>
                                <div class="acoes">
                                    <button class="btn-acao btn-editar">Editar</button>
                                    <button class="btn-acao btn-excluir">Excluir</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="func-nome">
                                    <img src="https://pravatar.cc/150?img=22" alt="Paulo">
                                    Paulo Rocha
                                </div>
                            </td>
                            <td><span class="badge-tipo badge-servente">Servente</span></td>
                            <td class="td-muted">(11) 95432-1098</td>
                            <td><span class="estrelas">★★★★☆</span> <span class="nota">4.5</span></td>
                            <td class="td-destaque">21</td>
                            <td><span class="badge-status status-inativo">Inativo</span></td>
                            <td>
                                <div class="acoes">
                                    <button class="btn-acao btn-editar">Editar</button>
                                    <button class="btn-acao btn-excluir">Excluir</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="func-nome">
                                    <img src="https://pravatar.cc/150?img=57" alt="Carlos">
                                    Carlos Mendes
                                </div>
                            </td>
                            <td><span class="badge-tipo badge-pedreiro">Pedreiro</span></td>
                            <td class="td-muted">(11) 93210-8765</td>
                            <td><span class="estrelas">★★★★☆</span> <span class="nota">4.3</span></td>
                            <td class="td-destaque">17</td>
                            <td><span class="badge-status status-ativo">Ativo</span></td>
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