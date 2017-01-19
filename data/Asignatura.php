<?php

/**
 * Description of Asignatura
 *
 * @author vfernandez
 */
require_once 'Conexion.php';

class Asignatura {

    private $idAsignatura;
    private $asignatura;

    public function __construct() {
        
    }

    function getIdAsignatura() {
        return $this->idAsignatura;
    }

    function getAsignatura() {
        return $this->asignatura;
    }

    function setIdAsignatura($idAsignatura) {
        $this->idAsignatura = $idAsignatura;
    }

    function setAsignatura($asignatura) {
        $this->asignatura = $asignatura;
    }

    /**
     * Método que ingresa un registro de Asignatura en la BD
     * @param String $nombreAsignatura Nombre de la asignatura
     * @return int Retorna 1 si la operaciones es correcta, -1 si no lo es
     */
    public function ingresarAsignatura($nombreAsignatura) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "INSERT INTO asignatura(asignatura) "
                    . "VALUES('$nombreAsignatura')"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //RESPUESTA SEGUN RESULTADO DE LA QUERY
            //LIBERANDO RECURSOS
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que actualizar un registro de asignatura
     * @param int $idAsignatura id de la asignatura
     * @param String $nombreAsignatura Nombre de la asignatura
     * @return int Retorna 1 si la operaciones es correcta, -1 si no lo es
     */
    public function actualizarAsignatura($idAsignatura, $nombreAsignatura) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "UPDATE asignatura SET asignatura='$nombreAsignatura' WHERE id_asignatura='$idAsignatura'"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //RESPUESTA SEGUN RESULTADO DE LA QUERY
            //LIBERANDO RECURSOS
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que elimina un registro de la tabla asignatura
     * @param int $idAsignatura id de la asignatura a eliminar
     * @return int Retorna 1 si la operaciones es correcta, -1 si no lo es
     */
    public function eliminarAsignatura($idAsignatura) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "DELETE FROM asignatura WHERE id_asignatura='$idAsignatura'"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //RESPUESTA SEGUN RESULTADO DE LA QUERY
            //LIBERANDO RECURSOS
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que retorna todos los registros de asignaturas presentes en la BD
     * @return array Retorna un array con los resultados
     */
    public function getAsignaturas() {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM asignatura ORDER BY asignatura"; //QUERY
            $rs = mysqli_query($cnx, $sql);
            $asignaturas = array();

            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO EL OBJETO
                $asignatura = new Asignatura();
                $asignatura->setIdAsignatura($r['id_asignatura']);
                $asignatura->setAsignatura($r['asignatura']);

                array_push($asignaturas, $asignatura); //AGREGANDO EL OBJETO AL ARRAY
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $asignaturas; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }
    
    
    /**
     * Método que obtiene una asignatura segun su id
     * @param int $idAsignatura id de la asignatura
     * @return \Asignatura Retorna un objeto del tipo Asignatura
     */
    public function getAsignaturaPorId($idAsignatura) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM asignatura WHERE id_asignatura='$idAsignatura'"; //QUERY
            $rs = mysqli_query($cnx, $sql);            

            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO EL OBJETO
                $asignatura = new Asignatura();
                $asignatura->setIdAsignatura($r['id_asignatura']);
                $asignatura->setAsignatura($r['asignatura']);               
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $asignatura; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }
    

}
