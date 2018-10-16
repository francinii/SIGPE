/**
 *  Valida la información de la zona de la amenaza
 * @returns {boolean}
 */
function validate_aprobacion() {

    var aprobadoPor = document.getElementById('aprobadoPor');
    if (aprobadoPor.value == "") {
        jAlert("Ingrese el nombre de la persona encargada", "Dato Requerido");
        aprobadoPor.setAttribute("style", "background-color:#EDF0FF");
        aprobadoPor.focus();
        return false;
    }
    return true;
}

function update_aprobacion(id, centro, version) {
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
                    // jAlert("Plan de acción actualizado con éxito", "Exito");
                    imprimirPDF(id, centro, version);
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

function visualizarPDF(id, centro) {
    imprimirPlanVistazo(centro, id);
}

function imprimirPDF(id, centro, version) {
    var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    // var random =  Math.floor(Math.random() * 1001); 
    jQuery('#CargandoModal').modal('show');
    jQuery.ajax({
        data: {"idCentro": id, "nombreCentro": centro, "version": version},
        url: 'mod/planEmergenciaPDF/planEmergenciaPDF.php',
        type: "GET",

        success: function (data) {
            if (data == 'Generado') {
                var nombreDoc = id + '-' + version + '.pdf';
                
                window.open('mod/versionesPDF/' + nombreDoc, '_blank');
            }

        },
        error: function (data,error,algomas) {
            alert("error "+error);

        },
        complete: function (data) {
            //alert("completo"+data);
            jQuery('#CargandoModal').modal('hide');
           // ver(id, version, 0);
        }

    });
    loading.innerHTML = "";

}
