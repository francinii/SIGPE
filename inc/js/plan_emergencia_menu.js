/*
 * Variable gobla que detecta cambios en los datos del formulario
 */
var cambios = new Array();
/**
 * agrega la funcion que detecta los cambios en los datos del formulario
 * activa una notificacion en el sistema
 *  llamado en  todos los formularios del sistema
 * @param {String } alert mensaje de datos sin guardar
 * @returns {undefined}
 */
function IniciarGuardarCambios(alert) {
    jQuery(".cambios").change(function (event) {
        jQuery(event.currentTarget).css("background-color", "#fcf7e0");
        if (cambios.length == 0) {
            jQuery("#divalertaDatosSinGuardar").addClass("panel panel-warning ");
            jQuery("#divalertaDatosSinGuardar").css("position", "fixed");
            jQuery("#divalertaDatosSinGuardar").css("bottom", "0");
            jQuery("#divalertaDatosSinGuardar").css("right", "0");
            jQuery("#divalertaDatosSinGuardar").css("margin-right", "2%");
            jQuery("#divalertaDatosSinGuardar").css("z-index", "1030");
            jQuery("#alertaDatosSinGuardar").append("<p>" + alert + "</p>");
        }
        var formulario = jQuery(event.currentTarget).parents(".formulario");
        if (!cambios.includes(formulario[0].id)) {
            cambios.push(formulario[0].id);
        }
    });
}


/**
 *  desactiva la notificacion de datos si guardar
 *  llamado en  todos los formularios del sistema
 * @returns {undefined}
 */
function datosGuardados(idformulario) {
    var pos=cambios.indexOf(idformulario);
    cambios.splice(pos, 1);
    jQuery("#" + idformulario + " .cambios").css("background-color", "#fff");
    if (cambios.length == 0) {
    jQuery("#divalertaDatosSinGuardar").removeClass("panel panel-warning");
    jQuery("#alertaDatosSinGuardar").html("");
    }
}

/**
 *  Menu del plan de emergencia, cambia entre los planes de emergencia 
 *  los ID de los planes son fijos en la base dependiendo del ID va al php
 *  llamado en  todos los formularios del sistema
 * @returns {undefined} redirreciona la  pagina dependiendo del ID
 */
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
        case 5:
            OpcionMenu('mod/planEmergencia/plan_emergencia_inventario.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
            break;
        case 6:
            OpcionMenu('mod/planEmergencia/plan_emergencia_identificacion_peligros.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
            break;
        case 7:
            OpcionMenu('mod/planEmergencia/plan_emergencia_poblacion.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
            break;
        case 8:
            OpcionMenu('mod/planEmergencia/plan_emergencia_rutas_evacuacion.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
            break;
        case 9:
            OpcionMenu('mod/planEmergencia/plan_emergencia_brigadistas.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
            break;
        case 10:
            OpcionMenu('mod/planEmergencia/plan_emergencia_ingreso.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);

            break;
        case 11:
            OpcionMenu('mod/planEmergencia/plan_emergiancia_puestos_brigada.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
            break;
        case 12:
            OpcionMenu('mod/planEmergencia/plan_emergencia_zona_seguridad.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
            break;
        case 13:
            OpcionMenu('mod/planEmergencia/plan_emergencia_capitulos_subcapitulos.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
            break;

    }

}
