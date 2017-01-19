<?php require_once '../../../negocio/configuracion/sede/procesarAdministrarSedes.php'; ?>
<table class="table table-striped table-hover thcenter">
    <thead>
        <tr>
            <th>Nombre Sede</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($sedes)):
            $c = 0;
            foreach ($sedes as $s):
                ?>
                <tr id="<?php echo "fila" . $c; ?>">
                    <td><input type="text" id="<?php echo "nombreSede" . $c; ?>" name="<?php echo "nombreSede" . $c; ?>" class="form-control" value="<?php echo $s->getNombreSede(); ?>"></td>
                    <td><button type="button" class="btn btn-success" onclick="actualizarSede(<?php echo $s->getIdSede(); ?>, '<?php echo "nombreSede" . $c; ?>')"><i class="fa fa-refresh"></i>&nbsp;Actualizar</button></td>
                    <td><button type="button" class="btn btn-danger" onclick="eliminarSede(<?php echo $s->getIdSede(); ?>, '<?php echo "fila" . $c; ?>')"><i class="fa fa-trash"></i>&nbsp;Eliminar</button></td>
                </tr>

                <?php
                $c++;
            endforeach;
        endif;
        ?>
    </tbody>

</table>
