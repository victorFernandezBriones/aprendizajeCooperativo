<?php

/**
 * Description of NivelCurso
 *
 * @author vfernandez
 */
require_once 'Conexion.php';

class NivelCurso {

    private $idNivelCurso;
    private $nivelCurso;

    public function __construct() {
        
    }

    function getIdNivelCurso() {
        return $this->idNivelCurso;
    }

    function getNivelCurso() {
        return $this->nivelCurso;
    }

    function setIdNivelCurso($idNivelCurso) {
        $this->idNivelCurso = $idNivelCurso;
    }

    function setNivelCurso($nivelCurso) {
        $this->nivelCurso = $nivelCurso;
    }

    /**
     * Método para ingresar registro en la tabla nivel_curso
     * @param String $nivelCurso nombre del nivel a agregar
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function ingresarNivelCurso($nivelCurso) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "INSERT INTO nivel_curso(nivel_curso) "
                    . "VALUES('$nivelCurso')"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //RESPUESTA SEGUN RESULTADO DE LA QUERY
            //LIBERANDO RECURSOS
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que actualizar un registro de la tabla nivel_curso
     * @param int $idNivelCurso id del nivel del curso
     * @param String $nivelCurso  nombre del nivel del curso
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function actualizarNivelCurso($idNivelCurso, $nivelCurso) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "UPDATE nivel_curso SET nivel_curso='$nivelCurso' "
                    . "WHERE id_nivel_curso='$idNivelCurso'"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //RESPUESTA SEGUN RESULTADO DE LA QUERY
            //LIBERANDO RECURSOS
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que elimina un registro de la tabla nivel_curso
     * @param int $idNivelCurso id del nivel de curso a eliminar
     * @return int  Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function eliminarNivelCurso($idNivelCurso) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "DELETE FROM nivel_curso WHERE id_nivel_curso='$idNivelCurso'"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //RESPUESTA SEGUN RESULTADO DE LA QUERY
            //LIBERANDO RECURSOS
            mysqli_close($cnx);

            return $exito; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que obtiene todos los registros de la tabla nivel_curso
     * @return array Retorna un array con los resultados
     */
    public function getNivelCursos() {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM nivel_curso"; //QUERY
            $rs = mysqli_query($cnx, $sql);
            $nivelCursos = array();

            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO EL OBJETO
                $nivelCurso = new NivelCurso();
                $nivelCurso->setIdNivelCurso($r['id_nivel_curso']);
                $nivelCurso->setNivelCurso($r['nivel_curso']);

                array_push($nivelCursos, $nivelCurso); //AGREGANDO EL OBJETO AL ARRAY
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $nivelCursos; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que obtiene un registro de nivel_curso segun su ID
     * @param int $idNivelCurso id del nivel curso a buscar
     * @return \NivelCurso Retorna un objeto con los resultados
     */
    public function getNivelCursoPorId($idNivelCurso) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE LA CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE LA CONEXION
            $sql = "SELECT * FROM nivel_curso WHERE id_nivel_curso='$idNivelCurso'"; //QUERY
            $rs = mysqli_query($cnx, $sql);
           
            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO EL OBJETO
                $nivelCurso = new NivelCurso();
                $nivelCurso->setIdNivelCurso($r['id_nivel_curso']);
                $nivelCurso->setNivelCurso($r['nivel_curso']);
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $nivelCurso; //RETORNANDO RESULTADO
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

}
