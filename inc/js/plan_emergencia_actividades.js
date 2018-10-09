

function guardarDatosActividades(idPlanEmergencia, pasar,count) {
    var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    var ajax = NuevoAjax();
    
    var lista = new Array();
    
    for (var i = 0;i < count; i++) {
    var Poblacion = new Array();
    var tipoPobalcion =  document.getElementById("tipo"+i).innerHTML;
    var descripcionAministrativo = document.getElementById("descripcion"+i).value;
    var totalAdministrativo = document.getElementById("total"+i).value;
    var discapacidadAdministrativo = document.getElementById("discapacidad"+i).value;
       
        Poblacion.push(tipoPobalcion);
        Poblacion.push(descripcionAministrativo);
        Poblacion.push(totalAdministrativo);
        Poblacion.push(discapacidadAdministrativo);
        
       lista.push(Poblacion);  
    }

    //Preparacion  llamada AJAX
    var _values_send =
            'idPlanEmergencia=' + idPlanEmergencia +
            '&lista=' + JSON.stringify(lista); 
          
    var _URL_ = "mod/planEmergencia/ajax_actividades.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + "&" + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
            page.innerHTML = cargando;
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                 datosGuardados();
                jAlert("Guardado  con exito", "Exito");
                if (pasar) {
                    OpcionMenu('mod/planEmergencia/plan_emergencia_instalaciones.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
                }
            } else if (response == 1 || response == 2) {
                jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
            } else if (response == 3) {
                jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
            } else {
                jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
            }

        }
    };
    ajax.send(null);
    loading.innerHTML = "";
}





