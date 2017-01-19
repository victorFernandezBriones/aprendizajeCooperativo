//------------------------------//
//           INICIO            //
//----------------------------//
function cargarInicio() {
    $(".cargaAjax").empty();
    $("#dato-inicio").show("fast");
}

//********************************//

//          MANTENEDORES         //

//******************************//


//------------------------------//
//          USUARIOS           //
//----------------------------//
function cargarPerfilUsuario() {
    $("#dato-inicio").hide("fast");
    $.get("configuracion/usuario/perfilUsuario.php", function (r) {

        $.getScript("funcionesJS/configuracion/funcionesAdmUsuarios.js");
        $(".cargaAjax").html(r);
    });
}

function cargarIngresarUsuario() {
    $("#dato-inicio").hide("fast");

    $.get("configuracion/usuario/ingresarUsuario.php", function (r) {
        $.getScript("funcionesJS/configuracion/funcionesAdmUsuarios.js");
        $(".cargaAjax").html(r);
    });
}


function cargarAdministrarUsuario() {
    $("#dato-inicio").hide("fast");

    $.get("configuracion/usuario/administrarUsuarios.php", function (r) {

        $.getScript("funcionesJS/configuracion/funcionesAdmUsuarios.js");
        $(".cargaAjax").html(r);
    });
}

//-------------------------------//
//           SEDES              //
//-----------------------------//

function cargarAdministrarSedes() {

    $("#dato-inicio").hide("fast");

    $.get("configuracion/sede/administrarSedes.php", function (r) {

        $.getScript("funcionesJS/configuracion/funcionesAdmSedes.js");
        $(".cargaAjax").html(r);
    });
}

//-------------------------------//
//           CURSOS             //
//-----------------------------//

function cargarAdministrarCursos() {

    $("#dato-inicio").hide("fast");

    $.get("configuracion/curso/administrarCursos.php", function (r) {

        $.getScript("funcionesJS/configuracion/funcionesAdmCursos.js");
        $(".cargaAjax").html(r);
    });
}


//-------------------------------//
//           NIVEL CURSOS       //
//-----------------------------//

function cargarAdministrarNivelCursos() {

    $("#dato-inicio").hide("fast");

    $.get("configuracion/nivelCurso/administrarNivelCursos.php", function (r) {

        $.getScript("funcionesJS/configuracion/funcionesAdmNivelCursos.js");
        $(".cargaAjax").html(r);
    });
}


//-------------------------------//
//         ASIGNATURA           //
//-----------------------------//

function cargarAdministrarAsignaturas() {

    $("#dato-inicio").hide("fast");

    $.get("configuracion/asignatura/administrarAsignatura.php", function (r) {

        $.getScript("funcionesJS/configuracion/funcionesAdmAsignaturas.js");
        $(".cargaAjax").html(r);
    });
}


//-------------------------------//
//         ENTIDADES            //
//-----------------------------//
function cargarAdministrarEntidad() {

    $("#dato-inicio").hide("fast");

    $.get("configuracion/entidad/administrarTipoEntidades.php", function (r) {

        $.getScript("funcionesJS/configuracion/funcionesAdmTipoEntidades.js");

        $(".cargaAjax").html(r);
    });
}


//********************************//

//       FIN MANTENEDORES        //

//******************************//



//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@//

//------------------------------//
//          PSICOLOGICO       //
//----------------------------//

function cargarPautaEvaluacionPsicologica() {

    $("#dato-inicio").hide("fast");
    $.get("psicologico/pautaEvaluacionPsicologica.php", function (r) {

        $.getScript("funcionesJS/psicologico/funcionesPsicologico.js");
        $.getScript("funcionesJS/cargarCalendario.js");
        $(".cargaAjax").html(r);
    });
}


function cargarInformeAlumno() {
    $("#dato-inicio").hide("fast");

    $("#liInformeAlumno").addClass('active');
    $.get("psicologico/informeAlumno.php", function (r) {

        $.getScript("funcionesJS/psicologico/funcionesPsicologico.js");
        $.getScript("funcionesJS/cargarCalendario.js");
        $(".cargaAjax").html(r);
    });
}



function cargarInformeGrupo() {
    $("#dato-inicio").hide("fast");
    $.get("psicologico/informeGrupo.php", function (r) {

        $.getScript("funcionesJS/psicologico/funcionesPsicologico.js");
        $.getScript("funcionesJS/cargarCalendario.js");
        $(".cargaAjax").html(r);
    });
}

//------------------------------//
//          ALUMNOS            //
//----------------------------//
function cargarIngresarAlumno() {
    $("#dato-inicio").hide("fast");

    $.get("alumno/ingresarAlumno.php", function (r) {

        $.getScript("funcionesJS/alumnos/funcionesAlumnos.js");
        $.getScript("funcionesJS/cargarCalendario.js");

        $(".cargaAjax").html(r);
    });
}

//------------------------------//
//         CALENDARIO          //
//----------------------------//
function cargarCalendario() {

    $("#dato-inicio").hide("fast");
    $.get("calendario/calendario.php", function (r) {

        $.getScript("funcionesJS/calendario/cargarCalendario.js");
        $(".cargaAjax").html(r);

    });

}


