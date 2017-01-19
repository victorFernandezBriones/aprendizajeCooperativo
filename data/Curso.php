<?php

/**
 * Description of Curso
 *
 * @author vfernandez
 */
require_once 'Conexion.php';
require_once 'CursoNivel.php';

class Curso {

    private $idCurso;
    private $curso;
    private $idNivelCurso;

    public function __construct() {
        
    }

    function getIdCurso() {
        return $this->idCurso;
    }

    function getCurso() {
        return $this->curso;
    }

    function getIdNivelCurso() {
        return $this->idNivelCurso;
    }

    function setIdCurso($idCurso) {
        $this->idCurso = $idCurso;
    }

    function setCurso($curso) {
        $this->curso = $curso;
    }

    function setIdNivelCurso($idNivelCurso) {
        $this->idNivelCurso = $idNivelCurso;
    }

    /**
     * Método que ingresa un registro de curso en la BD
     * @param Obj $curso objeto con los atributos a ingresar
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function ingresarCurso($curso) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "INSERT INTO curso(curso,id_nivel_curso) "
                    . "VALUES('" . $curso->getCurso() . "','" . $curso->getIdNivelCurso() . "')"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //RESPUESTA SEGUN RESULTADO DE LA QUERY
            //LIBERANDO RECURSOS
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que actualiza un registro de la tabla curso
     * @param Obj $curso curso a actualizar
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function actualizarCurso($curso) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "UPDATE curso SET curso= '" . $curso->getCurso() . "' , id_nivel_curso='" . $curso->getIdNivelCurso() . "' "
                    . "WHERE id_curso='" . $curso->getIdCurso() . "'"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //RESPUESTA SEGUN RESULTADO DE LA QUERY
            //LIBERANDO RECURSOS
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que elimina un registro de la tabla curso
     * @param type $idCurso
     * @return type
     */
    public function eliminarCurso($idCurso) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "DELETE FROM curso WHERE id_curso='$idCurso'"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //RESPUESTA SEGUN RESULTADO DE LA QUERY
            //LIBERANDO RECURSOS
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que obtiene todos los cursos presentes en la bd
     * @return array Retorna un array con los resultados obtenidos
     */
    public function getCursos() {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM curso ORDER BY id_nivel_curso,curso"; //QUERY
            $rs = mysqli_query($cnx, $sql);
            $cursos = array();

            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO EL OBJETO
                $curso = new Curso();
                $curso->setIdCurso($r['id_curso']);
                $curso->setCurso($r['curso']);
                $curso->setIdNivelCurso($r['id_nivel_curso']);

                array_push($cursos, $curso); //AGREGANDO EL OBJETO AL ARRAY
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $cursos; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que obtiene todos los cursos asociados a un nivel
     * @param int $idNivelCurso id del nivel del curso
     * @return array Retorna un array con los resultados obtenidos
     */
    public function getCursosPorNivel($idNivelCurso) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM curso WHERE id_nivel_curso='$idNivelCurso'"; //QUERY
            $rs = mysqli_query($cnx, $sql);
            $cursos = array();

            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO EL OBJETO
                $curso = new Curso();
                $curso->setIdCurso($r['id_curso']);
                $curso->setCurso($r['curso']);
                $curso->setIdNivelCurso($r['id_nivel_curso']);

                array_push($cursos, $curso); //AGREGANDO EL OBJETO AL ARRAY
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $cursos; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que obtiene un registro de curso segun su ID
     * @param int $idCurso id del curso a buscar
     * @return \Curso Retorna un objeto del tipo Curso con los datos solicitados
     */
    public function getCursoPorId($idCurso) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM curso WHERE id_curso='$idCurso'"; //QUERY
            $rs = mysqli_query($cnx, $sql);

            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO EL OBJETO
                $curso = new Curso();
                $curso->setIdCurso($r['id_curso']);
                $curso->setCurso($r['curso']);
                $curso->setIdNivelCurso($r['id_nivel_curso']);
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $curso; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    public function getCursoNivelPorID($idCurso) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM curso cu JOIN nivel_curso nv USING(id_nivel_curso)"
                    . " WHERE id_curso='$idCurso'"; //QUERY

            $rs = mysqli_query($cnx, $sql);
            $cursoNivel = new CursoNivel();

            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO EL OBJETO
                $curso = new Curso();
                $curso->setIdCurso($r['id_curso']);
                $curso->setCurso($r['curso']);
                $curso->setIdNivelCurso($r['id_nivel_curso']);

                $nivel = new NivelCurso();
                $nivel->setIdNivelCurso($r['id_nivel_curso']);
                $nivel->setNivelCurso($r['nivel_curso']);

                //ingresando datos al objeto
                $cursoNivel->setCurso($curso);
                $cursoNivel->setNivelCurso($nivel);
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $cursoNivel; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

}
