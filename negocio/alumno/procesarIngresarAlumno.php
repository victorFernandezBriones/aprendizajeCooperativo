<?php

require_once '../../data/Alumno.php';
require_once '../../data/Curso.php';
require_once '../../data/Usuario.php';
require_once '../../data/NivelCurso.php';
require_once '../../data/Entidad.php';
require_once '../../data/Funciones.php';
require_once '../../data/Documento.php';
require_once '../../data/TipoEntidad.php';

$sessionUsuario = new Usuario();
session_start();
$sessionUsuario = $_SESSION['usuario'];

//SERVICIOS
$serviceAlumno = new Alumno();
$serviceCurso = new Curso();
$serviceNivelCurso = new NivelCurso();
$serviceEntidad = new Entidad();
$serviceTipoEntidad = new TipoEntidad();
$serviceFunciones = new Funciones();
$serviceDocumento = new Documento();

//VARIABLES
$cursos = $serviceCurso->getCursos();
$tipoEntidades = $serviceTipoEntidad->getTipoEntidades();


if ($_POST):

    //DATOS ALUMNO
    $rutSinFormato = trim(htmlspecialchars($_POST['rut']));
    $explodeRut = explode("-", $rutSinFormato);
    $rut = $explodeRut[0];
    $dvRut = $explodeRut[1];

    $nombre = trim(ucwords(htmlspecialchars($_POST['nombre'])));
    $apellidoP = trim(ucwords(htmlspecialchars($_POST['apellidoP'])));
    $apellidoM = trim(ucwords(htmlspecialchars($_POST['apellidoM'])));
    $colegioProveniente = trim(ucwords(htmlspecialchars($_POST['colegioProveniente'])));
    $fechaNacimiento = $serviceFunciones->formatoFechaGuardarDB(trim(htmlspecialchars($_POST['fechaNacimiento'])));
    $edad = trim(htmlspecialchars($_POST['edad']));
    $idCurso = htmlspecialchars($_POST['idCurso']);
    $idAlumno = $serviceAlumno->getMaxIdAlumno() + 1;

    //INSTANCEANDO Y SETEANDO OBJETO
    $alumno = new Alumno();
    $alumno->setIdAlumno($idAlumno);
    $alumno->setRut($rut);
    $alumno->setDvRut($dvRut);
    $alumno->setNombreAlumno($nombre);
    $alumno->setApellidoPAlumno($apellidoP);
    $alumno->setApellidoMAlumno($apellidoM);
    $alumno->setColegioProveniente($colegioProveniente);
    $alumno->setFechaNacimiento($fechaNacimiento);
    $alumno->setEdad($edad);
    $alumno->setIdCurso($idCurso);
    $alumno->setIdEstadoAlumno(1);
    $alumno->setIdSede($sessionUsuario->getIdSede());

    if ($serviceAlumno->ingresarAlumno($alumno) != -1) :

        //------------------------------------//
        //       INGRESANDO ARCHIVOS         //
        //SUBIENDO FOTO AL SERVIDOR
        $archivoFoto = $_FILES['fotoAlumno']['tmp_name'];
        $nombreArchivo = $_FILES['fotoAlumno']['name'];
        $tamanoFoto = $serviceDocumento->convertirTamanoArchivo($_FILES['fotoAlumno']['size']);
        $ruta = "fotosAlumnos/";
        $fechaSubida = $serviceFunciones->obtenerFechaSinHora();


        $resultadoArchivos = $serviceDocumento->subirArchivoAlServidor($nombreArchivo, $archivoFoto, $ruta);
        $foto = new Documento();
        $foto->setMimeDocumento(end(explode(".", $nombreArchivo)));
        $foto->setNombreDocumento($nombreArchivo);
        $foto->setRuta($resultadoArchivos['ruta']);
        $foto->setIdAlumno($idAlumno);
        $foto->setFechaSubida($fechaSubida);
        $foto->setIdTipoDocumento(2); //tipo foto

        $serviceDocumento->ingresarDocumento($foto); //INGRESANDO FOTO
        //----------------------------------//        
        //DATOS ENTIDADES        
        $nombreEntidad = explode(',', trim(ucwords(htmlspecialchars($_POST['nombreEntidad']))));
        $apellidoEntidadP = explode(',', trim(ucwords(htmlspecialchars($_POST['apellidoEntidadP']))));
        $apellidoEntidadM = explode(',', trim(ucwords(htmlspecialchars($_POST['apellidoEntidadM']))));
        $celularE = explode(',', trim(htmlspecialchars($_POST['celularE'])));
        $fijoE = explode(',', trim(htmlspecialchars($_POST['fijoE'])));
        $emailE = explode(',', htmlspecialchars($_POST['emailE']));
        $idTipoEntidad = explode(',', htmlspecialchars($_POST['idTipoEntidad']));

        //insertando entidades
        for ($i = 0; $i < count($nombreEntidad); $i++) {

            $entidad = new Entidad();
            $entidad->setNombreEntidad($nombreEntidad[$i]);
            $entidad->setApellidoPEntidad($apellidoEntidadP[$i]);
            $entidad->setApellidoMEntidad($apellidoEntidadM[$i]);
            $entidad->setCelular($celularE[$i]);
            $entidad->setTelefonoFijo($fijoE[$i]);
            $entidad->setEmail($emailE[$i]);
            $entidad->setIdAlumno($idAlumno);
            $entidad->setIdTipoEntidad($idTipoEntidad[$i]);

            //ingresando entidad
            $serviceEntidad->ingresarEntidad($entidad);
        }


        echo 1;
    endif;


endif;
if ($_GET) :

    $fechaNacimiento = $_GET['fechaNacimiento'];

    echo $edad = $serviceFunciones->calcularEdad($fechaNacimiento);
    
    
endif;