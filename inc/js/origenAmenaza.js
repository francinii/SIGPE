/**
 *  Valida la información del origen de la amenaza
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
 * Añade el nuevo usuario a la base de datos.
 * @param {int} status verifica si se usa LDAP 0 = No, 1 =Si
 * @returns {undefined} redirecciona a la lista de usuarios
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
 * 
 * @param {type} id_origen_amenaza
 * @returns {undefined}
 */function delete_origen_amenaza(id_origen_amenaza) {
    jConfirm("Desea eliminar el origen:" + id_origen_amenaza, "Eliminar origen de amenaza", function (r) {
        if (r) {
            delete_origen_action(id_origen_amenaza);
        }
    });
}



/**
 * Actualiza la informacion del usuario
 * @param {string} id_user identificador del usuario que se actualiza
 lñp * @returns {undefined} N/A
 */
//function update_user(id_user){
//    if (validate_user(1)) {
//        var loading = document.getElementById('loading_container');
//        loading.innerHTML = cargando_bar;
//        //Obtener Valores
//        var id = id_user;
//        var nombre = document.getElementById('nombre_txt').value;
//        var email = document.getElementById('correo_txt').value;
//        var telefono = document.getElementById('telefono_txt').value;
//        var id_origen_tel = document.getElementById('origen_tel').value;
//        var id_roll = document.getElementById('rol_slc').value;
//        //Preparacion  llamada AJAX 
//        var ajax = NuevoAjax();
//        var _values_send =
//                'id=' + id +
//                '&nombre=' + nombre +
//                '&email=' + email +
//                '&telefono=' + telefono +
//                '&id_origen_tel=' + id_origen_tel +
//                '&id_roll=' + id_roll;
//        var _URL_ = "mod/admin/users/ajax_upd_user.php?";
//        //alert(_URL_ + _values_send); //DEBUG
//        ajax.open("GET", _URL_ + _values_send, true);
//        ajax.onreadystatechange = function() {
//            if (ajax.readyState == 1) {
//                //Nada
//            } else if (ajax.readyState == 4) {
//                var response = ajax.responseText;
//                //alert(response); //DEBUG
//                if (response == 0) {
//                    jAlert("Usuario actualizado con exito", "Exito");
//                    OpcionMenu('mod/admin/users/list_user.php?', '');
//                } else if (response == 1 || response == 2) {
//                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS");
//                } else {
//                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
//                }
//            }
//        };
//        ajax.send(null);
//        loading.innerHTML = "";
//    }
//}
//
///**
// * Redirecciona a la pantalla editar usuario
// * @param {string} id cédula del usuario
// */
//function view_user(id) {
//    OpcionMenu('mod/admin/users/edit_user.php?', 'id_user=' + id + '&view_mode=0');
//}
///**
// * Redirecciona a la pantalla editar usuario
// * @param {string} id cédula del usuario
// */
//function edit_user(id) {
//    OpcionMenu('mod/admin/users/edit_user.php?', 'id_user=' + id + '&view_mode=1');
//}
/**
 * 
 * @param {type} id_user
 * @returns {undefined}
 */



