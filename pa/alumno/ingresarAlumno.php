<?php require_once '../../negocio/alumno/procesarIngresarAlumno.php'; ?>

<!--BREADCRUM -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Bienvenido</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="#" onclick="cargarInicio()">Centro de aprendizaje</a></li>
            <li>Alumnos</li>
            <li class="active">Ingresar Alumno</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default sombra">
            <div class="panel-heading"><h1 class="color-secundario text-center blanco">Ingresar Alumno</h1></div>

            <div class="panel-body">
                <form id="formIngresarAlumno" name="formIngresarAlumno" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="rut" class="col-sm-4 control-label">Rut:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="rut" name="rut" placeholder="Ingrese rut sin puntos">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nombre" class="col-sm-4 control-label">Nombre:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="apellidoP" class="col-sm-4 control-label">Apellido Paterno:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="apellidoP" name="apellidoP" placeholder="Ingrese Apellido Paterno">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="apellidoM" class="col-sm-4 control-label">Apellido Materno:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="apellidoM" name="apellidoM" placeholder="Ingrese Apellido Materno">
                                </div>
                            </div>                           
                            <div id="divfotoAlumno" class="form-group">
                                <label for="fotoAlumno" class="col-sm-4 control-label">Foto:</label>
                                <div class="col-sm-8">
                                    <input type="file" id="fotoAlumno" name="fotoAlumno">
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div id="divFechaNacimiento" class="form-group">
                                <label for="fechaNacimiento" class="col-sm-4 control-label">Fecha Nacimiento:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="fechaNacimiento" name="fechaNacimiento" placeholder="Dia-Mes-Año">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edad" class="col-sm-4 control-label">Edad:</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" id="edad" name="edad" placeholder="Edad" min="1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="idCurso" class="col-sm-4 control-label">Curso:</label>
                                <div class="col-sm-4">
                                    <select id="idCurso" name="idCurso" class="form-control">
                                        <option value="">Seleccione</option>
                                        <?php
                                        if (isset($cursos)) :
                                            foreach ($cursos as $c) :
                                                $nivelCurso = $serviceNivelCurso->getNivelCursoPorId($c->getIdNivelCurso());
                                                ?>
                                                <option value="<?php echo $c->getIdCurso(); ?>"><?php echo $c->getCurso() . " " . $nivelCurso->getNivelCurso(); ?></option>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>

                                    </select>
                                </div>                       
                            </div>  
                            <div class="form-group">
                                <label for="colegioProveniente" class="col-sm-4 control-label">Colegio Proveniente:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="colegioProveniente" name="colegioProveniente" placeholder="Ingrese Colegio Proveniente">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="colegioProveniente" class="col-sm-4 control-label">Seguro M&eacute;dico:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="seguroMedico" name="seguroMedico" placeholder="Ingrese Seguro Médico">
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-warning btn-sm clonar" id="agregarFormEntidad" name="agregarFormEntidad"><i class="fa fa-plus-circle"></i>&nbsp;Agregar Entidad</button>
                        </div>  
                    </div>
                    <!--DATOS ENTIDAD -->
                    <div id="divEntidades">
                        <div id="datosEntidad" class="row form-clonado">                            
                            <div class="panel-heading"><h3 class="panel-title">Datos Entidad</h3></div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="idTipoEntidad" class="col-sm-4 control-label">Tipo Entidad:</label>
                                    <div class="col-sm-6">
                                        <select class="form-control"  name="idTipoEntidadE[][]" required="required">
                                            <option value="">Seleccione</option>
                                            <?php
                                            if (isset($tipoEntidades)) :
                                                foreach ($tipoEntidades as $te):
                                                    ?>
                                                    <option value="<?php echo $te->getIdTipoEntidad(); ?>"><?php echo $te->getTipoEntidad(); ?></option>
                                                    <?php
                                                endforeach;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nombreEntidad" class="col-sm-4 control-label">Nombre:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control"  name="nombreEntidad[]" placeholder="Ingrese Nombre">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="apellidoEntidadP" class="col-sm-4 control-label">Apellido Paterno:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control"  name="apellidoEntidadP[]" placeholder="Ingrese Apellido Paterno">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="apellidoEntidadM" class="col-sm-4 control-label">Apellido Materno:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="apellidoEntidadM[]" placeholder="Ingrese Apellido Materno">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="celularE" class="col-sm-4 control-label">Celular:</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control"  name="celularE[]" placeholder="Ingrese Celular">
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="fijoE" class="col-sm-4 control-label">Fijo:</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" name="fijoE[]" placeholder="Ingrese Fijo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="emailE" class="col-sm-4 control-label">E-mail:</label>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control" name="emailE[]" placeholder="ejemplo@ejemplo.cl">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="contenedorEntidades">

                        </div>

                    </div>

                    <!-- ACCIONES -->
                    <div class="form-group m-b-0">
                        <div class=" col-md-offset-2 col-sm-2">
                            <button type="Reset" class="btn btn-danger waves-effect waves-light btn-lg">Cancelar</button>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-success waves-effect waves-light btn-lg">Guardar</button>
                        </div>
                    </div>
                </form>
                <br/>
                <div class="row noDisplay divGifCarga">   
                    <div class="col-md-12">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active color-principal" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">100% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success text-center mensajeExito noDisplay"><label><i class="fa fa-user"></i>&nbsp;Alumno Ingresado Exitosamente</label></div>
                <div class="alert alert-danger text-center mensajeError noDisplay"><label><i class="fa fa-warning"></i>&nbsp;Error, no se ha podido ingresar el Alumno</label></div>
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div>
</div>

