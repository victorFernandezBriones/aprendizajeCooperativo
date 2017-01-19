<?php

/**
 * Description of TipoEntidad
 *
 * @author vfernandez
 */
require_once 'Conexion.php';

class TipoEntidad {

    private $idTipoEntidad;
    private $tipoEntidad;

    public function __construct() {
        
    }

    function getIdTipoEntidad() {
        return $this->idTipoEntidad;
    }

    function getTipoEntidad() {
        return $this->tipoEntidad;
    }

    function setIdTipoEntidad($idTipoEntidad) {
        $this->idTipoEntidad = $idTipoEntidad;
    }

    function setTipoEntidad($tipoEntidad) {
        $this->tipoEntidad = $tipoEntidad;
    }

    /**
     * Método que inserta un registro en la tabl tipo_entidad
     * @param String $tipoEntidad nombre del tipo de entidad
     * @return int Retorna 1 si la operación es correcta, -1 si no lo es
     */
    public function ingresarTipoEntidad($tipoEntidad) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "INSERT INTO tipo_entidad(tipo_entidad) VALUES('$tipoEntidad')"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO VALOR DEPENDIENDO DEL RESULTADO DE LA OPERACION
            //LIBERANDO RECURSOS
            mysqli_close($cnx);


            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que actualiza un registro en la tabla tipo_entidad
     * @param int $idTipoEntidad id del tipo entidad
     * @param String $tipoEntidad nombre del tipo de entidad
     * @return int Retorna 1 si la operación es correcta, -1 si no lo es
     */
    public function actualizarTipoEntidad($idTipoEntidad, $tipoEntidad) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "UPDATE tipo_entidad SET tipo_entidad='$tipoEntidad' WHERE id_tipo_entidad='$idTipoEntidad'"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO VALOR DEPENDIENDO DEL RESULTADO DE LA OPERACION
            //LIBERANDO RECURSOS
            mysqli_close($cnx);


            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que elimina un registro de la tabla tipo_entidad
     * @param int $idTipoEntidad id de la entidad a eliminar
     * @return Retorna 1 si la operación es correcta, -1 si no lo es
     */
    public function eliminarTipoEntidad($idTipoEntidad) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "DELETE FROM tipo_entidad WHERE id_tipo_entidad='$idTipoEntidad'"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO VALOR DEPENDIENDO DEL RESULTADO DE LA OPERACION
            //LIBERANDO RECURSOS
            mysqli_close($cnx);


            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que obtiene todos los tipos de entidad almacenados en la BD
     * @return array Retorna un array con los resultados obtenidos
     */
    public function getTipoEntidades() {
        try {
            $serviceCnx = new Conexion(); //servicio para la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "SELECT * FROM tipo_entidad ORDER BY tipo_entidad"; //query
            $tipoEntidades = array(); //array para almacenar los resultados
            $rs = mysqli_query($cnx, $sql); //resultset

            while ($r = mysqli_fetch_array($rs)) {//obteniendo resultados
                $tipoEntidad = new TipoEntidad(); //instanceando y seteando objeto
                $tipoEntidad->setIdTipoEntidad($r['id_tipo_entidad']);
                $tipoEntidad->setTipoEntidad($r['tipo_entidad']);

                array_push($tipoEntidades, $tipoEntidad); //ingresando el objeto al array
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $tipoEntidades; //retornando resultado
        } catch (Exception $ex) {
            echo $ex->getMessage(); //mensaje de excepcion
        }
    }

    /**
     * Método que obtiene un tipo de entidad segun su id
     * @param int $idTipoEntidad id del tipo de entidad
     * @return \TipoEntidad Retorna un objeto con los resultados
     */
    public function getTipoEntidadPorId($idTipoEntidad) {
        try {
            $serviceCnx = new Conexion(); //servicio para la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "SELECT * FROM tipo_entidad WHERE id_tipo_entidad='$idTipoEntidad'"; //query            
            $rs = mysqli_query($cnx, $sql); //resultset

            while ($r = mysqli_fetch_array($rs)) {//obteniendo resultados
                $tipoEntidad = new TipoEntidad(); //instanceando y seteando objeto
                $tipoEntidad->setIdTipoEntidad($r['id_tipo_entidad']);
                $tipoEntidad->setTipoEntidad($r['tipo_entidad']);
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $tipoEntidad; //retornando resultado
        } catch (Exception $ex) {
            echo $ex->getMessage(); //mensaje de excepcion
        }
    }

}
