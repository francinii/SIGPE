/**
 *  Valida la información del origen de la amenaza
 * @returns {boolean}
 */
function validate_user(status) {
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
function new_origen_amenaza(status) {
    if (validate_user(status)) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var nombre = document.getElementById('nombre').value;
        var activo =0;
        if(document.getElementById('inlineCheckbox1').checked) activo = 1;
        else activo = 0;
        
        var ajax = NuevoAjax();
        var _values_send =
                'nombre=' + nombre +
                '&activo=' + activo;
        var _URL_ = "mod/adminCategoriaAmenaza/adminOrigenAmenaza/ajax_new_origenAmenaza.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("GET", _URL_ + _values_send, true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 1) {
                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Origen añadido con exito", "Exito");
                    OpcionMenu('mod/adminCategoriaAmenaza/adminOrigenAmenaza/list_origenAmenaza.php?', '');
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
//        var id_tipo_tel = document.getElementById('tipo_tel').value;
//        var id_roll = document.getElementById('rol_slc').value;
//        //Preparacion  llamada AJAX 
//        var ajax = NuevoAjax();
//        var _values_send =
//                'id=' + id +
//                '&nombre=' + nombre +
//                '&email=' + email +
//                '&telefono=' + telefono +
//                '&id_tipo_tel=' + id_tipo_tel +
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
///**
// * 
// * @param {type} id_user
// * @returns {undefined}
// */
//function delete_user_action(id_user) {
//    var page = document.getElementById('container');
//    page.innerHTML = cargando;
//    var ajax = NuevoAjax();
//    //Preparacion  llamada AJAX
//    var _values_send = 'id_user=' + id_user;
//    var _URL_ = "mod/admin/users/ajax_del_user.php?";
//    //alert(_URL_ + _values_send); //DEBUG
//    ajax.open("GET", _URL_ + "&" + _values_send, true);
//    ajax.onreadystatechange = function() {
//        if (ajax.readyState == 1) {
//            page.innerHTML = cargando;
//        } else if (ajax.readyState == 4) {
//            var response = ajax.responseText;
//            //alert(response); //DEBUG
//            if (response == 0) {
//                jAlert('El usuario se a eliminado correctamente!', 'Exito');
//                OpcionMenu('mod/admin/users/list_user.php?', '');
//            } else if (response == 1 || response == 2) {
//                jAlert('Ha ocurrido un error en la Base de Datos Intentelo Nuevamente\n Si el problema continua comuniquese con la USTDS', 'Error');
//                OpcionMenu('mod/admin/users/list_user.php?', '');
//            } else {
//                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
//                OpcionMenu('mod/admin/users/list_user.php?', '');
//            }
//        }
//    };
//    page.innerHTML = '';
//    ajax.send(null);
//}
///**
// * 
// * @param {type} id_user
// * @returns {undefined}
// */
//function delete_user(id_user) {
//    jConfirm("Desea eliminar el usuario cédula:" + id_user, "Eliminar Usuario", function(r) {
//        if (r) {
//            delete_user_action(id_user);
//        }
//    });
//}
//
