<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Evaluacion
 *
 * @author vfernandez
 */
require_once 'Conexion.php';
require_once 'FuncionamientoAcademico.php';
require_once 'FuncionamientoInteraccional.php';
require_once 'EstadoPersonal.php';

class Evaluacion {

    private $idEvaluacion;
    private $fechaEvaluacion;
    private $episodioCritico;
    private $comentarios;
    private $idAsignatura;
    private $idAlumno;

    public function __construct() {
        
    }

    function getIdEvaluacion() {
        return $this->idEvaluacion;
    }

    function getFechaEvaluacion() {
        return $this->fechaEvaluacion;
    }

    function getEpisodioCritico() {
        return $this->episodioCritico;
    }

    function getComentarios() {
        return $this->comentarios;
    }

    function getIdAsignatura() {
        return $this->idAsignatura;
    }

    function getIdAlumno() {
        return $this->idAlumno;
    }

    function setIdEvaluacion($idEvaluacion) {
        $this->idEvaluacion = $idEvaluacion;
    }

    function setFechaEvaluacion($fechaEvaluacion) {
        $this->fechaEvaluacion = $fechaEvaluacion;
    }

    function setEpisodioCritico($episodioCritico) {
        $this->episodioCritico = $episodioCritico;
    }

    function setComentarios($comentarios) {
        $this->comentarios = $comentarios;
    }

    function setIdAsignatura($idAsignatura) {
        $this->idAsignatura = $idAsignatura;
    }

    function setIdAlumno($idAlumno) {
        $this->idAlumno = $idAlumno;
    }

