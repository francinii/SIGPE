

/**
 * cambia los select normales por seleckpicker
 *  llamado en list_formulario.php
 * @returns {undefined}
 */
var selectAnteriorFormulario = null;
function cargoAdminFormulario() {
    
    jQuery('.selectpicker').selectpicker();
    jQuery(".selectpicker").on("shown.bs.select", function (e, a) {
        selectAnteriorFormulario = e.currentTarget.value;
    });
}

/**
 * cancela el cambio de subcapitulo
 *  llamado en  list_formulario.php
 * @param {elemento html} select que sufrio la accion
 * @returns {undefined} 
 */
function reCargarAdminFormulario(select) {
    select.value = selectAnteriorFormulario;
    selectAnteriorFormulario = null;
    jQuery(select).selectpicker('destroy');
    jQuery(select).selectpicker();
    jQuery(select).on("shown.bs.select", function (e, a) {
        selectAnteriorFormulario = e.currentTarget.value;
    });
}

/**
 * Cambia el formulario de subcapitulo
 *  llamado en  list_formulario.php
 * @param {int} numero de selec que resivio la accion
 * @param {String} titulo del formulario
 * @returns {undefined}  llama al metood guardarOrdenFormulario()
 */

function odenarFomulario(numero, titulo) {
    var select = document.getElementById('select' + numero);
    var opcion = select[select.selectedIndex].text;
    jConfirm("Desea mover el formulario '" + titulo + "' a '" + opcion + "'", "Ordenar", function (r) {
        if (r) {
            guardarOrdenFormulario(numero, select.value, select);
        } else if (selectAnteriorFormulario != null) {
            reCargarAdminFormulario(select);
        }
    });
}

/**
 * Cambia el formulario de subcapitulo, conecta con el servidor
 *  llamado en  list_formulario.php
 * @param {int} id formulario
 * @param {int} subcapitulo  id del subcapitulo
 * @param {elemento html} select  que resivio la accion
 * @returns {undefined}  
 */

function guardarOrdenFormulario(id, subcapitulo, select) {
    var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    //Obtener Valores

    var ajax = NuevoAjax();
    var _values_send =
            'id=' + id +
            '&subcapitulo=' + subcapitulo;
    var _URL_ = "mod/adminPlanEmergencia/adminFormularios/ajax_ordenar_formulario.php?";
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

            } else if (response == 1 || response == 2) {
                jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                reCargarAdminFormulario(select);
            } else if (response == 3) {
                jAlert("el orden ya existe.\n Consulte a la USTDS", "Orden ya existe");
                reCargarAdminFormulario(select);
                ;
            } else {
                jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                reCargarAdminFormulario(select);
            }
        }
    };
    ajax.send(null);
    loading.innerHTML = "";

}

/**
 *  agregar el editor CKEDITOR a un texarea
 *  llamado en   edit_formulario.php
 * @param {Boolean} modo en qe esta la pagina (edicion o no)
 * @returns {undefined} 
 */

function CrearEditorFormulario(modo) {
    //CKFinder.setupCKEditor();
    if (modo) {
        editor = CKEDITOR.replace('DescripcionArriba', {
            filebrowserBrowseUrl: 'lib/ckeditor/ckfinder/ckfinder.html?type=Images',
            filebrowserImageUploadUrl: 'lib/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        });
    } else {
        editor = CKEDITOR.replace('DescripcionArriba',
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

    if (modo) {
        editor = CKEDITOR.replace('DescripcionAbajo', {
            filebrowserBrowseUrl: 'lib/ckeditor/ckfinder/ckfinder.html?type=Images',
            filebrowserImageUploadUrl: 'lib/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        });
    } else {
        editor = CKEDITOR.replace('DescripcionAbajo',
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
 *  valida la infromacion del formulario
 *  llamado en  edit_formulario.php
 * @returns {boolean}  
 */
function validate_formulario() {
    var titulo = document.getElementById('formulario_title');
    if (titulo.value == "") {
        jAlert("Ingrese el titulo del formulario", "Dato Requerido");
        titulo.setAttribute("style", "background-color:#EDF0FF");
        titulo.focus();
        return false;
    }
    return true;
}

/**
 *  actualiza la informacion del formulario, conecta con el servidor
 *  llamado en  edit_formulario.php
 *  @param {int} id del formulario
 *  @returns {undefined} redirecciona a list_formulario.php 
 */

function update_formulario(id) {
    if (validate_formulario()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var titulo = document.getElementById('formulario_title').value;
        var descripcionArriba = CKEDITOR.instances['DescripcionArriba'].getData();
        var descripcionAbajo = CKEDITOR.instances['DescripcionAbajo'].getData();
        
        var ajax = NuevoAjax();
        var formData = new FormData();
        formData.append('descripcionArriba', descripcionArriba);
        formData.append('descripcionAbajo', descripcionAbajo);
        var _values_send =
                'id=' + id +
                '&titulo=' + titulo;
                
        var _URL_ = "mod/adminPlanEmergencia/adminFormularios/ajax_edit_formulario.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("POST", _URL_ + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {

                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Formulario actualizado con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminFormularios/list_formulario.php?', '');
                } else if (response == 1 || response == 2) {
                    jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                } else if (response == 3) {
                    jAlert("El Formulario ya existe.\n Consulte a la USTDS", "Formulario ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }
            }
        };
        ajax.send(formData);
        loading.innerHTML = "";
    }
}