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
            row.insertBefore(row.prev());
        } else {
            row.insertAfter(row.next());
        }
        if (!row.hasClass("bg-info")) {
            row.addClass("bg-info");
        }
    });

}
function ordenarCapitulos() {


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
        var _values_send =
                'titulo=' + titulo +
                '&inlineCheckbox=' + activo +
                '&descripcion=' + descripcion;
        var _URL_ = "mod/adminPlanEmergencia/adminCapitulos/ajax_new_capitulo.php?";
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
                    OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/list_capitulos.php?', '');
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

//*****+*+ editar y ver capitulo********+

function update_capitulo(){
     if (validate_capitulo()) {
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        //Obtener Valores
        var titulo = document.getElementById('capitulo_title').value;
        var activo = 1;       
        var descripcion = CKEDITOR.instances['capitulo_Descripcion'].getData();
        var ajax = NuevoAjax();
        var _values_send =
                'titulo=' + titulo +
                '&inlineCheckbox=' + activo +
                '&descripcion=' + descripcion;
        var _URL_ = "mod/adminPlanEmergencia/adminCapitulos/ajax_edit_capitulo.php?";
        //alert(_URL_ + _values_send); //DEBUG
        ajax.open("GET", _URL_ + _values_send, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {

                //Nada
            } else if (ajax.readyState == 4) {
                var response = ajax.responseText;
                //alert(response); //DEBUG
                if (response == 0) {
                    jAlert("Origen actualizado con exito", "Exito");
                    OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/list_capitulos.php?', '');
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
