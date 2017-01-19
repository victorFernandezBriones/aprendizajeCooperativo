$(document).ready(function () {

//LIMPIANDO MENSAJE ERROR DE VALIDACIONES

    $(":input").focus(function () {
        $(".mensajeExito").hide("fast");
        $(".mensajeError").hide("fast");
    });

    $("#fotoAlumno").change(function () {

        $("#divfotoAlumno").removeClass("has-error");
        $("#fotoAlumno-error").hide("fast");

    });

    $("#fechaNacimiento").change(function () {
        $("#divFechaNacimiento").removeClass("has-error");
        $("#fechaNacimiento-error").hide("fast");
    });



    $("#agregarFormEntidad").click(function () {
        var num = $('.form-clonado').length; // 
        var numNuevoDiv = new Number(num + 1); // the numeric ID of the new input field being added

        var nuevoElemento = $('#datosEntidad').clone().attr('id', 'datosEntidad' + numNuevoDiv);

        nuevoElemento.clone().appendTo($('#contenedorEntidades'));

        //borrando el valor de los inputs clonados
        $("#datosEntidad" + numNuevoDiv).find(':input').each(function () {
            this.value = "";
        });
    });

//eliminando div clonados
    $(":Reset").click(function () {
        $("#contenedorEntidades").empty();
    });

//calculando edad
    $("#fechaNacimiento").change(function () {
        $.get("../negocio/alumno/procesarIngresarAlumno.php", {"fechaNacimiento": $(this).val()}, function (r) {

            $("#edad").val(r);

        });

    });

    $("#fechaNacimiento").blur(function () {
        $.get("../negocio/alumno/procesarIngresarAlumno.php", {"fechaNacimiento": $(this).val()}, function (r) {

            $("#edad").val(r);

        });

    });

//----------------------------------------------//

    $("#formIngresarAlumno").validate({
        rules: {
            rut: {
                required: true,
                rut: true
            },
            nombre: {
                required: true,
                letterswithbasicpunc: true,
                espacioBlanco: true,
                maxlength: 32
            },
            apellidoP: {
                required: true,
                letterswithbasicpunc: true,
                espacioBlanco: true,
                maxlength: 32
            },
            apellidoM: {
                required: true,
                letterswithbasicpunc: true,
                espacioBlanco: true,
                maxlength: 32
            },
            fechaNacimiento: {
                required: true
            },
            edad: {
                required: true,
                number: true
            },
            idCurso: {
                required: true
            },
            colegioProveniente: {
                required: true,
                maxlength: 40
            },
            fotoAlumno: {
                required: true
            }
        },
        messages: {
            rut: {
                required: "Por favor, ingrese Rut"

            },
            nombre: {
                required: "Por favor, ingrese Nombre",
                letterswithbasicpunc: "Error, ingrese letras solamente",
                espacioBlanco: "Error, no rellene con espacios",
                maxlength: "Error, límite de caracteres excedido(32)"
            },
            apellidoP: {
                required: "Por favor, ingrese Apellido Paterno",
                letterswithbasicpunc: "Error, ingrese letras solamente",
                espacioBlanco: "Error, no rellene con espacios",
                maxlength: "Error, límite de caracteres excedido(32)"
            },
            apellidoM: {
                required: "Por favor, ingrese Apellido Materno",
                letterswithbasicpunc: "Error, ingrese letras solamente",
                espacioBlanco: "Error, no rellene con espacios",
                maxlength: "Error, límite de caracteres excedido(32)"
            },
            fechaNacimiento: {
                required: "Por favor, ingrese Fecha de Nacimiento"
            },
            edad: {
                required: "Por favor, ingrese edad",
                number: "Ingrese números solamente"
            },
            idCurso: {
                required: "Por favor, seleccione Curso"
            },
            colegioProveniente: {
                required: "Por favor, ingrese colegio ",
                maxlength: "Error, límite de caracteres excedido"
            },
            fotoAlumno: {
                required: "Por favor, seleccione Foto"
            }
        },
        submitHandler: function () {

            //DATOS ALUMNO
            var rut = $("#rut").val();
            var nombre = $("#nombre").val();
            var apellidoP = $("#apellidoP").val();
            var apellidoM = $("#apellidoM").val();
            var fechaNacimiento = $("#fechaNacimiento").val();
            var edad = $("#edad").val();
            var idCurso = $("#idCurso").val();
            var colegioProveniente = $("#colegioProveniente").val();

            //ARCHIVOS  
            var fotoAlumno = $("#fotoAlumno")[0].files[0];
            //--------------------------------//
            //DATOS Entidad

            //SECCION PARA CAPTURAR LOS ID TIPO ENTIDAD DE LAS ENTIDADES CREADAS
            var idTipoEntidad = new Array();
            var c = 0;

            $("#divEntidades").find('select').each(function () {


                var elemento = this;

                idTipoEntidad[c] = elemento.value;

                c++;
            });


            var nombreEntidad = $("input[name='nombreEntidad[]']")
                    .map(function () {
                        return $(this).val();
                    }).get();


            var apellidoEntidadP = $("input[name='apellidoEntidadP[]']")
                    .map(function () {
                        return $(this).val();
                    }).get();

            var apellidoEntidadM = $("input[name='apellidoEntidadM[]']")
                    .map(function () {
                        return $(this).val();
                    }).get();

            var celularE = $("input[name='celularE[]']")
                    .map(function () {
                        return $(this).val();
                    }).get();

            var fijoE = $("input[name='fijoE[]']")
                    .map(function () {
                        return $(this).val();
                    }).get();


            var emailE = $("input[name='emailE[]']")
                    .map(function () {
                        return $(this).val();
                    }).get();


            //UTILIZANDO FORM DATA PARA ENVIAR ARCHIVOS DIGITALES
            var formData = new FormData();

            formData.append("rut", rut);
            formData.append("nombre", nombre);
            formData.append("apellidoP", apellidoP);
            formData.append("apellidoM", apellidoM);
            formData.append("fechaNacimiento", fechaNacimiento);
            formData.append("edad", edad);
            formData.append("idCurso", idCurso);
            formData.append("colegioProveniente", colegioProveniente);
            formData.append("fotoAlumno", fotoAlumno);
            formData.append("idTipoEntidad", idTipoEntidad);
            formData.append("nombreEntidad", nombreEntidad);
            formData.append("apellidoEntidadP", apellidoEntidadP);
            formData.append("apellidoEntidadM", apellidoEntidadM);
            formData.append("celularE", celularE);
            formData.append("fijoE", fijoE);
            formData.append("emailE", emailE);

            //gif de carga
            $(".divGifCarga").show("fast");

            //PETICION AJAX
            $.ajax({
                url: '../negocio/alumno/procesarIngresarAlumno.php', //Url a donde la enviaremos
                type: 'POST', //Metodo que usaremos
                contentType: false, //Debe estar en false para que pase el objeto sin procesar
                data: formData, //Le pasamos el objeto que creamos con los archivos
                processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
                cache: false,
                success: function (r) {
                   
                    $(".divGifCarga").hide("fast");

                    if (r == 1) {

                        $(".mensajeError").hide("fast");
                        $(".mensajeExito").show("fast");

                        $("#formIngresarAlumno").each(function () {//Limpiando el formulario
                            this.reset();
                        });

                        $("#contenedorEntidades").empty();

                    } else {
                        $(".mensajeExito").hide("fast");
                        $(".mensajeError").show("fast");
                    }
                }
            });

        }
    });


});
