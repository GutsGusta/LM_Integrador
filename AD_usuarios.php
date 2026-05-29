<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AD_usuarios.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Admin | LM</title>
</head>

<body>
    <?php
    require_once "partials/header.php";
    ?>

    <div class="cliente-wrapper">

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

            <a href="AD_usuarios.php" class="nav-item ativo">
                <i class="fa-solid fa-users"></i>
                Usuarios
            </a>

            <a href="AD_servicos.php" class="nav-item">
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
            <p class="content-titulo">Gerenciar Usuários</p>

            <div class="tabela-card">
                <div class="tabela-header">
                    <h3>Clientes</h3>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Nome do Cliente</th>
                            <th>Tipo de Profissional</th>
                            <th>Data do Agendamento</th>
                            <th>Horário</th>
                            <th>Preço Total</th>
                            <th>Profissional</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>João Pereira</td>
                            <td><span class="badge-tipo badge-pedreiro">Pedreiro</span></td>
                             <td class="data">01/08/2026 - 06/08/2026</td>
                            <td class="horario">08:00 - 14:00</td>
                            <td class="preco">R$500,00</td>
                            <td class="profissional">Luis Almeida</td>
                            <td>
                                <div class="acoes">
                                    <button class="btn-acao btn-excluir">Excluir</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Mariana Costa</td>
                            <td><span class="badge-tipo badge-mestre">Mestre de Obra</span></td>
                             <td class="data">01/08/2026 - 06/08/2026</td>
                            <td class="horario">08:00 - 14:00</td>
                            <td class="preco">R$700,00</td>
                            <td class="profissional">Pedro Silveira</td>
                            <td>
                                <div class="acoes">
                                    <button class="btn-acao btn-excluir">Excluir</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Felipe Rodrigues</td>
                            <td><span class="badge-tipo badge-servente">Servente</span></td>
                            <td class="data">01/08/2026 - 06/08/2026</td>
                            <td class="horario">08:00 - 14:00</td>
                            <td class="preco">R$350,00</td>
                            <td class="profissional">Vitor Rodrigues</td>
                            <td>
                                <div class="acoes">
                                    <button class="btn-acao btn-excluir">Excluir</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Camila Santos</td>
                            <td><span class="badge-tipo badge-servente">Servente</span></td>
                            <td class="data">01/08/2026 - 06/08/2026</td>
                            <td class="horario">08:00 - 14:00</td>
                            <td class="preco">R$1800,00</td>
                            <td class="profissional">Marta Oliveira</td>
                            <td>
                                <div class="acoes">
                                    <button class="btn-acao btn-excluir">Excluir</button>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td>Eduardo Lima</td>
                            <td><span class="badge-tipo badge-pedreiro">Pedreiro</span></td>
                            <td class="data">01/08/2026 - 06/08/2026</td>
                            <td class="horario">08:00 - 14:00</td>
                            <td class="preco">R$600,00</td>
                            <td class="profissional">Ronaldo Filho</td>
                            <td>
                                <div class="acoes">
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