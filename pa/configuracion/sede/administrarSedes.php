<?php require_once '../../../negocio/configuracion/sede/procesarAdministrarSedes.php'; ?>
<!--BREADCRUM -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Bienvenido</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="#" onclick="cargarInicio()">Centro de aprendizaje</a></li>
            <li >Configuraci&oacute;n</li>
            <li class="active">Administrar Sedes</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default sombra">
            <div class="panel-heading"><h3 class="panel-title">Ingresar Sedes</h3></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <form id="formIngresarSede" name="formIngresarSede" method="POST" class="form-inline">
                            <div class="form-group">
                                <label for="nombreSede">Nombre Sede:</label>
                                <input type="text" id="nombreSede" name="nombreSede" class="form-control" placeholder="Ingrese Sede">                                
                            </div>
                            <button id="btnAgregarSede" class="btn color-principal blanco"><i class="fa fa-home"></i>&nbsp;Agregar Sede</button>
                        </form>
                        <br/>
                        <div class="alert alert-success mensajeExito noDisplay"><i class="fa fa-home"></i>&nbsp;Sede ingresada Exitosamente</div>
                        <div class="alert alert-danger mensajeError noDisplay"><i class="fa fa-warning"></i>&nbsp;Error, no se ha podido ingresar la Sede</div>
                    </div>
                </div>      
                <br/>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default sombra">
            <div class="panel-heading"><h3 class="panel-title">Administrar Sedes</h3></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="table-responsive cargaAjaxTabla">
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

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>