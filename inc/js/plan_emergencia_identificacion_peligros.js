function guardarDatosIdentificacionPeligros(idPlanEmergencia, pasar) {
    var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    var filas = jQuery("#lista_identificacion_peligros tbody tr.trInformacion");
    var ajax = NuevoAjax();
    // var idPeligro = document.getElementById("idPeligro" + i).value;
    var lista = new Array();
    var cantFilas = filas.length;
    //  var fila = tabla.first();
    var i = 0;
    while (cantFilas > 0) {
        var Peligros = new Array();
        var idPeligro = document.getElementById("idPeligro" + i).value;
        var elementoPeligro = document.getElementById("peligro" + i);
        //  alert(elementoPeligro.tagName);
        if (elementoPeligro.tagName === 'TD') {
            var peligro = document.getElementById("peligro" + i).innerText;
        } else {
            var peligro = document.getElementById("peligro" + i).value;
        }
        var presente = document.getElementById("presente" + i).value;
        var ubicacion = document.getElementById("ubicacion" + i).value;
        var recomendacion = document.getElementById("recomendacion" + i).value;
        var fecha = document.getElementById("fecha" + i).value;
        var responsable = document.getElementById("responsable" + i).value;
        var priorizacion = document.getElementById("priorizacion" + i).value;
        Peligros.push(idPeligro);
        Peligros.push(peligro);
        if (presente == 'SI') {
            Peligros.push(1);
        } else {
            Peligros.push(0);
        }
        Peligros.push(ubicacion);
        Peligros.push(recomendacion);
        Peligros.push(fecha);
        Peligros.push(responsable);
        Peligros.push(priorizacion);
        lista.push(Peligros);
        i = i + 1;
        cantFilas = cantFilas - 1;
    }

    var formData = new FormData();
    formData.append('lista', JSON.stringify(lista));

    //Preparacion  llamada AJAX
    var _values_send =
            'idPlanEmergencia=' + idPlanEmergencia;

    var _URL_ = "mod/planEmergencia/ajax_identificacion_peligros.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("POST", _URL_ + "&" + _values_send, true);
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
                    OpcionMenu('mod/planEmergencia/plan_emergencia_identificacion_peligros.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
                }else{
                    OpcionMenu('mod/planEmergencia/plan_emergencia_identificacion_peligros.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
                }
            } else if (response == 1 || response == 2) {
                jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
            } else if (response == 3) {
                jAlert("el orden ya existe.\n Consulte a la USTDS", "Usuario ya existe");
            } else {
                jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
            }

        }
    };
    ajax.send(formData);
    loading.innerHTML = "";
}

function agregarFilaIdentificacionPeligro(titulo) {
    var tabla = jQuery("#lista_identificacion_peligros tbody");
    var id = tabla.children().last().attr('id');
    if (id == "trfinal") {
        id = tabla.children().last().prev().attr('id');
    }
    var cadena = id.slice(2);
    // alert(cadena);
    var id = (parseInt(cadena) + 1);
    var fila = '<tr class = "trInformacion" id="tr' + id + '">' +
            '<input type ="hidden" id ="idPeligro' + id + '" value ="-1">' +
            '<td><textarea class="form-control requerido cambios" id="peligro' + id + '" ></textarea></td>' +
            '<td> <select id= "presente' + id + '"  >' +
            '<option> SI</option>' +
            '<option> NO</option>' +
            '</select> ' +
            '<td> <input type="text" class="form-control requerido  cambios" id="ubicacion' + id + '" value="" ></td>' +
            '<td> <input type="text" class="form-control requerido cambios" id="recomendacion' + id + '"  ></td>' +
            '<td> <input type="date" class="form-control requerido cambios" id = "fecha' + id + '" value ="1900-01-01"></td>' +
            '<td> <input type="text" class="form-control requerido cambios" id = "responsable' + id + '" ></td>' +
            '<td> <select id= "priorizacion' + id + '"  >' +
            '<option> 1</option>' +
            '<option> 2</option>' +
            '<option> 3</option>' +
            '</select> ' +
            '<td>' + '<a class="puntero cambios"  onClick="javascript:eliminarFila(this);">' +
            '<div class="text-center"><i class="fa fa-close  text-danger" title="' + titulo + '"></i></div>' +
            '</a>' +
            '</td>';

    '</tr>'
    tabla.append(fila);
//        
}


function eliminarFilaPeligros(event, idPlan) {
    var loading = document.getElementById('loading_container');
    var idPeligro = event.parentNode.parentNode.firstElementChild.value;
    jQuery(event).trigger('change');
    var row = jQuery(event).parents("tr:first");
    var page = document.getElementById('container');
    //page.innerHTML = cargando;
    var ajax = NuevoAjax();
    //Preparacion  llamada AJAX
    var _values_send = 'idPeligro=' + idPeligro +
            '&idPlan=' + idPlan;
    var _URL_ = "mod/planEmergencia/ajax_del_identificacion_peligros.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + "&" + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
           // page.innerHTML = cargando;
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                jAlert('La fila se a eliminado correctamente!', 'Exito');
                //OpcionMenu('mod/planEmergencia/plan_emergencia_identificacion_peligros.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);

                row.remove();

            } else if (response == 1 || response == 2) {
                jAlert('Ha ocurrido un error en la Base de Datos Intentelo Nuevamente\n Si el problema continua comuniquese con la USTDS', 'Error');
            } else {
                jAlert('Ha ocurrido un error inesperado intentelo más tarde!', 'Error');
            }


        }
    };
    
    ajax.send(null);
loading.innerHTML = "";

}


