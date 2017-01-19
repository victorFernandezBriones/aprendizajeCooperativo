$(document).ready(function () {

//ESCONCIENDO MENSAJES AL HACER FOCUS EN UN INPUT
    $(":input").focus(function () {
        $(".mensajeExito").hide("fast");
        $(".mensajeError").hide("fast");
    });
//cambiar clase en tab link de mi perfil
    $("#aPerfil").click(function () {

        $(this).addClass("active");
        $("#aConfiguracion").removeClass("active");
    });
    $("#aConfiguracion").click(function () {
        $(this).addClass("active");
        $("#aPerfil").removeClass("active");
    });
    
    
//INGRESAR USUARIO
    $("#formIngresarUsuario").validate({//JQUERY VALIDATE
        rules: {//REGLAS DE VALIDACION
            nombre: {
                required: true,
                espacioBlanco: true,
                letterswithbasicpunc: true,
                maxlength: 32
            },
            apellidoP: {
                required: true,
                espacioBlanco: true,
                letterswithbasicpunc: true,
                maxlength: 32
            },
            apellidoM: {
                required: true,
                espacioBlanco: true,
                letterswithbasicpunc: true,
                maxlength: 32
            },
            nombreUsuario: {
                required: true,
                espacioBlanco: true,
                maxlength: 32,
                remote: {
                    url: "../negocio/validacionesRemotas/validarNombreUsuario.php",
                    type: 'GET',
                    data: {
                        nombreUsuario: function () {
                            return $('#nombreUsuario').val();
                        }
                    }
                }
            },
            contrasena: {
                required: true
            },
            reContrasena: {
                required: true,
                equalTo: "#contrasena"
            },
            email: {
                email: true,
                required: true,
                maxlength: 32,
                remote: {
                    url: "../negocio/validacionesRemotas/validarCorreo.php",
                    type: "GET",
                    data: {
                        email: function () {
                            return $("#email").val();
                        }
                    }
                }
            },
            idSede: {
                required: true
            },
            idTipoUsuario: {
                required: true
            }
        },
        messages: {//MENSAJE DEL FRAMEWORK
            nombre: {
                required: "Por favor, ingrese Nombre",
                espacioBlanco: "Error, no rellene con espacios",
                letterswithbasicpunc: "Error, ingrese letras solamente",
                maxlength: "Error, límite de caracteres excedido(32)"
            },
            apellidoP: {
                required: "Por favor, ingrese Apellido Paterno",
                espacioBlanco: "Error, no rellene con espacios",
                letterswithbasicpunc: "Error, ingrese letras solamente",
                maxlength: "Error, límite de caracteres excedido(32)"
            },
            apellidoM: {
                required: "Por favor, ingrese Apellido Materno",
                espacioBlanco: "Error, no rellene con espacios",
                letterswithbasicpunc: "Error, ingrese letras solamente",
                maxlength: "Error, límite de caracteres excedido(32)"
            },
            nombreUsuario: {
                required: "Por favor, ingrese nombre de usuario",
                espacioBlanco: "Error, no rellene con espacios",
                maxlength: "Error, límite de caracteres excedido(32)",
                remote: jQuery.validator.format("Nombre de usuario no disponible")
            },
            contrasena: {
                required: "Por favor, ingrese contrasena"
            },
            reContrasena: {
                required: "Por favor, confirme contrasena",
                equalTo: "Error, las contraseñas no coinciden"
            },
            email: {
                email: "Error, formato incorrecto",
                required: "Por favor, ingrese E-mail",
                maxlength: "Error, límite de caracteres excedido(32)",
                remote: jQuery.validator.format("Correo no disponible")
            },
            idSede: {
                required: "Por favor, seleccione una Sede"
            },
            idTipoUsuario: {
                required: "Por favor, seleccione un tipo de usuario"
            }
        },
        submitHandler: function () {
            //VARIABLES
            var nombre = $("#nombre").val();
            var apellidoP = $("#apellidoP").val();
            var apellidoM = $("#apellidoM").val();
            var nombreUsuario = $("#nombreUsuario").val();
            var contrasena = $("#contrasena").val();
            var email = $("#email").val();
            var idTipoUsuario = $("#idTipoUsuario").val();
            var idSede = $("#idSede").val();
            //gif de carga
            $(".divGifCarga").show("fast");
            //AJAX
            $.post("../negocio/configuracion/usuarios/procesarIngresarUsuario.php", {"nombre": nombre, "apellidoP": apellidoP, "apellidoM": apellidoM,
                "nombreUsuario": nombreUsuario, "contrasena": contrasena, "email": email, "idTipoUsuario": idTipoUsuario, "idSede": idSede}, function (r) {

                $(".divGifCarga").hide("fast"); //ESCONDER GIF DE CARGA

                if (r == 1) {//RESPUESTA EXITOSA
                    //ESCONDIENDO Y MOSTRNDO MENSAJES
                    $(".mensajeError").hide("fast");
                    $(".mensajeExito").show("fast");
                    $("#formIngresarUsuario").each(function () {//LIMPIANDO EL FORMULARIO
                        this.reset();
                    });
                } else {//RESPUESTA FALLIDA

                    $(".mensajeExito").hide("fast");
                    $(".mensajeError").show("fast");
                }


            });
        }

    });
//------------------------------------//
//          EDICION DE PERFIL        //
//----------------------------------//
    $("#formActualizarPerfil").validate({
        rules: {
            nombre: {
                required: true
            },
            apellidoP: {
                required: true
            },
            apellidoM: {
                required: true
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            nombre: {
                required: "Por favor, ingrese nombre"
            },
            apellidoP: {
                required: "Por favor, ingrese Apellido Paterno"
            },
            apellidoM: {
                required: "Por favor, ingrese Apellido Materno"
            },
            email: {
                required: "Por favor, ingrese Email",
                email: "Error, formato incorrecto"
            }

        },
        submitHandler: function () {
            var idUsuario = $("#idUsuario").val();
            var nombre = $("#nombre").val();
            var apellidoP = $("#apellidoP").val();
            var apellidoM = $("#apellidoM").val();
            var email = $("#email").val();

            $.post("../negocio/configuracion/usuarios/procesarActualizarPerfil.php", {"idUsuario": idUsuario, "nombre": nombre, "apellidoP": apellidoP, "apellidoM": apellidoM, "email": email,"flag":1}, function (r) {

                if (r == 1) {
                    swal(
                            '¡Perfil actualizado exitosamente',
                            '',
                            'success'
                            );

                } else {

                    swal(
                            '¡Error, no se ha podido actualizar el perfil',
                            '',
                            'error'
                            );
                }

            });

        }
    });


    $("#formActualizarContrasena").validate({
        rules: {
            contrasenaAntigua: {
                required: true,
                remote: {
                    url: "../negocio/validacionesRemotas/validarContrasena.php",
                    type: "GET",
                    data: {
                        contrasenaAntigua: function () {
                            return $("#contrasenaAntigua").val();
                        }
                    }
                }
            },
            contrasena: {
                required: true
            },
            reContrasena: {
                required: true,
                equalTo: "#contrasena"
            }
        },
        messages: {
            contrasenaAntigua: {
                required: "Por favor, ingrese contraseña",
                remote: jQuery.validator.format("Error, la contraseña es incorrecta")
            },
            contrasena: {
                required: "Por favor, ingrese contraseña"
            },
            reContrasena: {
                required: "Por favor, re-ingrese contraseña",
                equalTo: "Error, las contraseñas no coinciden"
            }
        },
        submitHandler: function () {
            var idUsuario = $("#idUsuario").val();
            var contrasena = $("#contrasena").val();

            $.post("../negocio/configuracion/usuarios/procesarActualizarPerfil.php", {"idUsuario": idUsuario, "contrasena": contrasena, "flag": 2}, function (r) {

                if (r == 1) {

                    $("#formActualizarContrasena").each(function () {//limpiando formulario
                        this.reset();
                    });

                    swal(
                            '¡Contraseña actualizada exitosamente',
                            '',
                            'success'
                            );

                } else {

                    swal(
                            '¡Error, no se ha podido actualizar la contraseña',
                            '',
                            'error'
                            );

                }

            });

        }
    });

});



function actualizarUsuario(idUsuario, idSedeM, idTipoUsuarioM, IdEstadoUsuarioM) {

    var idSede = $("#" + idSedeM + "").val();
    var idTipoUsuario = $("#" + idTipoUsuarioM + "").val();
    var idEstadoUsuario = $("#" + IdEstadoUsuarioM + "").val();
    $.post("../negocio/configuracion/usuarios/procesarAdministrarUsuarios.php", {"idUsuario": idUsuario, "idSede": idSede, "idTipoUsuario": idTipoUsuario, "idEstadoUsuario": idEstadoUsuario, "flag": 1}, function (r) {

        if (r == 1) {

            swal(
                    '¡Usuario actualizado exitosamente!',
                    '',
                    'success'
                    );
        } else {
            swal(
                    '¡Error, no se ha podido actualizar el Usuario!',
                    '',
                    'error'
                    );
        }


    });
}

function eliminarUsuario(idUsuario, idFila) {

    swal({//Seteando plugin sweetAlert
        title: '¿Está seguro que desea eliminar el Usuario?',
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

        $.post("../negocio/configuracion/usuarios/procesarAdministrarUsuarios.php", {"idUsuario": idUsuario, "flag": 2}, function (r) {

            if (r == 1) {
                swal(
                        '¡Usuario eliminado exitosamente!',
                        '',
                        'success'
                        );
                $("#" + idFila + "").hide("fast"); //ELIMINANDO FILA DE LA TABLA

            } else {

                swal(
                        '¡Error, no ha podido eliminar al usuario!',
                        '',
                        'error'
                        );
            }

        });


    }, function (dismiss) {

        if (dismiss === 'cancel') {
            swal(
                    'Cancelado',
                    'El Usuario no ha sido eliminado',
                    'error'
                    );
        }
        
    });
}