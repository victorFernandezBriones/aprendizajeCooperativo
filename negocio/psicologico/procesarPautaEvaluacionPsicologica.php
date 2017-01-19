<?php

require_once '../../data/Alumno.php';
require_once '../../data/Asignatura.php';
require_once '../../data/Curso.php';
require_once '../../data/NivelCurso.php';
require_once '../../data/Evaluacion.php';
require_once '../../data/EstadoPersonal.php';
require_once '../../data/FuncionamientoAcademico.php';
require_once '../../data/FuncionamientoInteraccional.php';
require_once '../../data/Asistencia.php';
require_once '../../data/Funciones.php';

$serviceAlumno = new Alumno();
$serviceAsignatura = new Asignatura();
$serviceCurso = new Curso();
$serviceNivelCurso = new NivelCurso();
$serviceEvaluacion = new Evaluacion();
$serviceEstadoPersonal = new EstadoPersonal();
$serviceFuncionamientoAcad = new FuncionamientoAcademico();
$serviceFuncionamientoI = new funcionamientoInteraccional();
$serviceFunciones = new Funciones();
$serviceAsistencia = new Asistencia();

$cursos = $serviceCurso->getCursos();
$asignaturas = $serviceAsignatura->getAsignaturas();

if ($_POST):
    //evaluacion
    $idEvaluacion = $serviceEvaluacion->getMaxIdEvaluacion() + 1;
    $idCurso = htmlspecialchars($_POST['idCurso']);
    $fechaIngreso = $serviceFunciones->formatoFechaGuardarDB(htmlspecialchars($_POST['fechaIngreso']));
    $idAsignatura = htmlspecialchars($_POST['asignatura']);
    $idAlumno = htmlspecialchars($_POST['idAlumno']);
    $promedio = htmlspecialchars($_POST['promedio']);
    $episodioCritico = htmlspecialchars($_POST['episodioCritico']);
    $comentarios = htmlspecialchars($_POST['comentarios']);

    //instanceando y seteando objeto
    $evaluacion = new Evaluacion();
    $evaluacion->setIdEvaluacion($idEvaluacion);
    $evaluacion->setIdAlumno($idAlumno);
    $evaluacion->setIdAsignatura($idAsignatura);
    $evaluacion->setEpisodioCritico($episodioCritico);
    $evaluacion->setComentarios($comentarios);
    $evaluacion->setFechaEvaluacion($fechaIngreso);


    //asistencia
    $ausente = htmlspecialchars($_POST['ausente']);
    $aTiempo = htmlspecialchars($_POST['aTiempo']);
    $tarde = htmlspecialchars($_POST['tarde']);
    $minAtraso = htmlspecialchars($_POST['minAtraso']);
    //Seteando objeto
    $asistencia = new Asistencia();
    $asistencia->setAtiempo($aTiempo);
    $asistencia->setAusente($ausente);
    $asistencia->setTarde($tarde);
    $asistencia->setMinutosAtraso($minAtraso);
    $asistencia->setIdEvaluacion($idEvaluacion);


    //estado personal
    $rEmocional = htmlspecialchars($_POST['rEmocional']);
    $rConducta = htmlspecialchars($_POST['rConducta']);
    $rAtencion = htmlspecialchars($_POST['rAtencion']);
    $caracter = htmlspecialchars($_POST['caracter']);
    $rAnimica = htmlspecialchars($_POST['rAnimica']);
    //seteando objeto
    $estadoPersonal = new EstadoPersonal();
    $estadoPersonal->setREmocional($rEmocional);
    $estadoPersonal->setRConducta($rConducta);
    $estadoPersonal->setRAtencion($rAtencion);
    $estadoPersonal->setCaracter($caracter);
    $estadoPersonal->setRAnimica($rAnimica);
    $estadoPersonal->setIdEvaluacion($idEvaluacion);

    //funcionamiento interaccional
    $participacion = htmlspecialchars($_POST['participacion']);
    $cooperacion = htmlspecialchars($_POST['cooperacion']);
    $respeto = htmlspecialchars($_POST['respeto']);
    $empatia = htmlspecialchars($_POST['empatia']);
    //Seteando objeto
    $funcionamientoInteraccional = new FuncionamientoInteraccional();
    $funcionamientoInteraccional->setParticipacion($participacion);
    $funcionamientoInteraccional->setCooperacion($cooperacion);
    $funcionamientoInteraccional->setRespeto($respeto);
    $funcionamientoInteraccional->setEmpatiaContacto($empatia);
    $funcionamientoInteraccional->setIdEvaluacion($idEvaluacion);

    //funcionamiento academico
    $focalizacion = htmlspecialchars($_POST['focalizacion']);
    $aperturaAprendizaje = htmlspecialchars($_POST['aperturaAprendizaje']);
    $cumplimientoRol = htmlspecialchars($_POST['cumplimientoRol']);
    $comprension = htmlspecialchars($_POST['comprension']);
    //Seteando objeto
    $funcionamientoAcad = new FuncionamientoAcademico();
    $funcionamientoAcad->setFocalizacion($focalizacion);
    $funcionamientoAcad->setAperturaAprendizaje($aperturaAprendizaje);
    $funcionamientoAcad->setCRolTarea($cumplimientoRol);
    $funcionamientoAcad->setComprension($comprension);
    $funcionamientoAcad->setIdEvaluacion($idEvaluacion);


    //INGRESANDO REGISTROS
    if ($serviceEvaluacion->ingresarEvaluacion($evaluacion) == 1) {

        $serviceAsistencia->ingresarAsistencia($asistencia);
        $serviceEstadoPersonal->ingresarEstadoPersonal($estadoPersonal);
        $serviceFuncionamientoAcad->ingresarFuncionamientoAcademico($funcionamientoAcad);
        $serviceFuncionamientoI->ingresarFuncionamientoInteraccional($funcionamientoInteraccional);
        
        echo 1;
        
    }else{
        echo -1;
    }
    
   
    
    
endif;