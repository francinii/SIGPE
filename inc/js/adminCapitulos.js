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

function flechasCapitulos(){
   
    jQuery(".up,.down").click(function(){
        var row = jQuery(this).parents("tr:first");
        if (jQuery(this).is(".up")) {
            row.insertBefore(row.prev());
        } else {
            row.insertAfter(row.next());
        }
    });

}
function ordenarCapitulos(){
    
    
}



