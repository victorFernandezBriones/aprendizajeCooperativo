$(document).ready(function () {

    //CARGANDO INPUTS
//SELECT2
    $('#idAsignaturas').select2({
        placeholder: 'Seleccione asignatura'
    });

    google.charts.load("current", {packages: ["corechart"]});
//ESCONDIENDO LOS MENSAJES DE EXITO O ERROR A HACER FOCUS EN ALGUN INPUT
    $(":input").focus(function () {
        $(".mensajeExito").hide("fast");
        $(".mensajeError").hide("fast");
    });

//CARGANDO LOS ALUMNOS POR CURSO
    $("#idCurso").change(function () {
        $.get("../negocio/comunes/cargarAlumnosCurso.php", {"idCurso": $(this).val()}, function (r) {
            $("#divAlumnos").html(r);
        });

    });

//MOSTRANDO O ESCODIENDO DIV DE MINUTOS DE ATRASO
    $("input[id=tarde]").click(function () {
        $("#divMinAtraso").show("fast");
    });

    $("input[id=aTiempo]").click(function () {
        $("#divMinAtraso").hide("fast");
        $("#minAtraso").val();
    });

    $("input[id=ausente]").click(function () {
        $("#divMinAtraso").hide("fast");
        $("#minAtraso").val();
    });



    //LIMPIANDO INPUTS CON VALIDACIONES
    $("#fechaInicio").change(function () {
        $("#divFechaInicio").removeClass("has-error");
        $("#fechaInicio-error").hide("fast");
    });

    $("#fechaTermino").change(function () {
        $("#divFechaTermino").removeClass("has-error");
        $("#fechaTermino-error").hide("fast");
    });


    //INGRESANDO FORMULARIO
    $("#formPautaEvaluacionPsicologico").validate({
        rules: {
            idCurso: {
                required: true
            },
            fechaIngreso: {
                required: true,
                formatoFecha: true
            },
            asignatura: {
                required: true
            },
            idAlumno: {
                required: true
            },
            asistencia: {
                required: true
            },
            minAtraso: {
                required: true,
                number: true
            },
            rEmocional: {
                required: true,
                number: true,
                max: 7
            },
            rConducta: {
                required: true,
                number: true,
                max: 7
            },
            rAtencion: {
                required: true,
                number: true,
                max: 7
            },
            caracter: {
                required: true,
                number: true,
                max: 7
            },
            rAnimica: {
                required: true,
                number: true,
                max: 7
            },
            participacion: {
                required: true,
                number: true,
                max: 7
            },
            cooperacion: {
                required: true,
                number: true,
                max: 7
            },
            respeto: {
                required: true,
                number: true,
                max: 7
            },
            empatia: {
                required: true,
                number: true,
                max: 7
            },
            focalizacion: {
                required: true,
                number: true,
                max: 7
            },
            aperturaAprendizaje: {
                required: true,
                number: true,
                max: 7
            },
            cumplimientoRol: {
                required: true,
                number: true,
                max: 7
            },
            comprension: {
                required: true,
                number: true,
                max: 7
            },
            episodioCritico: {
                required: true
            }
        },
        messages: {
            idCurso: {
                required: "Por favor, seleccione curso"
            },
            fechaIngreso: {
                required: "Ingrese fecha de ingreso",
                formatoFecha: "Error, formato incorrecto"
            },
            asignatura: {
                required: "Seleccione Asignatura"
            },
            idAlumno: {
                required: "Seleccione Alumno"
            },
            asistencia: {
                required: "Seleccione Asistencia"
            },
            minAtraso: {
                required: "Ingrese minutos de atraso",
                number: "Ingrese números"
            },
            rEmocional: {
                required: "Por favor, complete el campo",
                number: "Ingrese números",
                max: "Valor máximo excedido (7)"
            },
            rConducta: {
                required: "Por favor, complete el campo",
                number: "Ingrese números",
                max: "Valor máximo excedido (7)"
            },
            rAtencion: {
                required: "Por favor, complete el campo",
                number: "Ingrese números",
                max: "Valor máximo excedido (7)"
            },
            caracter: {
                required: "Por favor, complete el campo",
                number: "Ingrese números",
                max: "Valor máximo excedido (7)"
            },
            rAnimica: {
                required: "Por favor, complete el campo",
                number: "Ingrese números",
                max: "Valor máximo excedido (7)"
            },
            participacion: {
                required: "Por favor, complete el campo",
                number: "Ingrese números",
                max: "Valor máximo excedido (7)"
            },
            cooperacion: {
                required: "Por favor, complete el campo",
                number: "Ingrese números",
                max: "Valor máximo excedido (7)"
            },
            respeto: {
                required: "Por favor, complete el campo",
                number: "Ingrese números",
                max: "Valor máximo excedido (7)"
            },
            empatia: {
                required: "Por favor, complete el campo",
                number: "Ingrese números",
                max: "Valor máximo excedido (7)"
            },
            focalizacion: {
                required: "Por favor, complete el campo",
                number: "Ingrese números",
                max: "Valor máximo excedido (7)"
            },
            aperturaAprendizaje: {
                required: "Por favor, complete el campo",
                number: "Ingrese números",
                max: "Valor máximo excedido (7)"
            },
            cumplimientoRol: {
                required: "Por favor, complete el campo",
                number: "Ingrese números",
                max: "Valor máximo excedido (7)"
            },
            comprension: {
                required: "Por favor, complete el campo",
                number: "Ingrese números",
                max: "Valor máximo excedido (7)"
            },
            episodioCritico: {
                required: "Por favor, Seleccione una opción"
            }
        },
        submitHandler: function () {

            var idCurso = $("#idCurso").val();
            var fechaIngreso = $("#fechaIngreso").val();
            var asignatura = $("#asignatura").val();
            var idAlumno = $("#idAlumno").val();

            //ASISTENCIA
            var ausente = $("input[id=ausente]:checked").val() == "1" ? 1 : -1;
            var aTiempo = $("input[id=aTiempo]:checked").val() == "2" ? 1 : -1;
            var tarde = $("input[id=tarde]:checked").val() == "3" ? 1 : -1;
            var minAtraso = $("#minAtraso").val();

            //DATOS EVALUACION
            //estado personal
            var rEmocional = $("#rEmocional").val();
            var rConducta = $("#rConducta").val();
            var rAtencion = $("#rAtencion").val();
            var caracter = $("#caracter").val();
            var rAnimica = $("#rAnimica").val();

            //FUNCIONAMIENTO INTERACCIONAL
            var participacion = $("#participacion").val();
            var cooperacion = $("#cooperacion").val();
            var respeto = $("#respeto").val();
            var empatia = $("#empatia").val();

            //FUNCIONAMIENTO ACADEMICO
            var focalizacion = $("#focalizacion").val();
            var aperturaAprendizaje = $("#aperturaAprendizaje").val();
            var cumplimientoRol = $("#cumplimientoRol").val();
            var comprension = $("#comprension").val();

            //ANEXO
            var promedio = $("#promedio").val();
            var episodioCritico = $("#episodioCritico").val();
            var comentarios = $("#comentarios").val();

            $(".divGifCarga").show("fast");

            $.post("../negocio/psicologico/procesarPautaEvaluacionPsicologica.php", {"idCurso": idCurso, "fechaIngreso": fechaIngreso, "asignatura": asignatura, "idAlumno": idAlumno,
                "rEmocional": rEmocional, "rConducta": rConducta, "rAtencion": rAtencion, "caracter": caracter, "participacion": participacion, "cooperacion": cooperacion, "respeto": respeto,
                "empatia": empatia, "focalizacion": focalizacion, "aperturaAprendizaje": aperturaAprendizaje, "cumplimientoRol": cumplimientoRol, "comprension": comprension, "promedio": promedio,
                "episodioCritico": episodioCritico, "comentarios": comentarios, "ausente": ausente, "aTiempo": aTiempo, "tarde": tarde, "minAtraso": minAtraso, "rAnimica": rAnimica},
                    function (r) {

                        $(".divGifCarga").hide("fast");

                        if (r == 1) {

                            $(".mensajeError").hide();
                            $(".mensajeExito").show();

                            $("#formPautaEvaluacionPsicologico").each(function () {
                                this.reset();
                            });

                        } else {

                            $(".mensajeExito").hide();
                            $(".mensajeError").show();

                        }


                    });
        }

    });



//CALCULANDO PROMEDIO
    $(".nota").change(function () {

        //estado personal
        var rEmocional = parseInt($("#rEmocional").val() != "" ? $("#rEmocional").val() : 0);
        var rConducta = parseInt($("#rConducta").val() != "" ? $("#rConducta").val() : 0);
        var rAtencion = parseInt($("#rAtencion").val() != "" ? $("#rAtencion").val() : 0);
        var caracter = parseInt($("#caracter").val() != "" ? $("#caracter").val() : 0);

        //FUNCIONAMIENTO INTERACCIONAL
        var participacion = parseInt($("#participacion").val() != "" ? $("#participacion").val() : 0);
        var cooperacion = parseInt($("#cooperacion").val() != "" ? $("#cooperacion").val() : 0);
        var respeto = parseInt($("#respeto").val() != "" ? $("#respeto").val() : 0);
        var empatia = parseInt($("#empatia").val() != "" ? $("#empatia").val() : 0);
        var rAnimica = parseInt($("#rAnimica").val() != "" ? $("#rAnimica").val() : 0);

        //FUNCIONAMIENTO ACADEMICO
        var focalizacion = parseInt($("#focalizacion").val() != "" ? $("#focalizacion").val() : 0);
        var aperturaAprendizaje = parseInt($("#aperturaAprendizaje").val() != "" ? $("#aperturaAprendizaje").val() : 0);
        var cumplimientoRol = parseInt($("#cumplimientoRol").val() != "" ? $("#cumplimientoRol").val() : 0);
        var comprension = parseInt($("#comprension").val() != "" ? $("#comprension").val() : 0);

        var promedio;


        promedio = (rEmocional + rConducta + rAtencion + caracter + participacion + cooperacion + respeto + empatia + focalizacion + aperturaAprendizaje + cumplimientoRol + comprension + rAnimica) / 13;

        $("#promedio").val(promedio.toFixed((1)));
    });




    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@//
    //                        INFORME ALUMNO                        //
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@//

    $("#buscarCargarInforme").validate({
        rules: {
            idCurso: {
                required: true
            },
            idAlumno: {
                required: true
            },
            fechaInicio: {
                required: true,
                formatoFecha: true
            },
            fechaTermino: {
                required: true,
                formatoFecha: true
            }
        },
        messages: {
            idCurso: {
                required: "Seleccione Curso"
            },
            idAlumno: {
                required: "Seleccione Alumno"
            },
            fechaInicio: {
                required: "Ingrese Fecha de Inicio",
                formatoFecha: "Error, formato incorrecto"
            },
            fechaTermino: {
                required: "Ingrese Fecha de Término",
                formatoFecha: "Error, formato incorrecto"
            }
        },
        submitHandler: function () {

            var idAlumno = $("#idAlumno").val();
            var fechaInicio = $("#fechaInicio").val();
            var fechaTermino = $("#fechaTermino").val();
            var idAsignaturas = $("#idAsignaturas").val();

            $.get("../negocio/psicologico/procesarInformeAlumno.php", {"idAlumno": idAlumno, "fechaInicio": fechaInicio, "fechaTermino": fechaTermino, "idAsignaturas": idAsignaturas},
                    function (r) {

                        $(".cargaAjaxInforme").html(r);

                        $("#divGenerarReporte").show("fast");

                        var nombreAlumno = $("#nombreAlumno").val();

                        var ausente = $("#ausente").val();
                        var atiempo = $("#atiempo").val();
                        var tarde = $("#tarde").val();

                        var verde = $("#verde").val();
                        var amarillo = $("#amarillo").val();
                        var rojo = $("#rojo").val();


                        google.charts.setOnLoadCallback(cargarEstadisticaAsistencia(ausente, atiempo, tarde));
                        google.charts.setOnLoadCallback(cargarEstadisticaRegulacionGeneral(verde, amarillo, rojo));




                        var dom = $(".cargaAjaxInforme").html();

                        $("#htmlImprimir").val(dom);
                        $("#nombreAlumnoReporte").val(nombreAlumno);



                    });
        }

    });


    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@//
    //                        INFORME GRUPO                         //
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@//
    $("#idNivelCurso").change(function () {

        $.get("../negocio/comunes/cargarCursoNivel.php", {"idNivelCurso": $(this).val()}, function (r) {
            $("#divCurso").html(r);
        });

    });

    //GENERAR REPORTE
    $("#buscarCargarInformeGrupo").validate({
        rules: {
            idNivelCurso: {
                required: true
            },
            idCurso: {
                required: true
            },
            fechaInicio: {
                required: true,
                formatoFecha: true
            },
            fechaTermino: {
                required: true,
                formatoFecha: true
            }
        },
        messages: {
            idNivelCurso: {
                required: "Seleccione Nivel Curso"
            },
            idCurso: {
                required: "Seleccione Curso"
            },
            fechaInicio: {
                required: "Ingrese Fecha de Inicio",
                formatoFecha: "Error, formato incorrecto"
            },
            fechaTermino: {
                required: "Ingrese Fecha de Término",
                formatoFecha: "Error, formato incorrecto"
            }
        },
        submitHandler: function () {

            var idCurso = $("#idCurso").val();
            var fechaInicio = $("#fechaInicio").val();
            var fechaTermino = $("#fechaTermino").val();
            var idAsignaturas =$("#idAsignaturas").val();


            $(".divGifCarga").show("fast");
            $.get("../negocio/psicologico/procesarInformeGrupo.php", {"idCurso": idCurso, "fechaInicio": fechaInicio, "fechaTermino": fechaTermino,"idAsignaturas":idAsignaturas},
                    function (r) {
                        $(".divGifCarga").hide("fast");
                        $(".cargaAjaxInforme").html(r);
                        $("#divGenerarReporte").show("fast");

                        var dom = $(".cargaAjaxInforme").html();

                        $("#htmlImprimir").val(dom);
                        var nombreGrupoReporte = $("#nombreCurso").val();
                        $("#nombreGrupoReporte").val(nombreGrupoReporte);
                    });
        }


    });
});



