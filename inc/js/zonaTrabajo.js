/**
 * cambia los centro en base a las sedes
 * llamado en  list_zona_trabajo.php
 * @returns {undefined} recarga la pagina list_zonas_trabajo.php 
 */
function cambiarCentro(){
    var find_key = jQuery("#select_sede").val();
    OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/list_zona_trabajo.php?', 'find_key='+find_key)
}
/**
 * valida la informacion de los centros
 * llamado en  edit_zona_trabajo.php y new_zona_trabajo.php
 * @returns {boolean} 
 */
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
 * valida las imagenes cargadas de los centros
 * llamado en  edit_zona_trabajo.php y new_zona_trabajo.php
 * @returns {boolean} 
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

/**
 * agrega los nuevos centros de trabajo, conecta con el servidor
 * llamado en   new_zona_trabajo.php
 * @returns {undefined} redirecciona la pagina list_zonas_trabajo.php 
 */

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
        jQuery('#CargandoModal').modal('show');
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
       jQuery('#CargandoModal').modal('show');
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
            jQuery('#CargandoModal').modal('hide');
        };
        ajax.send(formData);
        loading.innerHTML = "";
    }
}
/**
 * elimina  centros de trabajo, conecta con el servidor
 * llamado en   list_zonas_trabajo.php 
 * @param {int} id del  centro  ha eliminar
 * @returns {undefined} recarga la pagina list_zonas_trabajo.php 
 */

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
 * confirma la elimina  centros de trabajo
 * llamado en   list_zonas_trabajo.php 
 * @param {int}id_zona_trabajo id  del  centro  ha eliminar
 *  * @param {String}titulo  del  centro  ha eliminar
 * @returns {undefined} llama al metodo delete_zona_trabajo_action o cancela
 */
function delete_zona_trabajo(id_zona_trabajo,titulo) {
    jConfirm("Desea eliminar el centro de trabajo:" + titulo, "Eliminar centro de trabajo", function (r) {
        if (r) {
            delete_zona_trabajo_action(id_zona_trabajo);
        }
    });
}

/**
 * actualiza el centros de trabajo,conecta con el servidor
 * llamado en   edit_zonas_trabajo.php 
 * @param {int}id  del  centro  ha eliminar
 * @returns {undefined} redireciona a  la pagina list_zonas_trabajo.php 
 */
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
        jQuery('#CargandoModal').modal('show');
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
                    
                    jAlert("Centro actualizado con éxito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/list_zona_trabajo.php?', 'find_key='+sede);
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("El centro ya existe.\n Consulte a la USTDS", "centro ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
                ;
            }
            jQuery('#CargandoModal').modal('hide')
        };
        ajax.send(formData);
        loading.innerHTML = "";
    }

}

/**
 * asocia usuarios  al centros de trabajo
 * llamado en   edit_zonas_trabajo.php y new_zonas_trabajo.php 
 * @returns {undefined} 
 */
function asociar_usuario_zona_trabajo() {
    var cedula = document.getElementById('select_usuario').value;
    var nombre = jQuery('#select_usuario option:selected').text();
    var existe = jQuery("#" + cedula);
    if (existe.length == 0) {
        jQuery("#tabla_usuario_zona tbody").append("<tr id = '" + cedula + "'><td>" + cedula + "</td><td>" + nombre + "</td><td onclick = 'eliminar_usuario_zona(" + cedula + ");'><i class='fa fa-close text-danger puntero' title='Eliminar'></i></td></tr>");
    }
}
/**
 * elimina usuarios  acociados al centros de trabajo
 * llamado en   edit_zonas_trabajo.php y new_zonas_trabajo.php 
 * @returns {undefined} 
 */
function eliminar_usuario_zona(cedula) {
    var elementoCedula = jQuery('#' + cedula);
    elementoCedula.remove();
}



