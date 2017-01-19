<?php

/**
 * Description of Documento
 *
 * @author vfernandez
 */
require_once 'Conexion.php';

class Documento {

    private $idDocumento;
    private $nombreDocumento;
    private $documento;
    private $mimeDocumento;
    private $tamanoDocumento;
    private $fechaSubida;
    private $ruta;
    private $idTipoDocumento;
    private $idAlumno;

    public function __construct() {
        
    }

    function getIdDocumento() {
        return $this->idDocumento;
    }

    function getNombreDocumento() {
        return $this->nombreDocumento;
    }

    function getDocumento() {
        return $this->documento;
    }

    function getMimeDocumento() {
        return $this->mimeDocumento;
    }

    function getTamanoDocumento() {
        return $this->tamanoDocumento;
    }

    function getFechaSubida() {
        return $this->fechaSubida;
    }

    function getRuta() {
        return $this->ruta;
    }

    function getIdTipoDocumento() {
        return $this->idTipoDocumento;
    }

    function getIdAlumno() {
        return $this->idAlumno;
    }

    function setIdDocumento($idDocumento) {
        $this->idDocumento = $idDocumento;
    }

    function setNombreDocumento($nombreDocumento) {
        $this->nombreDocumento = $nombreDocumento;
    }

    function setDocumento($documento) {
        $this->documento = $documento;
    }

    function setMimeDocumento($mimeDocumento) {
        $this->mimeDocumento = $mimeDocumento;
    }

    function setTamanoDocumento($tamanoDocumento) {
        $this->tamanoDocumento = $tamanoDocumento;
    }

    function setFechaSubida($fechaSubida) {
        $this->fechaSubida = $fechaSubida;
    }

    function setRuta($ruta) {
        $this->ruta = $ruta;
    }

    function setIdTipoDocumento($idTipoDocumento) {
        $this->idTipoDocumento = $idTipoDocumento;
    }

    function setIdAlumno($idAlumno) {
        $this->idAlumno = $idAlumno;
    }

    /**
     * Método que ingresa un registro de documento en la base de datos
     * @param Documento $documento objeto documento con los datos  ingresar
     * @return int Retorna 1 si la operacion es exitosa, -1 si no lo es
     */
    public function ingresarDocumento($documento) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE CONEXION
            $sql = "INSERT INTO documento(nombre_documento,documento,mime_documento,tamano_documento,fecha_subida,ruta,"
                    . "id_tipo_documento,id_alumno) VALUES('" . $documento->getNombreDocumento() . "','" . $documento->getDocumento() . "',"
                    . "'" . $documento->getMimeDocumento() . "','" . $documento->getTamanoDocumento() . "','" . $documento->getFechaSubida() . "',"
                    . "'" . $documento->getRuta() . "','" . $documento->getIdTipoDocumento() . "','" . $documento->getIdAlumno() . "')"; //QUERY

            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO FLAG DE LA RESPUESTA

            return $sql; //RETORNANDO RESULTADOS
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que obtiene un documento segun su id
     * @param int $idDocumento id del documento
     * @return \Documento Retorna un objeto documento
     */
    public function getDocumentoPorId($idDocumento) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE CONEXION
            $sql = "SELECT * FROM documento WHERE id_documento='$idDocumento'"; //QUERY
            $rs = mysqli_query($cnx, $sql); //RESULTSET

            while ($r = mysqli_fetch_array($rs)) {
                //INSTANCEANDO Y SETEANDO OBJETO
                $documento = new Documento();
                $documento->setIdDocumento($r['id_documento']);
                $documento->setNombreDocumento($r['nombre_documento']);
                $documento->setDocumento($r['documento']);
                $documento->setMimeDocumento($r['mime_documento']);
                $documento->setTamanoDocumento($r['tamano_documento']);
                $documento->setFechaSubida($r['fecha_subida']);
                $documento->setRuta($r['ruta']);
                $documento->setIdTipoDocumento($r['id_tipo_documento']);
                $documento->setIdAlumno($r['id_alumno']);
            }

            //LIBERANDO RECURSOS
            mysqli_free_result($rs);
            mysqli_close($cnx);

            return $documento; //RETORNANDO RESULTADOS
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Método que actualiza un registro de la tabla documento
     * @param Documento $documento Objeto con los datos a actualizar
     * @return int Retorna 1 si la operacion es correcta, -1 si no lo es
     */
    public function actualizarDocumento($documento) {
        try {
            $serviceCnx = new Conexion(); //SERVICIO DE CONEXION
            $cnx = $serviceCnx->conectar(); //LINK DE CONEXION
            $sql = "UPDATE documento SET nombre_documento='" . $documento->getNombreDocumento() . "',documento='" . $documento->getDocumento() . "',"
                    . "mime_documento='" . $documento->getMimeDocumento() . "',tamano_documento='" . $documento->getTamanoDocumento() . "',fecha_subida='" . $documento->getFechaSubida() . "',"
                    . "ruta='" . $documento->getRuta() . "',id_tipo_documento='" . $documento->getIdTipoDocumento() . "' "
                    . "WHERE id_documento='" . $documento->getIdDocumento() . "'";


            $exito = mysqli_query($cnx, $sql) == TRUE ? 1 : -1; //ASIGNANDO FLAG DE LA RESPUESTA

            return $exito; //RETORNANDO RESULTADOS
        } catch (Exception $ex) {
            echo $ex->getMessage(); //MENSAJE DE EXCEPCION
        }
    }

    /**
     * Metodo que convierte el tamaño del archivo de bytes al valor de tamaño correspondiente
     * @param int $tamanoArchivo Recibe el tamaño de un archivo en bytes y le otorga un formato de lectura de acuerdo a su tamaño
     */
    function convertirTamanoArchivo($tamanoArchivo) {

        $tamanoFormateado = ""; //variable que almacenará el valor formateado

        if ($tamanoArchivo >= 1 && $tamanoArchivo < 1024) {//formato byte
            $tamanoFormateado = $tamanoArchivo . " B";
        } else {

            if ($tamanoArchivo >= 1024 && $tamanoArchivo < 1048576) {//formato para kilobyte
                $tamanoFormateado = $tamanoArchivo / 1024;
                $tamanoFormateado = number_format($tamanoFormateado, 2, ",", ".") . " KB";
            } else {

                if ($tamanoArchivo >= 1048576 && $tamanoArchivo < 1073741824) {//formato para megabyte
                    $tamanoFormateado = ($tamanoArchivo / 1024) / 1024;
                    $tamanoFormateado = number_format($tamanoFormateado, 2, ",", ".") . " MB";
                }
            }
        }

        return $tamanoFormateado; //retorna el valor formateado
    }

    /**
     * Método que sube un archivo al servidor
     * @param String $nombreArchivo Nombre del archivo 
     * @param FILE $archivo Datos del archivo
     * @param String $ruta Ruta donde se subira el archivo
     * @return int Retorna un array con los resultados
     */
    function subirArchivoAlServidor($nombreArchivo, $archivo, $ruta) {
        try {
            $mime = end(explode(".", $nombreArchivo)); //mime del archivo
            $rutaArchivo = $ruta . md5($nombreArchivo) . "." . $mime; //url del archivo
            $exito = move_uploaded_file($archivo, $rutaArchivo) == TRUE ? 1 : -1;

            $resultados = array("exito" => $exito, "ruta" => $rutaArchivo);

            return $resultados; //subiendo el archivo al servidor
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
