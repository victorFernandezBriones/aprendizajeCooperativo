<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FuncionamientoAcademico
 *
 * @author vfernandez
 */
require_once 'Conexion.php';

class FuncionamientoAcademico {

    private $idFuncionamientoAcad;
    private $focalizacion;
    private $aperturaAprendizaje;
    private $cRolTarea;
    private $comprension;
    private $idEvaluacion;

    public function __construct() {
        
    }

    function getIdFuncionamientoAcad() {
        return $this->idFuncionamientoAcad;
    }

    function getFocalizacion() {
        return $this->focalizacion;
    }

    function getAperturaAprendizaje() {
        return $this->aperturaAprendizaje;
    }

    function getCRolTarea() {
        return $this->cRolTarea;
    }

    function getComprension() {
        return $this->comprension;
    }

    function getIdEvaluacion() {
        return $this->idEvaluacion;
    }

    function setIdFuncionamientoAcad($idFuncionamientoAcad) {
        $this->idFuncionamientoAcad = $idFuncionamientoAcad;
    }

    function setFocalizacion($focalizacion) {
        $this->focalizacion = $focalizacion;
    }

    function setAperturaAprendizaje($aperturaAprendizaje) {
        $this->aperturaAprendizaje = $aperturaAprendizaje;
    }

    function setCRolTarea($cRolTarea) {
        $this->cRolTarea = $cRolTarea;
    }

    function setComprension($comprension) {
        $this->comprension = $comprension;
    }

    function setIdEvaluacion($idEvaluacion) {
        $this->idEvaluacion = $idEvaluacion;
    }

    /**
     * Método que ingresa un registro en la tabla funcionamiento académico
     * @param FuncionamientoAcademico $funcionamientoAcademico
     * @return int Retorna 1 si la operación es correcta, -1 si no lo es
     */
    public function ingresarFuncionamientoAcademico($funcionamientoAcademico) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "INSERT INTO funcionamiento_academico(focalizacion,apertura_aprendizaje,c_rol_tarea,comprension,id_evaluacion) "
                    . "VALUES('" . $funcionamientoAcademico->getFocalizacion() . "','" . $funcionamientoAcademico->getAperturaAprendizaje() . "',"
                    . "'" . $funcionamientoAcademico->getCRolTarea() . "','" . $funcionamientoAcademico->getComprension() . "','" . $funcionamientoAcademico->getIdEvaluacion() . "')"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO FLAG DE RESULTADO DE LA OPERACION
//LIBERANDO RECURSOS
            mysqli_close($cnx);


            return $exito; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que actualiza un registro de la tabla funcionamiento academico
     * @param type $funcionamientoAcademico
     * @return type
     */
    public function actualizarFuncionamientoAcademico($funcionamientoAcademico) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "UPDATE funcionamiento_academico SET focalizacion='" . $funcionamientoAcademico->getFocalizacion() . "',apertura_aprendizaje='" . $funcionamientoAcademico->getAperturaAprendizaje() . "',"
                    . "c_rol_tarea='" . $funcionamientoAcademico->getCRolTarea() . "',comprension='" . $funcionamientoAcademico->getComprension() . "',id_evaluacion='" . $funcionamientoAcademico->getIdEvaluacion() . "' "
                    . " WHERE id_funcionamiento_acad='" . $funcionamientoAcademico->getIdFuncionamientoAcad() . "'"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO FLAG DE RESULTADO DE LA OPERACION
//LIBERANDO RECURSOS
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que obtiene un registro de funcionamiento academico por evaluacion
     * @param int $idEvaluacion id de la evaluacion
     * @return \FuncionamientoAcademico Retorna un objeto con los resultados
     */
    public function getFuncionamientoAcademicoPorEvaluacion($idEvaluacion) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM funcionamiento_academico WHERE id_evaluacion='$idEvaluacion'"; //QUERY
            $rs = mysqli_query($cnx, $sql);

//OBTENIENDO RESULTADOS
            while ($r = mysqli_fetch_array($rs)) {
//instanceando y seteando objetos
                $funcionamientoAcad = new FuncionamientoAcademico();
                $funcionamientoAcad->setIdFuncionamientoAcad($r['id_funcionamiento_acad']);
                $funcionamientoAcad->setFocalizacion($r['focalizacion']);
                $funcionamientoAcad->setAperturaAprendizaje($r['apertura_aprendizaje']);
                $funcionamientoAcad->setCRolTarea($r['c_rol_tarea']);
                $funcionamientoAcad->setComprension($r['comprension']);
                $funcionamientoAcad->setIdEvaluacion($r['id_evaluacion']);
            }
//LIBERANDO RECURSOS
            mysqli_close($cnx);
            mysqli_free_result($rs);


            return $funcionamientoAcad; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function getFuncionamientoAcademicoPorCursoYFecha($idCurso, $fechaEvaluacion) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT fa.id_funcionamiento_acad,fa.focalizacion,fa.apertura_aprendizaje,fa.c_rol_tarea,"
                    . "fa.comprension,id_evaluacion"
                    . " FROM funcionamiento_academico fa JOIN evaluacion e USING(id_evaluacion) JOIN alumno al USING(id_alumno) "
                    . " WHERE al.id_curso = '$idCurso' AND e.fecha_evaluacion = '$fechaEvaluacion'"; //QUERY
            $rs = mysqli_query($cnx, $sql);
            $funcionamientosA = array();

