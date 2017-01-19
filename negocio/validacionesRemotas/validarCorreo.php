<?php

require_once '../../data/Usuario.php';
$serviceUsuario = new Usuario();

$email = htmlspecialchars($_GET['email']);

if ($serviceUsuario->verificarCamposUnicos("", $email, 2) == 0) {

    echo 'true';
} else {

    echo 'false';
}
