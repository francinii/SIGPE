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
                    jAlert("Categoria añadida con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/list_categoria_amenaza.php?', 'find_key='+select_tipo);
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("La categoria ya existe.\n Consulte a la USTDS", "Categoria ya existe");
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
     var find_key = document.getElementById("select_tipo_amenaza").value;
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
              } else if (response == 3) {
                     jAlert( 'tiene datos  asociados','El categoria de amenaza no se puede eliminar');
            } else {
                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
            }
            OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/list_categoria_amenaza.php?', 'find_key=' + find_key);
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
    var fkid = document.getElementById('select_tipo_amenaza').value;
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
            OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/list_categoria_amenaza.php?', 'find_key=' + fkid);
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
    jConfirm("Desea " + estado + " la categoria: " + id_categoria_amenaza, "Cambiar estado de la categoria", function (r) {
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
                    OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/list_categoria_amenaza.php?', 'find_key=' + find_key);
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("La categoria ya existe.\n Consulte a la USTDS", "categoria ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(null);
        loading.innerHTML = "";
    }
    
}
