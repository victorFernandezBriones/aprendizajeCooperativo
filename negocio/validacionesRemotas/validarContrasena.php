<?php

require_once '../../data/Usuario.php';
$serviceUsuario = new Usuario();

$contrasenaAntigua = md5(htmlspecialchars($_GET['contrasenaAntigua']));

if ($serviceUsuario->verificarCamposUnicos($contrasenaAntigua, "", 3) != 0) {

    echo 'true';
} else {

    echo 'false';
}

