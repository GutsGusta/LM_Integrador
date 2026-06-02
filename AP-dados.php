<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AP-dados.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>Meus Dados</title>
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

            <a href="AP-dashboard.php" class="nav-item">
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
        
            <div class="dados-principais">
                <h4>Meus Dados:</h4>
                <form action="" method="POST" class="dados">
                    <div class="campo-horizontal">
                        <div class="campo">
                            <p>Nome Completo:</p>
                            <input type="text" name="">
                        </div>           
                        <div class="campo">
                            <p>E-mail:</p>
                            <input type="text" name="">
                        </div>
                    </div>
                    <div class="campo-horizontal">
                        <div class="campo">
                            <p>Telefone:</p>
                            <input type="text" name="">
                        </div>            
                        <div class="campo">
                            <p>Cidade de Residência:</p>
                            <input type="text" name="">
                            <!-- <select name="">
                                <option value="">São Paulo</option>
                                <option value="">Mauá</option>
                                <option value="">São Caetano do Sul</option>
                                <option value="">São Bernardo</option>
                                <option value="">Santo André</option>
                                <option value="">Ribeirão Pires</option>
                            </select> -->
                        </div>
                    </div>
                    <div class="campo-horizontal">
                        <div class="campo">
                            <p>Função</p>
                            <select name="">
                                <option value="">Servente</option>
                                <option value="">Pedreiro</option>
                                <option value="">Mestre de Obras</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit">Salvar</button>
                </form>
            </div>
            <div class="dados-principais">
                <h4>Serviços Qualificados:</h4>
                <form action="" method="POST" class="servicos">
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <div class="check">
                        <p>Serviço</p>
                        <input type="checkbox">
                    </div>
                    <button type="submit">Salvar</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>