            while ($r = mysqli_fetch_array($rs)) {
                //instanceando y seteando objeto
                $funcionamientoAcad = new FuncionamientoAcademico();
                $funcionamientoAcad->setIdFuncionamientoAcad($r['id_funcionamiento_acad']);
                $funcionamientoAcad->setFocalizacion($r['focalizacion']);
                $funcionamientoAcad->setAperturaAprendizaje($r['apertura_aprendizaje']);
                $funcionamientoAcad->setCRolTarea($r['c_rol_tarea']);
                $funcionamientoAcad->setComprension($r['comprension']);
                $funcionamientoAcad->setIdEvaluacion($r['id_evaluacion']);


                array_push($funcionamientosA, $funcionamientoAcad);
            }

            //LIBERANDO RECURSOS
            mysqli_close($cnx);
            mysqli_free_result($rs);


            return $funcionamientosA; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que calcula el promedio de funcionamiento academico
     * @param array $funcionamientosAcad Variable que contiene obj del tipo FuncionamientoAcademico
     * @return array Retorna un array asociativo con los resultados de la operación
     */
    function calcularPromediosFuncionamientoAcad($funcionamientosAcad) {
        try {
            $focalizacion = 0;
            $aperturaApren = 0;
            $cumplimientoRolTarea = 0;
            $comprension = 0;
            $total = count($funcionamientosAcad);

            //sumando valores por atributo
            foreach ($funcionamientosAcad as $fa) {
                $focalizacion+=$fa->getFocalizacion();
                $aperturaApren+=$fa->getAperturaAprendizaje();
                $cumplimientoRolTarea+=$fa->getCRolTarea();
                $comprension+=$fa->getComprension();
            }
            //promedios por atributos
            $focalizacionPromedio = $focalizacion / $total;
            $aperturaAprenPromedio = $aperturaApren / $total;
            $cumplimientoRolTareaPromedio = $cumplimientoRolTarea / $total;
            $comprensionPromedio = $comprension / $total;
            //Calculando promedio general
            $promedioGeneral = ($focalizacionPromedio + $aperturaAprenPromedio + $cumplimientoRolTareaPromedio + $comprensionPromedio) / 4;

            $resultados = array("focalizacion" => $focalizacionPromedio, "aperturaAprend" => $aperturaAprenPromedio,
                "cumplimientoRolTarea" => $cumplimientoRolTareaPromedio, "comprension" => $comprensionPromedio,
                "promedioGeneral" => $promedioGeneral); //array asociativo con los resultados

            return $resultados; //RETORNANDO LOS RESULTADOS DE LA OPERACION
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function obtenerClasificacionPorPromedioFA($funcionamientoA) {
        try {
            //iniciaizando variables
            $focalizacion = $funcionamientoA->getFocalizacion();
            $aperturaApren = $funcionamientoA->getAperturaAprendizaje();
            $cumplimientoRolTarea = $funcionamientoA->getCRolTarea();
            $comprension = $funcionamientoA->getComprension();


            $clasificacionF = "";
            $clasificacionA = "";
            $clasificacionCU = "";
            $clasificacionCO = "";

            //CLASIFICACIONES
            //PARTICIPACION
            if ($focalizacion <= 7 && $focalizacion >= 6) {
                $clasificacionF = "Centrado en la tarea.";
            } else {
                if ($focalizacion < 6 && $focalizacion >= 4) {
                    $clasificacionF = "Desatiende el trabajo en curso.";
                } else {
                    $clasificacionF = "Centrado en cosas externas o irrelevantes, distrae, interfiere.";
                }
            }

            //COOPERACION
            if ($aperturaApren <= 7 && $aperturaApren >= 5.75) {
                $clasificacionA = "Motivado.";
            } else {
                if ($aperturaApren < 5.75 && $aperturaApren >= 4) {
                    $clasificacionA = "Requiere que lo asistan, evitador.";
                } else {
                    $clasificacionA = "Resistente, cerrado o rechazante.";
                }
            }

            //REGULACION CONDUCTUAL
            if ($cumplimientoRolTarea <= 7 && $cumplimientoRolTarea >= 5.75) {
                $clasificacionCU = "Responsable, se hace cargo, responde.";
            } else {
                if ($cumplimientoRolTarea < 5.75 && $cumplimientoRolTarea >= 4) {
                    $clasificacionCU = "Trabaja pero de manera poco prolija o incompleta.";
                } else {
                    $clasificacionCU = "No asume su rol o tarea., no cumple.";
                }
            }


            //REGULACION DE LA ATENCION
            if ($comprension <= 7 && $comprension >= 5.75) {
                $clasificacionCO = "Logra comprensión y lo demuestra";
            } else {
                if ($comprension < 5.75 && $comprension >= 4) {
                    $clasificacionCO = "Comprensión débil o incompleta";
                } else {
                    $clasificacionCO = "No logra integrar el aprendizaje";
                }
            }


            $resultados = array("clasificacionF" => $clasificacionF, "clasificacionA" => $clasificacionA,
                "clasificacionCU" => $clasificacionCU, "clasificacionCO" => $clasificacionCO);

            return $resultados;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Método que calcula el promedio de un registro de Fncionamiento Academico
     * @param FuncionamientoInteraccional $funcionamientoA objeto con los valores a promediar
     * @return int Retorna el promedio final
     */
    function calcularPromedioFuncionamientoA($funcionamientoA) {
        try {

            //calculando promedio final
            $promedioFinal = ($funcionamientoA->getAperturaAprendizaje() + $funcionamientoA->getCRolTarea() + $funcionamientoA->getComprension() + $funcionamientoA->getFocalizacion()) / 4;
            //CALCULANDO PROMEDIO
        } catch (Exception $exc) {
            $promedioFinal = 1;
        }
        return $promedioFinal; //RETORNANDO RESULTADOS
    }

}
