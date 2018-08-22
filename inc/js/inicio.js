function OpcionInicio(){
    var selecion = jQuery("#selectInicio").val();
     var centro  = jQuery('#selectInicio option:selected').text();
    OpcionMenu('mod/planEmergencia/plan_emergencia_datos_generales.php?', 'idCentro='+selecion+'&nombreCentro='+centro);
}


