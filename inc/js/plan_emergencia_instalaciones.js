/**
 * guarda los datos de las instalaciones  del plan de emergencia , conecta con el servidor
 * llamado en  plan_emergencia_instalaciones.php  
 * @param {int} idCentro id del plan de emergancia
 * @param {int} pasar al sigueinte formulario(1,0)
 * @returns {undefined} 
 */
function guardarDatosInstalaciones(idCentro, pasar) {
    var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    var ajax = NuevoAjax();
    var Densidad = document.getElementById("Densidad").value;
    var area = document.getElementById("area").value;
    var instalaciones = document.getElementById("instalaciones").value;
    var zona = document.getElementById("zona").value;
    var topografica = document.getElementById("topografica").value;
    var terreno = document.getElementById("terreno").value;
    var colindantes = document.getElementById("colindantes").value;
    var tipo = document.getElementById("tipo").value;
    var antiguedad = document.getElementById("antiguedad").value;
    var cimientos = document.getElementById("cimientos").value;
    var estructura = document.getElementById("estructura").value;
    var paredes = document.getElementById("paredes").value;
    var Entrepiso = document.getElementById("Entrepiso").value;
    var techo = document.getElementById("techo").value;    
    var cielo = document.getElementById("cielo").value;
    var pisos = document.getElementById("pisos").value;
    var parqueo = document.getElementById("parqueo").value;
    var aguaPotable = document.getElementById("aguaPotable").value
    var sanitario = document.getElementById("sanitario").value;
    var pluvial = document.getElementById("pluvial").value;
    var electrico = document.getElementById("electrico").value;    
    var telefonico = document.getElementById("telefonico").value;
    var InstalacionesOtros = document.getElementById("InstalacionesOtros").value;
    //Preparacion  llamada AJAX
    var _values_send =
            'idCentro=' + idCentro +
            '&Densidad=' + Densidad +
            '&area=' + area +
            '&instalaciones=' + instalaciones +
            '&zona=' + zona +
            '&topografica=' + topografica +
            '&terreno=' + terreno +
            '&colindantes=' + colindantes +
            '&tipo=' + tipo +
            '&antiguedad=' + antiguedad +
            '&cimientos=' + cimientos +
            '&estructura=' + estructura +
            '&Entrepiso=' + Entrepiso +
            '&paredes=' + paredes +            
            '&techo=' + techo +
            '&cielo=' + cielo +
            '&pisos=' + pisos +
            '&parqueo=' + parqueo +
            '&aguaPotable=' + aguaPotable +            
            '&sanitario=' + sanitario +
            '&pluvial=' + pluvial +
            '&electrico=' + electrico +
            '&telefonico=' + telefonico +
            '&InstalacionesOtros=' + InstalacionesOtros;
           
    var _URL_ = "mod/planEmergencia/ajax_instalaciones.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + "&" + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
            page.innerHTML = cargando;
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                jAlert("Guardado  con exito", "Exito");
                datosGuardados();
                if (pasar) {                    
                    OpcionMenu('mod/planEmergencia/plan_emergencia_matriz.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
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


