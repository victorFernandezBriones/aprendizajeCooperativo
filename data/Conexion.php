<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conexion
 *
 * @author vfernandez
 */
class Conexion {

    private $servidor = "localhost";
    private $usuario = "aprendizaje_coop";
    private $contrasena = "coop.2016.axioma";
    private $db = "aprendizaje_cooperativo";
    public $conexion_id;
    public $error;

    public function __construct() {
        
    }

    /**
     * Metodo para establecer la conexion con la base de datos
     * @return link Retorna el link de la conexion
     */
    public function conectar() {
        try {

            $this->conexion_id = mysqli_connect($this->servidor, $this->usuario, $this->contrasena, $this->db); //estableciendo conexion

            if (!$this->conexion_id) {//mensaje en caso de conexion fallida
                $this->error = "Error, no se ha podido establecer la conexion";
                return $this->error; //retornando mensaje
            }

            return $this->conexion_id; //retornando link de la conexion
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
