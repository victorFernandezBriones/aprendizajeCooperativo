<?php require_once '../../../negocio/configuracion/asignatura/procesarAdministrarAsignatura.php';?>
<!--BREADCRUM -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Bienvenido</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="#" onclick="cargarInicio()">Centro de aprendizaje</a></li>
            <li >Configuraci&oacute;n</li>
            <li class="active">Administrar Asignaturas</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default sombra">
            <div class="panel-heading"><h3 class="panel-title">Ingresar Asignatura</h3></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <form id="formIngresarAsignatura" name="formIngresarAsignatura" method="POST" class="form-inline">
                            <div class="form-group">
                                <label for="nombreAsignatura">Nombre Asignatura:</label>
                                <input type="text" id="nombreAsignatura" name="nombreAsignatura" class="form-control" placeholder="Ingrese Asignatura">                                
                            </div>
                            <button id="btnAgregarAsignatura" class="btn color-principal blanco"><i class="fa fa-file"></i>&nbsp;Agregar Asignatura</button>
                        </form>
                        <br/>
                        <div class="alert alert-success mensajeExito noDisplay"><i class="fa fa-home"></i>&nbsp;Asignatura ingresada Exitosamente</div>
                        <div class="alert alert-danger mensajeError noDisplay"><i class="fa fa-warning"></i>&nbsp;Error, no se ha podido ingresar la Asignatura</div>
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
            <div class="panel-heading"><h3 class="panel-title">Administrar Asignatura</h3></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="table-responsive cargaAjaxTabla">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
