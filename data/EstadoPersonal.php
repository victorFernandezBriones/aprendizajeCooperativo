<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EstadoPersonal
 *
 * @author vfernandez
 */
require_once 'Conexion.php';

class EstadoPersonal {

    private $idEstadoPersonal;
    private $rEmocional;
    private $rAnimica;
    private $rConducta;
    private $rAtencion;
    private $caracter;
    private $idEvaluacion;

    public function __construct() {
        
    }

    function getIdEstadoPersonal() {
        return $this->idEstadoPersonal;
    }

    function getREmocional() {
        return $this->rEmocional;
    }

    function getRAnimica() {
        return $this->rAnimica;
    }

    function getRConducta() {
        return $this->rConducta;
    }

    function getRAtencion() {
        return $this->rAtencion;
    }

    function getCaracter() {
        return $this->caracter;
    }

    function getIdEvaluacion() {
        return $this->idEvaluacion;
    }

    function setIdEstadoPersonal($idEstadoPersonal) {
        $this->idEstadoPersonal = $idEstadoPersonal;
    }

    function setREmocional($rEmocional) {
        $this->rEmocional = $rEmocional;
    }

    function setRAnimica($rAnimica) {
        $this->rAnimica = $rAnimica;
    }

    function setRConducta($rConducta) {
        $this->rConducta = $rConducta;
    }

    function setRAtencion($rAtencion) {
        $this->rAtencion = $rAtencion;
    }

    function setCaracter($caracter) {
        $this->caracter = $caracter;
    }

    function setIdEvaluacion($idEvaluacion) {
        $this->idEvaluacion = $idEvaluacion;
    }

    /**
     * Método que ingresa un registro en la tabla estado personal
     * @param EstadoPersonal $estadoPersonal Objeto con los atributos a ingresar
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function ingresarEstadoPersonal($estadoPersonal) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "INSERT INTO estado_personal(r_emocional,r_animica,r_conducta,r_atencion,caracter,id_evaluacion) "
                    . "VALUES('" . $estadoPersonal->getREmocional() . "','" . $estadoPersonal->getRAnimica() . "','" . $estadoPersonal->getRConducta() . "',"
                    . "'" . $estadoPersonal->getRAtencion() . "','" . $estadoPersonal->getCaracter() . "','" . $estadoPersonal->getIdEvaluacion() . "')"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO FLAG DE RESULTADO DE LA OPERACION
            //LIBERANDO RECURSOS
            mysqli_close($cnx);


            return $exito; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que actualiza un registro de la tabla estado personal
     * @param EstadoPersonal $estadoPersonal Objeto con los atributos a actualizar
     * @return int Retorna 1 si la operación es correcta, -1 si no lo es
     */
    public function actualizarEstadoPersonal($estadoPersonal) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "UPDATE estado_personal SET r_emocional='" . $estadoPersonal->getREmocional() . "',r_animica='" . $estadoPersonal->getRAnimica() . "',"
                    . "r_conducta='" . $estadoPersonal->getRConducta() . "',r_atencion='" . $estadoPersonal->getRAtencion() . "',caracter='" . $estadoPersonal->getCaracter() . "',"
                    . "id_evaluacion ='" . $estadoPersonal->getIdEvaluacion() . "' WHERE id_estado_personal='" . $estadoPersonal->getIdEstadoPersonal() . "'"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO FLAG DE RESULTADO DE LA OPERACION
            //LIBERANDO RECURSOS
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que obtiene un registro de estado personal segun evaluación
     * @param int $idEvaluacion id de la evaluación
     * @return \EstadoPersonal Retorna un objeto con los resultados
     */
    public function getEstadoPersonalPorEvaluacion($idEvaluacion) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM estado_personal WHERE id_evaluacion ='$idEvaluacion'";
            $rs = mysqli_query($cnx, $sql);

            //OBTENIENDO RESULTADOS
            while ($r = mysqli_fetch_array($rs)) {

                $estadoPersonal = new EstadoPersonal();

                $estadoPersonal->setIdEstadoPersonal($r['id_estado_personal']);
                $estadoPersonal->setREmocional($r['r_emocional']);
                $estadoPersonal->setRAnimica($r['r_animica']);
                $estadoPersonal->setRConducta($r['r_conducta']);
                $estadoPersonal->setRAtencion($r['r_atencion']);
                $estadoPersonal->setCaracter($r['caracter']);
                $estadoPersonal->setIdEvaluacion($r['id_evaluacion']);
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $estadoPersonal; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {

            echo $exc->getMessage();
        }
    }

