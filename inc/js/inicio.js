function OpcionInicio(opc) {
    var selecion = jQuery("#selectInicio").val();
    var centro = jQuery('#selectInicio option:selected').text();

    if (selecion != null) {
        if (opc == 0) {
            OpcionMenu('mod/planEmergencia/plan_emergencia_datos_generales.php?', 'idCentro=' + selecion + '&nombreCentro=' + centro);
        } else {
            window.open("mod/planEmergenciaPDF/planEmergenciaPDF.php?idCentro= "+ selecion +" &nombreCentro= "+ centro, '_blank');
         //   location.href ="mod/planEmergenciaPDF/planEmergenciaPDF.php?idCentro= "+ selecion +" &nombreCentro= "+ centro;


        }
    }
}

function cambiarCentroInicio() {
    var find_key = jQuery("#selectIniciosede").val();
    OpcionMenu('mod/inicio.php?', 'find_key=' + find_key)
}


