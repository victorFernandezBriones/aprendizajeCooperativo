<?php

require_once 'data/Usuario.php';

if ($_POST) {

    $serviceUsuario = new Usuario();//SERVICIO
    $usuario = htmlspecialchars($_POST['usuario']);
    $contrasena = md5(htmlspecialchars($_POST['contrasena']));
    
    
    $sessionUsuario = $serviceUsuario->verificarLogin($usuario, $contrasena);//VERIFICANDO LOGIN

    if ($sessionUsuario != NULL) {//SI EL OBJETO NO ESTA VACIO REDIRIJO AL INICIO

        session_start();//INICIANDO SESSION
        $_SESSION['usuario'] = $sessionUsuario;//GUARDANDO LOS DATOS DEL USUARIO EN LA SESSION
        header("location:pa/inicio.php");//REDIRECCIONANDO
        
    } else {
        $error = "Usuario y contraseña incorrecta";//MENSAJE DE ERROR
    }
}