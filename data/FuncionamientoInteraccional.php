<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of funcionamientoInteraccional
 *
 * @author vfernandez
 */
require_once 'Conexion.php';

class FuncionamientoInteraccional {

    private $idFuncionamientoInteraccional;
    private $participacion;
    private $cooperacion;
    private $respeto;
    private $empatiaContacto;
    private $idEvaluacion;

    public function __construct() {
        
    }

    function getIdFuncionamientoInteraccional() {
        return $this->idFuncionamientoInteraccional;
    }

    function getParticipacion() {
        return $this->participacion;
    }

    function getCooperacion() {
        return $this->cooperacion;
    }

    function getRespeto() {
        return $this->respeto;
    }

    function getEmpatiaContacto() {
        return $this->empatiaContacto;
    }

    function getIdEvaluacion() {
        return $this->idEvaluacion;
    }

    function setIdFuncionamientoInteraccional($idFuncionamientoInteraccional) {
        $this->idFuncionamientoInteraccional = $idFuncionamientoInteraccional;
    }

    function setParticipacion($participacion) {
        $this->participacion = $participacion;
    }

    function setCooperacion($cooperacion) {
        $this->cooperacion = $cooperacion;
    }

    function setRespeto($respeto) {
        $this->respeto = $respeto;
    }

    function setEmpatiaContacto($empatiaContacto) {
        $this->empatiaContacto = $empatiaContacto;
    }

    function setIdEvaluacion($idEvaluacion) {
        $this->idEvaluacion = $idEvaluacion;
    }

    /**
     * Método que ingresa un registro en la table funcionamiento interaccional
     * @param FuncionamientoInteraccional $funcionamientoI Objeto con los datos a ingresar
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function ingresarFuncionamientoInteraccional($funcionamientoI) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "INSERT INTO funcionamiento_interaccional(participacion,cooperacion,respeto,empatia_contacto,id_evaluacion) "
                    . "VALUES('" . $funcionamientoI->getParticipacion() . "','" . $funcionamientoI->getCooperacion() . "','" . $funcionamientoI->getRespeto() . "',"
                    . "'" . $funcionamientoI->getEmpatiaContacto() . "','" . $funcionamientoI->getIdEvaluacion() . "')"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO FLAG DE RESULTADO DE LA OPERACION
            //LIBERANDO RECURSOS
            mysqli_close($cnx);


            return $exito; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que actualiza un registro en la tabla funcionamiento_interaccional
     * @param FuncionamientoInteraccional $funcionamientoI Objeto con los datos a entregar
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function actualizarFuncionamientoInteraccional($funcionamientoI) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "UPDATE funcionamiento_interaccional SET participacion='" . $funcionamientoI->getParticipacion() . "',cooperacion='" . $funcionamientoI->getCooperacion() . "',"
                    . "respeto='" . $funcionamientoI->getRespeto() . "',empatia_contacto='" . $funcionamientoI->getEmpatiaContacto() . "',id_evaluacion='" . $funcionamientoI->getIdEvaluacion() . "'"
                    . " WHERE id_funcionamiento_interaccional = '" . $funcionamientoI->getIdFuncionamientoInteraccional() . "'"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO FLAG DE RESULTADO DE LA OPERACION
            //LIBERANDO RECURSOS
            mysqli_close($cnx);


            return $exito; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que obtiene un registro de funcionamiento interaccional segun evaluacion
     * @param int $idEvaluacion id de la evaluacion
     * @return \funcionamientoInteraccional Retorna un obj con los resultados
     */
    public function getFuncionamientoInteraccionalPorEvaluacion($idEvaluacion) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM funcionamiento_interaccional WHERE id_evaluacion ='$idEvaluacion'"; //QUERY
            $rs = mysqli_query($cnx, $sql);

            while ($r = mysqli_fetch_array($rs)) {
                //instanceando y seteando objeto
                $funcionamientoI = new funcionamientoInteraccional();
                $funcionamientoI->setIdFuncionamientoInteraccional($r['id_funcionamiento_interaccional']);
                $funcionamientoI->setParticipacion($r['participacion']);
                $funcionamientoI->setCooperacion($r['cooperacion']);
                $funcionamientoI->setRespeto($r['respeto']);
                $funcionamientoI->setEmpatiaContacto($r['empatia_contacto']);
                $funcionamientoI->setIdEvaluacion($r['id_evaluacion']);
            }

            //LIBERANDO RECURSOS
            mysqli_close($cnx);
            mysqli_free_result($rs);


            return $funcionamientoI; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que obtiene los registros de Funcionamiento interaccional relacionados a un curso y una fecha
     * @param int $idCurso id del curso
     * @param date $fechaEvaluacion fecha de la evaluacion
     * @return array Retorna un array con los resultados
     */
    public function getFuncionamientoInteraccionalPorCursoYFecha($idCurso, $fechaEvaluacion) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT fi.id_funcionamiento_interaccional,fi.participacion,"
                    . "fi.cooperacion,fi.respeto,fi.empatia_contacto,id_evaluacion"
                    . " FROM funcionamiento_interaccional fi JOIN evaluacion e USING(id_evaluacion) JOIN alumno al USING(id_alumno) "
                    . " WHERE al.id_curso='$idCurso' AND e.fecha_evaluacion='$fechaEvaluacion'"; //QUERY
            $rs = mysqli_query($cnx, $sql);
            $funcionamientosI = array();

