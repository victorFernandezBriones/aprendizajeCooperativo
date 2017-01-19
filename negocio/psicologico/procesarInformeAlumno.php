<?php
require_once '../../data/Alumno.php';
require_once '../../data/Evaluacion.php';
require_once '../../data/Asistencia.php';
require_once '../../data/EstadoPersonal.php';
require_once '../../data/FuncionamientoAcademico.php';
require_once '../../data/FuncionamientoInteraccional.php';
require_once '../../data/Funciones.php';
require_once '../../data/Asignatura.php';

//SERVICIOS

if ($_GET):

    $serviceAlumno = new Alumno();
    $serviceEvaluacion = new Evaluacion();
    $serviceAsistencia = new Asistencia();
    $serviceEstadoPersonal = new EstadoPersonal();
    $serviceFuncionamientoAcad = new FuncionamientoAcademico();
    $serviceFuncionamientoI = new FuncionamientoInteraccional();
    $serviceFunciones = new Funciones();
    $serviceAsignatura = new Asignatura();


    $idAlumno = htmlspecialchars($_GET['idAlumno']);
    $fechaInicio = $serviceFunciones->formatoFechaGuardarDB(htmlspecialchars($_GET['fechaInicio']));
    $fechaTermino = $serviceFunciones->formatoFechaGuardarDB(htmlspecialchars($_GET['fechaTermino']));
    $asignaturas = $_GET['idAsignaturas'];

    $asistencias = array(); //array para almacenar los obj asistencia que de pende de cada evaluacion
    $funcionamientosI = array(); //array para almacenar los obj asistencia que de pende de cada evaluacion
    $funcionamientosA = array(); //array para almacenar los obj asistencia que de pende de cada evaluacion
    $estadosPersonales = array(); //array para almacenar los obj asistencia que de pende de cada evaluacion
    $evaluaciones = $serviceEvaluacion->getEvaluacionesPorAlumnoFechasYasignaturas($idAlumno, $fechaInicio, $fechaTermino, $asignaturas);
    $alumno = $serviceAlumno->getAlumnoPorId($idAlumno);
    $nombreAlumno = $alumno->getNombreAlumno() . " " . $alumno->getApellidoPAlumno() . " " . $alumno->getApellidoMAlumno();

    if (count($evaluaciones) > 0) {
        foreach ($evaluaciones as $e) {//obteniendo asistencias y promedios
            $asistencia = $serviceAsistencia->getAsistenciaPorEvaluacion($e->getIdEvaluacion());
            $estadoPersonal = $serviceEstadoPersonal->getEstadoPersonalPorEvaluacion($e->getIdEvaluacion());
            $funcionamientoI = $serviceFuncionamientoI->getFuncionamientoInteraccionalPorEvaluacion($e->getIdEvaluacion());
            $funcionamientoA = $serviceFuncionamientoAcad->getFuncionamientoAcademicoPorEvaluacion($e->getIdEvaluacion());

            array_push($asistencias, $asistencia);
            array_push($estadosPersonales, $estadoPersonal);
            array_push($funcionamientosI, $funcionamientoI);
            array_push($funcionamientosA, $funcionamientoA);
        }
    }

//REGULACION GENERAL
    $regulacionGeneral = $serviceEvaluacion->obtenerRegulacionGeneral($evaluaciones);

//resumen asistencia
    $ra = $serviceAsistencia->calcularAsistencias($asistencias); //metodo que calcula las asistencias del alumno
//promedio funcionamiento interaccional
    if (count($evaluaciones) > 0):
        $promediosFI = $serviceFuncionamientoI->calcularPromediosFuncionamientoI($funcionamientosI);
        $promediosFA = $serviceFuncionamientoAcad->calcularPromediosFuncionamientoAcad($funcionamientosA);
        $promediosEP = $serviceEstadoPersonal->calcularPromedioEstadoPersonal($estadosPersonales);
        $episodiosCriticos = $serviceEvaluacion->contarEpisodioCritico($evaluaciones);
    endif;

