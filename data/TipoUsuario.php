<?php

/**
 * Description of TipoUsuario
 *
 * @author vfernandez
 */
require_once 'Conexion.php';

class TipoUsuario {

    private $idTipoUsuario;
    private $tipoUsuario;

    public function __construct() {
        
    }

    function getIdTipoUsuario() {
        return $this->idTipoUsuario;
    }

    function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    function setIdTipoUsuario($idTipoUsuario) {
        $this->idTipoUsuario = $idTipoUsuario;
    }

    function setTipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }

    /**
     * Método que ingresa un registro de Tipo de usuario en la BD
     * @param String $tipoUsuario tipo de usuario a ingresar
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function ingresarTipoUsuario($tipoUsuario) {
        try {
            $serviceCnx = new Conexion(); //servicio para la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "INSERT INTO tipo_usuario(tipo_usuario) VALUES('$tipoUsuario')"; //query

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //dependiendo del resultado de la operacion asigno un numero
            //LIBERANDO RECURSOS

            mysqli_close($cnx);

            return $exito; //retornando resultado
        } catch (Exception $exc) {
            echo $exc->getMessage(); //mensaje de excepcion
        }
    }

    /**
     * Método que actualiza un registro de tipo de usuario en la BD
     * @param int $idTipoUsuario id del tipo de usuario
     * @param String $tipoUsuario nombre del tipo de usuario
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function actualizarTipoUsuario($idTipoUsuario, $tipoUsuario) {
        try {
            $serviceCnx = new Conexion(); //servicio para la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "UPDATE tipo_usuario SET tipo_usuario='$tipoUsuario' WHERE id_tipo_usuario='$idTipoUsuario'"; //query

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //dependiendo del resultado de la operacion asigno un numero
            //LIBERANDO RECURSOS

            mysqli_close($cnx);

            return $exito; //retornando resultado
        } catch (Exception $exc) {
            echo $exc->getMessage(); //mensaje de excepcion
        }
    }

    /**
     * Método que elimina un registro de la tabla Tipousuario
     * @param int  $idTipoUsuario id del tipo usuario a eliminar
     *  @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function eliminarTipoUsuario($idTipoUsuario) {
        try {
            $serviceCnx = new Conexion(); //servicio para la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "DELETE FROM tipo_usuario WHERE id_tipo_usuario='$idTipoUsuario'"; //query

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //dependiendo del resultado de la operacion asigno un numero
            //LIBERANDO RECURSOS

            mysqli_close($cnx);

            return $exito; //retornando resultado
        } catch (Exception $exc) {
            echo $exc->getMessage(); //mensaje de excepcion
        }
    }

    
    /**
     * Método que obtiene todos los tipos de usuarios presentes en la db
     * @return array Retorna un array con los resultados
     */
    public function getTipoDeUsuarios() {
        try {
            $serviceCnx = new Conexion(); //servicio para la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "SELECT * FROM tipo_usuario ORDER BY tipo_usuario"; //query
            $tiposUsuarios = array(); //array para almacenar los resultados
            $rs = mysqli_query($cnx, $sql); //resultset

            while ($r = mysqli_fetch_array($rs)) {//obteniendo resultados
                $tipoUsuario = new TipoUsuario(); //instanceando y seteando objeto
                $tipoUsuario->setIdTipoUsuario($r['id_tipo_usuario']);
                $tipoUsuario->setTipoUsuario($r['tipo_usuario']);

                array_push($tiposUsuarios, $tipoUsuario); //ingresando el objeto al array
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $tiposUsuarios; //retornando resultado
        } catch (Exception $exc) {
            echo $exc->getMessage(); //mensaje de excepcion
        }
    }

    /**
     * Método que obtiene un tipo de usuario por id
     * @param int $idTipoUsuario id del tipo de usuario
     * @return \TipoUsuario Retorna un obj tipo usuario
     */
    public function getTipoDeUsuarioPorId($idTipoUsuario) {
        try {
            $serviceCnx = new Conexion(); //servicio para la conexion
            $cnx = $serviceCnx->conectar(); //link de la conexion
            $sql = "SELECT * FROM tipo_usuario WHERE id_tipo_usuario = '$idTipoUsuario'"; //query
            
            $rs = mysqli_query($cnx, $sql); //resultset

            while ($r = mysqli_fetch_array($rs)) {//obteniendo resultados
                $tipoUsuario = new TipoUsuario(); //instanceando y seteando objeto
                $tipoUsuario->setIdTipoUsuario($r['id_tipo_usuario']);
                $tipoUsuario->setTipoUsuario($r['tipo_usuario']);                
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $tipoUsuario; //retornando resultado
            
        } catch (Exception $ex) {
            echo $ex->getMessage(); //mensaje de excepcion
        }
    }

}
