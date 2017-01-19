<?php

require_once '../../../data/Sede.php';
require_once '../../../data/TipoUsuario.php';
require_once '../../../data/Usuario.php';
//SERVICIOS
$serviceSede = new Sede();
$serviceTipoUsuario = new TipoUsuario();
$serviceUsuario = new Usuario();

$sedes = $serviceSede->getSedes();
$tiposUsuarios = $serviceTipoUsuario->getTipoDeUsuarios();

if ($_POST) {
    //variables
    $nombre = trim(ucwords(htmlspecialchars($_POST['nombre'])));
    $apellidoP = trim(ucwords(htmlspecialchars($_POST['apellidoP'])));
    $apellidoM = trim(ucwords(htmlspecialchars($_POST['apellidoM'])));
    $nombreUsuario = trim(htmlspecialchars($_POST['nombreUsuario']));
    $contrasena = md5(trim(htmlspecialchars($_POST['contrasena'])));
    $email = trim(htmlspecialchars($_POST['email']));
    $idTipoUsuario = htmlspecialchars($_POST['idTipoUsuario']);
    $idSede = htmlspecialchars($_POST['idSede']);

    //instanceando y seteando objetos
    $usuario = new Usuario();
    $usuario->setNombreUsuario($nombre);
    $usuario->setApellidoPUsuario($apellidoP);
    $usuario->setApellidoMUsuario($apellidoM);
    $usuario->setUsuario($nombreUsuario);
    $usuario->setContrasena($contrasena);
    $usuario->setEmail($email);
    $usuario->setIdSede($idSede);
    $usuario->setIdTipoUsuario($idTipoUsuario);
    $usuario->setIdEstadoUsuario(1); //ESTADO ACTIVO

    echo $serviceUsuario->ingresarUsuario($usuario);
}