    /**
     * Método que ingresa un registro en la tabla evaluacion
     * @param Evaluacion $evaluacion Objeto con los atributos a ingresar
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function ingresarEvaluacion($evaluacion) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "INSERT INTO evaluacion(id_evaluacion,fecha_evaluacion,episodio_critico,comentarios,id_asignatura,id_alumno) "
                    . "VALUES('" . $evaluacion->getIdEvaluacion() . "','" . $evaluacion->getFechaEvaluacion() . "','" . $evaluacion->getEpisodioCritico() . "','" . $evaluacion->getComentarios() . "',"
                    . "'" . $evaluacion->getIdAsignatura() . "','" . $evaluacion->getIdAlumno() . "')"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO FLAG DE RESULTADO DE LA OPERACION
//LIBERANDO RECURSOS
            mysqli_close($cnx);


            return $exito; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que obtiene la id máxima de la tabla evaluación
     * @return int Retorna la id máxima o mayor de la tabla
     */
    public function getMaxIdEvaluacion() {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT MAX(id_evaluacion) AS max FROM evaluacion"; //QUERY
            $rs = mysqli_query($cnx, $sql); //RESULTSET
            $max = 0;
//OBTENIENDO RESULTADOS
            while ($r = mysqli_fetch_array($rs)) {

                $max = $r['max'];
            }

//LIBERANDO RECURSOS
            mysqli_close($cnx);
            mysqli_free_result($rs);

            return $max; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que obtiene todas las evaluaciones asociadas a un alumno
     * @param int $idAlumno id del alumno
     * @return array Retorna un array con los resultados
     */
    public function getEvaluacionesPorAlumno($idAlumno) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM evaluacion WHERE id_alumno='$idAlumno' ORDER BY fecha_evaluacion DESC"; //QUERY
            $rs = mysqli_query($cnx, $sql); //RESULTSET
            $evaluaciones = array();
//OBTENIENDO RESULTADOS
            while ($r = mysqli_fetch_array($rs)) {
//INSTANCEANDO Y SETTEANDO OBJETO
                $evaluacion = new Evaluacion();
                $evaluacion->setIdEvaluacion($r['id_evaluacion']);
                $evaluacion->setFechaEvaluacion($r['fecha_evaluacion']);
                $evaluacion->setEpisodioCritico($r['episodio_critico']);
                $evaluacion->setComentarios($r['comentarios']);
                $evaluacion->setIdAsignatura($r['id_asignatura']);
                $evaluacion->setIdAlumno($r['id_alumno']);

                array_push($evaluaciones, $evaluacion); //INGRESANDO RESULTADOS AL ARRAY
            }

//LIBERANDO RECURSOS
            mysqli_close($cnx);
            mysqli_free_result($rs);

            return $evaluaciones; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que obtiene las evaluaciones de un alumno segun un rango de fechas
     * @param int $idAlumno id del alumno
     * @param Date $fechaInicio fecha de inicio
     * @param Date $fechaTermino fecha de término
     * @return array Retorna un array con los resultados
     */
    public function getEvaluacionesPorAlumnoFechasYasignaturas($idAlumno, $fechaInicio, $fechaTermino, $asignaturas) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            if ($asignaturas == "") {
                $sql = "SELECT * FROM evaluacion WHERE id_alumno='$idAlumno' AND fecha_evaluacion BETWEEN '$fechaInicio' AND '$fechaTermino' "
                        . "ORDER BY fecha_evaluacion DESC"; //QUERY
            } else {
                $sql = "SELECT * FROM evaluacion WHERE id_alumno='$idAlumno' AND fecha_evaluacion BETWEEN '$fechaInicio' AND '$fechaTermino' ";

//QUERY
                $c = 0;
                if (count($asignaturas) > 1) {

                    foreach ($asignaturas as $a) {
                        if ($c == 0) {
                            $sql.=" AND id_asignatura='$a' ";
                        } else {
                            $sql.=" OR id_asignatura='$a' ";
                        }
                        $c++;
                    }

                    $sql.=" ORDER BY fecha_evaluacion DESC";
                } else {
                    $sql.=" AND id_asignatura='$asignaturas[0]' ORDER BY fecha_evaluacion DESC";
                }
            }


            $rs = mysqli_query($cnx, $sql); //RESULTSET
            $evaluaciones = array();
//OBTENIENDO RESULTADOS
            while ($r = mysqli_fetch_array($rs)) {
//INSTANCEANDO Y SETTEANDO OBJETO
                $evaluacion = new Evaluacion();
                $evaluacion->setIdEvaluacion($r['id_evaluacion']);
                $evaluacion->setFechaEvaluacion($r['fecha_evaluacion']);
                $evaluacion->setEpisodioCritico($r['episodio_critico']);
                $evaluacion->setComentarios($r['comentarios']);
                $evaluacion->setIdAsignatura($r['id_asignatura']);
                $evaluacion->setIdAlumno($r['id_alumno']);

                array_push($evaluaciones, $evaluacion); //INGRESANDO RESULTADOS AL ARRAY               
            }

//LIBERANDO RECURSOS
            mysqli_close($cnx);
            mysqli_free_result($rs);

            return $evaluaciones; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que obtiene todas las evaluaciones por curso realizadas en un rango de fechas
     * @param int $idCurso id del curso
     * @param Date $fechaInicio Fecha de inicio
     * @param Date $fechaTermino Fecha de término
     * @return array Retorna un array con los resultados obtenidos
     */
    public function getEvaluacionesPorCursosFechasYAsignaturas($idCurso, $fechaInicio, $fechaTermino, $asignaturas) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION

            if ($asignaturas == "") {
                $sql = "SELECT e.id_evaluacion,e.fecha_evaluacion,e.episodio_critico,e.comentarios,e.id_asignatura,e.id_alumno"
                        . " FROM evaluacion e JOIN alumno al USING(id_alumno) "
                        . "WHERE al.id_curso = '$idCurso' AND e.fecha_evaluacion BETWEEN '$fechaInicio' AND '$fechaTermino' "
                        . "ORDER BY e.fecha_evaluacion DESC"; //QUERY 
            } else {
                $sql = "SELECT e.id_evaluacion,e.fecha_evaluacion,e.episodio_critico,e.comentarios,e.id_asignatura,e.id_alumno"
                        . " FROM evaluacion e JOIN alumno al USING(id_alumno) "
                        . "WHERE al.id_curso = '$idCurso' AND e.fecha_evaluacion BETWEEN '$fechaInicio' AND '$fechaTermino'";

                //QUERY
                $c = 0;
                if (count($asignaturas) > 1) {

                    foreach ($asignaturas as $a) {
                        if ($c == 0) {
                            $sql.=" AND e.id_asignatura = '$a' ";
                        } else {
                            $sql.=" OR e.id_asignatura = '$a' ";
                        }
                        $c++;
                    }

                    $sql.=" ORDER BY e.fecha_evaluacion DESC";
                } else {
                    $sql.=" AND e.id_asignatura = '$asignaturas[0]' ORDER BY e.fecha_evaluacion DESC";
                }
            }





            $rs = mysqli_query($cnx, $sql); //RESULTSET

            $evaluaciones = array();
            //OBTENIENDO RESULTADOS
            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETTEANDO OBJETO
                $evaluacion = new Evaluacion();
                $evaluacion->setIdEvaluacion($r['id_evaluacion']);
                $evaluacion->setFechaEvaluacion($r['fecha_evaluacion']);
                $evaluacion->setEpisodioCritico($r['episodio_critico']);
                $evaluacion->setComentarios($r['comentarios']);
                $evaluacion->setIdAsignatura($r['id_asignatura']);
                $evaluacion->setIdAlumno($r['id_alumno']);

                array_push($evaluaciones, $evaluacion); //INGRESANDO RESULTADOS AL ARRAY               
            }

