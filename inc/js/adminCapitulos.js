/**
 * agrega la funcion de ordenar capitulos, accion de las flechas
 *  llamado en  list_capitulos.php     
 * @returns {undefined} 
 */
function flechasCapitulos() {
    var rowPreCapitulo = null;
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
/**
 * conforma el orden de los capitulos
 *  llamado en  list_capitulos.php
 * @returns {undefined} llama al metodo guardarOrdenCapitulo() o cancela
 */
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
/**
 * actualiza el orden de los capitulos , conecta con el servidor
 *  llamado en  list_capitulos.php
 * @param {Array} lista en orden de los capitulos
 * @returns {undefined} recarga la pagina a list_capitulos.php
 */
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
                jAlert("el orden ya existe.\n Consulte a la USTDS", "orden ya existe");
            } else {
                jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
            }
        }
    };
    ajax.send(null);
    loading.innerHTML = "";

}

/**
 * confirma la activacion o desactivacion de un capitulo
 *  llamado en  list_capitulos.php
 * @param {id} id del capitulo
 * * @param {id} isActivo estado del capitulo (1,0)
 * * @param {String} titulo del capitulo
 * @returns {undefined} llama al metodo active_capitulo_action() o cancela
 */
function active_capitulo(id, isActivo, titulo) {
    var estado;
    if (isActivo == 1) {
        estado = "desactivar ";
        isActivo = 0;
    } else {
        estado = "activar ";
        isActivo = 1;
    }
    jConfirm("Desea " + estado + " el capitulo: " + titulo, "Cambiar estado del capitulo", function (r) {
        if (r) {
            active_capitulo_action(id, isActivo);
        }
    });

}
/**
 *  la activacion o desactivacion de un capitulo,conecta con el servidor
 *  llamado en  list_capitulos.php
 * @param {id} id del capitulo
 * * @param {id} isActivo estado del capitulo (1,0)
 * @returns {undefined} recarga la pagina a list_capitulos.php
 */
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
 *  confirma la eliminacion de un capitulo
 *  llamado en  list_capitulos.php
 * @param {id} id del capitulo
 * @param {String} titulo  del capitulo 
 * @returns {undefined} llama al metodo delete_capitulo_action() o cancela
 */
function delete_capitulo(id, titulo) {
    jConfirm("Desea eliminar el capitulo:" + titulo, "Eliminar capitulo", function (r) {
        if (r) {
            delete_capitulo_action(id);
        }
    });
}


/**
 *  eliminacion de un capitulo,conecta con el servidor
 *  llamado en  list_capitulos.php
 * @param {id} id del capitulo
 * @returns {undefined} recarga la pagina a list_capitulos.php
 */

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
                jAlert('El capitulo  se a eliminado correctamente!', 'Exito');

            } else if (response == 1 || response == 2) {
                jAlert('Ha ocurrido un error en la Base de Datos Intentelo Nuevamente\n Si el problema continua comuniquese con la USTDS', 'Error');

            } else if (response == 3) {
                jAlert('tiene subcapítulos asociados', 'El capítulo no se puede eliminar');

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
 *  agregar el editor CKEDITOR a un texarea
 *  llamado en  new_capitulos.php y en edit_capitulos.php
 * @param {Boolean} modo en qe esta la pagina (edicion o no)
 * @returns {undefined} 
 */

function CrearEditorCapitulos(modo) {
    //CKFinder.setupCKEditor();
    if (modo) {
        editor = CKEDITOR.replace('capitulo_Descripcion', {
            filebrowserBrowseUrl: 'lib/ckeditor/ckfinder/ckfinder.html?type=Images',
            filebrowserImageUploadUrl: 'lib/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        });
    } else {
        editor = CKEDITOR.replace('capitulo_Descripcion',
                {
                    on:
                            {
                                instanceReady: function (evt)
                                {
                                    // Hide the editor top bar.
                                    jQuery('.cke_top').css('display', 'none');
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

/**
 *  valida la infromacion de los capitulos
 *  llamado en  new_capitulos.php y en edit_capitulos.php
 * @returns {Boolean} 
 */

function validate_capitulo() {
    var titulo = document.getElementById('capitulo_title');
    if (titulo.value == "") {
        jAlert("Ingrese el titulo del formulario", "Dato Requerido");
        titulo.setAttribute("style", "background-color:#EDF0FF");
        titulo.focus();
        return false;
    }
    return true;
}


/**
 *  agrega un nuevo capitulo al sistema, conecta con el servidor
 *  llamado en  new_capitulos.php 
 * @returns {undefined}  redirecciona a list_capitulos.php
 */


function new_capitulo() {
    if (validate_capitulo()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var titulo = document.getElementById('capitulo_title').value;
        var activo = 1;
        var descripcion = CKEDITOR.instances['capitulo_Descripcion'].getData();
        var isdescripcion = 0;
        var descripcionUsuario = "";
        if (document.getElementById('inlineCheckbox1').checked)
            isdescripcion = 1;
        else
            isdescripcion = 0;

        if (isdescripcion) {
            descripcionUsuario = document.getElementById('capitulo_Descripcion_usuario').value
        }

        var ajax = NuevoAjax();
        var formData = new FormData();
        formData.append('descripcion', descripcion);
        var _values_send =
                'titulo=' + titulo +
                '&inlineCheckbox=' + activo +
                '&isdescripcion=' + isdescripcion +
                '&descripcionUsuario=' + descripcionUsuario;
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
                    jAlert("El Capitulo ya existe.\n Consulte a la USTDS", "Capitulo ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(formData);
        loading.innerHTML = "";
    }
}

/**
 *  actualiza un capitulo del sistema, conecta con el servidor
 *  llamado en  edit_capitulos.php
 *  @param {int} id del capitulo ha actualizar 
 * @returns {undefined}  redirecciona a list_capitulos.php
 */

function update_capitulo(id) {
    if (validate_capitulo()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var titulo = document.getElementById('capitulo_title').value;
        var descripcion = CKEDITOR.instances['capitulo_Descripcion'].getData();
        var isdescripcion = 0;
        var descripcionUsuario = "";
        if (document.getElementById('inlineCheckbox1').checked)
            isdescripcion = 1;
        else
            isdescripcion = 0;

        if (isdescripcion) {
            descripcionUsuario = document.getElementById('capitulo_Descripcion_usuario').value
        }
        var ajax = NuevoAjax();
        var formData = new FormData();
        formData.append('descripcion', descripcion);
        var _values_send =
                'id=' + id +
                '&titulo=' + titulo +
                '&isdescripcion=' + isdescripcion +
                '&descripcionUsuario=' + descripcionUsuario;
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

/**
 *  activa o desactia el campo para la descricion de usuario
 *  llamado en  edit_capitulos.php y new__capitulos.php
 *  @param {boolean} activar estado en que esta el campo 
 *  @param {String} titulo del campo  
 *  @param {String} subtitulo del campo 
 * @returns {undefined} 
 */

function activarDescripcionUsuarioCapitulo(activar, titulo, subtitulo) {
    if (activar) {
        var texto = jQuery("#div-capitulo_Descripcion_usuario").html();
        if (texto === "") {
            jQuery("#div-capitulo_Descripcion_usuario").html('<label  for="capitulo_Descripcion">' + titulo + '</label>' +
                    '<textarea class="form-control"  id="capitulo_Descripcion_usuario" name="capitulo_Descripcion_usuario" ></textarea>' +
                    '<p class="help-block"><small>' + subtitulo + '</small></p>')
        }
    } else {
        jQuery("#div-capitulo_Descripcion_usuario").html("");
    }
}
