/**
 *  Valida la información de la zona de la amenaza
 * @returns {boolean}
 */
function validate_sede() {
    var nombre = document.getElementById('nombre');
    var descripcion = document.getElementById('descripcion');
    if (nombre.value == "") {
        jAlert("Ingrese el nombre de sede", "Dato Requerido");
        nombre.setAttribute("style", "background-color:#EDF0FF");
        nombre.focus();
        return false;
    }else if(descripcion.value == ""){
        jAlert("Ingrese la descripción", "Dato Requerido");
        descripcion.setAttribute("style", "background-color:#EDF0FF");
        descripcion.focus();
        return false;
    }
    return true;
}

function update_sede(id) {
    if (validate_sede()) {
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
        var _URL_ = "mod/adminPlanEmergencia/adminSedes/ajax_edit_sedes.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("GET", _URL_ + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {

                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Sede actualizada con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminSedes/list_sedes.php?', '');
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("La Sede ya existe.\n Consulte a la USTDS", "Sede ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(null);
        loading.innerHTML = "";
    }
}

/**
 * 
 * @param {type} id
 * @returns {undefined}
 */
function delete_sedes_action(id) {
    var page = document.getElementById('container');
    page.innerHTML = cargando;
    var ajax = NuevoAjax();
    //Preparacion  llamada AJAX
    var _values_send = 'id=' + id;
    var _URL_ = "mod/adminPlanEmergencia/adminSedes/ajax_del_sedes.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + "&" + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
            page.innerHTML = cargando;
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                jAlert('La sede se a eliminada correctamente!', 'Exito');
            } else if (response == 1 || response == 2) {
                jAlert('Ha ocurrido un error en la Base de Datos Intentelo Nuevamente\n Si el problema continua comuniquese con la USTDS', 'Error');
            } else if (response == 3) {
                   jAlert( 'tiene centros de trabajo asociados','La sede no se puede eliminar');
            } else {
                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
            }
            OpcionMenu('mod/adminPlanEmergencia/adminSedes/list_sedes.php?', '');
        }
    };
    page.innerHTML = '';
    ajax.send(null);
}

/**
 * 
 * @param {type} id_sede
 * @returns {undefined}
 */
function delete_sedes(id_sede) {
    jConfirm("Desea eliminar la sede:" + id_sede, "Eliminar sede", function (r) {
        if (r) {
            delete_sedes_action(id_sede);
        }
    });
}

/**
 * Añade una nueva sede a la base de datos. * 
 * @returns {undefined} redirecciona a la lista de usuarios
 */
function new_sede() {
    if (validate_sede()) {
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
                'nombre=' + nombre +
                '&descripcion=' + descripcion +
                '&inlineCheckbox=' + activo;
        var _URL_ = "mod/adminPlanEmergencia/adminSedes/ajax_new_sedes.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("GET", _URL_ + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {
                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Sede añadida con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminSedes/list_sedes.php?', '');
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("La Sede ya existe.\n Consulte a la USTDS", "Sede ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(null);
        loading.innerHTML = "";
    }
}

