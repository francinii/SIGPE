function guardarDatosGenerales(idCentro) {
    var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    var ajax = NuevoAjax();    
    var actividad = document.getElementById("actividad");
    var direccion = document.getElementById("direccion");
    var conctacto_general = document.getElementById("conctacto_general");
    var fax = document.getElementById("fax");
    var email = document.getElementById("email");
    var NFPA = document.getElementById("NFPA");
    var uso = document.getElementById("uso");
    var horarios = document.getElementById("horarios");
    var seguridad = document.getElementById("seguridad");
    var servicio = document.getElementById("servicio");
    var administracion = document.getElementById("administracion");
    var academico = document.getElementById("academico");
    var estudiantil = document.getElementById("estudiantil");
    //Preparacion  llamada AJAX
    var _values_send =
            'idCentro=' + idCentro +      
            '&actividad=' + actividad+
            '&direccion=' + direccion+
            '&conctacto_general=' + conctacto_general+
            '&fax=' + fax+
            '&email=' + email+
            '&NFPA=' + NFPA+
            '&uso=' + uso+
            '&horarios=' + horarios+
            '&seguridad=' + seguridad+
            '&servicio=' + servicio+
            '&administracion=' + administracion+
            '&academico=' + academico+
            '&estudiantil=' + estudiantil;
    var _URL_ = "mod/planEmergencia/ajax_datos_generales.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + "&" + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
            page.innerHTML = cargando;
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 1) {
                jAlert('Guardado correctamente!', 'Exito');
               
            } else if (response == 0) {
                jAlert('Ha ocurrido un error en la Base de Datos Intentelo Nuevamente\n Si el problema continua comuniquese con la USTDS', 'Error');
            } else {
                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
            }

        }
    };
    ajax.send(null);
    loading.innerHTML = "";
}

