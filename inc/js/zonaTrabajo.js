/**
 *  Valida la información de la zona de la amenaza
 * @returns {boolean}
 */
function validate_zona_trabajo() {
    var nombre = document.getElementById('nombre');
    if (nombre.value == "") {
        jAlert("Ingrese el nombre de la zona de trabajo", "Dato Requerido");
        nombre.setAttribute("style", "background-color:#EDF0FF");
        nombre.focus();
        return false;
    }
    return true;
}

/**
 * Añade una nueva zona de trabajo a la base de datos.
 * @param {int} status verifica si se usa LDAP 0 = No, 1 =Si
 * @returns {undefined} redirecciona a la lista de usuarios
 */
function new_zona_trabajo() {
    if (validate_zona_trabajo()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var nombre = document.getElementById('nombre').value;
        var descripcion = document.getElementById('descripcion').value;
        var activo = 0;      
        var lista = new Array();
        var fila = document.getElementById("tabla_usuario_zona").firstElementChild.nextElementSibling;
        fila = fila.firstElementChild;
        while (fila != null) {
            var hijo = fila.firstElementChild;
            var text = hijo.innerHTML;
            lista.push(text);
            fila = fila.nextElementSibling;
        }
        if (document.getElementById('inlineCheckbox1').checked)
            activo = 1;
        else
            activo = 0;

        var ajax = NuevoAjax();
        var _values_send =
                '&lista=' + JSON.stringify(lista) +
                '&nombre=' + nombre +
                '&descripcion=' + descripcion +
                '&nombre=' + nombre +
                '&descripcion=' + descripcion +
                '&inlineCheckbox=' + activo;
        var _URL_ = "mod/adminPlanEmergencia/adminZonaTrabajo/ajax_new_zona_trabajo.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("GET", _URL_ + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {
                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Origen añadido con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/list_zona_trabajo.php?', '');
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("El origen ya existe.\n Consulte a la USTDS", "Usuario ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(null);
        loading.innerHTML = "";
    }
}

function delete_zona_trabajo_action(id) {
    var page = document.getElementById('container');
    page.innerHTML = cargando;
    var ajax = NuevoAjax();
    //Preparacion  llamada AJAX
    var _values_send = 'id=' + id;
    var _URL_ = "mod/adminPlanEmergencia/adminZonaTrabajo/ajax_del_zona_trabajo.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + "&" + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
            page.innerHTML = cargando;
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                jAlert('El origen de amenaza se a eliminado correctamente!', 'Exito');
            } else if (response == 1 || response == 2) {
                jAlert('Ha ocurrido un error en la Base de Datos Intentelo Nuevamente\n Si el problema continua comuniquese con la USTDS', 'Error');
            } else {
                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
            }
            OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/list_zona_trabajo.php?', '');
        }
    };
    page.innerHTML = '';
    ajax.send(null);
}

/**
 * 
 * @param {type} id_zona_trabajo
 * @returns {undefined}
 */function delete_zona_trabajo(id_zona_trabajo) {
    jConfirm("Desea eliminar la zona de trabajo:" + id_zona_trabajo, "Eliminar zona de trabajo", function (r) {
        if (r) {
            delete_zona_trabajo_action(id_zona_trabajo);
        }
    });
}

function update_zona_trabajo(id) {
    if (validate_zona_trabajo()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var nombre = document.getElementById('nombre').value;
        var descripcion = document.getElementById('descripcion').value;
        var activo = 0;
        if (document.getElementById('inlineCheckbox1').checked)
            activo = 1;
        else
            activo = 0;

        var ajax = NuevoAjax();
        var _values_send =
                'id=' + id +
                '&nombre=' + nombre +
                '&descripcion=' + descripcion +
                '&activo=' + activo;
        var _URL_ = "mod/adminPlanEmergencia/adminZonaTrabajo/ajax_edit_zona_trabajo.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("GET", _URL_ + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {

                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Origen actualizado con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/list_zona_trabajo.php?', '');
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("El categoria ya existe.\n Consulte a la USTDS", "Usuario ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(null);
        loading.innerHTML = "";
    }

}


function asociar_usuario_zona_trabajo() {
    var cedula = document.getElementById('select_usuario').value;
    var nombre = jQuery('#select_usuario option:selected').text();
    var existe = jQuery("#" + cedula);
    if (existe.length == 0) {
        jQuery("#tabla_usuario_zona tbody").append("<tr id = '" + cedula + "'><td>" + cedula + "</td><td>" + nombre + "</td><td onclick = 'eliminar_usuario_zona(" + cedula + ");'><i class='fa fa-close text-danger puntero' title='Eliminar'></i></td></tr>");
    }
}

function eliminar_usuario_zona(cedula) {
    var elementoCedula = jQuery('#' + cedula);
    elementoCedula.remove();
}



