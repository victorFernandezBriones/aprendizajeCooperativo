<?php

require_once '../../../data/Sede.php';

$serviceSede = new Sede();


//VARIABLES
$sedes = $serviceSede->getSedes();

if ($_POST):
    $flag = htmlspecialchars($_POST['flag']);

    switch ($flag) {

        case 1://AGREGAR SEDE
            $nombreSede = trim(ucwords(htmlspecialchars($_POST['nombreSede'])));
            echo $serviceSede->ingresarSede($nombreSede);

            break;

        case 2://ACTUALIZAR SEDE
            $idSede = htmlspecialchars($_POST['idSede']);
            $nombreSede = trim(ucwords(htmlspecialchars($_POST['nombreSede'])));

            echo $serviceSede->actualizarSede($idSede, $nombreSede);

            break;

        case 3://ELIMINAR SEDE
            $idSede = htmlspecialchars($_POST['idSede']);

            echo $serviceSede->eliminarSede($idSede);

            break;
    }
    
   
    
    
endif;