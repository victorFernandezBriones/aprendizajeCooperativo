<?php require_once '../../../negocio/configuracion/usuarios/procesarAdministrarUsuarios.php'; ?>
<!--BREADCRUM -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Bienvenido</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="#" onclick="cargarInicio()">Centro de aprendizaje</a></li>
            <li >Configuraci&oacute;n</li>
            <li class="active">Administrar Usuarios</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default sombra">
            <div class="panel-heading"><h3 class="panel-title">Administrar Usuarios</h3></div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="tablaUsuarios" class="table table-hover table-condensed table-striped table-rep-plugin">
                        <thead>
                            <tr class="text-center">
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Sede</th>
                                <th>Tipo Usuario</th>
                                <th>Estado Usuario</th>
                                <th>Actualizar</th>
                                <th>Eliminar</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($usuarios)):
                                $c = 0;
                                foreach ($usuarios as $u) :
                                    ?>
                                    <tr id="<?php echo "fila" . $c; ?>">
                                        <td><?php echo $u->getNombreUsuario(); ?></td>
                                        <td><?php echo $u->getApellidoPUsuario(); ?></td>
                                        <td><?php echo $u->getApellidoMUsuario(); ?></td>
                                        <td>
                                            <select id="<?php echo "idSedeMod" . $c; ?>" name="<?php echo "idSedeMod" . $c; ?>" class="form-control">
                                                <?php
                                                if (isset($sedes)):
                                                    foreach ($sedes as $s):
                                                        ?>
                                                        <option value="<?php echo $s->getIdSede(); ?>" <?php echo $s->getIdSede() == $u->getIdSede() ? 'selected' : ''; ?>><?php echo $s->getNombreSede(); ?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select id="<?php echo "idTipoUsuarioMod" . $c; ?>" name="<?php echo "idTipoUsuarioMod" . $c; ?>" class="form-control">
                                                <?php
                                                if (isset($tiposUsuarios)):
                                                    foreach ($tiposUsuarios as $tu):
                                                        ?>
                                                        <option value="<?php echo $tu->getIdTipoUsuario(); ?>" <?php echo $tu->getIdTipoUsuario() == $u->getIdTipoUsuario() ? 'selected' : ''; ?> ><?php echo $tu->getTipoUsuario(); ?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select id="<?php echo "idEstadoUsuarioMod" . $c; ?>" name="<?php echo "idEstadoUsuarioMod" . $c; ?>" class="form-control">
                                                <?php
                                                if (isset($estadosUsuarios)):
                                                    foreach ($estadosUsuarios as $eu):
                                                        ?>
                                                        <option value="<?php echo $eu->getIdEstadoUsuario(); ?>" <?php echo $eu->getIdEstadoUsuario() == $u->getIdEstadoUsuario() ? 'selected' : ''; ?> ><?php echo $eu->getEstadoUsuario(); ?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                        </td>
                                        <td><button class="btn btn-success" name="btnActualizarUsuario" onclick="actualizarUsuario(<?php echo $u->getIdUsuario(); ?>, '<?php echo "idSedeMod" . $c; ?>', '<?php echo "idTipoUsuarioMod" . $c; ?>', '<?php echo "idEstadoUsuarioMod" . $c; ?>')"><i class="fa fa-refresh"></i>&nbsp;Actualizar</button></td>
                                        <td><button class="btn btn-danger" name="btnEliminarUsuario" onclick="eliminarUsuario(<?php echo $u->getIdUsuario(); ?>,'<?php echo "fila" . $c; ?>');"><i class="fa fa-trash"></i>&nbsp;Eliminar</button></td>
                                    </tr>

                                    <?php
                                    $c++;
                                endforeach;

                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>