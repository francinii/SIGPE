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
                    OpcionMenu('mod/planEmergencia/plan_emergencia_poblacion.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
                } else {
                    OpcionMenu('mod/planEmergencia/plan_emergencia_identificacion_peligros.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
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
    ajax.send(formData);
    loading.innerHTML = "";
}

function agregarFilaIdentificacionPeligro(titulo) {
    var tabla = jQuery("#lista_identificacion_peligros tbody");
    ;
    var id = tabla.children('tr').last().attr('id');
    if (id == "trfinal") {
        id = tabla.children('tr').last().prev().attr('id');
    }
    var cadena = id.slice(2);
    // alert(cadena);
    var id = (parseInt(cadena) + 1);
    var fila = '<tr class = "trInformacion" id="tr' + id + '">' +
            '<input type ="hidden" id ="idPeligro' + id + '" value ="-1">' +
            '<td><textarea class="form-control habilitar requerido cambios" id="peligro' + id + '" ></textarea></td>' +
            '<td> <select id= "presente' + id + '" class = "form-control" onchange="cambioCalcularSiPresente(this)"   >' +
            '<option> SI</option>' +
            '<option> NO</option>' +
            '</select> ' +
            '<td> <input type="text" class="form-control requerido  cambios" id="ubicacion' + id + '" value="" ></td>' +
            '<td> <input type="text" class="form-control requerido cambios" id="recomendacion' + id + '"  ></td>' +
            '<td> <input type="date" class="form-control requerido cambios" id = "fecha' + id + '" value ="1900-01-01"></td>' +
            '<td> <input type="text" class="form-control requerido cambios" id = "responsable' + id + '" ></td>' +
            '<td id ="priorizaciontd' + id + '"> <select class="form-control cambios" id= "priorizacion' + id + '"   onchange="cambiarCalcularPriorizacion2(this,\'priorizaciontd'+id+'\')" >' +
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
    jQuery("#peligro" + id).focus();
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

function calcularPriorizacion2(prioridad, priorizacion) {
    var prorizaciontd = document.getElementById(priorizacion);
    if (prioridad != null) {
        if (prioridad == 1) {
            prorizaciontd.style.backgroundColor = "#d9534f";
        } else if (prioridad == 2) {
            prorizaciontd.style.backgroundColor = "#f0ad4e";

        } else if (prioridad == 3) {
            prorizaciontd.style.backgroundColor = "#5cb85c";
        } else {
            prorizaciontd.style.backgroundColor = "#5cb85c";
        }
    } else {
        prorizaciontd.style.backgroundColor = "#5cb85c";
    }
}




function cambiarCalcularPriorizacion2(event, priorizacion) {
    var prioridad = event.value; //selector
    calcularPriorizacion2(prioridad, priorizacion);
}

function calcularSiPresente() {
    var celda = "";
    var rows = jQuery('#lista_identificacion_peligros tbody').children('tr.trInformacion');
    var i = 0;
    rows.each(function () {
        var input = jQuery(this).find('td .habilitar');
        jQuery(this).find('td .habilitar').each(function () {
            celda = jQuery('#presente' + i).val();

            var valor = jQuery(this);

            if (celda == 'NO') {
                var cambio = jQuery(this).prop('disabled', true);
                //var hijos= cambio.children('td:first-child').prop('disabled', true);
                //   hijos.prop('disabled', true);
            }

        });
        i += 1;
    });


}

function cambioCalcularSiPresente(event) {
    var tr = "";
    var td = "";

    tr = event.parentElement.parentElement;
//       var ubicacion =  tr.firstElementChild.nextElementSibling.nextElementSibling;
//       var recomendacion = ubicacion.nextElementSibling;
//        var fecha = recomendacion.nextElementSibling;
//        var responsable = fecha.nextElementSibling;
//        var priorizacion = responsable.nextElementSibling;
//         var recomendacion = priorizacion.nextElementSibling;
//    if(event.selected == "SI"){        
//        jQuery(ubicacion.firstElementChild).prop('disabled', true);
//    }
    jQuery(tr).find('td .habilitar').each(function () {
        var valor = jQuery(this);
        if (event.options[event.selectedIndex].value == 'NO') {
            jQuery(this).prop('disabled', true);
        } else {
            jQuery(this).prop('disabled', false);
        }

    });

}
