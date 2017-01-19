<?php

require_once '../../../data/TipoEntidad.php';

$serviceTipoEntidad = new TipoEntidad();


$tipoEntidades = $serviceTipoEntidad->getTipoEntidades();


if ($_POST):
    $flag = htmlspecialchars($_POST['flag']);

    switch ($flag) {

        case 1://AGREGAR TIPO ENTIDAD
            
            $tipoEntidad = trim(ucwords(htmlspecialchars($_POST['tipoEntidad'])));
            
            echo $serviceTipoEntidad->ingresarTipoEntidad($tipoEntidad);

            break;

        case 2://ACTUALIZAR TIPO ENTIDAD
            
            $idTipoEntidad = htmlspecialchars($_POST['idTipoEntidad']);
            
            $tipoEntidad = trim(ucwords(htmlspecialchars($_POST['tipoEntidad'])));

            echo $serviceTipoEntidad->actualizarTipoEntidad($idTipoEntidad, $tipoEntidad);
            
            break;

        case 3://ELIMINAR TIPO ENTIDAD
            
            $idTipoEntidad = htmlspecialchars($_POST['idTipoEntidad']);

            echo $serviceTipoEntidad->eliminarTipoEntidad($idTipoEntidad);

            break;
    }
    
   
    
    
endif;