
/**
 *  agrega una fila a la tabla
 *  llamado en  pla_emergencia_brigadistas.php
 * @param {String} titulo el boton de eliminar
 * @param {String} idtabla de la tabla
 * @param {String} alert  mensage de alerta
 * @returns {undefined}
 */
function agregarBrigadistas(titulo, idtabla, alert) {
    var tabla = jQuery(idtabla + " tbody");
    var id = tabla.children().last().attr('id');
    if (typeof id == 'undefined') {
        id = 0;
    } else {
       // var id = id.split('-');
        var id = (parseInt(id) + 1);
    }
    var fila = '<tr id="' + id + '">' +
            '<td> <input  type="text" class="form-control requerido cambios" id="brigadista' + id + '"  ></td>' +
            '<td> <input  type="text" class="form-control requerido cambios" id="puntoPartida' + id + '"  ></td>' +
            '<td> <input  type="text" class="form-control requerido cambios" id="zonaEvacuar' + id + '"  ></td>' +
            '<td> <input  type="number" value = "0" min = "0" class="form-control requerido cambios" id="numeroPersonas' + id + '"  ></td>' +
            '<td> <input  type="number" value = "0" min = "0" class="form-control requerido cambios" id="distancia' + id + '"  ></td>' +
            '<td> <input  type="number" value = "0" min = "0" class="form-control requerido cambios" id="tiempo' + id + '"  ></td>' +
            '<td>' +
            '<a class="puntero cambios"  onClick="javascript:eliminarFilaBrigadistas(this);">' +
            '<div class="text-center"><i class="fa fa-close  text-danger" title="' + titulo + '"></i></div>' +
            ' </a>' +
            ' </td>' +
            '</tr>';
    tabla.append(fila);
    llenarSelect(id, 'nada',0);
    llenarSelect(id, 'nada',1);
    IniciarGuardarCambios(alert);
}
/**
 *  Elimina una fila de la tabla
 *  llamado en  pla_emergencia_brigadistas.php
 * @param {elemento HTML} event  elemento que resive la accion
 * @returns {undefined}
 */
function eliminarFilaBrigadistas(event) {
    jQuery(event).trigger('change');
    var row = jQuery(event).parents("tr:first");
    row.remove();

}
/**
 *  Valida la informacion de la tabla 
 *  llamado en  pla_emergencia_brigadistas.php
 * @param {String} tabla id de la tabla 
 * @returns {boolean}
 */
function validate_brigada(tabla) {
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
 *  Quita el color azul de los campos validados
 *  llamado en  pla_emergencia_brigadistas.php
 * @param {String} tabla id de la tabla 
 * @returns {undefined}
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
 *  Guarda los datos del formulario POblacion , conecta con el servidor
 *  llamado en  pla_emergencia_brigadistas.php
 * @param {int} pasar al siguiente formulario(1,0)
 * @param {int} idPlanEmergencia id del plan de emergencia 
 * @returns {undefined}
 */
function guardarBrigadistas(idPlanEmergencia, pasar, idtable) {
    if (validate_brigada("#" + idtable)) {
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
            lista.push({"brigadista": jQuery("#" + "brigadista" + count).val(),
                "puntoPartida": jQuery("#" + "puntoPartida" + count).val(),
                "zonaEvacuar": jQuery("#" + "zonaEvacuar" + count).val(), 
                "numeroPersonas": jQuery("#" +  "numeroPersonas" + count).val(),
                "distancia": jQuery("#" + "distancia" + count).val(),
                "tiempo": jQuery("#" +  "tiempo" + count).val()});

            count++;
            fila = fila.nextElementSibling;
        }
        var formData = new FormData();
        formData.append('lista', JSON.stringify(lista));
        //Preparacion  llamada AJAX
        var _values_send =
                'idPlanEmergencia=' + idPlanEmergencia;
        var _URL_ = "mod/planEmergencia/ajax_brigadistas.php?";
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
                        OpcionMenu('mod/planEmergencia/plan_emergencia_ingreso.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
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