function CrearEditorCapitulosSubcapitulos(modo, id) {
    //CKFinder.setupCKEditor();

    editor = CKEDITOR.replace(id, {
        filebrowserBrowseUrl: 'lib/ckeditor/ckfinder/ckfinder.html?type=Images',
        filebrowserImageUploadUrl: 'lib/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
    editor.on('change', function() {
        jQuery('#'+id).trigger('change');}
            );

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

function guardarCapituloUsuario(idPlanEmergencia, idCapitulo, id, pasar) {
    var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    var ajax = NuevoAjax();
    var descripcion = CKEDITOR.instances['capitulo_Descripcion_usuario' + id].getData();
    var formData = new FormData();
    formData.append('descripcion', descripcion);

    //Preparacion  llamada AJAX
    var _values_send =
            'idPlanEmergencia=' + idPlanEmergencia +
            '&idCapitulo=' + idCapitulo;


    var _URL_ = "mod/planEmergencia/ajax_plan_emergencia_capitulos_subcapitulos.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("POST", _URL_ + "&" + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
            page.innerHTML = cargando;
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                datosGuardados();
                jAlert("Guardado  con exito", "Exito");
                if (pasar) {
                    OpcionMenu('mod/planEmergencia/plan_emergencia_instalaciones.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
                }
            } else if (response == 1 || response == 2) {
                jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
            } else if (response == 3) {
                jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
            } else {
                jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
            }

        }
    };
    ajax.send(formData);
    loading.innerHTML = "";

}

function guardarSubCapituloUsuario(idPlanEmergencia, idSubcapitulo, id, pasar) {
    var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    var ajax = NuevoAjax();
    var descripcion = CKEDITOR.instances['subcapitulo_Descripcion_usuario' + id].getData();
    var formData = new FormData();
    formData.append('descripcion', descripcion);

    //Preparacion  llamada AJAX
    var _values_send =
            'idPlanEmergencia=' + idPlanEmergencia +
            '&idSubcapitulo=' + idSubcapitulo;


    var _URL_ = "mod/planEmergencia/ajax_plan_emergencia_capitulos_subcapitulos.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("POST", _URL_ + "&" + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
            page.innerHTML = cargando;
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                datosGuardados();
                jAlert("Guardado  con exito", "Exito");
                if (pasar) {
                    OpcionMenu('mod/planEmergencia/plan_emergencia_instalaciones.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
                }
            } else if (response == 1 || response == 2) {
                jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
            } else if (response == 3) {
                jAlert("el orden ya existe.\n Consulte a la USTDS", "Usuario ya existe");
            } else {
                jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
            }

        }
    };
    ajax.send(formData);
    loading.innerHTML = "";
}

