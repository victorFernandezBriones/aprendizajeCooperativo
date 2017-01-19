$(document).ready(function () {

    //ESCONDIENDO MENSAJES
    $(":input").focus(function () {

        $(".mensajeExito").hide("fast");
        $(".mensajeError").hide("fast");

    });

    $("#formIngresarSede").validate({
        rules: {
            nombreSede: {
                required: true,
                maxlength: 32,
                espacioBlanco: true
            }
        },
        messages: {
            nombreSede: {
                required: "Ingrese nombre de Sede",
                maxlength: "Error, límite de caracteres excedido(32)",
                espacioBlanco: "Error, no rellene con espacios"
            }
        },
        submitHandler: function () {
            var nombreSede = $("#nombreSede").val();

            $.post("../negocio/configuracion/sede/procesarAdministrarSedes.php", {"nombreSede": nombreSede, "flag": 1}, function (r) {
                if (r == 1) {
                    $(".mensajeError").hide("fast");
                    $(".mensajeExito").show("fast");

                    $("#nombreSede").val("");
                    $.get("configuracion/sede/listarSedesAjax.php", function (r) {

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


function actualizarSede(idSede, nombreSedeM) {
    var nombreSede = $("#" + nombreSedeM + "").val();

    $.post("../negocio/configuracion/sede/procesarAdministrarSedes.php", {"idSede": idSede, "nombreSede": nombreSede, "flag": 2}, function (r) {
        if (r == 1) {
            swal(
                    '¡Sede actualizada exitosamente!',
                    '',
                    'success'
                    );
        } else {
            swal(
                    '¡Error, no se ha podido actualizar la sede!',
                    '',
                    'error'
                    );
        }
    });
}

function eliminarSede(idSede, idFila) {

    swal({//Seteando plugin sweetAlert
        title: '¿Está seguro que desea eliminar la Sede?',
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



        $.post("../negocio/configuracion/sede/procesarAdministrarSedes.php", {"idSede": idSede, "flag": 3}, function (r) {
            if (r == 1) {
                swal(
                        '¡Sede eliminada exitosamente!',
                        '',
                        'success'
                        );
                $("#" + idFila + "").hide("fast");
            } else {
                swal(
                        '¡Error, no se ha podido eliminar la sede!',
                        '',
                        'error'
                        );
            }
        });
        
    }, function (dismiss) {

        if (dismiss === 'cancel') {
            swal(
                    'Cancelado',
                    'La Sede no ha sido eliminada',
                    'error'
                    );
        }
    });

}