            while ($r = mysqli_fetch_array($rs)) {
                //instanceando y seteando objeto
                $funcionamientoI = new funcionamientoInteraccional();
                $funcionamientoI->setIdFuncionamientoInteraccional($r['id_funcionamiento_interaccional']);
                $funcionamientoI->setParticipacion($r['participacion']);
                $funcionamientoI->setCooperacion($r['cooperacion']);
                $funcionamientoI->setRespeto($r['respeto']);
                $funcionamientoI->setEmpatiaContacto($r['empatia_contacto']);
                $funcionamientoI->setIdEvaluacion($r['id_evaluacion']);

                array_push($funcionamientosI, $funcionamientoI);
            }

            //LIBERANDO RECURSOS
            mysqli_close($cnx);
            mysqli_free_result($rs);


            return $funcionamientosI; //RETORNANDO RESULTADOS
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * Método que calcula los promedios por item
     * @param array $funcionamientosI Array con todos los obj funcionamiento interaccional obtenidos en el informe
     * @return array Retorna un array asociativo con los promedio obtenidos por cada item y, tambien, el promedio final
     */
    function calcularPromediosFuncionamientoI($funcionamientosI) {
        try {
            //INICIALIZANDO VARIABLES
            $participacion = 0;
            $cooperacion = 0;
            $respeto = 0;
            $empatiaContacto = 0;
            $total = count($funcionamientosI);

            foreach ($funcionamientosI as $fi) {
                //SUMANDO RESULTADOS
                $participacion+=$fi->getParticipacion();
                $cooperacion+=$fi->getCooperacion();
                $respeto+=$fi->getRespeto();
                $empatiaContacto+=$fi->getEmpatiaContacto();
            }
            //calculando promedios por intems
            $participacionPromedio = $participacion / $total;
            $cooperacionPromedio = $cooperacion / $total;
            $respetoPromedio = $respeto / $total;
            $empatiaContactoPromedio = $empatiaContacto / $total;

            //calculando promedio final
            $promedioFinal = ($participacionPromedio + $cooperacionPromedio + $respetoPromedio + $empatiaContactoPromedio) / 4;
            //ingresando resultados a un array asociativo
            $resultados = array("participacionPromedio" => $participacionPromedio, "cooperacionPromedio" => $cooperacionPromedio,
                "respetoPromedio" => $respetoPromedio, "empatiaContactoPromedio" => $empatiaContactoPromedio, "promedioFinal" => $promedioFinal);



            return $resultados; //RETORNANDO RESULTADOS
            //CALCULANDO PROMEDIO
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Método que calcula el promedio de un registro de Fncionamiento interaccional
     * @param FuncionamientoInteraccional $funcionamientoI objeto con los valores a promediar
     * @return int Retorna el promedio final
     */
    function calcularPromedioFuncionamientoI($funcionamientoI) {
        try {
            //calculando promedio final
            $promedioFinal = ($funcionamientoI->getParticipacion() + $funcionamientoI->getCooperacion() + $funcionamientoI->getRespeto() + $funcionamientoI->getEmpatiaContacto()) / 4;
            //ingresando resultados a un array asociativo
        } catch (Exception $ex) {
            $promedioFinal = 1;
        }

        return $promedioFinal; //RETORNANDO RESULTADOS
    }

    /**
     * Método que obtiene la clasificacion del alumno segun promedio
     * @param EstadoPersonal $funcionamientoI Objeto con los promedios por atributo
     * @return Array Retorna un array asociativo con las clasificaciones
     */
    public function obtenerClasificacionPorPromedioFI($funcionamientoI) {
        try {
            //iniciaizando variables
            $participacion = $funcionamientoI->getParticipacion();
            $cooperacion = $funcionamientoI->getCooperacion();
            $respeto = $funcionamientoI->getRespeto();
            $empatiaC = $funcionamientoI->getEmpatiaContacto();


            $clasificacionP = "";
            $clasificacionC = "";
            $clasificacionR = "";
            $clasificacionE = "";

            //CLASIFICACIONES
            //PARTICIPACION
            if ($participacion <= 7 && $participacion >= 5.75) {
                $clasificacionP = "Involucramiento activo";
            } else {
                if ($participacion < 5.75 && $participacion >= 4) {
                    $clasificacionP = "Pasivo, poco comprometido";
                } else {
                    $clasificacionP = "Desligado, desconectado.";
                }
            }

            //COOPERACION
            if ($cooperacion <= 7 && $cooperacion >= 5.75) {
                $clasificacionC = "Colaborador  ";
            } else {
                if ($cooperacion < 5.75 && $cooperacion >= 4) {
                    $clasificacionC = "Conectado, pero descansa en el esfuerzo grupal";
                } else {
                    $clasificacionC = "Desinteresado en los demás y en la meta grupal";
                }
            }

            //REGULACION CONDUCTUAL
            if ($respeto <= 7 && $respeto >= 5.75) {
                $clasificacionR = "Respeta autoestima de los otros";
            } else {
                if ($respeto < 5.75 && $respeto >= 4) {
                    $clasificacionR = "Poco considerado";
                } else {
                    $clasificacionR = "Hostil, hiriente, violento";
                }
            }


            //REGULACION DE LA ATENCION
            if ($empatiaC <= 7 && $empatiaC >= 5.75) {
                $clasificacionE = "Afectuoso, cercano";
            } else {
                if ($empatiaC < 5.75 && $empatiaC >= 4) {
                    $clasificacionE = "Reservado";
                } else {
                    $clasificacionE = "Defensivo";
                }
            }


            $resultados = array("clasificacionP" => $clasificacionP, "clasificacionC" => $clasificacionC,
                "clasificacionR" => $clasificacionR, "clasificacionE" => $clasificacionE);

            return $resultados;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
