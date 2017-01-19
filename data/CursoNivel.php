<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CursoNivel
 *
 * @author vfernandez
 */
require_once 'Curso.php';
require_once 'NivelCurso.php';

class CursoNivel {

    //colaboracion de Clases
    private $curso;
    private $nivelCurso;

    public function __construct() {
        
    }

    function getCurso() {
        return $this->curso;
    }

    function getNivelCurso() {
        return $this->nivelCurso;
    }

    function setCurso($curso) {
        $this->curso = $curso;
    }

    function setNivelCurso($nivelCurso) {
        $this->nivelCurso = $nivelCurso;
    }

    

}
