<?php

/**
 * Description of Entidad
 *
 * @author vfernandez
 */
require_once 'Conexion.php';

class Entidad {

    private $idEntidad;
    private $nombreEntidad;
    private $apellidoPEntidad;
    private $apellidoMEntidad;
    private $celular;
    private $telefonoFijo;
    private $email;
    private $idTipoEntidad;
    private $idAlumno;

    public function __construct() {
        
    }

    function getIdEntidad() {
        return $this->idEntidad;
    }

    function getNombreEntidad() {
        return $this->nombreEntidad;
    }

    function getApellidoPEntidad() {
        return $this->apellidoPEntidad;
    }

    function getApellidoMEntidad() {
        return $this->apellidoMEntidad;
    }

    function getCelular() {
        return $this->celular;
    }

    function getTelefonoFijo() {
        return $this->telefonoFijo;
    }

    function getEmail() {
        return $this->email;
    }

    function getIdTipoEntidad() {
        return $this->idTipoEntidad;
    }

    function getIdAlumno() {
        return $this->idAlumno;
    }

    function setIdEntidad($idEntidad) {
        $this->idEntidad = $idEntidad;
    }

    function setNombreEntidad($nombreEntidad) {
        $this->nombreEntidad = $nombreEntidad;
    }

    function setApellidoPEntidad($apellidoPEntidad) {
        $this->apellidoPEntidad = $apellidoPEntidad;
    }

    function setApellidoMEntidad($apellidoMEntidad) {
        $this->apellidoMEntidad = $apellidoMEntidad;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setTelefonoFijo($telefonoFijo) {
        $this->telefonoFijo = $telefonoFijo;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setIdTipoEntidad($idTipoEntidad) {
        $this->idTipoEntidad = $idTipoEntidad;
    }

    function setIdAlumno($idAlumno) {
        $this->idAlumno = $idAlumno;
    }

    /**
     * Método que inserta un registro en la tabla Entidad
     * @param Entidad $entidad Objeto con los datos a gastar
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function ingresarEntidad($entidad) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "INSERT INTO entidad(nombre_entidad,apellidoP_entidad,apellidoM_entidad,celular,telefono_fijo,email,id_tipo_entidad,id_alumno) "
                    . "VALUES('" . $entidad->getNombreEntidad() . "','" . $entidad->getApellidoPEntidad() . "','" . $entidad->getApellidoMEntidad() . "',"
                    . "'" . $entidad->getCelular() . "','" . $entidad->getTelefonoFijo() . "','" . $entidad->getEmail() . "','" . $entidad->getIdTipoEntidad() . "',"
                    . "'" . $entidad->getIdAlumno() . "')"; //QUERY


            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO VALOR DEPENDIENDO DEL RESULTADO DE LA OPERACION
            //LIBERANDO RECURSOS
            mysqli_close($cnx);


            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que actualiza un registro en la tabla Entidad
     * @param Entidad $entidad Objeto con los datos a actualizar
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function actualizarEntidad($entidad) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "UPDATE entidad SET nombre_entidad= '" . $entidad->getNombreEntidad() . "',apellidoP_entidad='" . $entidad->getApellidoPEntidad() . "',"
                    . "apellidoM_entidad='" . $entidad->getApellidoMEntidad() . "',celular='" . $entidad->getCelular() . "',telefono_fijo='" . $entidad->getTelefonoFijo() . "',"
                    . "email='" . $entidad->getEmail() . "',id_tipo_entidad='" . $entidad->getIdTipoEntidad() . "', id_alumno='" . $entidad->getIdAlumno() . "' "
                    . "WHERE id_entidad='" . $entidad->getIdEntidad() . "'"; //QUERY  

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO VALOR DEPENDIENDO DEL RESULTADO DE LA OPERACION
            //LIBERANDO RECURSOS
            mysqli_close($cnx);


            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que elimina un registro de la tabla Entidad
     * @param int $idEntidad id de la entidad a eliminar
     * @return Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function eliminarEntidad($idEntidad) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "DELETE FROM entidad WHERE id_entidad='$idEntidad'"; //QUERY  

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO VALOR DEPENDIENDO DEL RESULTADO DE LA OPERACION
            //LIBERANDO RECURSOS
            mysqli_close($cnx);


            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que obtiene un registro de la tabla Entidad
     * @param int $idEntidad id de la entidad a buscar
     * @return \Entidad Retorna un objeto con el resultado obtenido
     */
    public function getEntidadPorId($idEntidad) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM entidad WHERE id_entidad='$idEntidad'"; //QUERY 
            $rs = mysqli_query($cnx, $sql);

            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO OBJETO
                $entidad = new Entidad();
                $entidad->setIdEntidad($r['id_entidad']);
                $entidad->setNombreEntidad($r['nombre_entidad']);
                $entidad->setApellidoPEntidad($r['apellidoP_entidad']);
                $entidad->setApellidoMEntidad($r['apellidoM_entidad']);
                $entidad->setCelular($r['celular']);
                $entidad->setTelefonoFijo($r['telefono_fijo']);
                $entidad->setEmail($r['email']);
                $entidad->setIdTipoEntidad($r['id_tipo_entidad']);
                $entidad->setIdAlumno($r['id_alumno']);
            }
            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $entidad; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

}
