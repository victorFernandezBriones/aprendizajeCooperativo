<?php require_once '../../../negocio/configuracion/asignatura/procesarAdministrarAsignatura.php'; ?>
<table class="table table-striped table-hover thcenter">
    <thead>
        <tr>
            <th>Nombre Asignatura</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($asignaturas)):
            $c = 0;
            foreach ($asignaturas as $a):
                ?>
                <tr id="<?php echo "fila" . $c; ?>">
                    <td><input type="text" id="<?php echo "nombreAsignatura" . $c; ?>" name="<?php echo "nombreAsignatura" . $c; ?>" class="form-control" value="<?php echo $a->getAsignatura(); ?>"></td>
                    <td><button type="button" class="btn btn-success" onclick="actualizarAsignatura(<?php echo $a->getIdAsignatura(); ?>, '<?php echo "nombreAsignatura" . $c; ?>')"><i class="fa fa-refresh"></i>&nbsp;Actualizar</button></td>
                    <td><button type="button" class="btn btn-danger" onclick="eliminarAsignatura(<?php echo $a->getIdAsignatura(); ?>, '<?php echo "fila" . $c; ?>')"><i class="fa fa-trash"></i>&nbsp;Eliminar</button></td>
                </tr>

                <?php
                $c++;
            endforeach;
        endif;
        ?>
    </tbody>
</table>