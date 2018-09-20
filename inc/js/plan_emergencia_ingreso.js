function agregarFilaIngresos(titulo, combo, alert) {
    var tabla = jQuery("#lista_ingreso tbody");
    var id = tabla.children().last().attr('id')
    if (typeof id == 'undefined') {
        id = 0;
    }else{
        var id=(parseInt(id) + 1); 
    } 
    var fila = '<tr id="' + id + '">' +
            '<td> <input  type="text"    class="form-control requerido cambios" id="tipo' + id + '" ></td>' +
            '<td> <input  type="text"     class="form-control requerido cambios" id="ubicacion' + id + '"></td>' +
            '<td> <input  type="number"  min="0"     class="form-control requerido cambios" id="Distancia' + id + '" value="0" ></td>' +
            '<td> <input  type="number"  min="0"    class="form-control requerido cambios" id="Tiempo' + id + '" value="0"></td>' +
            '<td>' +
            '<a class="puntero cambios"  onClick="javascript:eliminarFilaIngreso(this);">' +
            '<div class="text-center"><i class="fa fa-close  text-danger" title="' + titulo + '"></i></div>' +
            ' </a>' +
            ' </td>';

    '</tr>'
    tabla.append(fila);

    selectEquipos(id, combo, 'nada');
    IniciarGuardarCambios(alert);
    jQuery("#E-tipoEquipo" + id).focus();
}
function eliminarFilaIngreso(event) {
    jQuery(event).trigger('change');
    var row = jQuery(event).parents("tr:first");
    row.remove();

}

function validate_Ingreso(tabla) {
    var filas = jQuery(tabla + " tbody").children();
    for (var i = 0; i < filas.length; i++) {
        var inputs = jQuery(filas[i]).children("td").children(".requerido");
        for (var j = 0; j < inputs.length; j++) {
            var input = inputs[j];
            if (input.value == "") {
                jAlert("El datos debe ser un numero", "Dato incorrecto");
                jQuery(input).css("background-color", "#EDF0FF");
                input.focus();
                return false;
            }
        }

    }
    return true;
}

function validadoIngreso(tabla){
     var filas = jQuery(tabla + " tbody").children();
    for (var i = 0; i < filas.length; i++) {
        var inputs = jQuery(filas[i]).children("td").children(".requerido");
        for (var j = 0; j < inputs.length; j++) {
            var input = inputs[j];           
                jQuery(input).css("background-color", "#fff");            
              
        }

    }
  
}

function guardarIncreso(idPlanEmergencia, pasar) {
     if (validate_Ingreso("#lista_ingreso")) {
         validadoIngreso("#lista_ingreso");
        
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        var ajax = NuevoAjax();

        var lista = new Array();
        var fila = document.getElementById("lista_ingreso").firstElementChild.nextElementSibling;
        fila = fila.firstElementChild;
        var count = 0;
        while (fila != null) {
            var tipo =jQuery("#tipo" + count);
            if(tipo[0].tagName=='INPUT'){
               tipo=tipo[0].value; 
            }else{
               tipo=tipo[0].innerText;  
            }
            
            lista.push({"tipo":tipo, "ubicacion": jQuery("#ubicacion" + count).val(),
                "Distancia": jQuery("#Distancia" + count).val(), "Tiempo": jQuery("#Tiempo" + count).val()});


            count++;
            fila = fila.nextElementSibling;
        }
         var formData = new FormData();
        formData.append('lista',JSON.stringify(lista));
        //Preparacion  llamada AJAX
        var _values_send =
                'idPlanEmergencia=' + idPlanEmergencia;

        var _URL_ = "mod/planEmergencia/ajax_ingreso.php?";
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
                        OpcionMenu('mod/planEmergencia/plan_emergencia_instalaciones.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
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
    
}