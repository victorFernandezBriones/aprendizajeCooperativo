<?php
require_once '../../data/Curso.php';
$serviceCurso = new Curso();
if ($_GET):

    $idNivelCurso = htmlspecialchars($_GET['idNivelCurso']);
    $cursos = $serviceCurso->getCursosPorNivel($idNivelCurso);

endif;
?>
<select id="idCurso" name="idCurso" class="form-control">
    <option value="">Seleccione</option>
    <?php
    if (isset($cursos)) :
        foreach ($cursos as $c) :
            ?>
            <option value="<?php echo $c->getIdCurso() ?>"><?php echo $c->getCurso(); ?> </option>
            <?php
        endforeach;
    endif;
    ?>  
</select>