endif;
?>

<div id="asd" class="row">
    <h4 class="text-center blanco color-principal">Informe Alumnos</h4>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <label class=" col-sm-6 control-label">Nombre Completo:</label>
            <label class="col-sm-6 control-label"><?php echo $alumno->getNombreAlumno() . " " . $alumno->getApellidoPAlumno() . " " . $alumno->getApellidoMAlumno(); ?></label>
        </div>
        <div class="form-group">
            <label class=" col-sm-6 control-label">Fecha Inicial:</label>
            <label class=" col-sm-6 control-label"><?php echo $serviceFunciones->formatoFecha($fechaInicio); ?></label>            
        </div>
        <div class="form-group">
            <label class=" col-sm-6 control-label">Fecha T&eacute;rmino:</label>
            <label class=" col-sm-6 control-label"><?php echo $serviceFunciones->formatoFecha($fechaTermino); ?></label>            
        </div>
        <div class="form-group">
            <label class=" col-sm-5 control-label">Asignatura(s):</label>
            <div class="col-sm-6">
                <ul>
                    <?php
                    foreach ($evaluaciones as $e) {
                        $asignatura = $serviceAsignatura->getAsignaturaPorId($e->getIdAsignatura());
                        ?>
                        <li><label><?php echo $asignatura->getAsignatura(); ?></label></li>
                    <?php } ?>
                </ul>      
            </div>

        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 text-center">
        <div id="divLogoInforme" class="text-center">
            <img id="logoInforme" class="img-responsive" alt="logoColegio" src="media/logoCentroEducacional.jpg">
        </div>

    </div>
</div>

<?php if (count($evaluaciones) == 0): ?>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning text-center"><i class="fa fa-warning"></i>&nbsp;No se han realizado evaluaciones</div>

        </div>

    </div>
    <?php