            //LIBERANDO RECURSOS
            mysqli_close($cnx);
            mysqli_free_result($rs);

            return $evaluaciones; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que obtiene todas las evaluaciones por grupo curso
     * @param int $idCurso id del curso a consultar
     * @return array Retorna un array con los resultados
     */
    public function getEvaluacionesPorCurso($idCurso) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT e.id_evaluacion, e.fecha_evaluacion, e.episodio_critico, e.comentarios, e.id_asignatura, e.id_alumno"
                    . " FROM evaluacion e JOIN alumno al USING(id_alumno) JOIN curso c USING(id_curso) "
                    . "WHERE c.id_curso = '$idCurso' "
                    . "ORDER BY e.fecha_evaluacion DESC"; //QUERY
            $rs = mysqli_query($cnx, $sql); //RESULTSET
            $evaluaciones = array();
            //OBTENIENDO RESULTADOS
            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETTEANDO OBJETO
                $evaluacion = new Evaluacion();
                $evaluacion->setIdEvaluacion($r['id_evaluacion']);
                $evaluacion->setFechaEvaluacion($r['fecha_evaluacion']);
                $evaluacion->setEpisodioCritico($r['episodio_critico']);
                $evaluacion->setComentarios($r['comentarios']);
                $evaluacion->setIdAsignatura($r['id_asignatura']);
                $evaluacion->setIdAlumno($r['id_alumno']);

