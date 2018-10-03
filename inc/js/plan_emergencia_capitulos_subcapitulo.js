function CrearEditorCapitulosSubcapitulos(modo, id) {
    //CKFinder.setupCKEditor();
   
        editor = CKEDITOR.replace(id, {
            filebrowserBrowseUrl: 'lib/ckeditor/ckfinder/ckfinder.html?type=Images',
            filebrowserImageUploadUrl: 'lib/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        });
    

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

