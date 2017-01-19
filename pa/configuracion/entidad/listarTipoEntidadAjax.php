<?php require_once '../../../negocio/configuracion/entidad/procesarAdministrarTipoEntidades.php'; ?>
<table class="table table-striped table-hover thcenter">
    <thead>
        <tr>
            <th>Tipo Entidad</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($tipoEntidades)):
            $c = 0;
            foreach ($tipoEntidades as $te):
                ?>
                <tr id="<?php echo "fila" . $c; ?>">
                    <td><input type="text" id="<?php echo "tipoEntidad" . $c; ?>" name="<?php echo "tipoEntidad" . $c; ?>" class="form-control" value="<?php echo $te->getTipoEntidad(); ?>"></td>
                    <td><button type="button" class="btn btn-success" onclick="actualizarTipoEntidad(<?php echo $te->getIdTipoEntidad(); ?>, '<?php echo "tipoEntidad" . $c; ?>')"><i class="fa fa-refresh"></i>&nbsp;Actualizar</button></td>
                    <td><button type="button" class="btn btn-danger" onclick="eliminarTipoEntidad(<?php echo $te->getIdTipoEntidad(); ?>, '<?php echo "fila" . $c; ?>')"><i class="fa fa-trash"></i>&nbsp;Eliminar</button></td>
                </tr>

                <?php
                $c++;
            endforeach;
        endif;
        ?>
    </tbody>
</table>