<?php require_once '../../../negocio/configuracion/entidad/procesarAdministrarTipoEntidades.php';?>
<!--BREADCRUM -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Bienvenido</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="#" onclick="cargarInicio()">Centro de aprendizaje</a></li>
            <li >Configuraci&oacute;n</li>
            <li class="active">Administrar Tipo de Entidades</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default sombra">
            <div class="panel-heading"><h3 class="panel-title">Ingresar Tipo de Entidad</h3></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <form id="formIngresarEntidad" name="formIngresarEntidad" method="POST" class="form-inline">
                            <div class="form-group">
                                <label for="tipoEntidad">Tipo Entidad:</label>
                                <input type="text" id="tipoEntidad" name="tipoEntidad" class="form-control" placeholder="Ingrese Tipo de Entidad">                                
                            </div>
                            <button id="btnAgregarTipoEntidad" class="btn color-principal blanco"><i class="fa fa-users"></i>&nbsp;Agregar Entidad</button>
                        </form>
                        <br/>
                        <div class="alert alert-success mensajeExito noDisplay"><i class="fa fa-home"></i>&nbsp;Entidad ingresada Exitosamente</div>
                        <div class="alert alert-danger mensajeError noDisplay"><i class="fa fa-warning"></i>&nbsp;Error, no se ha podido ingresar la Entidad</div>
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
            <div class="panel-heading"><h3 class="panel-title">Administrar Tipo de Entidades</h3></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="table-responsive cargaAjaxTabla">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>