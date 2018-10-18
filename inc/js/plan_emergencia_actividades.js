/**
 * valida de infromacion de aprovacion del plan de emergancia
 *  llamado en  plan_emergencia_aprobacion.php
 * @returns {Boolean} 
 */
function validate_actividades(count) {
    for (var i = 0; i < count; i++) {
        var totalAdministrativo = document.getElementById("total" + i);
        var total = parseInt(totalAdministrativo.value, 10);
        if (!Number.isInteger(total)) {
            jAlert("El total aproximado es inválido. Introdúzcalo nuevamente", "Dato Requerido");
            totalAdministrativo.setAttribute("style", "background-color:#EDF0FF");
            totalAdministrativo.focus();
            return false;
        }
    }
    return true;
}

/**
 * actualiza los datos de poblacion de actividades  del plan de emergencia , conecta con el servidor
 * llamado en  plan_emergencia_actividades.php  
 * @param {int} idPlanEmergencia del plan de emergancia
 * @param {int} pasar al sigueinte formulario(1,0)
 * @param {int} count cantidad de filas   
 * @returns {undefined} 
 */
function guardarDatosActividades(idPlanEmergencia, pasar, count) {
    if (validate_actividades(count)) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        var ajax = NuevoAjax();
        var lista = new Array();
        for (var i = 0; i < count; i++) {
            var Poblacion = new Array();
            var tipoPobalcion = document.getElementById("tipo" + i).innerHTML;
            var descripcionAministrativo = document.getElementById("descripcion" + i).value;
            var totalAdministrativo = document.getElementById("total" + i).value;
            var discapacidadAdministrativo = document.getElementById("discapacidad" + i).value;
            Poblacion.push(tipoPobalcion);
            Poblacion.push(descripcionAministrativo);
            Poblacion.push(totalAdministrativo);
            Poblacion.push(discapacidadAdministrativo);
            lista.push(Poblacion);
        }

        //Preparacion  llamada AJAX
        var _values_send =
                'idPlanEmergencia=' + idPlanEmergencia +
                '&lista=' + JSON.stringify(lista);

        var _URL_ = "mod/planEmergencia/ajax_actividades.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("GET", _URL_ + "&" + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {
                page.innerHTML = cargando;
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    datosGuardados("lista_usuarios");
                    jAlert("Guardado  con exito", "Exito");
                    if (pasar) {
                        OpcionMenu('mod/planEmergencia/plan_emergencia_instalaciones.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
                    }
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }

            }
        };
        ajax.send(null);
        loading.innerHTML = "";
    }
}





