/**
 *  valida la informacion del tipo de amenaza
 *  llamado en  new_tipo_amenaza.php y edit_tipo_amenaza.php
 * @returns {Boolean} 
 */
function validate_tipo_amenaza() {
    var nombre = document.getElementById('nombre');
    if (nombre.value == "") {
        jAlert("Ingrese el nombre del tipo de la amenaza", "Dato Requerido");
        nombre.setAttribute("style", "background-color:#EDF0FF");
        nombre.focus();
        return false;
    }
    var select_tipo = document.getElementById('select_tipo').value;
    if (select_tipo == "") {
        jAlert("Seleccione un tipo de amenaza", "Dato Requerido");
        select_tipo.setAttribute("style", "background-color:#EDF0FF");
        select_tipo.focus();
        return false;
    }


    return true;
}

/**
 *  Agrega un nuevo  tipo de amenaza, conecta con el servidor
 *  llamado en  new_tipo_amenaza.php   
 * @returns {undefined} redirreciona list_tipo_amenaza.php  
 */
function new_tipo_amenaza() {
    if (validate_tipo_amenaza()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var nombre = document.getElementById('nombre').value;
        var activo = 0;
        if (document.getElementById('inlineCheckbox1').checked)
            activo = 1;
        else
            activo = 0;

        var select_tipo = document.getElementById('select_tipo').value;
        var ajax = NuevoAjax();
        var _values_send =
                'nombre=' + nombre +
                '&inlineCheckbox=' + activo +
                '&select_tipo=' + select_tipo;
        var _URL_ = "mod/adminPlanEmergencia/adminMatriz/adminTipoAmenaza/ajax_new_tipo_amenaza.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("GET", _URL_ + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {

                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Tipo de la amenaza añadido con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminTipoAmenaza/list_tipo_amenaza.php?', '');
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("El tipo ya existe.\n Consulte a la USTDS", "Tipo ya existe");
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
 *  Elimina un  tipo de amenaza, conecta con el servidor
 *  llamado en  list_tipo_amenaza.php 
 *   @param {int} id del tipo de amenaza 
 * @returns {undefined} redirreciona list_tipo_amenaza.php  
 */
function delete_tipo_action(id) {
    var page = document.getElementById('container');
    page.innerHTML = cargando;
    var ajax = NuevoAjax();
    //Preparacion  llamada AJAX
    var _values_send = 'id=' + id;
    var _URL_ = "mod/adminPlanEmergencia/adminMatriz/adminTipoAmenaza/ajax_del_tipo_amenaza.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + "&" + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
            page.innerHTML = cargando;
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                jAlert('El tipo de amenaza se a eliminado correctamente!', 'Exito');
            } else if (response == 1 || response == 2) {
                jAlert('Ha ocurrido un error en la Base de Datos Intentelo Nuevamente\n Si el problema continua comuniquese con la USTDS', 'Error');
             }else if ( response == 3){
                jAlert( 'tiene categorias de amenaza asociados','El tipo de amenaza no se puede eliminar');
            } else {
                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
            }
            OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminTipoAmenaza/list_tipo_amenaza.php?', '');
        }
    };
    page.innerHTML = '';
    ajax.send(null);
}

/**
 *  confirma elimininacion de un  tipo de amenaza
 *  llamado en  list_tipo_amenaza.php 
 *  @param {int} id_tipo_amenaza id del tipo de amenaza 
 *  @param {String} titulo del tipo de amenaza 
 * @returns {undefined} llama al metodo delete_tipo_action() o cancela
 */
function delete_tipo_amenaza(id_tipo_amenaza,titulo) {
    jConfirm("Desea eliminar el tipo:" + titulo, "Eliminar tipo de amenaza", function (r) {
        if (r) {
            delete_tipo_action(id_tipo_amenaza);
        }
    });
}
/**
 *  activa/desactiva  tipo de amenaza,conecta con el servidor
 *  llamado en  list_tipo_amenaza.php 
 *  @param {int} id_tipo_amenaza id del tipo de amenaza 
 *  @param {int} activo  estado del tipo de amenaza (1,0)
 * @returns {undefined} redirreciona list_tipo_amenaza.php  
 */
function active_tipo_action(id,activo) {
    var page = document.getElementById('container');
    page.innerHTML = cargando;
    var ajax = NuevoAjax();
    //Preparacion  llamada AJAX
    var _values_send = 'id=' + id +
            '&activo='+activo;
    var _URL_ = "mod/adminPlanEmergencia/adminMatriz/adminTipoAmenaza/ajax_active_tipo_amenaza.php?";
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
            OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminTipoAmenaza/list_tipo_amenaza.php?', '');
        }
    };
    page.innerHTML = '';
    ajax.send(null);
}

/**
 *  confirma activa/desactiva  tipo de amenaza
 *  llamado en  list_tipo_amenaza.php 
 *  @param {int} id_tipo_amenaza id del tipo de amenaza 
 *  @param {int} activo  estado del tipo de amenaza (1,0)
 * @returns {undefined} redirreciona list_tipo_amenaza.php  
 */
function active_tipo_amenaza(id_tipo_amenaza, activo) {
    var estado;
    if (activo == 1) {
        estado = "desactivar ";
        activo = 0;
    } else {
        estado = "activar ";
        activo = 1;
    }
    jConfirm("Desea " + estado + " el tipo: " + id_tipo_amenaza, "Cambiar estado del tipo de amenaza", function (r) {
        if (r) {
            active_tipo_action(id_tipo_amenaza, activo);
        }
    });
}

/**
 *  actualizar tipo de amenaza, conecta con el servidor
 *  llamado en  edit_tipo_amenaza.php 
 *  @param {int} id id del tipo de amenaza 
 * @returns {undefined} redirreciona list_tipo_amenaza.php  
 */
function update_tipo_amenaza(id) {
    if (validate_tipo_amenaza()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var nombre = document.getElementById('nombre').value;
        var activo = 0;
        if (document.getElementById('inlineCheckbox1').checked)
            activo = 1;
        else
            activo = 0;

        var fkid = document.getElementById('select_tipo').value;

        var ajax = NuevoAjax();
        var _values_send =
                'id=' + id +
                '&nombre=' + nombre +
                '&fkid=' + fkid +
                '&activo=' + activo;
        var _URL_ = "mod/adminPlanEmergencia/adminMatriz/adminTipoAmenaza/ajax_edit_tipo_amenaza.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("GET", _URL_ + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {
                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Tipo de amenaza actualizada con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminTipoAmenaza/list_tipo_amenaza.php?', '');
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("El Tipo ya existe.\n Consulte a la USTDS", "El tipo ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(null);
        loading.innerHTML = "";
    }

}
