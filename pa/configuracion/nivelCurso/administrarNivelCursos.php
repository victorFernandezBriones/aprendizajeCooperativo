<?php require_once '../../../negocio/configuracion/nivelCurso/procesarAdministrarNivelCurso.php'; ?>

<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Bienvenido</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="#" onclick="cargarInicio()">Centro de aprendizaje</a></li>
            <li >Configuraci&oacute;n</li>
            <li class="active">Administrar Nivel Cursos</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default sombra">
            <div class="panel-heading"><h3 class="panel-title">Ingresar Nivel Curso</h3></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <form id="formIngresarNivelCurso" name="formIngresarNivelCurso" method="POST" class="form-inline">
                            <div class="form-group">
                                <label for="nombreNivelCurso">Nombre Nivel Curso:</label>
                                <input type="text" id="nivelCurso" name="nivelCurso" class="form-control" placeholder="Ingrese Nivel Curso">                                
                            </div>

                            <button id="btnAgregarNivelCurso" class="btn color-principal blanco"><i class="fa fa-home"></i>&nbsp;Agregar Nivel Curso</button>
                        </form>
                        <br/>
                        <div class="alert alert-success mensajeExito noDisplay"><i class="fa fa-home"></i>&nbsp;Nivel Curso ingresado Exitosamente</div>
                        <div class="alert alert-danger mensajeError noDisplay"><i class="fa fa-warning"></i>&nbsp;Error, no se ha podido ingresar el Nivel Curso</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default sombra">
            <div class="panel-heading"><h3 class="panel-title">Administrar Nivel Cursos</h3></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="table-responsive cargaAjaxTabla">
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

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>