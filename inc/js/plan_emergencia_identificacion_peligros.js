function guardarDatosIdentificacionPeligros(idPlanEmergencia, pasar, count) {
    var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    var ajax = NuevoAjax();

    var lista = new Array();

    for (var i = 0; i < count; i++) {
        var Peligros = new Array();
        var idPeligro = document.getElementById("idPeligro" + i).value;
        var peligro = document.getElementById("peligro" + i).innerHTML;
        var presente = document.getElementById("presente" + i).value;
        var ubicacion = document.getElementById("ubicacion" + i).value;
        var recomendacion = document.getElementById("recomendacion" + i).value;
        var fecha = document.getElementById("fecha" + i).value;
        var responsable = document.getElementById("responsable" + i).value;
        var priorizacion = document.getElementById("priorizacion" + i).value;
        Peligros.push(idPeligro);
        Peligros.push(peligro);
        Peligros.push(presente);
        Peligros.push(ubicacion);
        Peligros.push(recomendacion);
        Peligros.push(fecha);
        Peligros.push(responsable);
        Peligros.push(priorizacion);
        lista.push(Peligros);
    }

    //Preparacion  llamada AJAX
    var _values_send =
            'idPlanEmergencia=' + idPlanEmergencia +
            '&lista=' + JSON.stringify(lista);

    var _URL_ = "mod/planEmergencia/ajax_identificacion_peligros.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + "&" + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
            page.innerHTML = cargando;
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                datosGuardados();
                jAlert("Guardado  con exito", "Exito");
                if (pasar) {
                    OpcionMenu('mod/planEmergencia/plan_emergencia_identificacion_peligros.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
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