else:
    ?>
    <div class="row">
        <hr>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <h4 class="color-principal blanco text-center">Porcentaje de asistencia</h4>
            <br/>
            <div class="table-responsive">
                <table class="table table-bordered table-hover tabla-informes">
                    <thead>
                        <tr>
                            <th>Ausente</th>
                            <th>A tiempo</th>
                            <th>Tarde</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody  class="text-center">
                        <tr>
                            <td><label class="control-label"><?php echo $ra['ausente']; ?></label></td>
                            <td><label class="control-label"><?php echo $ra['atiempo']; ?></label></td>
                            <td><label class="control-label"><?php echo $ra['tarde']; ?></label></td>
                            <td><label class="control-label"><?php echo $ra['total']; ?></label></td>
                        </tr>
                    </tbody>
                </table>

                <input type="hidden"  id="total" value="<?php echo $ra['total']; ?>">
                <input type="hidden"  id="atiempo" value="<?php echo $ra['atiempo']; ?>">
                <input type="hidden"  id="ausente" value="<?php echo $ra['ausente']; ?>">
                <input type="hidden"  id="tarde" value="<?php echo $ra['tarde']; ?>"> 

            </div>
            <!--Estadisticas -->

            <div id="estadisticaAsistencia" class="estadisticas">



            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-6">
            <h4 class="color-principal blanco text-center">Regulaci&oacute;n General</h4>
            <br/>
            <div class="table-responsive">
                <table class="table table-bordered table-hover tabla-informes">
                    <thead>
                        <tr>
                            <th>Regulaci&oacute;n Estable</th>
                            <th>Regulaci&oacute;n Inestable</th>
                            <th>Disregulaci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td><label class="control-label"><?php echo $regulacionGeneral['verde']; ?></label></td>
                            <td><label class="control-label"><?php echo $regulacionGeneral['amarillo']; ?></label></td>
                            <td><label class="control-label"><?php echo $regulacionGeneral['rojo']; ?></label></td>
                        </tr>

                    </tbody>  
                </table>
            </div>

            <input type="hidden" id="verde" value="<?php echo $regulacionGeneral['verde']; ?>">
            <input type="hidden" id="amarillo" value="<?php echo $regulacionGeneral['amarillo']; ?>">
            <input type="hidden" id="rojo" value="<?php echo $regulacionGeneral['rojo']; ?>">


            <div id="estadisticaRegulacionGeneral" class="estadisticas">

            </div>

        </div>
    </div>
    <hr>
    <div class="row">
        <h4 class="color-principal blanco text-center">Porcentaje de Episodios Cr&iacute;ticos</h4>
        <div class="col-xs-12 table-responsive text-center">
            <table id="tablaAsistencia">
                <tr>
                    <td>
                        <h4>D&iacute;as Asistidos:</h4>
                    </td>
                    <td>
                        <h4><?php echo $ra['tarde'] + $ra['atiempo']; ?></h4>
                    </td>
                    <td>
                        <h4>D&iacute;as Cr&iacute;ticos:</h4>
                    </td>
                    <td>
                        <h4><?php echo $episodiosCriticos; ?></h4>
                    </td>
                </tr>              
            </table>
        </div>
    </div>
    <br/>
    <hr>
    <br/>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">      
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-hover text-center tabla-informes">
                        <thead>
                            <tr>
                                <th>Estado Personal</th>
                                <th>Promedios</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //obteniendo clasificaciones segun promedio
                            $promedioGeneralEstadoP = new EstadoPersonal();
                            $promedioGeneralEstadoP->setRAnimica($promediosEP['rAnimica']);
                            $promedioGeneralEstadoP->setREmocional($promediosEP['rEmocional']);
                            $promedioGeneralEstadoP->setRConducta($promediosEP['rConductual']);
                            $promedioGeneralEstadoP->setRAtencion($promediosEP['rAtencion']);
                            $promedioGeneralEstadoP->setCaracter($promediosEP['caracter']);

                            $clasificacionesEP = $serviceEstadoPersonal->obtenerClasificacionPorPromedioEP($promedioGeneralEstadoP);
                            ?>
                            <tr>
                                <td class="text-left">1.- Regulaci&oacute;n An&iacute;mica</td>
                                <td class="<?php echo $serviceFunciones->colorPromedio($promediosEP['rAnimica']); ?>">
                                    <?php echo $serviceFunciones->formatoNotasyPromedios($promediosEP['rAnimica']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="<?php echo $serviceFunciones->colorPromedio($promediosEP['rAnimica']); ?>">
                                    <?php echo $clasificacionesEP['clasificacionRA']; ?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-left" >2.- Regulaci&oacute;n Emocional</td>
                                <td class="<?php echo $serviceFunciones->colorPromedio($promediosEP['rEmocional']); ?>">
                                    <?php echo $serviceFunciones->formatoNotasyPromedios($promediosEP['rEmocional']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="<?php echo $serviceFunciones->colorPromedio($promediosEP['rEmocional']); ?>">
                                    <?php echo $clasificacionesEP['clasificacionRE']; ?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-left">3.- Regulaci&oacute;n Conductual</td>
                                <td class="<?php echo $serviceFunciones->colorPromedio($promediosEP['rConductual']); ?>">
                                    <?php echo $serviceFunciones->formatoNotasyPromedios($promediosEP['rConductual']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="<?php echo $serviceFunciones->colorPromedio($promediosEP['rConductual']); ?>">
                                    <?php echo $clasificacionesEP['clasificacionRC']; ?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-left">4.- Regulaci&oacute;n de la Atenci&oacute;n</td>
                                <td class="<?php echo $serviceFunciones->colorPromedio($promediosEP['rAtencion']); ?>">
                                    <?php echo $serviceFunciones->formatoNotasyPromedios($promediosEP['rAtencion']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="<?php echo $serviceFunciones->colorPromedio($promediosEP['rAtencion']); ?>">
                                    <?php echo $clasificacionesEP['clasificacionRAT']; ?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-left">5.- Car&aacute;cter</td>
                                <td class="<?php echo $serviceFunciones->colorPromedio($promediosEP['caracter']); ?>">
                                    <?php echo $serviceFunciones->formatoNotasyPromedios($promediosEP['caracter']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="<?php echo $serviceFunciones->colorPromedio($promediosEP['caracter']); ?>">
                                    <?php echo $clasificacionesEP['clasificacionC']; ?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-left">6.- Promedio General Estado Personal</td>
                                <td class="<?php echo $serviceFunciones->colorPromedio($promediosEP['promedioGeneral']); ?>">
                                    <?php echo $serviceFunciones->formatoNotasyPromedios($promediosEP['promedioGeneral']); ?>
                                </td>
                            </tr>                                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 table-responsive">        
            <div class="form-group">
                <div class="col-md-12 table-responsive">
                    <table  id="tableDetalleEstadoPersonal" class="table table-bordered table-hover text-center tabla-informes">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Regulaci&oacute;n An&iacute;mica</th>
                                <th>Regulaci&oacute;n Emocional</th>
                                <th>Regulaci&oacute;n Conductual</th>
                                <th>Regulaci&oacute;n de la Atenci&oacute;n</th>
                                <th>Car&aacute;cter</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($evaluaciones)):
                                foreach ($evaluaciones as $e) :
                                    $ep = $serviceEstadoPersonal->getEstadoPersonalPorEvaluacion($e->getIdEvaluacion()); //ESTADO PERSONAL
                                    ?>
                                    <tr>
                                        <td><?php echo $serviceFunciones->formatoFecha($e->getFechaEvaluacion()); ?></td>
                                        <td class="<?php echo $serviceFunciones->colorPromedio($ep->getRAnimica()); ?>"><?php echo $ep->getRAnimica(); ?></td>
                                        <td class="<?php echo $serviceFunciones->colorPromedio($ep->getREmocional()); ?>"><?php echo $ep->getREmocional(); ?></td>
                                        <td class="<?php echo $serviceFunciones->colorPromedio($ep->getRConducta()); ?>"><?php echo $ep->getRConducta(); ?></td>
                                        <td class="<?php echo $serviceFunciones->colorPromedio($ep->getRAtencion()); ?>"><?php echo $ep->getRAtencion(); ?></td>
                                        <td class="<?php echo $serviceFunciones->colorPromedio($ep->getCaracter()); ?>"><?php echo $ep->getCaracter(); ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 table-responsive"> 
            <table class="table table-bordered table-hover table-striped text-center tabla-informes">
                <thead>
                    <tr>
                        <th>Funcionamiento Interaccional</th>
                        <th>Promedios</th>
                    </tr>
                </thead>
                <tbody >
                    <?php
                    $promedioGeneralFuncionamientoI = new FuncionamientoInteraccional();
                    $promedioGeneralFuncionamientoI->setParticipacion($promediosFI['participacionPromedio']);
                    $promedioGeneralFuncionamientoI->setCooperacion($promediosFI['cooperacionPromedio']);
                    $promedioGeneralFuncionamientoI->setRespeto($promediosFI['respetoPromedio']);
                    $promedioGeneralFuncionamientoI->setEmpatiaContacto($promediosFI['empatiaContactoPromedio']);

                    $clasificacionFI = $serviceFuncionamientoI->obtenerClasificacionPorPromedioFI($promedioGeneralFuncionamientoI);
                    ?>
                    <tr>
                        <td class="text-left">1.- Participaci&oacute;n</td>
                        <td  class="<?php echo $serviceFunciones->colorPromedio($promediosFI['participacionPromedio']); ?>">
                            <?php echo $serviceFunciones->formatoNotasyPromedios($promediosFI['participacionPromedio']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFI['participacionPromedio']); ?>">
                            <?php echo $clasificacionFI['clasificacionP']; ?>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td class="text-left">2.- Cooperaci&oacute;n</td>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFI['cooperacionPromedio']); ?>">
                            <?php echo $serviceFunciones->formatoNotasyPromedios($promediosFI['cooperacionPromedio']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFI['cooperacionPromedio']); ?>">
                            <?php echo $clasificacionFI['clasificacionC']; ?>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td class="text-left">3.-Respeto</td>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFI['respetoPromedio']); ?>">
                            <?php echo $serviceFunciones->formatoNotasyPromedios($promediosFI['respetoPromedio']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFI['respetoPromedio']); ?>">
                            <?php echo $clasificacionFI['clasificacionR']; ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-left">4.-Empat&iacute;a y Contacto</td>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFI['empatiaContactoPromedio']); ?>">
                            <?php echo $serviceFunciones->formatoNotasyPromedios($promediosFI['empatiaContactoPromedio']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFI['empatiaContactoPromedio']); ?>">
                            <?php echo $clasificacionFI['clasificacionE']; ?>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td class="text-left">5.-Promedio Funcionamiento Interaccional</td>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFI['promedioFinal']); ?>">
                            <?php echo $serviceFunciones->formatoNotasyPromedios($promediosFI['promedioFinal']); ?>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 table-responsive"> 
            <table class="table table-bordered table-hover text-center tabla-informes">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Participaci&oacute;n</th>
                        <th>Cooperaci&oacute;n</th>
                        <th>Respeto</th>
                        <th>Empat&iacute;a</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($evaluaciones)):
                        foreach ($evaluaciones as $e) :
                            $fi = $serviceFuncionamientoI->getFuncionamientoInteraccionalPorEvaluacion($e->getIdEvaluacion());
                            ?>
                            <tr>
                                <td><?php echo $e->getFechaEvaluacion(); ?></td>
                                <td class="<?php echo $serviceFunciones->colorPromedio($fi->getParticipacion()); ?>"><?php echo $fi->getParticipacion(); ?></td>
                                <td class="<?php echo $serviceFunciones->colorPromedio($fi->getCooperacion()); ?>"><?php echo $fi->getCooperacion(); ?></td>
                                <td class="<?php echo $serviceFunciones->colorPromedio($fi->getRespeto()); ?>"><?php echo $fi->getRespeto(); ?></td>
                                <td class="<?php echo $serviceFunciones->colorPromedio($fi->getEmpatiaContacto()); ?>"><?php echo $fi->getEmpatiaContacto(); ?></td>
                            </tr>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 table-responsive">
            <?php
            $funcionamientoAG = new FuncionamientoAcademico();
            $funcionamientoAG->setFocalizacion($promediosFA['focalizacion']);
            $funcionamientoAG->setAperturaAprendizaje($promediosFA['aperturaAprend']);
            $funcionamientoAG->setCRolTarea($promediosFA['cumplimientoRolTarea']);
            $funcionamientoAG->setComprension($promediosFA['comprension']);

            $clasificacioFA = $serviceFuncionamientoAcad->obtenerClasificacionPorPromedioFA($funcionamientoAG);
            ?>
            <table class="table table-bordered table-hover table-striped text-center tabla-informes">
                <thead>
                    <tr>
                        <th>Funcionamiento Acad&eacute;mico</th>
                        <th>Promedios</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td class="text-left">1.- Focalizaci&oacute;n</td>
                        <td  class="<?php echo $serviceFunciones->colorPromedio($promediosFA['focalizacion']); ?>"><?php echo $serviceFunciones->formatoNotasyPromedios($promediosFA['focalizacion']); ?> </td>
                    </tr>
                    <tr>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFA['focalizacion']); ?>">
                            <?php echo $clasificacioFA['clasificacionF']; ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-left">2.- Apertura al Aprendizaje</td>
                        <td  class="<?php echo $serviceFunciones->colorPromedio($promediosFA['aperturaAprend']); ?>"><?php echo $serviceFunciones->formatoNotasyPromedios($promediosFA['aperturaAprend']); ?> </td>
                    </tr>
                    <tr>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFA['aperturaAprend']); ?>">
                            <?php echo $clasificacioFA['clasificacionA']; ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-left">3.- Cumplimiento de Rol o Tarea</td>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFA['cumplimientoRolTarea']); ?>"><?php echo $serviceFunciones->formatoNotasyPromedios($promediosFA['cumplimientoRolTarea']); ?> </td>
                    </tr>
                    <tr>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFA['cumplimientoRolTarea']); ?>">
                            <?php echo $clasificacioFA['clasificacionCU']; ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-left">4.- Comprensi&oacute;n</td>
                        <td  class="<?php echo $serviceFunciones->colorPromedio($promediosFA['comprension']); ?>"><?php echo $serviceFunciones->formatoNotasyPromedios($promediosFA['comprension']); ?> </td>
                    </tr>
                    <tr>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFA['comprension']); ?>">
                            <?php echo $clasificacioFA['clasificacionCO']; ?>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td class="text-left">5.- Promedio General Funcionamiento Acad&eacute;mico</td>
                        <td  class="<?php echo $serviceFunciones->colorPromedio($promediosFA['promedioGeneral']); ?>"><?php echo $serviceFunciones->formatoNotasyPromedios($promediosFA['promedioGeneral']); ?> </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 table-responsive">
            <table id="tablaDetalleFA" class="table table-bordered table-hover text-center tabla-informes">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Focalizaci&oacute;n</th>
                        <th>Apertura al Aprendizaje</th>
                        <th>Cumplimiento de Rol o Tarea</th>
                        <th>Comprensi&oacute;n</th>                   
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($evaluaciones)):
                        foreach ($evaluaciones as $e) :
                            $fa = $serviceFuncionamientoAcad->getFuncionamientoAcademicoPorEvaluacion($e->getIdEvaluacion());
                            ?>
                            <tr>
                                <td><?php echo $serviceFunciones->formatoFecha($e->getFechaEvaluacion()); ?></td>
                                <td class="<?php echo $serviceFunciones->colorPromedio($fa->getFocalizacion()); ?>"><?php echo $fa->getFocalizacion(); ?></td>
                                <td class="<?php echo $serviceFunciones->colorPromedio($fa->getAperturaAprendizaje()); ?>"><?php echo $fa->getAperturaAprendizaje(); ?></td>
                                <td class="<?php echo $serviceFunciones->colorPromedio($fa->getCRolTarea()); ?>"><?php echo $fa->getCRolTarea(); ?></td>
                                <td class="<?php echo $serviceFunciones->colorPromedio($fa->getComprension()); ?>"><?php echo $fa->getComprension(); ?></td>
                            </tr>
                            <?php
                        endforeach;
                    endif;
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center blanco color-principal">Comentarios</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <?php
                    if (isset($evaluaciones)) :
                        foreach ($evaluaciones as $e) :
                            ?>
                            <tr>
                                <td class="fechaTd">
                                    <?php echo $serviceFunciones->formatoFecha($e->getFechaEvaluacion()); ?>
                                </td>
                                <td class="text-justify">
                                    <?php echo $e->getComentarios(); ?>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div id="divGenerarReporte" class="row noDisplay">
        <div class="col-md-12">
            <form id="formImprimirInforme" action="../negocio/informes/imprimirReportes.php" method="POST" target="_blank">
                <input type="hidden" id="htmlImprimir" name="htmlImprimir" value="">
                <input type="hidden" id="nombreAlumnoReporte" name="nombreAlumnoReporte" value="">
                <input type="hidden" id="flag" name="flag" value="1">
                <button type="button" onclick="imprimirInforme('informeAlumno')" class="btn color-principal blanco">&nbsp;Generar Reporte</button>
            </form>
        </div>
    </div>    
    <input type="hidden" name="nombreAlumno" id="nombreAlumno" value="<?php echo $nombreAlumno; ?>">

<?php endif; ?>




