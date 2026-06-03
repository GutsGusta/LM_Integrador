<<<<<<< HEAD
<?php

session_start();

require_once 'data.php';

if (!isset($_SESSION['avaliacoes'])) {
    $_SESSION['avaliacoes'] = $avaliacao;
}



=======
<?php

session_start();

require_once 'data.php';

if (!isset($_SESSION['avaliacoes'])) {
    $_SESSION['avaliacoes'] = $avaliacao;
}



>>>>>>> adfc705 (Enviado os dados da Bia)
// session_destroy();