function cargarEstadisticaAsistencia(ausente, atiempo, tarde) {

    var a = parseInt(ausente);
    var at = parseInt(atiempo);
    var t = parseInt(tarde);
    // Define the chart to be drawn.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Asistencia');
    data.addColumn('number', 'Días');
    data.addRows([
        ['Ausente', a],
        ['A tiempo', at],
        ['Tarde', t]
    ]);

    // Set chart options
    var options = {
        'width': 550,
        'height': 350,
        'is3D': true,
        colors: ['#ff0000', '#58c386', '#d58512']
    };

    // Instantiate and draw the chart.
    var chart = new google.visualization.PieChart(document.getElementById('estadisticaAsistencia'));
    chart.draw(data, options);

}


function cargarEstadisticaRegulacionGeneral(verde, amarillo, rojo) {

    var v = parseInt(verde);
    var a = parseInt(amarillo);
    var r = parseInt(rojo);
    // Define the chart to be drawn.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Regulación');
    data.addColumn('number', 'Evento');
    data.addRows([
        ['Regulación Estable', v],
        ['Regulacion Inestable', a],
        ['Disregulación', r]
    ]);

    // Set chart options
    var options = {
        'width': 550,
        'height': 350,
        'is3D': true,
        colors: ['#58c386', '#d58512', '#ff0000']

    };

    // Instantiate and draw the chart.
    var chart = new google.visualization.PieChart(document.getElementById('estadisticaRegulacionGeneral'));
    chart.draw(data, options);


}


