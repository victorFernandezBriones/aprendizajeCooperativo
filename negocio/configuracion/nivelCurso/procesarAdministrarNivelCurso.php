<?php

require_once '../../../data/NivelCurso.php';

$serviceNivelCurso = new NivelCurso();

$nivelCursos = $serviceNivelCurso->getNivelCursos();


if ($_POST) {

    $flag = htmlspecialchars($_POST['flag']);

    switch ($flag) {

        case 1://AGREGAR NIVEL CURSO

            $nivelCurso = trim(ucwords(htmlspecialchars($_POST['nivelCurso'])));

            echo $serviceNivelCurso->ingresarNivelCurso($nivelCurso);

            break;

        case 2://ACTUALIZAR NIVEL CURSO
            $idNivelCurso = htmlspecialchars($_POST['idNivelCurso']);
            $nivelCurso = trim(ucwords(htmlspecialchars($_POST['nivelCurso'])));


            echo $serviceNivelCurso->actualizarNivelCurso($idNivelCurso, $nivelCurso);
            break;

        case 3://ELIMINAR NIVEL CURSO
            $idNivelCurso = htmlspecialchars($_POST['idNivelCurso']);

            echo $serviceNivelCurso->eliminarNivelCurso($idNivelCurso);

            break;
    }
}