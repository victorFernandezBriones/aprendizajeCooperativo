<?php
require_once '../../data/Alumno.php';
$serviceAlumno = new Alumno();
if ($_GET):

    $idCurso = htmlspecialchars($_GET['idCurso']);
    $alumnos = $serviceAlumno->getAlumnosPorCurso($idCurso);

endif;
?>
<select id="idAlumno" name="idAlumno" class="form-control">
    <option value="">Seleccione</option>
    <?php
    if (isset($alumnos)) :
        foreach ($alumnos as $a) :
            ?>
            <option value="<?php echo $a->getIdAlumno() ?>"><?php echo $a->getNombreAlumno() . " " . $a->getApellidoPAlumno()." ".$a->getApellidoMAlumno(); ?> </option>
            <?php
        endforeach;
    endif;
    ?>
   
</select>