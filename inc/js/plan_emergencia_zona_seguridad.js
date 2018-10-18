/**
 * Funcion que agrega una nueva zona de seguridad a la tabla de zona de seguridad * 
 * @param {String} titulo (title) para el botón de eliminar fila
 * @param {String} idTabla corresponde al id de la tabla  
 * @param {String} alert mensaje de alerta
 * @returns {undefined} Llama al metodo IniciarGuardarCambios
 */
function agregarZonaSeguridad(titulo, idtabla, alert) {
    var tabla = jQuery(idtabla + " tbody");
    var id = tabla.children().last().attr('id');
    if (typeof id == 'undefined') {
        id = 0;
    } else {
        // var id = id.split('-');
        var id = (parseInt(id) + 1);
    }
    var fila = '<tr id="' + id + '">' +
            '<td> <input  id="nombre' + id + '"  type="text" class="form-control requerido cambios" ></td>' +
            '<td> <input  id="ubicacion' + id + '"  type="text" class="form-control requerido cambios" ></td>' +
            '<td> <input  id="capacidad' + id + '"  type="number" min = "0" value = "0" class="form-control requerido cambios" ></td>' +
            '<td><textarea rows="1"   type="text"   class="form-control requerido cambios" id="observaciones' + id + '"></textarea></td>' +
            '<td> <input  id="sector' + id + '"  type="text" class="form-control requerido cambios" ></td>' +
            '<td>' +
            '<a class="puntero cambios"  onClick="javascript:eliminarFila(this);">' +
            '<div class="text-center"><i class="fa fa-close  text-danger" title="' + titulo + '"></i></div>' +
            ' </a>' +
            ' </td>' +
            '</tr>';
    tabla.append(fila);
    IniciarGuardarCambios(alert);
}

/**
 * Funcion que elimina una fila en la tabla de zona de seguridad
 * @param {Event} event para el botón de eliminar fila
 * @returns {undefined} 
 */
function eliminarFilaZonaSeguridad(event) {
    jQuery(event).trigger('change');
    var row = jQuery(event).parents("tr:first");
    row.remove();
}

/**
 * Funcion que valida los datos de los registros de la tabla
 * @param {String} tabla corresponde al id de la tabla 
 * @returns {Boolean} return false si los datos son inválidos, true en caso contrario 
 */
function validate_plan(tabla) {
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

/**
 * Funcion que elimina el color de los campos validados
 * @param {String} tabla corresponde al id de la tabla 
 * @returns {Undefined} 
 */
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

/**
 * Funcion que guarda los registros de las zonas de seguridad en la base de datos
 * @param {int} idPlanEmergencia corresponde al id del plan de emergencia
 * @param {int} pasar cooresponde a un valor que indica si se debe o no pasar
 * al siguiente formulario
 * @param {int} idtable corresonde al id de la tabla
 * @returns {Undefined} Envia una solicitud ajax
 */
function guardarZonaSeguridad(idPlanEmergencia, pasar, idtable) {
    if (validate_plan("#" + idtable)) {
        validado("#" + idtable);
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        var ajax = NuevoAjax();
        var lista = new Array();
        var id;
        var fila = document.getElementById(idtable).firstElementChild.nextElementSibling;
        fila = fila.firstElementChild;
        var count = 0;
        while (fila != null) {
            count = fila.id;
            //count=id[1];
            lista.push({"nombre": jQuery("#" + "nombre" + count).val(),
                "ubicacion": jQuery("#" + "ubicacion" + count).val(),
                "capacidad": jQuery("#" + "capacidad" + count).val(),
                "observaciones": jQuery("#" + "observaciones" + count).val(),
                "sector": jQuery("#" + "sector" + count).val()});

            count++;
            fila = fila.nextElementSibling;
        }
        var formData = new FormData();
        formData.append('lista', JSON.stringify(lista));
        //Preparacion  llamada AJAX
        var _values_send =
                'idPlanEmergencia=' + idPlanEmergencia;
        var _URL_ = "mod/planEmergencia/ajax_zona_seguridad.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("POST", _URL_ + "&" + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {
                page.innerHTML = cargando;
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    datosGuardados(idtable);
                    jAlert("Guardado  con exito", "Exito");
                    if (pasar) {
                        OpcionMenu('mod/planEmergencia/plan_emergencia_capitulos_subcapitulos.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
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
        ajax.send(formData);
        loading.innerHTML = "";
    }
}
