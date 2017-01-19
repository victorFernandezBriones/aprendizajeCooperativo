<?php

/**
 * Description of EstadoUsuario
 *
 * @author vfernandez
 */
require_once 'Conexion.php';

class EstadoUsuario {

    private $idEstadoUsuario;
    private $estadoUsuario;

    public function __construct() {
        
    }

    function getIdEstadoUsuario() {
        return $this->idEstadoUsuario;
    }

    function getEstadoUsuario() {
        return $this->estadoUsuario;
    }

    function setIdEstadoUsuario($idEstadoUsuario) {
        $this->idEstadoUsuario = $idEstadoUsuario;
    }

    function setEstadoUsuario($estadoUsuario) {
        $this->estadoUsuario = $estadoUsuario;
    }

    
    /**
     * Método que obtiene todos los estados de usuario presentes en la BD
     * @return array Retorna un array con los resultados obtenidos
     */
    public function getEstadosUsuarios() {
        try {
            $serviceCnx = new Conexion();//SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar();//LINK DE LA CONEXION
            $sql = "SELECT * FROM estado_usuario";//QUERY
            $estadosUsuarios = array();//ARRAY PARA ALMACENAR LOS RESULTADOS
            $rs = mysqli_query($cnx, $sql); //RESULTSET

            while ($r = mysqli_fetch_array($rs)) {//OBTENIENDO LOS RESULTADOS
                //INSTANCEANDO Y SETEANDO LOS OBJETOS
                $estadoUsuario = new EstadoUsuario();
                $estadoUsuario->setIdEstadoUsuario($r['id_estado_usuario']);
                $estadoUsuario->setEstadoUsuario($r['estado_usuario']);

                array_push($estadosUsuarios, $estadoUsuario);//INGRESANDO OBJ AL ARRAY
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $estadosUsuarios;//RETORNANDO RESULTADOS
            
        } catch (Exception $ex) {
            echo $ex->getMessage();//MENSAJE DE EXCEPCION
        }
    }

}
