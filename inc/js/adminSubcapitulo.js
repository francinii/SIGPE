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

function cambiarSubcapitulos(){
    var find_key = jQuery("#select_capitulos").val();
    OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/list_subcapitulos.php?', 'find_key='+find_key)
}
