<?php

require_once '../../data/NivelCurso.php';
require_once '../../data/Curso.php';
require_once '../../data/Funciones.php';
require_once '../../data/Asignatura.php';


$serviceCurso = new Curso();
$serviceNivelCurso = new NivelCurso();
$serviceFunciones = new Funciones();
$serviceAsignatura = new Asignatura();

$cursos = $serviceCurso->getCursos();
$fechaActual = $serviceFunciones->obtenerFechaActual();
$nivelCurso = $serviceNivelCurso->getNivelCursos();
$asignaturas=$serviceAsignatura->getAsignaturas();
