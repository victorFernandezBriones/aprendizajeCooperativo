$(document).ready(function () {

    $('#calendar').fullCalendar({
        locale: 'es',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        selectable: true,
        selectHelper: true,
        events: "../negocio/calendario/procesarCalendario.php",
        loading: function (bool) {
            if (bool)
                $('#loading').show();
            else
                $('#loading').hide();
        },
        select: function (start, end) {//INGRESAR EVENTO

            $('# #').val(moment(start).format('DD-MM-YYYY'));
            $('#').modal('show');
        },
        eventRender: function (event, element) {//EDITAR EVENTO
            element.bind('dblclick', function () {
               
                $('#').modal('show');
            });
        },
        eventClick: function (event, element) {//ACCION A REALIZAR AL HACER CLICK EN EL EVENTO
            $.get("../negocio/hitoContractual/actualizarHitoAjax.php", {"idHito": event.id}, function (r) {
                $.getScript("funcionesJS/hitoContractual/funcionesHitos.js");
                $("#divAjaxHitoEdit").html(r);
                $("#idHito").val(event.id);//ASIGNANDO IDHITO AL INPUT

            });
            $('#ModalEdit').modal('show');
        }
    });

});