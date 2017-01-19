<?php
require_once '../../data/Curso.php';
require_once '../../data/NivelCurso.php';
require_once '../../data/Evaluacion.php';
require_once '../../data/Asistencia.php';
require_once '../../data/EstadoPersonal.php';
require_once '../../data/FuncionamientoAcademico.php';
require_once '../../data/FuncionamientoInteraccional.php';
require_once '../../data/Funciones.php';
require_once '../../data/Asignatura.php';


//SERVICIOS

if ($_GET):

    $serviceCurso = new Curso();
    $serviceEvaluacion = new Evaluacion();
    $serviceEstadoPersonal = new EstadoPersonal();
    $serviceFuncionamientoAcad = new FuncionamientoAcademico();
    $serviceFuncionamientoI = new FuncionamientoInteraccional();
    $serviceFunciones = new Funciones();
    $serviceAsignatura = new Asignatura();


    $idCurso = htmlspecialchars($_GET['idCurso']);
    $fechaInicio = $serviceFunciones->formatoFechaGuardarDB(htmlspecialchars($_GET['fechaInicio']));
    $fechaTermino = $serviceFunciones->formatoFechaGuardarDB(htmlspecialchars($_GET['fechaTermino']));
    $asignaturas = $_GET['idAsignaturas'];   
    $funcionamientosI = array(); //array para almacenar los obj asistencia que de pende de cada evaluacion
    $funcionamientosA = array(); //array para almacenar los obj asistencia que de pende de cada evaluacion
    $estadosPersonales = array(); //array para almacenar los obj asistencia que de pende de cada evaluacion
    $evaluaciones = $serviceEvaluacion->getEvaluacionesPorCursosFechasYAsignaturas($idCurso, $fechaInicio, $fechaTermino,$asignaturas);
    $curso = $serviceCurso->getCursoNivelPorID($idCurso);
    $cursoNivel = $serviceCurso->getCursoNivelPorID($idCurso);
    $nombreCurso = $cursoNivel->getCurso()->getCurso() . " " . $cursoNivel->getNivelCurso()->getNivelCurso();

    $fechas = array();
    if (count($evaluaciones) > 0):
        foreach ($evaluaciones as $e) {//obteniendo asistencias y promedios
            $estadoPersonal = $serviceEstadoPersonal->getEstadoPersonalPorEvaluacion($e->getIdEvaluacion());
            $funcionamientoI = $serviceFuncionamientoI->getFuncionamientoInteraccionalPorEvaluacion($e->getIdEvaluacion());
            $funcionamientoA = $serviceFuncionamientoAcad->getFuncionamientoAcademicoPorEvaluacion($e->getIdEvaluacion());

            $promedioGraficos = $serviceEvaluacion->obtenerPromedios($estadoPersonal, $funcionamientoI, $funcionamientoA);


            array_push($fechas, $e->getFechaEvaluacion());


            array_push($estadosPersonales, $estadoPersonal);
            array_push($funcionamientosI, $funcionamientoI);
            array_push($funcionamientosA, $funcionamientoA);
        }
    endif;


    $fechas = array_unique($fechas); //eliminando valores duplicados 
    $fechas = array_values($fechas); //reordenando indices del array
//OBTENIENDO PROMEDIOS GENERALES DE CADA SECCION POR FECHA
    $promediosEPG = array();
    $promediosFIG = array();
    $promediosFAG = array();
//promedios por fechas
    if (count($evaluaciones) > 0):

        foreach ($fechas as $f) {
            $funcI = $serviceFuncionamientoI->getFuncionamientoInteraccionalPorCursoYFecha($idCurso, $f);
            $pFIG = $serviceFuncionamientoI->calcularPromediosFuncionamientoI($funcI);


            $funcA = $serviceFuncionamientoAcad->getFuncionamientoAcademicoPorCursoYFecha($idCurso, $f);
            $pFAG = $serviceFuncionamientoAcad->calcularPromediosFuncionamientoAcad($funcA);

            $estadosP = $serviceEstadoPersonal->getEstadosPersonalesPorFechaYcurso($idCurso, $f);
            $pEPG = $serviceEstadoPersonal->calcularPromedioEstadoPersonal($estadosP);

            array_push($promediosEPG, $pEPG['promedioGeneral']);
            array_push($promediosFIG, $pFIG['promedioFinal']);
            array_push($promediosFAG, $pFAG['promedioGeneral']);
        }
    endif;
    //configurando variables para generar estadisticas
    $pEPG = implode(";", $promediosEPG); //promedio general estado personal
    $pFIG = implode(";", $promediosFIG); //promedio general funcionamiento interaccional
    $pFAG = implode(";", $promediosFAG); //promedio general funcionamiento interaccional

    $fechas = implode(";", $fechas); //separando array para pasarlo a javascript
