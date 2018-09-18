function guardarDatosIdentificacionPeligros(idPlanEmergencia, pasar, count) {
    var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    var ajax = NuevoAjax();

    var lista = new Array();

    for (var i = 0; i < count; i++) {
        var Peligros = new Array();
        var idPeligro = document.getElementById("idPeligro" + i).value;
        var peligro = document.getElementById("peligro" + i).innerHTML;
        var presente = document.getElementById("presente" + i).value;
        var ubicacion = document.getElementById("ubicacion" + i).value;
        var recomendacion = document.getElementById("recomendacion" + i).value;
        var fecha = document.getElementById("fecha" + i).value;
        var responsable = document.getElementById("responsable" + i).value;
        var priorizacion = document.getElementById("priorizacion" + i).value;
        Peligros.push(idPeligro);
        Peligros.push(peligro);
        if(presente == 'SI'){
             Peligros.push(1);
        }else {
             Peligros.push(0);
        }
       
        Peligros.push(ubicacion);
        Peligros.push(recomendacion);
        Peligros.push(fecha);
        Peligros.push(responsable);
        Peligros.push(priorizacion);
        lista.push(Peligros);
    }

    //Preparacion  llamada AJAX
    var _values_send =
            'idPlanEmergencia=' + idPlanEmergencia +
            '&lista=' + JSON.stringify(lista);

    var _URL_ = "mod/planEmergencia/ajax_identificacion_peligros.php?";
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
    ajax.send(null);
    loading.innerHTML = "";
}

function agregarFilaIdentificacionPeligro(titulo) {
    var tabla = jQuery("#lista_identificacion_peligros tbody");
    var id = tabla.children().last().attr('id');
    if(id == "tr36"){
        
    }
    var id = (parseInt(id[1]) + 1);    
    var fila = '<tr id="tr' + id + '">' +
                            '<td><input style = "width: 100%;" type="text"    class="form-control requerido cambios" id="peligro'+id+'" ></td>'
                            '<td> <input style = "width: 100%;" type="text"   class="form-control requerido cambios" id="presente'+id+'" ></td>'+
                            '<td> <input style = "width: 100%;" type="text"   class="form-control requerido  cambios" id="ubicacion'+id+'" value="" ></td>'+
                            '<td> <input style = "width: 100%;" type="text"   class="form-control requerido cambios" id="recomendacion'+id+'"  ></td>'+
                            '<td> <input style = "width: 100%;" type="date"   class="form-control requerido cambios" fecha'+id+'" ></td>'+    
                            '<td> <input style = "width: 100%;" type="text" class="form-control requerido cambios" responsable'+id+'" ></td>'+               
                            '<td> <input style = "width: 100%;" type="text" class="form-control requerido cambios" priorizacion'+id+'" ></td>'+               
                            '<td>' + '<a class="puntero cambios"  onClick="javascript:eliminarFila(this);">' +
            '<div class="text-center"><i class="fa fa-close  text-danger" title="' + titulo + '"></i></div>' +
            ' </a>' +
            ' </td>';

    '</tr>'
    tabla.append(fila);
//        
}


function eliminarFila(event) {
    jQuery(event).trigger('change');
    var row = jQuery(event).parents("tr:first");
    row.remove();

}