function cargarEstadisticaEstadoPGrupo(ep, prom) {
    var fechas = new Array();
    var promedios = new Array();

    fechas = ep.split(';');
    promedios = prom.split(';');
    var data = [];

    for (i = 0; i < fechas.length; i++) {
        data[i] = {Fecha: fechas[i], "Promedio": promedios[i]};

    }

    new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'estadisticaEPGrupo',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: data,
        xkey: 'Fecha',
        ykeys: ['Promedio'],
        labels: ['Promedio'],
        pointSize: 6,
        hideHover: 'auto',
        resize: true,
        behaveLikeLine: true,
        lineColors: ['#310472'],
        xLabelFormat: function (Fecha) {
            return Fecha.getDate() + '/' + (Fecha.getMonth() + 1);
        },
        dateFormat: function (date) {
            d = new Date(date);
            return d.getDate() + '/' + (d.getMonth() + 1);
        }
    });

}


function cargarEstadisticafuncIGrupo(fech, prom) {

    var fechas = new Array();
    var promedios = new Array();

    fechas = fech.split(';');
    promedios = prom.split(';');
    var data = [];

    for (i = 0; i < fechas.length; i++) {
        data[i] = {Fecha: fechas[i], "Promedio": promedios[i]};

    }

    new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'estadisticasFIG',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: data,
        xkey: 'Fecha',
        ykeys: ['Promedio'],
        labels: ['Promedio'],
        pointSize: 6,
        hideHover: 'auto',
        resize: true,
        behaveLikeLine: true,
        lineColors: ['#310472'],
        xLabelFormat: function (Fecha) {
            return Fecha.getDate() + '/' + (Fecha.getMonth() + 1);
        },
        dateFormat: function (date) {
            d = new Date(date);
            return d.getDate() + '/' + (d.getMonth() + 1);
        }
    });
}


