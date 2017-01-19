$(document).ready(function () {
    //ESCONDIENDO MENSAJES
    $(":input").focus(function () {

        $(".mensajeExito").hide("fast");
        $(".mensajeError").hide("fast");

    });


    $("#formIngresarNivelCurso").validate({
        rules: {
            nombreNivelCurso: {
                required: true,
                letterswithbasicpunc: true,
                maxlength: 15
            }
        },
        messages: {
            nivelCurso: {
                required: "Por favor, ingrese Nivel Curso",
                letterswithbasicpunc: "Ingrese letras solamente",
                maxlength: "Error, límite de caracteres excedido (15)"
            }
        },
        submitHandler: function () {
            var nivelCurso = $("#nivelCurso").val();

            $.post("../negocio/configuracion/nivelCurso/procesarAdministrarNivelCurso.php", {"nivelCurso": nivelCurso, "flag": 1},
                    function (r) {

                        if (r == 1) {
                            $(".mensajeError").hide("fast");
                            $(".mensajeExito").show("fast");

                            $("#nivelCurso").val("");

                            $.get("configuracion/nivelCurso/listarNivelCursosAjax.php", function (r) {

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


function actualizarNivelCurso(idNivelCurso, nivelCursoM) {
    var nivelCurso = $("#" + nivelCursoM + "").val();

    $.post("../negocio/configuracion/nivelCurso/procesarAdministrarNivelCurso.php", {"idNivelCurso": idNivelCurso, "nivelCurso": nivelCurso, "flag": 2}, function (r) {
        if (r == 1) {
            swal(
                    '¡Nivel Curso actualizado exitosamente!',
                    '',
                    'success'
                    );
        } else {
            swal(
                    '¡Error, no se ha podido actualizar el Nivel Curso!',
                    '',
                    'error'
                    );
        }
    });
}

function eliminarNivelCurso(idNivelCurso, idFila) {

    swal({//Seteando plugin sweetAlert
        title: '¿Está seguro que desea eliminar el Nivel Curso?',
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



        $.post("../negocio/configuracion/nivelCurso/procesarAdministrarNivelCurso.php", {"idNivelCurso": idNivelCurso, "flag": 3}, function (r) {
            if (r == 1) {
                swal(
                        '¡Nivel Curso eliminado exitosamente!',
                        '',
                        'success'
                        );

                $("#" + idFila + "").hide("fast");


            } else {
                swal(
                        '¡Error, no se ha podido eliminar el Nivel Curso!',
                        '',
                        'error'
                        );
            }
        });

    }, function (dismiss) {

        if (dismiss === 'cancel') {
            swal(
                    'Cancelado',
                    'El Nivel Curso no fue eliminado',
                    'error'
                    );
        }
    });
}