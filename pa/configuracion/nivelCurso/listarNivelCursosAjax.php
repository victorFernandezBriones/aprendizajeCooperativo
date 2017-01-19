<?php require_once '../../../negocio/configuracion/nivelCurso/procesarAdministrarNivelCurso.php'; ?>
<table class="table table-striped table-hover thcenter">
    <thead>
        <tr>
            <th>Nivel Curso</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($nivelCursos)):
            $c = 0;
            foreach ($nivelCursos as $nc):
                ?>
                <tr id="<?php echo "fila" . $c; ?>">
                    <td><input type="text" id="<?php echo "nivelCurso" . $c; ?>" name="<?php echo "nivelCurso" . $c; ?>" class="form-control" value="<?php echo $nc->getNivelCurso(); ?>"></td>
                    <td><button type="button" class="btn btn-success" onclick="actualizarNivelCurso(<?php echo $nc->getIdNivelCurso(); ?>, '<?php echo "nivelCurso" . $c; ?>')"><i class="fa fa-refresh"></i>&nbsp;Actualizar</button></td>
                    <td><button type="button" class="btn btn-danger" onclick="eliminarNivelCurso(<?php echo $nc->getIdNivelCurso(); ?>, '<?php echo "fila" . $c; ?>')"><i class="fa fa-trash"></i>&nbsp;Eliminar</button></td>
                </tr>

                <?php
                $c++;
            endforeach;
        endif;
        ?>
    </tbody>

</table>