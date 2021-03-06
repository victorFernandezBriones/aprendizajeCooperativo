<?php require_once '../../negocio/psicologico/cargarInforme.php'; ?>

<!--BREADCRUM -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Bienvenido</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="#" onclick="cargarInicio()">Centro de aprendizaje</a></li>
            <li>Psicol&oacute;gico</li>
            <li class="active">Informe Alumno</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default sombra">
            <div class="panel-heading"><h1 class="color-secundario text-center blanco">Informe Alumno</h1></div>

            <div class="panel-body">
                <form id="buscarCargarInforme" name="buscarCargarInforme" method="POST" class="form-horizontal">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 form-group">
                            <label class="col-sm-4 control-label">Curso:</label>
                            <div class="col-sm-6">
                                <select id="idCurso" name="idCurso" class="form-control">
                                    <option value="">Seleccione</option>
                                    <?php
                                    if (isset($cursos)) :
                                        foreach ($cursos as $c) :
                                            $nivel = $serviceNivelCurso->getNivelCursoPorId($c->getIdNivelCurso());
                                            ?>
                                            <option value="<?php echo $c->getIdCurso(); ?>"><?php echo $c->getCurso() . "  " . $nivel->getNivelCurso(); ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 form-group">
                            <label class="col-sm-4 control-label">Alumno:</label>
                            <div id="divAlumnos" class="col-sm-6">
                                <select id="idAlumno" name="idAlumno" class="form-control">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="divFechaInicio" class="col-xs-12 col-sm-12 col-md-6 form-group">
                            <label class="col-sm-4 control-label">Fecha Inicio:</label>
                            <div class="col-sm-4">
                                <input type="text" id="fechaInicio" name="fechaInicio" class="form-control" placeholder="Día-Mes-Año">
                            </div>
                        </div>
                        <div id="divFechaTermino" class="col-xs-12 col-sm-12 col-md-6 form-group">
                            <label class="col-sm-4 control-label">Fecha T&eacute;rmino:</label>
                            <div class="col-sm-4">
                                <input type="text" id="fechaTermino" name="fechaTermino" class="form-control" placeholder="Día-Mes-Año" value="<?php echo $fechaActual; ?>">
                            </div>
                        </div>                        
                    </div>
                    <div class="row">                      
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Asignatura(s):</label>
                                <div class="col-sm-8">
                                    <select id="idAsignaturas" class="select2 form-control" style="width: 100%" multiple="multiple">
                                        <option value="">Todas</option>
                                        <?php
                                        if (isset($asignaturas)) :
                                            foreach ($asignaturas as $a) :
                                                ?>     
                                                <option value="<?php echo $a->getIdAsignatura(); ?>"><?php echo $a->getAsignatura(); ?></option>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>      
                                    </select>
                                </div>
                            </div>
                        </div>                       
                    </div>
                    <div class="row">                       
                        <div class="col-xs-12 col-sm-12 col-md-6 form-group">
                            <label class="col-sm-4 control-label"></label>
                            <div class="col-sm-4">
                                <button type="submit" name="btnBuscarCargarInforme" id="btnBuscarCargarInforme" class="btn btn-success waves-effect"><i class="fa fa-search"></i>&nbsp;Generar Informe</button>
                            </div>
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
                <div class="row">
                    <div class="col-md-12">
                        <div id="informeAlumno" name="informeAlumno" class="cargaAjaxInforme">


                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>   
</div>
