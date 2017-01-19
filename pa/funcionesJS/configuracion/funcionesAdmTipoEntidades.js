$(document).ready(function () {

//ESCONDIENDO MENSAJES
    $(":input").focus(function () {
        $(".mensajeExito").hide("fast");
        $(".mensajeError").hide("fast");
    });



    $("#formIngresarEntidad").validate({//validando y enviando formulario
        rules: {
            tipoEntidad: {
                required: true
            }
        },
        messages: {
            tipoEntidad: {
                required: "Por favor, ingrese Tipo Entidad"
            }
        },
        submitHandler: function () {

            var tipoEntidad = $("#tipoEntidad").val();

            $.post("../negocio/configuracion/entidad/procesarAdministrarTipoEntidades.php", {"tipoEntidad": tipoEntidad, "flag": 1}, function (r) {

                if (r == 1) {

                    $(".mensajeError").hide("fast");
                    $(".mensajeExito").show("fast");

                    $("#tipoEntidad").val("");

                    $.get("configuracion/entidad/listarTipoEntidadAjax.php", function (r) {

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


function actualizarTipoEntidad(idTipoEntidad, tipoEntidadM) {

    var tipoEntidad = $("#" + tipoEntidadM + "").val();

    $.post("../negocio/configuracion/entidad/procesarAdministrarTipoEntidades.php", {"idTipoEntidad": idTipoEntidad, "tipoEntidad": tipoEntidad, "flag": 2}, function (r) {

        if (r == 1) {
            swal(
                    '¡Tipo Entidad actualizada exitosamente!',
                    '',
                    'success'
                    );
        } else {
            swal(
                    '¡Error, no se ha podido actualizar el Tipo de Entidad!',
                    '',
                    'error'
                    );
        }
    });
}

function eliminarTipoEntidad(idTipoEntidad, idFila) {

    swal({//Seteando plugin sweetAlert
        title: '¿Está seguro que desea eliminar el Tipo de Entidad?',
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

        $.post("../negocio/configuracion/entidad/procesarAdministrarTipoEntidades.php", {"idTipoEntidad": idTipoEntidad, "flag": 3}, function (r) {
            if (r == 1) {
                swal(
                        '¡Tipo de Entidad eliminada exitosamente!',
                        '',
                        'success'
                        );
                $("#" + idFila + "").hide("fast");
                
            } else {
                swal(
                        '¡Error, no se ha podido eliminar el Tipo de Entidad!',
                        '',
                        'error'
                        );
            }
        });

    }, function (dismiss) {

        if (dismiss === 'cancel') {
            swal(
                    'Cancelado',
                    'El Tipo de Entidad no ha sido eliminado',
                    'error'
                    );
        }
    });

}
