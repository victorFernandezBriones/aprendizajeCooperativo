<?php

require_once '../../../data/Asignatura.php';

$serviceAsignatura = new Asignatura();


//VARIABLES
$asignaturas = $serviceAsignatura->getAsignaturas();

if ($_POST):

    $flag = htmlspecialchars($_POST['flag']);

    switch ($flag) {

        case 1://AGREGAR ASIGNATURA

            $nombreAsignatura = trim(ucwords(htmlspecialchars($_POST['nombreAsignatura'])));
            echo $serviceAsignatura->ingresarAsignatura($nombreAsignatura);

            break;

        case 2://ACTUALIZAR ASIGNATURA
            $idAsignatura = htmlspecialchars($_POST['idAsignatura']);
            $nombreAsignatura = trim(ucwords(htmlspecialchars($_POST['nombreAsignatura'])));

            echo $serviceAsignatura->actualizarAsignatura($idAsignatura, $nombreAsignatura);

            break;

        case 3://ELIMINAR ASIGNATURA

            $idAsignatura = htmlspecialchars($_POST['idAsignatura']);

            echo $serviceAsignatura->eliminarAsignatura($idAsignatura);

            break;
    }
    
   
    
    
endif;

