//******* list_capitulo********
var rowPreCapitulo = null;
function flechasCapitulos() {

    jQuery(".up,.down").click(function () {
        var row = jQuery(this).parents("tr:first");
        if (rowPreCapitulo != null) {
            rowPreCapitulo.removeClass("bg-info")
        }
        rowPreCapitulo = row;
        if (jQuery(this).is(".up")) {
            var texto = row.children(".numeroCapitulo").text();
            if (row.prev().length > 0) {
                row.children(".numeroCapitulo").text(row.prev().children(".numeroCapitulo").text());
                row.prev().children(".numeroCapitulo").text(texto);
            }
            row.insertBefore(row.prev());
        } else {
            var texto = row.children(".numeroCapitulo").text();
            if (row.next().length > 0) {
            row.children(".numeroCapitulo").text(row.next().children(".numeroCapitulo").text());
            row.next().children(".numeroCapitulo").text(texto);
            }
            row.insertAfter(row.next());
        }
        if (!row.hasClass("bg-info")) {
            row.addClass("bg-info");
        }

        jQuery("#miprueba").focus();
    });

}
function ordenarCapitulos() {
    jConfirm("Desea reordenar los capitulos ", "Ordenar", function (r) {
        if (r) {
            var lista = new Array();
            var fila = document.getElementById("lista_capitulos").firstElementChild.nextElementSibling;
            fila = fila.firstElementChild;
            while (fila != null) {
                var hijo = fila.firstElementChild;
                var text = hijo.innerHTML;
                lista.push(text);
                fila = fila.nextElementSibling;
            }
            guardarOrdenCapitulo(lista);
        }
    });

}

function guardarOrdenCapitulo(lista) {
    var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    //Obtener Valores

    var ajax = NuevoAjax();
    var _values_send =
            'lista=' + JSON.stringify(lista);
    var _URL_ = "mod/adminPlanEmergencia/adminCapitulos/ajax_ordenar_capitulo.php?";
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
                OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/list_capitulos.php?', '');
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

function active_capitulo(id, isActivo, titulo) {
    var estado;
    if (isActivo == 1) {
        estado = "desactivar ";
        isActivo = 0;
    } else {
        estado = "activar ";
        isActivo = 1;
    }
    jConfirm("Desea " + estado + " el capitulo: " + titulo, "Cambiar estado de actividad", function (r) {
        if (r) {
            active_capitulo_action(id, isActivo);
        }
    });

}

function active_capitulo_action(id, isActivo) {
    var page = document.getElementById('container');
    page.innerHTML = cargando;
    var ajax = NuevoAjax();
    //Preparacion  llamada AJAX
    var _values_send = 'id=' + id +
            '&activo=' + isActivo;
    var _URL_ = "mod/adminPlanEmergencia/adminCapitulos/ajax_active_capitulo.php?";
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
            OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/list_capitulos.php?', '');
        }
    };
    page.innerHTML = '';
    ajax.send(null);
}


/**
 * 
 * @param {type} id_origen_amenaza
 * @returns {undefined}
 */function delete_capitulo(id, titulo) {
    jConfirm("Desea eliminar el capitulo:" + titulo, "Eliminar capitulo", function (r) {
        if (r) {
            delete_capitulo_action(id);
        }
    });
}

function delete_capitulo_action(id) {
    var page = document.getElementById('container');
    page.innerHTML = cargando;
    var ajax = NuevoAjax();
    //Preparacion  llamada AJAX
    var _values_send = 'id=' + id;
    var _URL_ = "mod/adminPlanEmergencia/adminCapitulos/ajax_del_capitulo.php?";
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

            } else if (response == 1 || response == 2) {
                jAlert('Ha ocurrido un error en la Base de Datos Intentelo Nuevamente\n Si el problema continua comuniquese con la USTDS', 'Error');
            } else {
                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
            }
            OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/list_capitulos.php?', '');
        }
    };
    page.innerHTML = '';
    ajax.send(null);
}

//*****+*+ new capitulo********+
function CrearEditorCapitulos() {

    editor = CKEDITOR.replace('capitulo_Descripcion');
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

function validate_capitulo() {
    var titulo = document.getElementById('capitulo_title');
    if (titulo.value == "") {
        jAlert("Ingrese el titulo del capitulo", "Dato Requerido");
        titulo.setAttribute("style", "background-color:#EDF0FF");
        titulo.focus();
        return false;
    }
    return true;
}

function new_capitulo() {
    if (validate_capitulo()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var titulo = document.getElementById('capitulo_title').value;
        var activo = 1;
        var descripcion = CKEDITOR.instances['capitulo_Descripcion'].getData();
        var ajax = NuevoAjax();
          var formData = new FormData();
        formData.append('descripcion',descripcion);
        var _values_send =
                'titulo=' + titulo +
                '&inlineCheckbox=' + activo;
        var _URL_ = "mod/adminPlanEmergencia/adminCapitulos/ajax_new_capitulo.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("POST", _URL_ + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {

                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Capitulo añadido con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/list_capitulos.php?', '');
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("El Capitulo ya existe.\n Consulte a la USTDS", "Usuario ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(formData);
        loading.innerHTML = "";
    }
}

//*****+*+ editar y ver capitulo********+

function update_capitulo(id) {
    if (validate_capitulo()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var titulo = document.getElementById('capitulo_title').value;
        var descripcion = CKEDITOR.instances['capitulo_Descripcion'].getData();
        var ajax = NuevoAjax();
          var formData = new FormData();
        formData.append('descripcion',descripcion);        
        var _values_send =
                'id=' + id +
                '&titulo=' + titulo;
        var _URL_ = "mod/adminPlanEmergencia/adminCapitulos/ajax_edit_capitulo.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("POST", _URL_ + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {

                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Capitulo actualizado con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/list_capitulos.php?', '');
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("El Capitulo ya existe.\n Consulte a la USTDS", "Usuario ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(formData);
        loading.innerHTML = "";
    }

}

