var cambios = 0;
function IniciarGuardarCambios(alert) {
    jQuery(".cambios").change(function () {
        if (cambios == 0) {
            cambios = 1;
            jQuery("#divalertaDatosSinGuardar").addClass("panel panel-warning ");
            jQuery("#divalertaDatosSinGuardar").css("position", "fixed");
            jQuery("#divalertaDatosSinGuardar").css("bottom", "0");
             jQuery("#divalertaDatosSinGuardar").css("right", "0");
            jQuery("#divalertaDatosSinGuardar").css("margin-right", "2%");
            jQuery("#divalertaDatosSinGuardar").css("z-index", "1030");
            jQuery("#alertaDatosSinGuardar").append("<p>" + alert + "</p>");
        }
    });
}

function datosGuardados() {
    cambios = 0;
    jQuery("#divalertaDatosSinGuardar").removeClass("panel panel-warning");
    jQuery("#alertaDatosSinGuardar").html("");
}
function cambiarMenu(numero, idCentro, nombreCentro) {
    switch (numero) {
        case 1:
            OpcionMenu('mod/planEmergencia/plan_emergencia_datos_generales.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
            break;
        case 2:
            OpcionMenu('mod/planEmergencia/plan_emergencia_actividades.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
            break;
        case 3:
            OpcionMenu('mod/planEmergencia/plan_emergencia_instalaciones.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
            break;
        case 4:
            OpcionMenu('mod/planEmergencia/plan_emergencia_matriz.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
            break;
    }

}