    /**
     * Método que calcula los promedios de las evaluaciones personales
     * @param array $estadosPersonales array con las evaluaciones personales
     * @return array Retorna un array asociativo con los resultados
     */
    public function calcularPromedioEstadoPersonal($estadosPersonales) {
        try {
            $rEmocional = 0;
            $rAnimica = 0;
            $rConducta = 0;
            $rAtencion = 0;
            $caracter = 0;
            $total = count($estadosPersonales);

            foreach ($estadosPersonales as $ep) {
                //SUMANDO RESULTADOS
                $rEmocional+=$ep->getREmocional();
                $rAnimica+=$ep->getRAnimica();
                $rConducta+=$ep->getRConducta();
                $rAtencion+=$ep->getRAtencion();
                $caracter += $ep->getCaracter();
            }

            //PROMEDIOS
            $rEmocionalPromedio = $rEmocional / $total;
            $rAnimicaPromedio = $rAnimica / $total;
            $rConductaPromedio = $rConducta / $total;
            $rAtencionPromedio = $rAtencion / $total;
            $caracterPromedio = $caracter / $total;

            $promedioGeneral = ($rEmocionalPromedio + $rAnimicaPromedio + $rConductaPromedio + $rAtencionPromedio + $caracterPromedio) / 5; //calculando promedio general
            //resultados
            $resultados = array("rEmocional" => $rEmocionalPromedio, "rAnimica" => $rAnimicaPromedio, "rConductual" => $rConductaPromedio,
                "rAtencion" => $rAtencionPromedio, "caracter" => $caracterPromedio, "promedioGeneral" => $promedioGeneral);

            return $resultados; //retornando array asociativo con los resultados
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Método que obtiene la clasificacion del alumno segun promedio
     * @param EstadoPersonal $estadoPersonal Objeto con los promedios por atributo
     * @return Array Retorna un array asociativo con las clasificaciones
     */
    public function obtenerClasificacionPorPromedioEP($estadoPersonal) {
        try {
            //iniciaizando variables
            $rAnimica = $estadoPersonal->getRAnimica();
            $rEmocional = $estadoPersonal->getREmocional();
            $rConductal = $estadoPersonal->getRConducta();
            $rAtencion = $estadoPersonal->getRAtencion();
            $caracter = $estadoPersonal->getCaracter();

            $clasificacionRA = "";
            $clasificacionRE = "";
            $clasificacionRC = "";
            $clasificacionRAT = "";
            $clasificacionC = "";

            //CLASIFICACIONES
            //REGULACION ANIMICA
            if ($rAnimica <= 7 && $rAnimica >= 5.75) {
                $clasificacionRA = "Buen ánimo";
            } else {
                if ($rAnimica < 5.75 && $rAnimica >= 4) {
                    $clasificacionRA = "Decaimiento o desmotivación";
                } else {
                    $clasificacionRA = "Introversión o abulia";
                }
            }

            //REGULACION EMOCIONAL
            if ($rEmocional <= 7 && $rEmocional >= 5.75) {
                $clasificacionRE = "Estabilidad";
            } else {
                if ($rEmocional < 5.75 && $rEmocional >= 4) {
                    $clasificacionRE = "Irritabilidad o hipersensibilidad";
                } else {
                    $clasificacionRE = "Descontrol emocional";
                }
            }

            //REGULACION CONDUCTUAL
            if ($rConductal <= 7 && $rConductal >= 5.75) {
                $clasificacionRC = "Tranquilidad";
            } else {
                if ($rConductal < 5.75 && $rConductal >= 4) {
                    $clasificacionRC = "Inquietud";
                } else {
                    $clasificacionRC = "Descontrol, verbal o conductual";
                }
            }


            //REGULACION DE LA ATENCION
            if ($rAtencion <= 7 && $rAtencion >= 5.75) {
                $clasificacionRAT = "Atento";
            } else {
                if ($rAtencion < 5.75 && $rAtencion >= 4) {
                    $clasificacionRAT = "Distráctil";
                } else {
                    $clasificacionRAT = "Disperso";
                }
            }

            //REGULACION DE LA ATENCION
            if ($caracter <= 7 && $caracter >= 5.75) {
                $clasificacionC = "Ajustado";
            } else {
                if ($caracter < 5.75 && $caracter >= 4) {
                    $clasificacionC = "Actitudes inadecuadas";
                } else {
                    $clasificacionC = "Inmoderado, Manipulación";
                }
            }

            $resultados = array("clasificacionRA" => $clasificacionRA, "clasificacionRE" => $clasificacionRE,
                "clasificacionRC" => $clasificacionRC, "clasificacionRAT" => $clasificacionRAT, "clasificacionC" => $clasificacionC);

            return $resultados;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Método que calcula el promedio de un registro de Estado Personal
     * @param FuncionamientoInteraccional $estadoP objeto con los valores a promediar
     * @return int Retorna el promedio final
     */
    function calcularPromedioEstadoP($estadoP) {
        try {

            //calculando promedio final
            $promedioFinal = ($estadoP->getCaracter() + $estadoP->getRAnimica() + $estadoP->getRAtencion() + $estadoP->getRConducta() + $estadoP->getREmocional()) / 5;


            //CALCULANDO PROMEDIO
        } catch (Exception $exc) {
            $promedioFinal = 1;
        }

        return $promedioFinal; //RETORNANDO RESULTADOS
    }

    public function getEstadosPersonalesPorFechaYcurso($idCurso, $fechaEvaluacion) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT r_animica,r_emocional,r_conducta,r_atencion,caracter FROM estado_personal EP JOIN evaluacion e USING(id_evaluacion) "
                    . "JOIN alumno a USING(id_alumno) WHERE e.fecha_evaluacion ='$fechaEvaluacion' AND a.id_curso='$idCurso' ";
            $rs = mysqli_query($cnx, $sql);
            $estadosPersonales = array();
            //OBTENIENDO RESULTADOS
            while ($r = mysqli_fetch_array($rs)) {

                $estadoPersonal = new EstadoPersonal();


                $estadoPersonal->setREmocional($r['r_emocional']);
                $estadoPersonal->setRAnimica($r['r_animica']);
                $estadoPersonal->setRConducta($r['r_conducta']);
                $estadoPersonal->setRAtencion($r['r_atencion']);
                $estadoPersonal->setCaracter($r['caracter']);

                array_push($estadosPersonales, $estadoPersonal);
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $estadosPersonales; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {

            echo $exc->getMessage();
        }
    }

}
