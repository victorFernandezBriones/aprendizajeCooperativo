<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Asistencia
 *
 * @author vfernandez
 */
require_once 'Conexion.php';

class Asistencia {

    private $idAsistencia;
    private $ausente;
    private $atiempo;
    private $tarde;
    private $minutosAtraso;
    private $idEvaluacion;

    public function __construct() {
        
    }

    function getIdAsistencia() {
        return $this->idAsistencia;
    }

    function getAusente() {
        return $this->ausente;
    }

    function getAtiempo() {
        return $this->atiempo;
    }

    function getMinutosAtraso() {
        return $this->minutosAtraso;
    }

    function getIdEvaluacion() {
        return $this->idEvaluacion;
    }

    function setIdAsistencia($idAsistencia) {
        $this->idAsistencia = $idAsistencia;
    }

    function setAusente($ausente) {
        $this->ausente = $ausente;
    }

    function setAtiempo($atiempo) {
        $this->atiempo = $atiempo;
    }

    function setMinutosAtraso($minutosAtraso) {
        $this->minutosAtraso = $minutosAtraso;
    }

    function setIdEvaluacion($idEvaluacion) {
        $this->idEvaluacion = $idEvaluacion;
    }

    function getTarde() {
        return $this->tarde;
    }

    function setTarde($tarde) {
        $this->tarde = $tarde;
    }

    /**
     * Método que ingresa un registro en la tabla asistencia
     * @param Asistencia $asistencia Objeto con los atributos a ingresar
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function ingresarAsistencia($asistencia) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "INSERT INTO asistencia(ausente,atiempo,tarde,minutos_atraso,id_evaluacion) "
                    . "VALUES('" . $asistencia->getAusente() . "','" . $asistencia->getAtiempo() . "','" . $asistencia->getTarde() . "',"
                    . "'" . $asistencia->getMinutosAtraso() . "','" . $asistencia->getIdEvaluacion() . "')"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO FLAG DE RESULTADO DE LA OPERACION
            //LIBERANDO RECURSOS
            mysqli_close($cnx);


            return $exito; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que actualiza un registro de asistencia de un alumno(a)
     * @param Asistencia $asistencia Objeto con los atributos a actualizar
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function actualizarAsistenciaAlumno($asistencia) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "UPDATE asistencia SET ausente='" . $asistencia->getAusente() . "',atiempo='" . $asistencia->getAtiempo() . "'"
                    . ",tarde='" . $asistencia->getTarde() . "',minutos_atraso='" . $asistencia->getMinutosAtraso() . "',id_evaluacion='" . $asistencia->getIdEvaluacion() . "' "
                    . "WHERE id_alumno='" . $asistencia->getIdAlumno() . "'"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO FLAG DE RESULTADO DE LA OPERACION
            //LIBERANDO RECURSOS
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que obtiene un registro de asistencia de una evaluación
     * @param int $idEvaluacion id de la evaluación
     * @return Asistencia Retorna un objeto con los resultados
     */
    public function getAsistenciaPorEvaluacion($idEvaluacion) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM asistencia WHERE id_evaluacion ='$idEvaluacion'"; //QUERY
            $rs = mysqli_query($cnx, $sql);

            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO EL OBJETO
                $asistencia = new Asistencia();
                $asistencia->setAusente($r['ausente']);
                $asistencia->setAtiempo($r['atiempo']);
                $asistencia->setTarde($r['tarde']);
                $asistencia->setMinutosAtraso($r['minutos_atraso']);
                $asistencia->setIdEvaluacion($r['id_evaluacion']);
            }

            //LIBERANDO RECURSOS
            mysqli_close($cnx);
            mysqli_free_result($rs);

            return $asistencia; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    
    /**
     * Método que realiza la suma de todas las asistencias presentes en el array que ingresa por parametro
     * @param array $asistencias Contiene objetos Asistencia con los valores relacionados a las evaluaciones
     * @return array Retorna un array asociativo con el resumen por atributo de las asistencias
     */
    public function calcularAsistencias($asistencias) {
        try {

            $total = count($asistencias);
            $ausente = 0;
            $atiempo = 0;
            $tarde = 0;
            foreach ($asistencias as $a) {

                //sumando valores a las variables dependiendo de los objetos almacenados en el array pasado por parametro
                $ausente = $a->getAusente() == 1 ? $ausente = $ausente + 1 : $ausente; //no funciona con el autoincrementar ++
                $atiempo = $a->getAtiempo() == 1 ? $atiempo = $atiempo + 1 : $atiempo; //no funciona con el autoincrementar ++
                $tarde = $a->getTarde() == 1 ? $tarde = $tarde + 1 : $tarde; //no funciona con el autoincrementar ++
            }
            //entregando datos al array
            $resumenAsistencias = array("ausente" => $ausente, "atiempo" => $atiempo,
                "tarde" => $tarde, "total" => $total); //ARRAY ASOCIATIVO CON LOS RESULTADOS


            return $resumenAsistencias;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

}
