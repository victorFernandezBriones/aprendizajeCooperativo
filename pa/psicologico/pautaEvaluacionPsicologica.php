<?php require_once '../../negocio/psicologico/procesarPautaEvaluacionPsicologica.php'; ?>

<!--BREADCRUM -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Bienvenido</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="#" onclick="cargarInicio()">Centro de aprendizaje</a></li>
            <li>Psicol&oacute;gico</li>
            <li class="active">Pauta Evaluaci&oacute;n Psicol&oacute;gica</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default sombra">
            <div class="panel-heading"><h1 class="color-secundario text-center blanco">Pauta Evaluaci&oacute;n Psicol&oacute;gica</h1></div>

            <div class="panel-body">
                <form id="formPautaEvaluacionPsicologico" name="formPautaEvaluacionPsicologico" class="form-horizontal" role="form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="curso" class="col-sm-2 control-label">Curso:</label>
                                <div class="col-sm-8">
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
                            <div id="divFechaEvaluacion" class="form-group">
                                <label for="fecha" class="col-sm-2 control-label">Fecha:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="fechaIngreso" name="fechaIngreso" placeholder="Dia-Mes-Año">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asignatura" class="col-sm-2 control-label">Asignatura:</label>
                                <div  class="col-sm-8">
                                    <select class="form-control" id="asignatura" name="asignatura" >
                                        <option value="">Seleccione</option>
                                        <?php
                                        if (isset($asignaturas)) :
                                            foreach ($asignaturas as $as) :
                                                ?>
                                                <option value="<?php echo $as->getIdAsignatura(); ?>"><?php echo $as->getAsignatura(); ?></option>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alumno" class="col-sm-2 control-label">Alumno:</label>
                                <div id="divAlumnos" class="col-sm-8">
                                    <select class="form-control" id="idAlumno" name="idAlumno" >
                                        <option value="">Seleccione</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="panel-heading"><h5 class="panel-title plomo">Asistencia</h5></div>
                    <div class="row form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 ">
                            <label class="col-sm-8 control-label">Ausente:</label>  
                            <div class="col-sm-4">
                                <input type="radio" class="form-control" id="ausente" name="asistencia" value="1">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <label class="col-sm-8 control-label">A tiempo:</label>  
                            <div class="col-sm-4">
                                <input type="radio" class="form-control" id="aTiempo" name="asistencia" value="2">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <label class="col-sm-8 control-label">Tarde:</label>  
                            <div class="col-sm-4">
                                <input type="radio" class="form-control" id="tarde" name="asistencia" value="3">
                            </div>
                        </div>
                        <div id="divMinAtraso" class="col-xs-12 col-sm-12 col-md-3 noDisplay form-group">
                            <label class="col-sm-8 control-label">Min. Atraso:</label>  
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="minAtraso" name="minAtraso" min="0">
                            </div>
                        </div>
                    </div>


                    <div class="panel-heading"><h5 class="panel-title plomo">Estado Personal</h5></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Regulaci&oacute;n Emocional:</label>             
                                <div class="col-sm-4">
                                    <input type="number" class="form-control nota" id="rEmocional" name="rEmocional" min="1" max="7">
                                </div> 
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Regulaci&oacute;n Conductal:</label>             
                                <div class="col-sm-4">
                                    <input type="number" class="form-control nota" id="rConducta" name="rConducta" min="1" max="7">
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Regulaci&oacute;n Atenci&oacute;n:</label>             
                                <div class="col-sm-4">
                                    <input type="number" class="form-control nota" id="rAtencion" name="rAtencion" min="1" max="7">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Car&aacute;cter:</label>             
                                <div class="col-sm-4">
                                    <input type="number" class="form-control nota" id="caracter" name="caracter" min="1" max="7">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="panel-heading"><h5 class="panel-title plomo">Funcionamiento interaccional</h5></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Participaci&oacute;n:</label>             
                                <div class="col-sm-4">
                                    <input type="number" class="form-control nota" id="participacion" name="participacion" min="1" max="7">
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Cooperaci&oacute;n:</label>             
                                <div class="col-sm-4">
                                    <input type="number" class="form-control nota" id="cooperacion" name="cooperacion" min="1" max="7">
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Respeto:</label>             
                                <div class="col-sm-4">
                                    <input type="number" class="form-control nota" id="respeto" name="respeto" min="1" max="7">
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Empat&iacute;a y contacto:</label>             
                                <div class="col-sm-4">
                                    <input type="number" class="form-control nota" id="empatia" name="empatia" min="1" max="7">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Regulaci&oacute;n An&iacute;mica:</label>             
                                <div class="col-sm-4">
                                    <input type="number" class="form-control nota" id="rAnimica" name="rAnimica" min="1" max="7">
                                </div> 
                            </div>
                        </div>
                    </div>


                    <div class="panel-heading"><h5 class="panel-title plomo">Funcionamiento acad&eacute;mico</h5></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="focalizacion" class="col-sm-8 control-label">Focalizaci&oacute;n:</label>             
                                <div class="col-sm-4">
                                    <input type="number" class="form-control nota" id="focalizacion" name="focalizacion" min="1" max="7">
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="aperturaApredizaje" class="col-sm-8 control-label">Apertura y aprendizaje:</label>             
                                <div class="col-sm-4">
                                    <input type="number" class="form-control nota" id="aperturaAprendizaje" name="aperturaAprendizaje" min="1" max="7">
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="cumplimientoRol" class="col-sm-8 control-label">Cumplimiento rol o tarea:</label>             
                                <div class="col-sm-4">
                                    <input type="number" class="form-control nota" id="cumplimientoRol" name="cumplimientoRol" min="1" max="7">
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="comprension" class="col-sm-8 control-label">Comprensi&oacute;n: </label>             
                                <div class="col-sm-4">
                                    <input type="number" class="form-control nota" id="comprension" name="comprension" min="1" max="7">
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="promedio" class="col-sm-4 control-label">Promedio:</label>             
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="promedio" name="promedio" min="0" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="episodioCritico" class="col-sm-4 control-label">Episodio Cr&iacute;tico:</label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="episodioCritico" name="episodioCritico" >
                                        <option value="">Seleccione</option>
                                        <option value="1">S&iacute;</option>
                                        <option value="2">No</option>
                                    </select>
                                </div> 
                            </div>

                        </div>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label for="comentarios" class="col-sm-2 control-label">Comentarios:</label> 
                        <div class="col-sm-8">
                            <textarea id="comentarios" name="comentarios" class="noResize form-control" rows="5"  style="resize: none"placeholder="Ingrese comentario"></textarea>
                        </div>
                    </div>

                    <!-- ACCIONES -->
                    <div class="form-group m-b-0">
                        <div class="col-md-offset-2 col-sm-2">
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

                <div class="alert alert-success text-center mensajeExito noDisplay"><label><i class="fa fa-user"></i>&nbsp;Evaluaci&oacute;n ingresada exitosamente</label></div>
                <div class="alert alert-danger text-center mensajeError noDisplay"><label><i class="fa fa-warning"></i>&nbsp;Error, no se ha podido ingresar la evaluaci&oacute;n</label></div>
            </div>
        </div>
    </div>
</div>