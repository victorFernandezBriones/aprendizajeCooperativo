$(document).ready(function () {
    //ESCONDIENDO MENSAJES
    $(":input").focus(function () {

        $(".mensajeExito").hide("fast");
        $(".mensajeError").hide("fast");

    });

    $("#formIngresarCurso").validate({
        rules: {
            nombreCurso: {
                required: true,
                maxlength: 10,
                espacioBlanco: true
            },
            idNivelCurso: {
                required: true
            }
        },
        messages: {
            nombreCurso: {
                required: "Por favor, ingrese Curso",
                maxlength: "Error, límite de caracteres excedido(10)",
                espacioBlanco: "Error, no rellene con espacios"
            },
            idNivelCurso: {
                required: "Por favor, seleccione Nivel Curso"
            }
        },
        submitHandler: function () {
            var nombreCurso = $("#nombreCurso").val();
            var idNivelCurso = $("#idNivelCurso").val();

            $.post("../negocio/configuracion/curso/procesarAdministrarCurso.php", {"idNivelCurso": idNivelCurso, "nombreCurso": nombreCurso, "flag": 1}, function (r) {

                if (r == 1) {
                    $(".mensajeError").hide("fast");
                    $(".mensajeExito").show("fast");

                   $("#nombreCurso").val("");
                   $("#idNivelCurso").val("");

                    $.get("configuracion/curso/listarCursosAjax.php", function (r) {

                        $(".cargaAjaxTabla").html(r);
                    });

                } else {
                    $(".mensajeExito").hide("fast");
                    $(".mensajeError").show("fast");
                }
            });
        }

    });
});


function actualizarCurso(idCurso, nombreCursoM, IdNivelCursoM) {
    var idNivelCurso = $("#" + IdNivelCursoM + "").val();
    var nombreCurso = $("#" + nombreCursoM + "").val();



    $.post("../negocio/configuracion/curso/procesarAdministrarCurso.php", {"idCurso": idCurso, "nombreCurso": nombreCurso, "idNivelCurso": idNivelCurso, "flag": 2}, function (r) {
        alert(r);
        if (r == 1) {
            swal(
                    '¡Curso actualizado exitosamente!',
                    '',
                    'success'
                    );
        } else {
            swal(
                    '¡Error, no se ha podido actualizar el Curso!',
                    '',
                    'error'
                    );
        }
    });
}

function eliminarCurso(idCurso, idFila) {

    swal({//Seteando plugin sweetAlert
        title: '¿Está seguro que desea eliminar el Curso?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'No, cancelar',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    }).then(function () {



        $.post("../negocio/configuracion/curso/procesarAdministrarCurso.php", {"idCurso": idCurso, "flag": 3}, function (r) {
            if (r == 1) {
                swal(
                        '¡Curso eliminado exitosamente!',
                        '',
                        'success'
                        );

                $("#" + idFila + "").hide("fast");


            } else {
                swal(
                        '¡Error, no se ha podido eliminar el Curso!',
                        '',
                        'error'
                        );
            }
        });

    }, function (dismiss) {

        if (dismiss === 'cancel') {
            swal(
                    'Cancelado',
                    'El Curso no fue eliminado',
                    'error'
                    );
        }
    });
}

