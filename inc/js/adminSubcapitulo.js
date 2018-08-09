/// list_subcapitulo
function cambiarSubcapitulos(){
    var find_key = jQuery("#select_capitulos").val();
    OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/list_subcapitulos.php?', 'find_key='+find_key)
}

var rowPreSubCapitulo = null;
function flechasSubCapitulos() {

    jQuery(".up,.down").click(function () {
        var row = jQuery(this).parents("tr:first");
        if (rowPreSubCapitulo != null) {
            rowPreSubCapitulo.removeClass("bg-info")
        }
        rowPreSubCapitulo = row;
        if (jQuery(this).is(".up")) {
            row.insertBefore(row.prev());
        } else {
            row.insertAfter(row.next());
        }
        if (!row.hasClass("bg-info")) {
            row.addClass("bg-info");
        }
    });

}
function ordenarSubCapitulos() {
    jConfirm("Desea reordenar los subcapitulos ", "Ordenar", function (r) {
        if (r) {
            var lista = new Array();
            var fila = document.getElementById("lista_subcapitulos").firstElementChild.nextElementSibling;
            fila = fila.firstElementChild;
            while (fila != null) {
                var hijo = fila.firstElementChild;
                var text = hijo.innerHTML;
                lista.push(text);
                fila = fila.nextElementSibling;
            }
            guardarOrdenSubcapitulo(lista)
        }
    });

}

function guardarOrdenSubcapitulo(lista) {
    var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
    //Obtener Valores
   var select_tipo=jQuery("#select_capitulos").val();
    var ajax = NuevoAjax();
    var _values_send =
            'lista=' + JSON.stringify(lista);
    var _URL_ = "mod/adminPlanEmergencia/adminSubcapitulos/ajax_ordenar_subcapitulos.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {

            //Nada
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                jAlert("Ordenado  con exito", "Exito");
                OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/list_subcapitulos.php?', 'find_key='+select_tipo);
            } else if (response == 1 || response == 2) {
                jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
            } else if (response == 3) {
                jAlert("el orden ya existe.\n Consulte a la USTDS", "Usuario ya existe");
            } else {
                jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
            }
        }
    };
    ajax.send(null);
    loading.innerHTML = "";

}


function active_subcapitulo(id,isActivo,titulo,select){
     var estado;
    if (isActivo == 1) {
        estado = "desactivar ";
        isActivo =0;
    } else {
        estado = "activar ";
        isActivo =1;
    }
    jConfirm("Desea " + estado + " el subcapitulo: " + titulo, "Cambiar estado de actividad", function (r) {
        if (r) {
            active_subcapitulo_action(id, isActivo,select);
        }
    });
    
}

function active_subcapitulo_action(id,isActivo,select) {
    var page = document.getElementById('container');
    page.innerHTML = cargando;
    var ajax = NuevoAjax();
    //Preparacion  llamada AJAX
    var _values_send = 'id=' + id +
            '&activo='+isActivo;
    var _URL_ = "mod/adminPlanEmergencia/adminSubcapitulos/ajax_active_subcapitulo.php?";
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
                   OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/list_subcapitulos.php?', 'find_key='+select);
            } else if (response == 0) {
                jAlert('Ha ocurrido un error en la Base de Datos Intentelo Nuevamente\n Si el problema continua comuniquese con la USTDS', 'Error');
            } else {
                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
            }
         
        }
    };
    page.innerHTML = '';
    ajax.send(null);
}


/**
 * 
 * @param {type} id_origen_amenaza
 * @returns {undefined}
 */function delete_subcapitulo(id , titulo,select) {
    jConfirm("Desea eliminar el subcapitulo:" + titulo , "Eliminar capitulo", function (r) {
        if (r) {
            delete_subcapitulo_action(id,select);
        }
    });
}

function delete_subcapitulo_action(id,select) {
    var page = document.getElementById('container');
    page.innerHTML = cargando;
    var ajax = NuevoAjax();
    //Preparacion  llamada AJAX
    var _values_send = 'id=' + id;
    var _URL_ = "mod/adminPlanEmergencia/adminSubcapitulos/ajax_del_subcapitulo.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + "&" + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
            page.innerHTML = cargando;
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                jAlert('El Capitulo  se a eliminado correctamente!', 'Exito');
             OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/list_subcapitulos.php?', 'find_key='+select);
            } else if (response == 1 || response == 2) {
                jAlert('Ha ocurrido un error en la Base de Datos Intentelo Nuevamente\n Si el problema continua comuniquese con la USTDS', 'Error');
            } else {
                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
            }
            
        }
    };
    page.innerHTML = '';
    ajax.send(null);
}

// crear subcapitulo
function CrearEditorSubcapitulos() {
      editor = CKEDITOR.replace('Subcapitulo_Descripcion');
    editor.addCommand("mySimpleCommand", {
        exec: function (edt) {
            edt.insertText(" <&nombreZonaTrabajo&> ");
        }
    });
    editor.ui.addButton('SuperButton', {
        label: "zona trabajo",
        command: 'mySimpleCommand',
        toolbar: 'tools',
        icon: 'samples/img/casaIcono.PNG'
    });
}

function validate_subcapitulo() {
    var titulo = document.getElementById('subcapitulo_title');
    if (titulo.value == "") {
        jAlert("Ingrese el titulo del subcapitulo", "Dato Requerido");
        titulo.setAttribute("style", "background-color:#EDF0FF");
        titulo.focus();
        return false;
    }   
    return true;
}

function new_subcapitulo() {
    if (validate_subcapitulo()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var titulo = document.getElementById('subcapitulo_title').value;
        var activo = 1;
        var select_tipo = document.getElementById('subcapitulo_capitulo').value;
        var descripcion = CKEDITOR.instances['Subcapitulo_Descripcion'].getData();
        var ajax = NuevoAjax();
        var _values_send =
                'titulo=' + titulo +
                '&inlineCheckbox=' + activo +
                '&select_tipo=' + select_tipo +
                '&descripcion=' + descripcion;
        var _URL_ = "mod/adminPlanEmergencia/adminSubcapitulos/ajax_new_subcapitulo.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("GET", _URL_ + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {

                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Subcapitulo añadido con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/list_subcapitulos.php?', 'find_key='+select_tipo);
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("El Subcapitulo ya existe.\n Consulte a la USTDS", "Usuario ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(null);
        loading.innerHTML = "";
    }
}


//**** actualizar subcapitulo****
function update_subcapitulo(id){
     if (validate_subcapitulo()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var titulo = document.getElementById('subcapitulo_title').value;
        var activo = 1;
        var select_tipo = document.getElementById('subcapitulo_capitulo').value;
        var descripcion = CKEDITOR.instances['Subcapitulo_Descripcion'].getData();
        var ajax = NuevoAjax();
        var _values_send =
                 'id=' + id +
                '&titulo=' + titulo +
                '&select_tipo=' + select_tipo +
                '&descripcion=' + descripcion;
        var _URL_ = "mod/adminPlanEmergencia/adminSubcapitulos/ajax_edit_subcapitulo.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("GET", _URL_ + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {

                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Subcapitulo añadido con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/list_subcapitulos.php?', 'find_key='+select_tipo);
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("El Subcapitulo ya existe.\n Consulte a la USTDS", "Usuario ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(null);
        loading.innerHTML = "";
    }
    
}

