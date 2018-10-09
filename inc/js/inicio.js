function OpcionInicio(opc) {
    var selecion = jQuery("#selectInicio").val();
    var centro = jQuery('#selectInicio option:selected').text();

    if (selecion != null) {
        if (opc == 0) {
            OpcionMenu('mod/planEmergencia/plan_emergencia_datos_generales.php?', 'idCentro=' + selecion + '&nombreCentro=' + centro);
        } else if (opc == 1) {
            window.open("mod/planEmergenciaPDF/planEmergenciaPDF.php?idCentro=" + selecion + "&nombreCentro=" + centro, '_blank');
            //   location.href ="mod/planEmergenciaPDF/planEmergenciaPDF.php?idCentro= "+ selecion +" &nombreCentro= "+ centro;
        } else if (opc == 2) {
             OpcionMenu('mod/planEmergencia/plan_emergencia_aprobacion.php?', 'idCentro=' + selecion + '&nombreCentro=' + centro);
       }
    }
}

function nuevaVersionPlan(){
    jConfirm("Al crear una nueva versión, la anterior queda obsoleta, ¿Desea continuar?", "Nueva versión", function (r) {
        if (r) {
            nuevaVersionPlan_accion();
        } 
    });    
}
function nuevaVersionPlan_accion(){
     var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    //Obtener Valores

    var ajax = NuevoAjax();
    var _values_send ='';
    var _URL_ = "mod/ajax_inicio.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {

            //Nada
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                jAlert("Versión creada con exito", "Exito");
            } else if (response == 1 || response == 2) {
                jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");                
            } else if (response == 3) {
                jAlert("el orden ya existe.\n Consulte a la USTDS", "Usuario ya existe");            
            } else {
                jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                
            }
        }
    };
    ajax.send(null);
    loading.innerHTML = "";    
}

function cambiarCentroInicio() {
    var find_key = jQuery("#selectIniciosede").val();
    OpcionMenu('mod/inicio.php?', 'find_key=' + find_key)
}


