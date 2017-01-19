<?php

require_once '../../../data/Usuario.php';
require_once '../../../data/TipoUsuario.php';
require_once '../../../data/Sede.php';
require_once '../../../data/EstadoUsuario.php';


//SERVICIOS
$serviceUsuario = new Usuario();
$serviceTipoUsuario = new TipoUsuario();
$serviceEstadoUsuario = new EstadoUsuario();
$serviceSede = new Sede();
//SETEANDO VARIABLES A UTILIZAR 
$usuarios = $serviceUsuario->getUsuarios();
$estadosUsuarios = $serviceEstadoUsuario->getEstadosUsuarios();
$sedes = $serviceSede->getSedes();
$tiposUsuarios = $serviceTipoUsuario->getTipoDeUsuarios();

if ($_POST) {

    $flag = htmlspecialchars($_POST['flag']);

    switch ($flag) {
        
        case 1://ACTUALIZAR
        
            //Inicializando variables
            $idUsuario = htmlspecialchars($_POST['idUsuario']);
            $idSede = htmlspecialchars($_POST['idSede']);
            $idTipoUsuario= htmlspecialchars($_POST['idTipoUsuario']);
            $idEstadoUsuario = htmlspecialchars($_POST['idEstadoUsuario']);
            
            //Instanceando y seteando objetos
            $usuario = new Usuario();
            $usuario->setIdUsuario($idUsuario);
            $usuario->setIdSede($idSede);
            $usuario->setIdTipoUsuario($idTipoUsuario);
            $usuario->setIdEstadoUsuario($idEstadoUsuario);            
            
            echo $serviceUsuario->actualizarUsuario($usuario,1);//Actualizando al usuario

            break;

        case 2://ELIMINAR
            $idUsuario = htmlspecialchars($_POST['idUsuario']);
            
            echo $serviceUsuario->eliminarUsuario($idUsuario);
            
            break;
    }
}