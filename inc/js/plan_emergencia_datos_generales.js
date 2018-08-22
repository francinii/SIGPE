

function guardarDatosGenerales(idCentro, pasar) {
    var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    var ajax = NuevoAjax();
    var actividad = document.getElementById("actividad").value;
    var direccion = document.getElementById("direccion").value;
    var conctacto_general = document.getElementById("conctacto_general").value;
    var telefono = document.getElementById("telefono").value;
    var fax = document.getElementById("fax").value;
    var email = document.getElementById("email").value;
    var NFPA = document.getElementById("NFPA").value;
    var uso = document.getElementById("uso").value;
    var horarios = document.getElementById("horarios").value;
    var seguridad = document.getElementById("seguridad").value;
    var servicio = document.getElementById("servicio").value;
    var administracion = document.getElementById("administracion").value;
    var academico = document.getElementById("academico").value;
    var estudiantil = document.getElementById("estudiantil").value;
    //Preparacion  llamada AJAX
    var _values_send =
            'idCentro=' + idCentro +
            '&actividad=' + actividad +
            '&direccion=' + direccion +
            '&conctacto_general=' + conctacto_general +
            '&telefono=' + telefono +
            '&fax=' + fax +
            '&email=' + email +
            '&NFPA=' + NFPA +
            '&uso=' + uso +
            '&horarios=' + horarios +
            '&seguridad=' + seguridad +
            '&servicio=' + servicio +
            '&administracion=' + administracion +
            '&academico=' + academico +
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
            if (response == 0) {
                jAlert("Guardado  con exito", "Exito");
                cambios=0;
                if (pasar) {                    
                    OpcionMenu('mod/planEmergencia/plan_emergencia_actividades.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
                }
            } else if (response == 1 || response == 2) {
                jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
            } else if (response == 3) {
                jAlert("el orden ya existe.\n Consulte a la USTDS", "Usuario ya existe");
            } else {
                jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
            }

        }
    };
    ajax.send(null);
    loading.innerHTML = "";
}

