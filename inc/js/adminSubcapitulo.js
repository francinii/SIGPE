/// list_subcapitulo
function cambiarSubcapitulos() {
    var find_key = jQuery("#select_subcapitulos").val();
    OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/list_subcapitulos.php?', 'find_key=' + find_key)
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
            var texto = row.children(".numeroSubcapitulo").text();
            if (row.prev().length > 0) {
                row.children(".numeroSubcapitulo").text(row.prev().children(".numeroSubcapitulo").text());
                row.prev().children(".numeroSubcapitulo").text(texto);
            }
            row.insertBefore(row.prev());
        } else {
            var texto = row.children(".numeroSubcapitulo").text();
            if (row.next().length > 0) {
                row.children(".numeroSubcapitulo").text(row.next().children(".numeroSubcapitulo").text());
                row.next().children(".numeroSubcapitulo").text(texto);
            }
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
    var select_tipo = jQuery("#select_subcapitulos").val();
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
                OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/list_subcapitulos.php?', 'find_key=' + select_tipo);
            } else if (response == 1 || response == 2) {
                jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
            } else if (response == 3) {
                jAlert("el orden ya existe.\n Consulte a la USTDS", "orden ya existe");
            } else {
                jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
            }
        }
    };
    ajax.send(null);
    loading.innerHTML = "";

}


function active_subcapitulo(id, isActivo, titulo, select) {
    var estado;
    if (isActivo == 1) {
        estado = "desactivar ";
        isActivo = 0;
    } else {
        estado = "activar ";
        isActivo = 1;
    }
    jConfirm("Desea " + estado + " el subcapitulo: " + titulo, "Cambiar estado del subcapitulo", function (r) {
        if (r) {
            active_subcapitulo_action(id, isActivo, select);
        }
    });

}

function active_subcapitulo_action(id, isActivo, select) {
    var page = document.getElementById('container');
    page.innerHTML = cargando;
    var ajax = NuevoAjax();
    //Preparacion  llamada AJAX
    var _values_send = 'id=' + id +
            '&activo=' + isActivo;
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

            } else if (response == 0) {
                jAlert('Ha ocurrido un error en la Base de Datos Intentelo Nuevamente\n Si el problema continua comuniquese con la USTDS', 'Error');
            } else {
                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
            }
            OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/list_subcapitulos.php?', 'find_key=' + select);
        }
    };
    page.innerHTML = '';
    ajax.send(null);
}


/**
 *
 * @param {type} id_origen_amenaza
 * @returns {undefined}
 */function delete_subcapitulo(id, titulo, select) {
    jConfirm("Desea eliminar el subcapitulo:" + titulo, "Eliminar subcapitulo", function (r) {
        if (r) {
            delete_subcapitulo_action(id, select);
        }
    });
}

function delete_subcapitulo_action(id, select) {
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
                jAlert('El subcapitulo  se a eliminado correctamente!', 'Exito');

            } else if (response == 1 || response == 2)  {
                jAlert('Ha ocurrido un error en la Base de Datos Intentelo Nuevamente\n Si el problema continua comuniquese con la USTDS', 'Error');
            }else if ( response == 3){
                jAlert( 'tiene formularios asociados','El subcapítulo no se puede eliminar');
            }
            else {
                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
            }
            OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/list_subcapitulos.php?', 'find_key=' + select);
        }
    };
    page.innerHTML = '';
    ajax.send(null);
}

// crear subcapitulo
function CrearEditorSubcapitulos(modo) {
    if(modo){
    editor = CKEDITOR.replace('Subcapitulo_Descripcion', {
        filebrowserBrowseUrl: 'lib/ckeditor/ckfinder/ckfinder.html?type=Images',
        filebrowserImageUploadUrl: 'lib/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
    } else {
        editor = CKEDITOR.replace('Subcapitulo_Descripcion',
                {
                    on:
                            {
                                instanceReady: function (evt)
                                {
                                    // Hide the editor top bar.
                                    jQuery('.cke_top').css('display','none');;
                                }
                            }
                });
    }
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
        var isdescripcion = 0;
        var descripcionUsuario = "";
        if (document.getElementById('inlineCheckbox1').checked)
            isdescripcion = 1;
        else
            isdescripcion = 0;

        if (isdescripcion) {
            descripcionUsuario = document.getElementById('subcapitulo_Descripcion_usuario').value
        }
        var ajax = NuevoAjax();
        var formData = new FormData();
        formData.append('descripcion', descripcion);
        var _values_send =
                'titulo=' + titulo +
                '&inlineCheckbox=' + activo +
                '&select_tipo=' + select_tipo +
                '&isdescripcion=' + isdescripcion +
                '&descripcionUsuario=' + descripcionUsuario;
        var _URL_ = "mod/adminPlanEmergencia/adminSubcapitulos/ajax_new_subcapitulo.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("POST", _URL_ + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {

                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Subcapitulo añadido con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/list_subcapitulos.php?', 'find_key=' + select_tipo);
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("El Subcapitulo ya existe.\n Consulte a la USTDS", "Subcapitulo ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(formData);
        loading.innerHTML = "";
    }
}


//**** actualizar subcapitulo****
function update_subcapitulo(id) {
    if (validate_subcapitulo()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var titulo = document.getElementById('subcapitulo_title').value;
        var activo = 1;
        var select_tipo = document.getElementById('subcapitulo_capitulo').value;
        var descripcion = CKEDITOR.instances['Subcapitulo_Descripcion'].getData();
        var isdescripcion = 0;
        var descripcionUsuario = "";
        if (document.getElementById('inlineCheckbox1').checked)
            isdescripcion = 1;
        else
            isdescripcion = 0;

        if (isdescripcion) {
            descripcionUsuario = document.getElementById('subcapitulo_Descripcion_usuario').value
        }

        var ajax = NuevoAjax();
        var formData = new FormData();
        formData.append('descripcion', descripcion);

        var _values_send =
                'id=' + id +
                '&titulo=' + titulo +
                '&select_tipo=' + select_tipo +
                '&isdescripcion=' + isdescripcion +
                '&descripcionUsuario=' + descripcionUsuario;
        var _URL_ = "mod/adminPlanEmergencia/adminSubcapitulos/ajax_edit_subcapitulo.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("POST", _URL_ + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {

                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Subcapitulo añadido con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/list_subcapitulos.php?', 'find_key=' + select_tipo);
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("El Subcapitulo ya existe.\n Consulte a la USTDS", "Subcapitulo ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(formData);
        loading.innerHTML = "";
    }

}

function activarDescripcionUsuarioSubCapitulo(activar, tutilo, subtitulo) {
    if (activar) {
        var texto = jQuery("#div-subcapitulo_Descripcion_usuario").html();
        if (texto === "") {
            jQuery("#div-subcapitulo_Descripcion_usuario").html('<label  for="subcapitulo_Descripcion_usuario">' + tutilo + '</label>' +
                    '<textarea class="form-control"  id="subcapitulo_Descripcion_usuario" name="subcapitulo_Descripcion_usuario" ></textarea>' +
                    '<p class="help-block"><small>' + subtitulo + '</small></p>')
        }
    } else {
        jQuery("#div-subcapitulo_Descripcion_usuario").html("");
    }
}