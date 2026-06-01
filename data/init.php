<?php

session_start();

require_once 'data.php';

if (!isset($_SESSION['avaliacoes'])) {
    $_SESSION['avaliacoes'] = $avaliacao;
}



// session_destroy();