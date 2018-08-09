/**
 *  Valida la información del categoria de la amenaza
 * @returns {boolean}
 */
function validate_categoria_amenaza() {
    var nombre = document.getElementById('nombre');
    if (nombre.value == "") {
        jAlert("Ingrese el nombre del categoria de la amenaza", "Dato Requerido");
        nombre.setAttribute("style", "background-color:#EDF0FF");
        nombre.focus();
        return false;
    }
    var select_tipo = document.getElementById('select_tipo').value;
    if (select_tipo == "") {
        jAlert("Seleccione un categoria de amenaza", "Dato Requerido");
        select_tipo.setAttribute("style", "background-color:#EDF0FF");
        select_tipo.focus();
        return false;
    }


    return true;
}

/**
 * Añade el nuevo usuario a la base de datos.
 * @param {int} status verifica si se usa LDAP 0 = No, 1 =Si
 * @returns {undefined} redirecciona a la lista de usuarios
 */
function new_categoria_amenaza() {
    if (validate_categoria_amenaza()) {
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
        var _URL_ = "mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/ajax_new_categoria_amenaza.php?";
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
                    OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/list_categoria_amenaza.php?', '');
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


function cambiarTipoAmenaza() {
    var find_key = document.getElementById("select_tipo_amenaza").value;
    OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/list_categoria_amenaza.php?', 'find_key=' + find_key);
}


function delete_categoria_action(id) {
    var page = document.getElementById('container');
    page.innerHTML = cargando;
    var ajax = NuevoAjax();
    //Preparacion  llamada AJAX
    var _values_send = 'id=' + id;
    var _URL_ = "mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/ajax_del_categoria_amenaza.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + "&" + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
            page.innerHTML = cargando;
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                jAlert('La categoria de amenaza se a eliminado correctamente!', 'Exito');
            } else if (response == 1 || response == 2) {
                jAlert('Ha ocurrido un error en la Base de Datos Intentelo Nuevamente\n Si el problema continua comuniquese con la USTDS', 'Error');
            } else {
                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
            }
            OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/list_categoria_amenaza.php?', '');
        }
    };
    page.innerHTML = '';
    ajax.send(null);
}
/**
 * 
 * @param {type} id_categoria_amenaza
 * @returns {undefined}
 */function delete_categoria_amenaza(id_categoria_amenaza) {
    jConfirm("Desea eliminar la categoria:" + id_categoria_amenaza, "Eliminar categoria de amenaza", function (r) {
        if (r) {
            delete_categoria_action(id_categoria_amenaza);
        }
    });
}



function active_categoria_action(id,activo) {
    var page = document.getElementById('container');
    page.innerHTML = cargando;
    var ajax = NuevoAjax();
    //Preparacion  llamada AJAX
    var _values_send = 'id=' + id +
            '&activo='+activo;
    var _URL_ = "mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/ajax_active_categoria_amenaza.php?";
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
            OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/list_categoria_amenaza.php?', '');
        }
    };
    page.innerHTML = '';
    ajax.send(null);
}

/**
 * 
 * @param {type} id_categoria_amenaza
 * @param {type} activo
 * @returns {undefined}
 */function active_categoria_amenaza(id_categoria_amenaza, activo) {
    var estado;
    if (activo == 1) {
        estado = "desactivar ";
        activo =0;
    } else {
        estado = "activar ";
        activo =1;
    }
    jConfirm("Desea " + estado + " el categoria: " + id_categoria_amenaza, "Cambiar estado de actividad", function (r) {
        if (r) {
            active_categoria_action(id_categoria_amenaza, activo);
        }
    });
}



//ACTUALIZAR ESTE METODO
function update_categoria_amenaza(id){
     if (validate_categoria_amenaza()) {
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
        var _URL_ = "mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/ajax_edit_categoria_amenaza.php?";
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
                    OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/list_categoria_amenaza.php?', '');
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
//        var id_categoria_tel = document.getElementById('categoria_tel').value;
//        var id_roll = document.getElementById('rol_slc').value;
//        //Preparacion  llamada AJAX 
//        var ajax = NuevoAjax();
//        var _values_send =
//                'id=' + id +
//                '&nombre=' + nombre +
//                '&email=' + email +
//                '&telefono=' + telefono +
//                '&id_categoria_tel=' + id_categoria_tel +
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
