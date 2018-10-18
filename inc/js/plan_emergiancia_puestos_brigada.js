/**
 * agrega una fila de puesto a la tabla
 *  llamado en  plan_emergencia_puestos_brigada.php
 * @param {String} titulo el boton de eliminar
 * @param {String} alert mensage de alerta
 * @param {String} agregar titulo del boton de agregar
 * @param {String} descripcion del sector incial
 * @param {String} labePuesto labe del puesto nuevo
 * @returns {undefined}
 */
function agregarFilaPuesto(titulo, alert, agregar,descripcion,labePuesto) {
    var tabla = jQuery("#lista_puestoBrigada tbody");
    var id = tabla.children().last().attr('id');
    if (typeof id == 'undefined') {
        id = 0;
    } else {
        var id = id.split('-');
        var id = (parseInt(id[1]) + 1);
    }
    var fila = '<tr class="seccionPuesto" id="Pues-' + id + '">' +
            '<td  style="align-items:center; background-color:lightblue" class = " form-inline" colspan="2">' +
           '<span>'+labePuesto+':</span>'+
            '<input style="width:40%;" type="text"  class="form-control requerido cambios" id="Puesto' + id + '" value="'+descripcion+'" ></td>' +
            '<td  style="background-color:lightblue">' +
            '<a class="puntero cambios"  onClick="javascript:eliminarFilafuncion(this);">' +
            '<div class="text-center"><i class="fa fa-close  text-danger" title="' + titulo + '"></i></div>' +
            ' </a>' +
            ' </td>' +
            '<td  style="background-color:lightblue">' +
            '<a class="puntero cambios"  onclick="javascript: agregarFilafuncion(\'' + titulo + '\',\'' + alert + '\',\'Pues-' + id + '\');">' +
            '<div class="text-center"><i class="fa fa-plus  text-success " title="' + agregar + '"></i></div>' +
            '</a>' +
            '</td>';

    '</tr>'
    tabla.append(fila);
    IniciarGuardarCambios(alert);
    jQuery("#Puesto" + id).focus();
}

/**
 * agrega una fila a un puesto a la tabla
 *  llamado en  plan_emergencia_puestos_brigada.php
 * @param {String} titulo el boton de eliminar
 * @param {String} alert mensage de alerta
 * @param {String} Idselec id de la fila
 * @returns {undefined}
 */

function agregarFilafuncion(titulo, alert, Idselec) {
    var Sector = jQuery("#" + Idselec);
    var tabla = jQuery("#lista_puestoBrigada tbody");
    var hasnext = true;
    var nextpuesto = Sector.next();
    while (!nextpuesto.hasClass('seccionPuesto')) {
        nextpuesto = nextpuesto.next();
        if (nextpuesto.length == 0) {
            hasnext = false;
            break;
        }
    }
    
    var id = tabla.children().last().attr('id');
    if (typeof id == 'undefined') {
        id = 1;
        agregarFilaSector(titulo, alert);
    } else {
        var id = id.split('-');
        id = (parseInt(id[1]) + 1);
    }
    var fila = '<tr id="fil-' + id + '">' +
            '<td> <textarea  rows="1" type="text"   class="form-control requerido cambios" id="funcion'+id+'" ></textarea></td>'+
            '<td> <textarea  rows="1" type="text"    class="form-control requerido  cambios" id="plazo'+id+'" ></textarea></td>'+
            '<td>' +
            '<a class="puntero cambios"  onClick="javascript:eliminarFilafuncion(this);">' +
            '<div class="text-center"><i class="fa fa-close  text-danger" title="' + titulo + '"></i></div>' +
            ' </a>' +
            ' </td>' +
            '<td></td>';

    '</tr>'
    if (hasnext) {
        nextpuesto.before(fila);
    } else {
        tabla.append(fila);
    }
    IniciarGuardarCambios(alert);
    jQuery("#plazo" + id).focus();
}

/**
 *  Elimina una fila de la tabla
 *  llamado en  plan_emergencia_puestos_brigada.php
 * @param {elemento HTML} event  elemento que resive la accion
 * @returns {undefined}
 */
function eliminarFilafuncion(event) {
    jQuery(event).trigger('change');
    var row = jQuery(event).parents("tr:first");
    row.remove();

}

/**
 *  Valida la informacion de la tabla 
 *  llamado en  plan_emergencia_puestos_brigada.php
 * @param {String} tabla id de la tabla 
 * @returns {boolean}
 */
function validate_InventarioPuesto(tabla) {
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
 *  llamado en  plan_emergencia_puestos_brigada.php
 * @param {String} tabla id de la tabla 
 * @returns {undefined}
 */

function validadoPuesto(tabla) {
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
 *  Guarda los datos del formulario puestos brigada , conecta con el servidor
 *  llamado en  plan_emergencia_puestos_brigada.php
 * @param {int} idPlanEmergencia id del plan de emergencia 
 * @param {int} pasar al siguiente formulario(1,0) 
 * @returns {undefined}
 */

function guardarPuestoBrigada(idPlanEmergencia, pasar) {
    if (validate_InventarioPuesto("#lista_puestoBrigada")) {
        validadoPuesto("#lista_puestoBrigada");
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        var ajax = NuevoAjax();
        var id;
        var puestoActual = "";
        var puesto;
        var lista = new Array();       
        var body =  jQuery("#lista_puestoBrigada tbody")[0];
        var fila = body.firstElementChild;
        var count = 0;
        while (fila != null) {
            id = fila.id;
            id = id.split('-');
            count=id[1];
            if (id[0] == "Pues") {
                puesto = jQuery("#Puesto" + count).val();                
                fila = fila.nextElementSibling;
                id = fila.id;
                id = id.split('-');
                count=id[1];
                if (puesto != puestoActual) {

                    puestoActual = puesto;
                }
            }
            lista.push({"funcion": jQuery("#funcion" + count).val(), "plazo": jQuery("#plazo" + count).val(),
                "Puesto": puestoActual});
            fila = fila.nextElementSibling;
        }
        var formData = new FormData();
        formData.append('lista', JSON.stringify(lista));
        //Preparacion  llamada AJAX
        var _values_send =
                'idPlanEmergencia=' + idPlanEmergencia;

        var _URL_ = "mod/planEmergencia/ajax_puestos_brigada.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("POST", _URL_ + "&" + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {
                page.innerHTML = cargando;
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    datosGuardados('lista_puestoBrigada');
                    jAlert("Guardado  con exito", "Exito");
                    if (pasar) {
                        OpcionMenu('mod/planEmergencia/plan_emergencia_zona_seguridad.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
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

