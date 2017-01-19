<?php

require_once '../../../data/Curso.php';
require_once '../../../data/NivelCurso.php';

//SERVICIOS
$serviceCurso = new Curso();
$serviceNivelCurso = new NivelCurso();

//VARIABLES
$nivelCursos = $serviceNivelCurso->getNivelCursos();
$cursos = $serviceCurso->getCursos();

if ($_POST) {

    $flag = htmlspecialchars($_POST['flag']);

    switch ($flag) {

        case 1://AGREGAR CURSO

            $nombreCurso = trim(ucwords(htmlspecialchars($_POST['nombreCurso'])));
            $idNivelCurso = htmlspecialchars($_POST['idNivelCurso']);

            $curso = new Curso();
            $curso->setCurso($nombreCurso);
            $curso->setIdNivelCurso($idNivelCurso);

            echo $serviceCurso->ingresarCurso($curso);

            break;

        case 2://ACTUALIZAR CURSO

            $idCurso = htmlspecialchars($_POST['idCurso']);
            $idNivelCurso = htmlspecialchars($_POST['idNivelCurso']);
            $nombreCurso = trim(ucwords(htmlspecialchars($_POST['nombreCurso'])));

            $curso = new Curso();
            $curso->setIdCurso($idCurso);
            $curso->setCurso($nombreCurso);
            $curso->setIdNivelCurso($idNivelCurso);

            echo $serviceCurso->actualizarCurso($curso);

            break;

        case 3://ELIMINAR CURSO
            $idCurso = htmlspecialchars($_POST['idCurso']);

            echo $serviceCurso->eliminarCurso($idCurso);

            break;
    }
}

