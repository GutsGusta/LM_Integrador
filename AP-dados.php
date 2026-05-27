<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AP.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>Meus Dados</title>
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
                            <p>Cidade e UF</p>
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
            </div>
            
            <h4>Meus Dados:</h4>
            <form action="" class="dados">
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
                        <p>Cidade e Estado:</p>
                        <input type="text" name="">
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
    </main>
</body>
</html>