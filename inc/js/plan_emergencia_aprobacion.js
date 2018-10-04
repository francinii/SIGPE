/**
 *  Valida la información de la zona de la amenaza
 * @returns {boolean}
 */
function validate_aprobacion() {
 
    var aprobadoPor = document.getElementById('aprobadoPor');
    if (aprobadoPor.value == "") {
        jAlert("Ingrese el nombre de la persona encargada", "Dato Requerido");
        nombre.setAttribute("style", "background-color:#EDF0FF");
        nombre.focus();
        return false;
    }
    return true;
}

function update_aprobacion(id) {
    if (validate_aprobacion()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
  
        var aprobadoPor = document.getElementById('aprobadoPor').value;
        var codigoZona = document.getElementById('codigoZona').value;
        var ajax = NuevoAjax();
        var _values_send =
                'id=' + id +        
                 '&codigoZona=' + codigoZona +               
                '&aprobadoPor=' + aprobadoPor;
        var _URL_ = "mod/planEmergencia/ajax_plan_emergencia_aprobacion.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("GET", _URL_ + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {
                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Plan de acción actualizado con éxito", "Exito");
                   // OpcionMenu('mod/adminPlanEmergencia/adminSedes/list_sedes.php?', '');
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("Error al actualizar los datos.\n Consulte a la USTDS", "Error de actualización");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(null);
        loading.innerHTML = "";
    }
}

