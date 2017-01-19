<?php

/**
 * Description of Sede
 *
 * @author vfernandez
 */
require_once 'Conexion.php';

class Sede {

    private $idSede;
    private $nombreSede;

    public function __construct() {
        
    }

    function getIdSede() {
        return $this->idSede;
    }

    function getNombreSede() {
        return $this->nombreSede;
    }

    function setIdSede($idSede) {
        $this->idSede = $idSede;
    }

    function setNombreSede($nombreSede) {
        $this->nombreSede = $nombreSede;
    }

    /**
     * Método que ingresa un registro de sede a la BD
     * @param String $nombreSede Nombre de la sede a crear
     * @return int Retorna un 1 si la operacion es correcta, -1 si no lo es
     */
    public function ingresarSede($nombreSede) {
        try {
            $serviceCnx = new Conexion(); //servicio para la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "INSERT INTO sede(nombre_sede) VALUES('$nombreSede')"; //query

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //dependiendo del resultado de la operacion asigno un numero
            //LIBERANDO RECURSOS

            mysqli_close($cnx);

            return $exito; //retornando resultado
        } catch (Exception $exc) {
            echo $exc->getMessage(); //mensaje de excepcion
        }
    }

    /**
     * Método que actualiza un registro de sede
     * @param int $idSede id de la sede
     * @param String $nombreSede Nombre actualizado
     * @return int Retorna un 1 si la operacion es correcta, -1 si no lo es
     */
    public function actualizarSede($idSede, $nombreSede) {
        try {
            $serviceCnx = new Conexion(); //servicio para la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "UPDATE sede SET nombre_sede='$nombreSede' WHERE id_sede='$idSede'"; //query

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //dependiendo del resultado de la operacion asigno un numero
            //LIBERANDO RECURSOS
            mysqli_close($cnx);

            return $exito; //retornando resultado
        } catch (Exception $exc) {
            echo $exc->getMessage(); //mensaje de excepcion
        }
    }

    /**
     * Método que elimina un registro de la tabla sede
     * @param int $idSede id de la sede    
     * @return int Retorna un 1 si la operacion es correcta, -1 si no lo es
     */
    public function eliminarSede($idSede) {
        try {
            $serviceCnx = new Conexion(); //servicio para la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "DELETE FROM sede WHERE id_sede='$idSede'"; //query

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //dependiendo del resultado de la operacion asigno un numero
            //LIBERANDO RECURSOS
            mysqli_close($cnx);

            return $exito; //retornando resultado
        } catch (Exception $exc) {
            echo $exc->getMessage(); //mensaje de excepcion
        }
    }

    /**
     * Método que obtiene todos los registros de sede
     * @return array Retorna un array con las sedes
     */
    public function getSedes() {
        try {
            $serviceCnx = new Conexion(); //servicio para la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "SELECT * FROM sede ORDER BY nombre_sede"; //query
            $sedes = array(); //array para almacenar los resultados
            $rs = mysqli_query($cnx, $sql); //resultset

            while ($r = mysqli_fetch_array($rs)) {//obteniendo resultados
                $sede = new Sede(); //instanceando y seteando objeto
                $sede->setIdSede($r['id_sede']);
                $sede->setNombreSede($r['nombre_sede']);

                array_push($sedes, $sede); //ingresando el objeto al array
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $sedes; //retornando resultado
        } catch (Exception $exc) {
            echo $exc->getMessage(); //mensaje de excepcion
        }
    }

    /**
     * Método que obtiene un registro de sede segun su id
     * @param int $idSede id de la sede a consutlar
     * @return \Sede Retorna un objeto Sede con la informacion requerida
     */
    public function getSedePorId($idSede) {
        try {
            $serviceCnx = new Conexion(); //servicio para la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "SELECT * FROM sede WHERE id_sede='$idSede'"; //query

            $rs = mysqli_query($cnx, $sql); //resultset

            while ($r = mysqli_fetch_array($rs)) {//obteniendo resultados
                $sede = new Sede(); //instanceando y seteando objeto
                $sede->setIdSede($r['id_sede']);
                $sede->setNombreSede($r['nombre_sede']);
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $sede; //retornando resultado
        } catch (Exception $exc) {
            echo $exc->getMessage(); //mensaje de excepcion
        }
    }

}
