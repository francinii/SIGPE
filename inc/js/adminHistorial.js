/**
 * cambia los centro de trabajo  en base a la sedes
 *  llamado en  list_historial.php     
 * @returns {undefined} 
 */

function cambiarCentroHistorial() {
    var find_key = jQuery("#selectHistorialsede").val();
    OpcionMenu('mod/adminPlanEmergencia/adminHistorial/list_historial.php?', 'find_key=' + find_key)
}

/**
 * cambia el historial en base al centro de trabajo
 *  llamado en  list_historial.php     
 * @returns {undefined} 
 */
function cambiarHistorial() {
    var find_key = jQuery("#selectHistorialsede").val();
    var find_keyCentro = jQuery("#selectHistorialcentro").val();
    OpcionMenu('mod/adminPlanEmergencia/adminHistorial/list_historial.php?', 'find_key=' + find_key+'&find_keyCentro='+find_keyCentro)
}

/**
 *  confirma la eliminacion de un historial
 *  llamado en  list_historial.php
 * @param {id} id del historial
 * @param {String} titulo  del historial
 * @param {String} direccion  donde esta el historial
 * @returns {undefined} llama al metodo delete_historial_action() o cancela
 */

 function delete_historial(id, titulo,direccion) {
    jConfirm("Desea eliminar el Historial:" + titulo, "Eliminar Historial", function (r) {
        if (r) {
            delete_historial_action(id,direccion);
        }
    });
}
/**
 *   elimina  un historial, conecta con el servidor
 *  llamado en  list_historial.php
 * @param {id} id del historial
 * @param {String} direccion  donde esta el historial
 * @returns {undefined} recarga pagina list_historial.php
 */
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
                jAlert('El plan  se a eliminado correctamente del historial!', 'Exito');

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

/**
 *  Imprime un pdf del historial
 *  llamado en  list_historial.php
 * @param {String} nombre dirrecion   donde esta el historial
 * @returns {undefined} abre un pdf del historial
 */

function imprimierVersion(nombre){
    window.open('mod/versionesPDF/'+nombre, '_blank');
}