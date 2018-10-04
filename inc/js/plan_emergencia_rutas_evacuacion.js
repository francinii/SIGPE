
function agregarRutasEvacuacion(titulo, idtabla, alert) {
    var tabla = jQuery(idtabla + " tbody");
    var id = tabla.children().last().attr('id');
    if (typeof id == 'undefined') {
        id = 0;
    } else {
       // var id = id.split('-');
        var id = (parseInt(id) + 1);
    }
    var fila = '<tr id="' + id + '">' +
            '<td> <input  type="text" class="form-control requerido cambios" id="area' + id + '"></td>' +
            '<td><input  type="text"  class="form-control requerido cambios" id="personasPermanentes' + id + '"  ></td>' +
            '<td><input  type="text"  class="form-control requerido cambios" id="personasFlotantes' + id + '"  ></td>' +
            '<td><input  type="text"  class="form-control requerido cambios" id="rutaP' + id + '"  ></td>' +
            '<td><input  type="number" value = "0" min = "0" class="form-control requerido cambios" id="distanciaP' + id + '"  ></td>' +
            '<td><input  type="number" value = "0" min = "0" class="form-control requerido cambios" id="tiempoP' + id + '"  ></td>' +
            '<td><input  type="text" class="form-control requerido cambios" id="rutaS' + id + '"  ></td>' +
            '<td><input  type="number" value = "0" min = "0" class="form-control requerido cambios" id="distanciaS' + id + '"  ></td>' +
            '<td><input  type="number" value = "0" min = "0" class="form-control requerido cambios" id="tiempoS' + id + '"  ></td>' +
            '<td>' +
            '<a class="puntero cambios"  onClick="javascript:eliminarFilaRutasEvacuacion(this);">' +
            '<div class="text-center"><i class="fa fa-close  text-danger" title="' + titulo + '"></i></div>' +
            ' </a>' +
            ' </td>' +
            '</tr>';
    tabla.append(fila);
    IniciarGuardarCambios(alert);
}

function eliminarFilaRutasEvacuacion(event) {
    jQuery(event).trigger('change');
    var row = jQuery(event).parents("tr:first");
    row.remove();

}

function validate_Inventario(tabla) {
    var filas = jQuery(tabla + " tbody").children();
    for (var i = 0; i < filas.length; i++) {
        var inputs = jQuery(filas[i]).children("td").children(".requerido");
        for (var j = 0; j < inputs.length; j++) {
            var input = inputs[j];
            if (input.value == "") {
                jAlert("Es necesario rellenar los campos", "Dato Requerido");
                jQuery(input).css("background-color", "#EDF0FF");
                input.focus();
                return false;
            }
        }

    }
    return true;
}

function validado(tabla) {
    var filas = jQuery(tabla + " tbody").children();
    for (var i = 0; i < filas.length; i++) {
        var inputs = jQuery(filas[i]).children("td").children(".requerido");
        for (var j = 0; j < inputs.length; j++) {
            var input = inputs[j];
            jQuery(input).css("background-color", "#fff");

        }

    }

}



function guardarRutasEvacuacion(idPlanEmergencia, pasar, idtable) {
    if (validate_Inventario("#" + idtable)) {
        validado("#" + idtable);
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        var ajax = NuevoAjax();
        var lista = new Array();
        var fila = document.getElementById(idtable).firstElementChild.nextElementSibling;
        fila = fila.firstElementChild;
        var count = 0;
        while (fila != null) {
            count = fila.id;
            lista.push({"area": jQuery("#" + "area" + count).val(),
            "personasPermanentes": jQuery("#" + "personasPermanentes" + count).val(),
            "personasFlotantes": jQuery("#" + "personasFlotantes" + count).val(),
            "rutaP": jQuery("#" +  "rutaP" + count).val(),
            "distanciaP": jQuery("#" + "distanciaP" + count).val(),
            "tiempoP": jQuery("#" +  "tiempoP" + count).val(),
            "rutaS": jQuery("#" +  "rutaS" + count).val(),
            "distanciaS": jQuery("#" +  "distanciaS" + count).val(),
            "tiempoS": jQuery("#" +  "tiempoS" + count).val()});
            count++;
            fila = fila.nextElementSibling;
        }
        var formData = new FormData();
        formData.append('lista', JSON.stringify(lista));
        //Preparacion  llamada AJAX
        var _values_send =
                'idPlanEmergencia=' + idPlanEmergencia;
        var _URL_ = "mod/planEmergencia/ajax_rutas_evacuacion.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("POST", _URL_ + "&" + _values_send, true);
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
                        OpcionMenu('mod/planEmergencia/plan_emergencia_brigadistas.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
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
        ajax.send(formData);
        loading.innerHTML = "";
    }
}