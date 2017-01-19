<?php

require_once '../../../data/Usuario.php';
require_once '../../../data/TipoUsuario.php';
require_once '../../../data/Sede.php';

session_start();
$sessionUsuario = new Usuario();
$sessionUsuario = $_SESSION['usuario'];

//SERVICIOS
$serviceUsuario = new Usuario();
$serviceSede = new Sede();
$serviceTipoUsuario = new TipoUsuario();
//VARIABLES
$sede = $serviceSede->getSedePorId($sessionUsuario->getIdSede());
$tipoUsuario = $serviceTipoUsuario->getTipoDeUsuarioPorId($sessionUsuario->getIdTipoUsuario());

if ($_POST) {

    $flag = htmlspecialchars($_POST['flag']);

    switch ($flag) {
        
        case 1://ACTUALIZANDO PERFIL

            $idUsuario = htmlspecialchars($_POST['idUsuario']);
            $nombreUsuario = trim(ucwords(htmlspecialchars($_POST['nombre'])));
            $apellidoP = trim(ucwords(htmlspecialchars($_POST['apellidoP'])));
            $apellidoM = trim(ucwords(htmlspecialchars($_POST['apellidoM'])));
            $email = htmlspecialchars($_POST['email']);

            //instanceando y seteando objetos
            $usuario = new Usuario();
            $usuario->setIdUsuario($idUsuario);
            $usuario->setNombreUsuario($nombreUsuario);
            $usuario->setApellidoPUsuario($apellidoP);
            $usuario->setApellidoMUsuario($apellidoM);
            $usuario->setEmail($email);

            echo $serviceUsuario->actualizarUsuario($usuario, 2);
            $_SESSION['usuario'] = $serviceUsuario->getUsuarioPorID($idUsuario);
            break;

        case 2://ACTUALIZAR CONTRASENA

            $idUsuario = htmlspecialchars($_POST['idUsuario']);
            $contrasena = md5(htmlspecialchars($_POST['contrasena']));
            $usuario = new Usuario();

            $usuario->setIdUsuario($idUsuario);
            $usuario->setContrasena($contrasena);

            echo $serviceUsuario->actualizarUsuario($usuario, 3);

            break;
    }
}