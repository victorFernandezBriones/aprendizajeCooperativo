$(document).ready(function () {
    //ESCONDIENDO MENSAJES
    $(":input").focus(function () {

        $(".mensajeExito").hide("fast");
        $(".mensajeError").hide("fast");

    });

    $("#formIngresarAsignatura").validate({
        rules: {
            nombreAsignatura: {
                required: true,
                maxlength: 30,
                espacioBlanco: true
            }
        },
        messages: {
            nombreAsignatura: {
                required: "Por favor, ingrese Asignatura",
                maxlength: "Error, límite de caracteres excedido(30)",
                espacioBlanco: "Error, no rellene con espacios"
            }
        },
        submitHandler: function () {

            var nombreAsignatura = $("#nombreAsignatura").val();

            $.post("../negocio/configuracion/asignatura/procesarAdministrarAsignatura.php", {"nombreAsignatura": nombreAsignatura, "flag": 1}, function (r) {

                if (r == 1) {

                    $(".mensajeError").hide("fast");
                    $(".mensajeExito").show("fast");

                    $("#nombreAsignatura").val("");

                    $.get("configuracion/asignatura/listarAsignaturasAjax.php", function (r) {

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


function actualizarAsignatura(idAsignatura, nombreAsignaturaM) {

    var nombreAsignatura = $("#" + nombreAsignaturaM + "").val();



    $.post("../negocio/configuracion/asignatura/procesarAdministrarAsignatura.php", {"idAsignatura": idAsignatura, "nombreAsignatura": nombreAsignatura, "flag": 2}, function (r) {
        
        if (r == 1) {
            swal(
                    '¡Asignatura actualizada exitosamente!',
                    '',
                    'success'
                    );
        } else {
            swal(
                    '¡Error, no se ha podido actualizar la Asignatura!',
                    '',
                    'error'
                    );
        }
    });
}

function eliminarAsignatura(idAsignatura, idFila) {

    swal({//Seteando plugin sweetAlert
        title: '¿Está seguro que desea eliminar la Asignatura?',
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



        $.post("../negocio/configuracion/asignatura/procesarAdministrarAsignatura.php", {"idAsignatura": idAsignatura, "flag": 3}, function (r) {
            if (r == 1) {
                swal(
                        '¡Asignatura eliminado exitosamente!',
                        '',
                        'success'
                        );

                $("#" + idFila + "").hide("fast");


            } else {
                swal(
                        '¡Error, no se ha podido eliminar la Asignatura!',
                        '',
                        'error'
                        );
            }
        });

    }, function (dismiss) {

        if (dismiss === 'cancel') {
            swal(
                    'Cancelado',
                    'La Asigntura no ha sido eliminada',
                    'error'
                    );
        }
    });
}


