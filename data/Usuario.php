<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author vfernandez
 */
require_once 'Conexion.php';

class Usuario {

    private $idUsuario;
    private $nombreUsuario;
    private $apellidoPUsuario;
    private $apellidoMUsuario;
    private $usuario;
    private $contrasena;
    private $email;
    private $idTipoUsuario;
    private $idEstadoUsuario;
    private $idSede;

    public function __construct() {
        
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    function getApellidoPUsuario() {
        return $this->apellidoPUsuario;
    }

    function getApellidoMUsuario() {
        return $this->apellidoMUsuario;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getContrasena() {
        return $this->contrasena;
    }

    function getEmail() {
        return $this->email;
    }

    function getIdTipoUsuario() {
        return $this->idTipoUsuario;
    }

    function getIdEstadoUsuario() {
        return $this->idEstadoUsuario;
    }

    function getIdSede() {
        return $this->idSede;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    function setApellidoPUsuario($apellidoPUsuario) {
        $this->apellidoPUsuario = $apellidoPUsuario;
    }

    function setApellidoMUsuario($apellidoMUsuario) {
        $this->apellidoMUsuario = $apellidoMUsuario;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setIdTipoUsuario($idTipoUsuario) {
        $this->idTipoUsuario = $idTipoUsuario;
    }

    function setIdEstadoUsuario($idEstadoUsuario) {
        $this->idEstadoUsuario = $idEstadoUsuario;
    }

    function setIdSede($idSede) {
        $this->idSede = $idSede;
    }

    /**
     * Método que inserta un registro en la tabla usuario 
     * @param Obj $usuario Objeto con los atributos a ingresar en la BD
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function ingresarUsuario($usuario) {
        try {
            $serviceCnx = new Conexion(); //servicio de conexion
            $cnx = $serviceCnx->conectar(); //link de conexion
            $sql = "INSERT INTO usuario(nombre_usuario,apellidoP_usuario,apellidoM_usuario,usuario,contrasena,email,id_tipo_usuario,id_estado_usuario,id_sede) "
                    . "VALUES('" . $usuario->getNombreUsuario() . "','" . $usuario->getApellidoPUsuario() . "','" . $usuario->getApellidoMUsuario() . "','" . $usuario->getUsuario() . "',"
                    . "'" . $usuario->getContrasena() . "','" . $usuario->getEmail() . "','" . $usuario->getIdTipoUsuario() . "','" . $usuario->getIdEstadoUsuario() . "','" . $usuario->getIdSede() . "')"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO FLAG
//liberando recursos
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Método que actualiza un usuario de la BD
     * @param Obj $usuario Usuario con los atributos a actualizar
     * @param int $flag flag para seleccionar la query de la actualizacion
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function actualizarUsuario($usuario, $flag) {
        try {
            $serviceCnx = new Conexion(); //servicio de conexion
            $cnx = $serviceCnx->conectar(); //link de conexion

            switch ($flag) {

                case 1://ACTUALIZACION DESDE MODULO CONFIG
                    $sql = "UPDATE usuario SET id_estado_usuario='" . $usuario->getIdEstadoUsuario() . "',id_tipo_usuario='" . $usuario->getIdTipoUsuario() . "',"
                            . "id_sede='" . $usuario->getIdSede() . "' WHERE id_usuario ='" . $usuario->getIdUsuario() . "'"; //QUERY
                    break;


                case 2://ACTUALIZACION DESDE PERFIL PERSONAL
                    $sql = "UPDATE usuario SET nombre_usuario='" . $usuario->getNombreUsuario() . "', apellidoP_usuario='" . $usuario->getApellidoPUsuario() . "',"
                            . "apellidoM_usuario='" . $usuario->getApellidoMUsuario() . "', email='" . $usuario->getEmail() . "'  "
                            . "WHERE id_usuario ='" . $usuario->getIdUsuario() . "'"; //QUERY

                    break;

                case 3://ACTUALIZAR CONTRASEÑA
                    $sql = "UPDATE usuario SET contrasena='" . $usuario->getContrasena() . "' WHERE id_usuario ='" . $usuario->getIdUsuario() . "'";
                    break;
            }


            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO FLAG
            //liberando recursos
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Método que elimina un usuario de la BD
     * @param int $idUsuario id del usuario
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function eliminarUsuario($idUsuario) {
        try {
            $serviceCnx = new Conexion(); //servicio de conexion
            $cnx = $serviceCnx->conectar(); //link de conexion
            $sql = "DELETE FROM usuario WHERE id_usuario = '$idUsuario'"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO FLAG
            //liberando recursos
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Método que obtiene un usuario por id
     * @param int $idUsuario id del usuario
     * @return \Usuario Retorna un obj usuario con todos sus atributos
     */
    public function getUsuarioPorID($idUsuario) {
        try {
            $serviceCnx = new Conexion(); //servicio de conexion
            $cnx = $serviceCnx->conectar(); //link de conexion
            $sql = "SELECT * FROM usuario WHERE id_usuario = '$idUsuario'"; //QUERY
            $rs = mysqli_query($cnx, $sql);

            while ($r = mysqli_fetch_array($rs)) {
                $usuario = new Usuario();
                $usuario->setIdUsuario($r['id_usuario']);
                $usuario->setNombreUsuario($r['nombre_usuario']);
                $usuario->setApellidoPUsuario($r['apellidoP_usuario']);
                $usuario->setApellidoMUsuario($r['apellidoM_usuario']);
                $usuario->setUsuario($r['usuario']);
                $usuario->setContrasena($r['contrasena']);
                $usuario->setEmail($r['email']);
                $usuario->setIdTipoUsuario($r['id_tipo_usuario']);
                $usuario->setIdEstadoUsuario($r['id_estado_usuario']);
                $usuario->setIdSede($r['id_sede']);
            }


            //liberando recursos
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $usuario; //RETORNANDO RESULTADO
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Método que obtiene todos los usuarios de la BD
     * @return array Retorna un array con los usuarios
     */
    public function getUsuarios() {
        try {
            $serviceCnx = new Conexion(); //servicio de conexion
            $cnx = $serviceCnx->conectar(); //link de conexion
            $sql = "SELECT * FROM usuario"; //QUERY
            $rs = mysqli_query($cnx, $sql);
            $usuarios = array();

            while ($r = mysqli_fetch_array($rs)) {
                $usuario = new Usuario();
                $usuario->setIdUsuario($r['id_usuario']);
                $usuario->setNombreUsuario($r['nombre_usuario']);
                $usuario->setApellidoPUsuario($r['apellidoP_usuario']);
                $usuario->setApellidoMUsuario($r['apellidoM_usuario']);
                $usuario->setUsuario($r['usuario']);
                $usuario->setContrasena($r['contrasena']);
                $usuario->setEmail($r['email']);
                $usuario->setIdTipoUsuario($r['id_tipo_usuario']);
                $usuario->setIdEstadoUsuario($r['id_estado_usuario']);
                $usuario->setIdSede($r['id_sede']);

                array_push($usuarios, $usuario);
            }


            //liberando recursos
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $usuarios; //RETORNANDO RESULTADO
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Método que verifica el login y retorna un obj usuario
     * @param int $usuario nombre de usuario
     * @param type $contrasena contrasena de la cuenta
     * @return \Usuario Retorna un obj usuario con todos sus atributos
     */
    public function verificarLogin($user, $contrasena) {
        try {
            $serviceCnx = new Conexion(); //servicio de conexion
            $cnx = $serviceCnx->conectar(); //link de conexion
            $sql = "SELECT * FROM usuario WHERE usuario = '$user' AND contrasena = '$contrasena' AND id_estado_usuario = 1"; //QUERY
            $rs = mysqli_query($cnx, $sql);

            $usuario = "";
            while ($r = mysqli_fetch_array($rs)) {

                $usuario = new Usuario();
                $usuario->setIdUsuario($r['id_usuario']);
                $usuario->setNombreUsuario($r['nombre_usuario']);
                $usuario->setApellidoPUsuario($r['apellidoP_usuario']);
                $usuario->setApellidoMUsuario($r['apellidoM_usuario']);
                $usuario->setUsuario($r['usuario']);
                $usuario->setContrasena($r['contrasena']);
                $usuario->setEmail($r['email']);
                $usuario->setIdTipoUsuario($r['id_tipo_usuario']);
                $usuario->setIdEstadoUsuario($r['id_estado_usuario']);
                $usuario->setIdSede($r['id_sede']);
            }


            //liberando recursos
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $usuario; //RETORNANDO RESULTADO            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Método que verifica los campos únicos
     * @param String $nombreUsuario Nombre de usuario a verificar
     * @param String $correo Correo a verificar
     * @param int $flag flag para definir la acción
     * @return int retorna la cantidad de filas afectadas por la query
     */
    public function verificarCamposUnicos($nombreUsuario, $correo, $flag) {
        try {
            $serviceCnx = new Conexion(); //servicio de conexion
            $cnx = $serviceCnx->conectar(); //link de conexion

            switch ($flag) {

                case 1: //NOMBRE USUARIO
                    $sql = "SELECT * FROM usuario WHERE usuario = '$nombreUsuario'";

                    break;

                case 2://CORREO
                    $sql = "SELECT * FROM usuario WHERE email = '$correo'";
                    break;
                
                case 3://Contrasena
                    $contrasena = $nombreUsuario;
                    $sql = "SELECT * FROM usuario WHERE contrasena = '$contrasena'";
                    break;
            }

            $rs = mysqli_query($cnx, $sql);

            $filasAfectadas = mysqli_num_rows($rs);

            //liberando recursos
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $filasAfectadas; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

}
