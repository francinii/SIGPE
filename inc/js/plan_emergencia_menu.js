var cambios = 0;
function IniciarGuardarCambios() {
    jQuery(".cambios").change(function () {
        cambios = 1;        
    });
}
function MenuPlanEmergencia(numero, idCentro, nombreCentro){
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
function cambiarMenu(numero, idCentro, nombreCentro){  
    if (cambios) {         
    jConfirm("Desea continuar sin guardar los cambios", "cambios sin guardar", function (r) {
        if (r) {
            cambios=0;
           MenuPlanEmergencia(numero, idCentro, nombreCentro)
        }
    });

    } 
    else {
       MenuPlanEmergencia(numero, idCentro, nombreCentro)  
    }
}




