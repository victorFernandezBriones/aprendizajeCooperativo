<?php require_once '../../../negocio/configuracion/curso/procesarAdministrarCurso.php'; ?>

<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Bienvenido</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="#" onclick="cargarInicio()">Centro de aprendizaje</a></li>
            <li >Configuraci&oacute;n</li>
            <li class="active">Administrar Cursos</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default sombra">
            <div class="panel-heading"><h3 class="panel-title">Ingresar Curso</h3></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <form id="formIngresarCurso" name="formIngresarCurso" method="POST" class="form-inline">
                            <div class="form-group">
                                <label for="nombreCurso">Nombre Curso:</label>
                                <input type="text" id="nombreCurso" name="nombreCurso" class="form-control" placeholder="Ingrese Curso">                                
                            </div>
                            <div class="form-group">
                                <label for="nombreCurso">Nivel Curso:</label>
                                <select id="idNivelCurso" name="idNivelCurso" class="form-control">
                                    <option value="">Seleccione</option>
                                    <?php
                                    if (isset($nivelCursos)) :
                                        foreach ($nivelCursos as $nc):
                                            ?>
                                            <option value="<?php echo $nc->getIdNivelCurso(); ?>"><?php echo $nc->getNivelCurso(); ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>

                                </select>
                            </div>
                            <button id="btnAgregarCurso" class="btn color-principal blanco"><i class="fa fa-home"></i>&nbsp;Agregar Curso</button>
                        </form>
                        <br/>
                        <div class="alert alert-success mensajeExito noDisplay"><i class="fa fa-home"></i>&nbsp;Curso ingresado Exitosamente</div>
                        <div class="alert alert-danger mensajeError noDisplay"><i class="fa fa-warning"></i>&nbsp;Error, no se ha podido ingresar el Curso</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default sombra">
            <div class="panel-heading"><h3 class="panel-title">Administrar Cursos</h3></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="table-responsive cargaAjaxTabla">
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
                                                <td><button type="button" class="btn btn-success" onclick="actualizarCurso(<?php echo $cu->getIdCurso(); ?>, '<?php echo "nombreCurso" . $c; ?>','<?php echo "idNivelCurso" . $c; ?>')"><i class="fa fa-refresh"></i>&nbsp;Actualizar</button></td>
                                                <td><button type="button" class="btn btn-danger" onclick="eliminarCurso(<?php echo $cu->getIdCurso(); ?>, '<?php echo "fila" . $c; ?>')"><i class="fa fa-trash"></i>&nbsp;Eliminar</button></td>
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