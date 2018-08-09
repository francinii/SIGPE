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