//promedio funcionamiento interaccional
    if (count($evaluaciones) > 0):
        $promediosFI = $serviceFuncionamientoI->calcularPromediosFuncionamientoI($funcionamientosI);
        $promediosFA = $serviceFuncionamientoAcad->calcularPromediosFuncionamientoAcad($funcionamientosA);
        $promediosEP = $serviceEstadoPersonal->calcularPromedioEstadoPersonal($estadosPersonales);
        $episodiosCriticos = $serviceEvaluacion->contarEpisodioCritico($evaluaciones);
    endif;

endif;
?>
<div class="row">
    <h4 class="text-center blanco color-principal">Informe Grupo</h4>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">           
            <label class=" col-sm-6 control-label">Curso:</label>
            <label class="col-sm-6 control-label"><?php echo $curso->getCurso()->getCurso() . " " . $curso->getNivelCurso()->getNivelCurso(); ?></label>
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
    <br/>
    <hr>
    <br/>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5">
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
        <div class="col-xs-12 col-sm-12 col-md-7">        
            <div class="form-group">
                <div class="col-md-12 ">
                    <h4 class="text-center">Estado Personal</h4>
                    <div id="estadisticaEPGrupo" class="estadisticas">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5 table-responsive"> 
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
        <div class="col-xs-12 col-sm-12 col-md-7 "> 
            <h4 class="text-center">Funcionamiento Interaccional</h4>
            <div id="estadisticasFIG" class="estadisticas">

            </div>

        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5 table-responsive">
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
                        <td  class="<?php echo $serviceFunciones->colorPromedio($promediosFA['focalizacion']); ?>">
                            <?php echo $serviceFunciones->formatoNotasyPromedios($promediosFA['focalizacion']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFA['focalizacion']); ?>">
                            <?php echo $clasificacioFA['clasificacionF']; ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-left">2.- Apertura al Aprendizaje</td>
                        <td  class="<?php echo $serviceFunciones->colorPromedio($promediosFA['aperturaAprend']); ?>">
                            <?php echo $serviceFunciones->formatoNotasyPromedios($promediosFA['aperturaAprend']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFA['aperturaAprend']); ?>">
                            <?php echo $clasificacioFA['clasificacionA']; ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-left">3.- Cumplimiento de Rol o Tarea</td>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFA['cumplimientoRolTarea']); ?>">
                            <?php echo $serviceFunciones->formatoNotasyPromedios($promediosFA['cumplimientoRolTarea']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFA['cumplimientoRolTarea']); ?>">
                            <?php echo $clasificacioFA['clasificacionCU']; ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-left">4.- Comprensi&oacute;n</td>
                        <td  class="<?php echo $serviceFunciones->colorPromedio($promediosFA['comprension']); ?>">
                            <?php echo $serviceFunciones->formatoNotasyPromedios($promediosFA['comprension']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="<?php echo $serviceFunciones->colorPromedio($promediosFA['comprension']); ?>">
                            <?php echo $clasificacioFA['clasificacionCO']; ?>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td class="text-left">5.- Promedio General Funcionamiento Acad&eacute;mico</td>
                        <td  class="<?php echo $serviceFunciones->colorPromedio($promediosFA['promedioGeneral']); ?>">
                            <?php echo $serviceFunciones->formatoNotasyPromedios($promediosFA['promedioGeneral']); ?>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7">
            <h4 class="text-center"> Funcionamiento Acad&eacute;mico</h4>
            <div id="estadisticasFAG" class="estadisticas">

            </div>
        </div>
    </div>
    <input type="hidden" id="nombreCurso" name="nombreCurso" value="<?php echo $nombreCurso; ?>">


<?php endif; ?>

<script>
    cargarEstadisticaEstadoPGrupo('<?php echo $fechas; ?>', '<?php echo $pEPG; ?>');
    cargarEstadisticafuncIGrupo('<?php echo $fechas; ?>', '<?php echo $pFIG; ?>');
    cargarEstadisticafuncAGrupo('<?php echo $fechas; ?>', '<?php echo $pFIG; ?>');

</script>