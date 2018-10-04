function cambiarCentroHistorial() {
    var find_key = jQuery("#selectHistorialsede").val();
    OpcionMenu('mod/adminPlanEmergencia/adminHistorial/list_historial.php?', 'find_key=' + find_key)
}

function cambiarHistorial() {
    var find_key = jQuery("#selectHistorialsede").val();
    var find_keyCentro = jQuery("#selectHistorialcentro").val();
    OpcionMenu('mod/adminPlanEmergencia/adminHistorial/list_historial.php?', 'find_key=' + find_key+'&find_keyCentro='+find_keyCentro)
}

 function delete_historial(id, titulo,direccion) {
    jConfirm("Desea eliminar el Historial:" + titulo, "Eliminar Historial", function (r) {
        if (r) {
            delete_historial_action(id,direccion);
        }
    });
}
/// pruebaa
function delete_historial_action(id,direccion) {
    var find_key = jQuery("#selectHistorialsede").val();
    var find_keyCentro = jQuery("#selectHistorialcentro").val();
    var page = document.getElementById('container');
    page.innerHTML = cargando;
    var ajax = NuevoAjax();
     
    
    //Preparacion  llamada AJAX
    var _values_send = 'id=' + id+
                       '&direccion='+direccion;
    var _URL_ = "mod/adminPlanEmergencia/adminHistorial/ajax_del_historial.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + "&" + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
            page.innerHTML = cargando;
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                jAlert('El historial  se a eliminado correctamente!', 'Exito');

            } else if (response == 1 || response == 2) {
                jAlert('Ha ocurrido un error en la Base de Datos Intentelo Nuevamente\n Si el problema continua comuniquese con la USTDS', 'Error');
            } else {
                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
            }
           OpcionMenu('mod/adminPlanEmergencia/adminHistorial/list_historial.php?', 'find_key=' + find_key+'&find_keyCentro='+find_keyCentro);
        }
    };
    page.innerHTML = '';
    ajax.send(null);
}

function imprimierVersion(nombre){
    window.open('mod/versionesPDF/'+nombre, '_blank');
}