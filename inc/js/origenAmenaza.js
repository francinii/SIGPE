/**
 *  valida la informacion del origen de amenaza
 *  llamado en  edit_origen_amenaza.php y new__origen_amenaza.php
 * @returns {boolean} 
 */
function validate_origen_amenaza() {
    var nombre = document.getElementById('nombre');
    if (nombre.value == "") {
        jAlert("Ingrese el nombre del origen de la amenaza", "Dato Requerido");
        nombre.setAttribute("style", "background-color:#EDF0FF");
        nombre.focus();
        return false;
    }

    return true;
}

/**
 *  agrega una nuevo origen de amenaza, conecta al servidor
 *  llamado en  new__origen_amenaza.php
 * @returns {undefined} redirecciona list_origen_amenaza.php
 */
function new_origen_amenaza() {
    if (validate_origen_amenaza()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var nombre = document.getElementById('nombre').value;
        var activo = 0;
        if (document.getElementById('inlineCheckbox1').checked)
            activo = 1;
        else
            activo = 0;

        var ajax = NuevoAjax();
        var _values_send =
                'nombre=' + nombre +
                '&inlineCheckbox=' + activo;
        var _URL_ = "mod/adminPlanEmergencia/adminMatriz/adminOrigenAmenaza/ajax_new_origen_amenaza.php?";
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
                    OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminOrigenAmenaza/list_origen_amenaza.php?', '');
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("El origen ya existe.\n Consulte a la USTDS", "Origen ya existe");
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
 *  Elimina un origen de amenaza, conecta al servidor
 *  llamado en  list_origen_amenaza.php
 * @returns {undefined} redirecciona list_origen_amenaza.php
 */
function delete_origen_action(id) {
    var page = document.getElementById('container');
    page.innerHTML = cargando;
    var ajax = NuevoAjax();
    //Preparacion  llamada AJAX
    var _values_send = 'id=' + id;
    var _URL_ = "mod/adminPlanEmergencia/adminMatriz/adminOrigenAmenaza/ajax_del_origen_amenaza.php?";
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
            } else if (response == 3) {
                jAlert('tiene tipos de amenaza asociados', 'El origen de amenaza no se puede eliminar');
            } else {
                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
            }
            OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminOrigenAmenaza/list_origen_amenaza.php?', '');
        }
    };
    page.innerHTML = '';
    ajax.send(null);
}

/**
 *  confirma la  eliminacion de  un origen de amenaza
 *  llamado en  list_origen_amenaza.php
 * @returns {undefined} delete_origen_action() o cancela
 */
function delete_origen_amenaza(id_origen_amenaza, descripcion) {
    jConfirm("Desea eliminar el origen:" + descripcion, "Eliminar origen de amenaza", function (r) {
        if (r) {
            delete_origen_action(id_origen_amenaza);
        }
    });
}



/**
 *   confirma  activacion o desactivacion de un  origen de amenaza
 *  llamado en  list_origen_amenaza.php 
 *  @param {int} id_origen_amenaza id del origen de amenaza
 *  @param {int} activo estado del capitulo (1,0)
 * @returns {undefined} llama al metodo active_origen_action() o cancela
 */
function active_origen_amenaza(id_origen_amenaza, activo) {
    var estado;
    if (activo == 1) {
        estado = "desactivar ";
        activo = 0;
    } else {
        estado = "activar ";
        activo = 1;
    }
    jConfirm("Desea " + estado + " el origen: " + id_origen_amenaza, "Cambiar estado de actividad", function (r) {
        if (r) {
            active_origen_action(id_origen_amenaza, activo);
        }
    });
}

/**
 *   activa o desactiva  un  origen de amenaza,conecta con el servidor
 *  llamado en  list_origen_amenaza.php 
 *  @param {int} id id del origen de amenaza
 *  @param {int} activo estado del capitulo (1,0)
 * @returns {undefined} llama al metodo active_origen_action() o cancela
 */
function active_origen_action(id, activo) {
    var page = document.getElementById('container');
    page.innerHTML = cargando;
    var ajax = NuevoAjax();
    //Preparacion  llamada AJAX
    var _values_send = 'id=' + id +
            '&activo=' + activo;
    var _URL_ = "mod/adminPlanEmergencia/adminMatriz/adminOrigenAmenaza/ajax_active_origen_amenaza.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + "&" + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
            page.innerHTML = cargando;
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 1) {
                jAlert('El estado ha sido actualizado!', 'Exito');
            } else if (response == 0) {
                jAlert('Ha ocurrido un error en la Base de Datos Intentelo Nuevamente\n Si el problema continua comuniquese con la USTDS', 'Error');
            } else {
                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
            }
            OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminOrigenAmenaza/list_origen_amenaza.php?', '');
        }
    };
    page.innerHTML = '';
    ajax.send(null);
}
/**
 *   actualiza un  origen de amenaza,conecta con el servidor
 *  llamado en  list_origen_amenaza.php 
 *  @param {int}  id del origen de amenaza 
 * @returns {undefined} redirecciona a list_origen_amenaza.php
 */
function update_origen_amenaza(id) {
    if (validate_origen_amenaza()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var nombre = document.getElementById('nombre').value;
        var activo = 0;
        if (document.getElementById('inlineCheckbox1').checked)
            activo = 1;
        else
            activo = 0;

        var ajax = NuevoAjax();
        var _values_send =
                'id=' + id +
                '&nombre=' + nombre +
                '&activo=' + activo;
        var _URL_ = "mod/adminPlanEmergencia/adminMatriz/adminOrigenAmenaza/ajax_edit_origen_amenaza.php?";
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
                    OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminOrigenAmenaza/list_origen_amenaza.php?', '');
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