function cargarEstadisticafuncAGrupo(fech, prom) {

    var fechas = new Array();
    var promedios = new Array();

    fechas = fech.split(';');
    promedios = prom.split(';');
    var data = [];

    for (i = 0; i < fechas.length; i++) {
        data[i] = {Fecha: fechas[i], "Promedio": promedios[i]};

    }

    new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'estadisticasFAG',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: data,
        xkey: 'Fecha',
        ykeys: ['Promedio'],
        labels: ['Promedio'],
        pointSize: 6,
        hideHover: 'auto',
        resize: true,
        behaveLikeLine: true,
        lineColors: ['#310472'],
        xLabelFormat: function (Fecha) {
            return Fecha.getDate() + '/' + (Fecha.getMonth() + 1);
        },
        dateFormat: function (date) {
            d = new Date(date);
            return d.getDate() + '/' + (d.getMonth() + 1);
        }
    });
}



function labelFormatter(label, series) {
    return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>"
            + label + "<br/>" + Math.round(series.percent) + "%</div>";
}




function imprimirInforme(nombreInput) {
    var dom = "<img class='logoInforme' src='../../pa/media/logoCentroEducacional.jpg'>" + $("#" + nombreInput + "").html();
    ;
    $("#htmlImprimir").val(dom);

    $("#formImprimirInforme").submit();
}