                array_push($evaluaciones, $evaluacion); //INGRESANDO RESULTADOS AL ARRAY               
            }

            //LIBERANDO RECURSOS
            mysqli_close($cnx);
            mysqli_free_result($rs);

            return $evaluaciones; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que actualiza un registro de evaluacion de un alumno
     * @param Evaluacion $evaluacion Objeto con los atributos a actualizar
     * @return int Retorna 1 si la operación es correcta, -1 si no lo es
     */
    public function actualizarEvaluacionPorUsuario($evaluacion) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "UPDATE evaluacion SET fecha_evaluacion = '" . $evaluacion->getFechaEvaluacion() . "', "
                    . "episodio_critico = '" . $evaluacion->getEpisodioCritico() . "', comentarios = '" . $evaluacion->getComentarios() . "', "
                    . "id_asignatura = '" . $evaluacion->getIdAsignatura() . "', id_alumno = '" . $evaluacion->getIdAlumno() . "' "
                    . "WHERE id_alumno = '" . $evaluacion->getIdAlumno() . "'"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO FLAG DE RESULTADO DE LA OPERACION
            //LIBERANDO RECURSOS
            mysqli_close($cnx);


            return $exito; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que cuenta los episodios críticos de las evaluaciones
     * @param array $evaluaciones Contiene las evaluacion obtenidas
     * @return int Retorna la cantidad de episodios criticos
     */
    public function contarEpisodioCritico($evaluaciones) {
        try {
            $episodiosCriticos = 0;
            //CONTANDO EPISODIOS CRITICOS
            foreach ($evaluaciones as $e) {
                $episodiosCriticos = $e->getEpisodioCritico() == 1 ? $episodiosCriticos+=1 : $episodiosCriticos;
            }

            //RETORNANDO RESULTADOS
            return $episodiosCriticos;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Método que obtiene el promedio de todas las secciones que componen la evaluacion
     * @param EstadoPersonal $estadoP Estado personal
     * @param FuncionamientoInteraccional $funcionamientoI Funcionamiento Interaccional
     * @param FuncionamientoAcademico $funcionamientoA Funcionamiento Academico
     * @return int Retorna el promedio final
     */
    function obtenerPromedioSecciones($estadoP, $funcionamientoI, $funcionamientoA) {
        //obteniendo promedios
        $notaEP = $estadoP->calcularPromedioEstadoP($estadoP);
        $notaFI = $funcionamientoI->calcularPromedioFuncionamientoI($funcionamientoI);
        $notaFA = $funcionamientoA->calcularPromedioFuncionamientoA($funcionamientoA);

        return ($notaEP + $notaFI + $notaFA) / 3; //retornando resultado 
    }

    function obtenerPromedios($estadoP, $funcionamientoI, $funcionamientoA) {
        //obteniendo promedios
        $notaEP = $estadoP->calcularPromedioEstadoP($estadoP);
        $notaFI = $funcionamientoI->calcularPromedioFuncionamientoI($funcionamientoI);
        $notaFA = $funcionamientoA->calcularPromedioFuncionamientoA($funcionamientoA);

        $resultados = array("notaEP" => $notaEP, "notaFI" => $notaFI, "notaFA" => $notaFA);

        return $resultados; //retornando resultado 
    }

    public function obtenerRegulacionGeneral($evaluaciones) {
        try {
            //SERVICIOS
            $serviceEstadoP = new EstadoPersonal();
            $serviceFuncionamientoI = new FuncionamientoInteraccional();
            $serviceFuncionamientoA = new FuncionamientoAcademico();
            //INICIALIZANDO VARIABLES
            $rojo = 0;
            $amarillo = 0;
            $verde = 0;

            foreach ($evaluaciones as $e) {
                //intanceando secciones
                $estadoP = $serviceEstadoP->getEstadoPersonalPorEvaluacion($e->getIdEvaluacion());
                $funcionamientoI = $serviceFuncionamientoI->getFuncionamientoInteraccionalPorEvaluacion($e->getIdEvaluacion());
                $funcionamientoA = $serviceFuncionamientoA->getFuncionamientoAcademicoPorEvaluacion($e->getIdEvaluacion());
                //calculando promedio de las secciones
                $promedioSecciones = $this->obtenerPromedioSecciones($estadoP, $funcionamientoI, $funcionamientoA);

                //calculando regulacion general por promedio
                if ($promedioSecciones < 7 && $promedioSecciones >= 5.75) {
                    $verde++;
                } else {
                    if ($promedioSecciones < 5.75 && $promedioSecciones >= 4) {
                        $amarillo++;
                    } else {
                        $rojo++;
                    }
                }
            }

            $resultados = array("verde" => $verde, "amarillo" => $amarillo, "rojo" => $rojo); //Array con lso resultados

            return $resultados;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
