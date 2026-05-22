<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/funcionarios.css">
    <link rel="icon" type="x-icon" href="uploads/Logo-LM.png">
    <title>LM | Funcionários</title>
</head>

<body>
    <?php
    require_once "partials/header.php";
    ?>

    <section class="funcionarios-section">
        <h2>Nossos Profissionais</h2>

        <div class="abas">
            <button class="aba ativa">Todos</button>
            <button class="aba">Pedreiros</button>
            <button class="aba">Serventes</button>
            <button class="aba">Mestres de Obra</button>
        </div>

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
</body>

</html>