<?php

/**
 * Description of Alumno
 *
 * @author vfernandez
 */
require_once 'Conexion.php';

class Alumno {

    private $idAlumno;
    private $rut;
    private $dvRut;
    private $nombreAlumno;
    private $apellidoPAlumno;
    private $apellidoMAlumno;
    private $fechaNacimiento;
    private $edad;
    private $colegioProveniente;
    private $idCurso;
    private $idSede;
    private $idEstadoAlumno;

    public function __construct() {
        
    }

    function getIdAlumno() {
        return $this->idAlumno;
    }

    function getRut() {
        return $this->rut;
    }

    function getDvRut() {
        return $this->dvRut;
    }

    function getNombreAlumno() {
        return $this->nombreAlumno;
    }

    function getApellidoPAlumno() {
        return $this->apellidoPAlumno;
    }

    function getApellidoMAlumno() {
        return $this->apellidoMAlumno;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function getEdad() {
        return $this->edad;
    }

    function getColegioProveniente() {
        return $this->colegioProveniente;
    }

    function getIdCurso() {
        return $this->idCurso;
    }

    function getIdSede() {
        return $this->idSede;
    }

    function getIdEstadoAlumno() {
        return $this->idEstadoAlumno;
    }

    function setIdAlumno($idAlumno) {
        $this->idAlumno = $idAlumno;
    }

    function setRut($rut) {
        $this->rut = $rut;
    }

    function setDvRut($dvRut) {
        $this->dvRut = $dvRut;
    }

    function setNombreAlumno($nombreAlumno) {
        $this->nombreAlumno = $nombreAlumno;
    }

    function setApellidoPAlumno($apellidoPAlumno) {
        $this->apellidoPAlumno = $apellidoPAlumno;
    }

    function setApellidoMAlumno($apellidoMAlumno) {
        $this->apellidoMAlumno = $apellidoMAlumno;
    }

    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function setEdad($edad) {
        $this->edad = $edad;
    }

    function setColegioProveniente($colegioProveniente) {
        $this->colegioProveniente = $colegioProveniente;
    }

    function setIdCurso($idCurso) {
        $this->idCurso = $idCurso;
    }

    function setIdSede($idSede) {
        $this->idSede = $idSede;
    }

    function setIdEstadoAlumno($idEstadoAlumno) {
        $this->idEstadoAlumno = $idEstadoAlumno;
    }

    /**
     * Método que inserta un registro en la tabla Alumno
     * @param Obj $alumno Objeto Alumno con los atributos a ingresar
     * @return int Retorna 1 si la operación es correcta, -1 si no lo es
     */
    public function ingresarAlumno($alumno) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "INSERT INTO alumno(id_alumno,rut_alumno,dv_rut,nombre_alumno,apellidoP_alumno,apellidoM_alumno,fecha_nacimiento,edad,colegio_proveniente,"
                    . "id_curso,id_sede,id_estado_alumno) "
                    . "VALUES('" . $alumno->getIdAlumno() . "','" . $alumno->getRut() . "','" . $alumno->getDvRut() . "','" . $alumno->getNombreAlumno() . "','" . $alumno->getApellidoPAlumno() . "',"
                    . "'" . $alumno->getApellidoMAlumno() . "','" . $alumno->getFechaNacimiento() . "','" . $alumno->getEdad() . "','" . $alumno->getColegioProveniente() . "',"
                    . "'" . $alumno->getIdCurso() . "','" . $alumno->getIdSede() . "','" . $alumno->getIdEstadoAlumno() . "')"; //QUERY


            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO VALOR DEPENDIENDO DEL RESULTADO DE LA OPERACION
            //LIBERANDO RECURSOS
            mysqli_close($cnx);


            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que actualiza un registro en la tabla Alumno
     * @param Alumno $alumno Objeto tipo Alumno con los datos a actualizar
     * @return int Retorna 1 si la operación es correcta, -1 si no lo es
     */
    public function actualizarAlumno($alumno) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "UPDATE alumno SET rut_alumno= '" . $alumno->getRut() . "',dv_rut='" . $alumno->getDvRut() . "',nombre_alumno='" . $alumno->getNombreAlumno() . "',"
                    . "apellidoP_alumno='" . $alumno->getApellidoPAlumno() . "',apellidoM_alumno='" . $alumno->getApellidoPAlumno() . "',fecha_nacimiento='" . $alumno->getFechaNacimiento() . "',"
                    . "edad='" . $alumno->getEdad() . "',colegio_proveniente='" . $alumno->getColegioProveniente() . "',id_curso='" . $alumno->getIdCurso() . "',id_sede='" . $alumno->getIdSede() . "',"
                    . "' WHERE id_alumno='" . $alumno->getIdAlumno() . "'";
            //QUERY


            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO VALOR DEPENDIENDO DEL RESULTADO DE LA OPERACION
            //LIBERANDO RECURSOS
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que elimina un registro de la tabla alumno
     * @param int $idAlumno id del alumno a eliminar
     * @return int Retorna 1 si la operación es correcta, -1 si no lo es
     */
    public function eliminarAlumno($idAlumno) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "DELETE FROM alumno WHERE id_alumno='$idAlumno'"; //QUERY 

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO VALOR DEPENDIENDO DEL RESULTADO DE LA OPERACION
            //LIBERANDO RECURSOS
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que retorna un registro de la tabla alumno
     * @param int $idAlumno id del alumno
     * @return \Alumno Retorna un objeto con los resultados
     */
    public function getAlumnoPorId($idAlumno) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM alumno WHERE id_alumno='$idAlumno'"; //QUERY 
            $rs = mysqli_query($cnx, $sql);

            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO OBJETO
                $alumno = new Alumno();
                $alumno->setIdAlumno($r['id_alumno']);
                $alumno->setRut($r['rut_alumno']);
                $alumno->setDvRut($r['dv_rut']);
                $alumno->setNombreAlumno($r['nombre_alumno']);
                $alumno->setApellidoPAlumno($r['apellidoP_alumno']);
                $alumno->setApellidoMAlumno($r['apellidoM_alumno']);
                $alumno->setFechaNacimiento($r['fecha_nacimiento']);
                $alumno->setEdad($r['edad']);
                $alumno->setColegioProveniente($r['colegio_proveniente']);
                $alumno->setIdCurso($r['id_curso']);
                $alumno->setIdSede($r['id_sede']);
                $alumno->setIdEstadoAlumno($r['id_estado_alumno']);
            }
            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $alumno; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que obtiene todos los registros de la tabla alumnos
     * @return array Retorna un array con los resultados
     */
    public function getAlumnos() {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM alumno WHERE"; //QUERY 
            $rs = mysqli_query($cnx, $sql);
            $alumnos = array();
            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO OBJETO
                $alumno = new Alumno();
                $alumno->setIdAlumno($r['id_alumno']);
                $alumno->setRut($r['rut_alumno']);
                $alumno->setDvRut($r['dv_rut']);
                $alumno->setNombreAlumno($r['nombre_alumno']);
                $alumno->setApellidoPAlumno($r['apellidoP_alumno']);
                $alumno->setApellidoMAlumno($r['apellidoM_alumno']);
                $alumno->setFechaNacimiento($r['fecha_nacimiento']);
                $alumno->setEdad($r['edad']);
                $alumno->setColegioProveniente($r['colegio_proveniente']);
                $alumno->setIdCurso($r['id_curso']);
                $alumno->setIdSede($r['id_sede']);
                $alumno->setIdEstadoAlumno($r['id_estado_alumno']);

                array_push($alumnos, $alumno); //insertando el obj en el array
            }
            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $alumnos; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que obtiene todos los alumnos asociados a un curso
     * @param int $idCurso id del curso
     * @return array Retorna un array con los resultados
     */
    public function getAlumnosPorCurso($idCurso) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM alumno WHERE id_curso='$idCurso'"; //QUERY 
            $rs = mysqli_query($cnx, $sql);
            $alumnos = array();
            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO OBJETO
                $alumno = new Alumno();
                $alumno->setIdAlumno($r['id_alumno']);
                $alumno->setRut($r['rut_alumno']);
                $alumno->setDvRut($r['dv_rut']);
                $alumno->setNombreAlumno($r['nombre_alumno']);
                $alumno->setApellidoPAlumno($r['apellidoP_alumno']);
                $alumno->setApellidoMAlumno($r['apellidoM_alumno']);
                $alumno->setFechaNacimiento($r['fecha_nacimiento']);
                $alumno->setEdad($r['edad']);
                $alumno->setColegioProveniente($r['colegio_proveniente']);
                $alumno->setIdCurso($r['id_curso']);
                $alumno->setIdSede($r['id_sede']);
                $alumno->setIdEstadoAlumno($r['id_estado_alumno']);

                array_push($alumnos, $alumno); //insertando el obj en el array
            }
            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $alumnos; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que obtiene el id mayor de la tabla alumno
     * @return int Retorna el id mayor obtenido
     */
    public function getMaxIdAlumno() {
        try {

            $serviceCnx = new Conexion(); //SERVICIO PARA LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT MAX(id_alumno) AS max FROM alumno"; //QUERY 
            $rs = mysqli_query($cnx, $sql);
            $max = 0;

            while ($r = mysqli_fetch_array($rs)) {
                $max = $r['max'];
            }
            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $max; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

}
