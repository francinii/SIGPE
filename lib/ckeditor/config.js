/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
    config.toolbarGroups = [
        {name: 'document', groups: ['mode', 'document', 'doctools']},
        {name: 'clipboard', groups: ['clipboard', 'undo']},
        {name: 'editing', groups: ['find', 'selection', 'spellchecker', 'editing']},
        {name: 'forms', groups: ['forms']},
        '/',
        {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']},
        {name: 'links', groups: ['links']},
        {name: 'insert', groups: ['insert']},
        '/',
        {name: 'styles', groups: ['styles']},
        {name: 'colors', groups: ['colors']},
        {name: 'tools', groups: ['tools']},
        {name: 'others', groups: ['others']},
        {name: 'about', groups: ['about']}
    ];

    config.removeButtons = 'Save,Templates,NewPage,Preview,Print,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CreateDiv,BidiRtl,Language,Link,Unlink,Anchor,Flash,Iframe,ShowBlocks,About,TextColor,BGColor';
     
   //config.filebrowserImageBrowseUrl = 'lib/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';  
   //config.filebrowserImageUploadUrl = 'lib/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
   //config.filebrowserImageBrowseUrl = 'lib/ckeditor/ckfinder/ckfinder.html?type=Images';  
   //config.filebrowserImageUploadUrl = 'inc/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';

    config.entities_latin = false;
};
