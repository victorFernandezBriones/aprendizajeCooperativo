<?php require_once '../../../negocio/configuracion/curso/procesarAdministrarCurso.php';?>

<table class="table table-striped table-hover thcenter">
    <thead>
        <tr>
            <th>Curso</th>
            <th>Nivel Curso</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($cursos)):
            $c = 0;
            foreach ($cursos as $cu):
                ?>
                <tr id="<?php echo "fila" . $c; ?>">
                    <td><input type="text" id="<?php echo "nombreCurso" . $c; ?>" name="<?php echo "nombreCurso" . $c; ?>" class="form-control" value="<?php echo $cu->getCurso(); ?>"></td>
                    <td>
                        <select id="<?php echo "idNivelCurso" . $c; ?>" name="<?php echo "idNivelCurso" . $c; ?>" class="form-control">
                            <?php
                            if (isset($nivelCursos)) :
                                foreach ($nivelCursos as $nc):
                                    ?>
                                    <option value="<?php echo $nc->getIdNivelCurso(); ?>" <?php echo $nc->getIdNivelCurso() == $cu->getIdNivelCurso() ? 'selected' : ''; ?>><?php echo $nc->getNivelCurso(); ?></option>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </td>
                    <td><button type="button" class="btn btn-success" onclick="actualizarSede(<?php echo $cu->getIdCurso(); ?>, '<?php echo "nombreCurso" . $c; ?>', '<?php echo "idNivelCurso" . $c; ?>')"><i class="fa fa-refresh"></i>&nbsp;Actualizar</button></td>
                    <td><button type="button" class="btn btn-danger" onclick="eliminarSede(<?php echo $cu->getIdCurso(); ?>, '<?php echo "fila" . $c; ?>')"><i class="fa fa-trash"></i>&nbsp;Eliminar</button></td>
                </tr>

                <?php
                $c++;
            endforeach;
        endif;
        ?>
    </tbody>

</table>
