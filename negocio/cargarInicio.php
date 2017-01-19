<?php

require_once '../data/Usuario.php';
require_once '../data/TipoUsuario.php';

$sessionUsuario = new Usuario();
$sessionUsuario = $_SESSION['usuario'];

$serviceTipoUsuario = new TipoUsuario();

$tipoUsuario =$serviceTipoUsuario->getTipoDeUsuarioPorId($sessionUsuario->getIdTipoUsuario());
