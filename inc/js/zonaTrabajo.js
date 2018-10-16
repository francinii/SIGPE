/**
 *  Valida la información de la zona de la amenaza
 * @returns {boolean}
 */
function cambiarCentro(){
    var find_key = jQuery("#select_sede").val();
    OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/list_zona_trabajo.php?', 'find_key='+find_key)
}


function validate_zona_trabajo() {
    var nombre = document.getElementById('nombre');
    if (nombre.value == "") {
        jAlert("Ingrese el nombre del centro de trabajo", "Dato Requerido");
        nombre.setAttribute("style", "background-color:#EDF0FF");
        nombre.focus();
        return false;
    }
     var sede = document.getElementById('select_sede');
    if (sede.value == "") {
        jAlert("No hay sedes en el sistema, debe agregar una", "Dato Requerido");
        sede.setAttribute("style", "background-color:#EDF0FF");
        sede.focus();
        return false;
    }
    return true;
}

/**
 * Añade una nueva zona de trabajo a la base de datos.
 * @param {int} status verifica si se usa LDAP 0 = No, 1 =Si
 * @returns {undefined} redirecciona a la lista de usuarios
 */
function validarImagen(){
    var file2 = document.getElementById("type-file")
    if(file2.files[0]!=null){
    var archivo = file2.files[0]; 
    var resultado= archivo.type.indexOf("image/");
    if(resultado!=0){
        jAlert("El logo debe ser una imagen", "Dato no permitido");
        return false
    }
   }
   var file2 = document.getElementById("type-file-ubicacion")
    if(file2.files[0]!=null){
    var archivo = file2.files[0]; 
    var resultado= archivo.type.indexOf("image/");
    if(resultado!=0){
        jAlert("La ubicación debe ser una imagen", "Dato no permitido");
        return false
    }
   }
   return true;
}

function new_zona_trabajo() {
    if (validate_zona_trabajo() && validarImagen()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var nombre = document.getElementById('nombre').value;
        var sede = document.getElementById('select_sede').value;
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
        var file1 = document.getElementById("type-file");
        var archivo1 = file1.files[0]; 
        
        var file2 = document.getElementById("type-file-ubicacion");
        var archivo2 = file2.files[0];
        
        var formData = new FormData();
        formData.append('archivo1',archivo1);
        formData.append('archivo2',archivo2);
        
        var ajax = NuevoAjax();
        var _values_send =
                '&lista=' + JSON.stringify(lista) +
                '&nombre=' + nombre +
                '&sede=' + sede +                          
                '&descripcion=' + descripcion +
                '&inlineCheckbox=' + activo;
        
 
        var _URL_ = "mod/adminPlanEmergencia/adminZonaTrabajo/ajax_new_zona_trabajo.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("POST", _URL_ + _values_send, true);
       
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {
                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Centro añadido con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/list_zona_trabajo.php?', 'find_key='+sede);
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("El centro ya existe.\n Consulte a la USTDS", "Centro ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(formData);
        loading.innerHTML = "";
    }
}

function delete_zona_trabajo_action(id) {
    var page = document.getElementById('container');
    var sede = document.getElementById('select_sede').value;
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
                jAlert('El centro se a eliminado correctamente!', 'Exito');
            } else if (response == 1 || response == 2) {
                jAlert('Ha ocurrido un error en la Base de Datos Intentelo Nuevamente\n Si el problema continua comuniquese con la USTDS', 'Error');
           } else if (response == 3) {
                jAlert('El centro de trabajo tiene Usuarios o Datos asociados', 'No se puede eliminar');
            } else {
                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
            }
            OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/list_zona_trabajo.php?', 'find_key='+sede);
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
    jConfirm("Desea eliminar el centro de trabajo:" + id_zona_trabajo, "Eliminar centro de trabajo", function (r) {
        if (r) {
            delete_zona_trabajo_action(id_zona_trabajo);
        }
    });
}

function update_zona_trabajo(id) {
    if (validate_zona_trabajo() && validarImagen()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var nombre = document.getElementById('nombre').value;
        var sede = document.getElementById('select_sede').value;       
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

        var file1 = document.getElementById("type-file");
        var archivo1 = file1.files[0]; 
        
        var file2 = document.getElementById("type-file-ubicacion");
        var archivo2 = file2.files[0];
        
        var formData = new FormData();
        formData.append('archivo1',archivo1);
        formData.append('archivo2',archivo2);

        var ajax = NuevoAjax();
        var _values_send =
                '&lista=' + JSON.stringify(lista) +
                '&id=' + id +
                '&nombre=' + nombre +
                '&sede=' + sede +              
                '&descripcion=' + descripcion +
                '&activo=' + activo;
        var _URL_ = "mod/adminPlanEmergencia/adminZonaTrabajo/ajax_edit_zona_trabajo.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("POST", _URL_ + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {
                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("centro actualizado con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/list_zona_trabajo.php?', 'find_key='+sede);
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("El centro ya existe.\n Consulte a la USTDS", "centro ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(formData);
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



