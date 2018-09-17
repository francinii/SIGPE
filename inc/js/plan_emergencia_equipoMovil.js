function agregarFilaEquipo(titulo, combo) {
    var tabla = jQuery("#lista_equipos tbody");
    var id = tabla.children().last().attr('id')
     var id = id.split('-');
    var id = (parseInt(id[1]) + 1);  
    var fila = '<tr id="E-' + id + '">' +
            '<td> <input style = "width: 100%;" type="text"    class="form-control requerido cambios" id="E-tipoEquipo' + id + '"  ></td>' +
            '<td> <input style = "width: 100%;" type="number"   class="form-control requerido cambios" id="E-cantidad' + id + '" value="0" ></td>' +
            '<td> <input style = "width: 100%;" type="number"   class="form-control requerido cambios" id="E-capacidad' + id + '" value="0"></td>' +
            '<td><textarea rows="1" style ="width: 100%;"  type="text"   class="form-control requerido cambios" id="E-caracteristica' + id + '"></textarea></td>' +
            '<td> <input style = "width: 100%;" type="text"     class="form-control requerido cambios" id="E-contacto' + id + '"  ></td>' +
            '<td> <input style = "width: 100%;" type="text"  class="form-control requerido cambios" id="E-ubicacion' + id + '" ></td>' +
            '<td> <select id="E-categoria' + id + '" name="select_subcapitulos" class="form-control cambios"></select></td>' +
            '<td>' +
            '<a class="puntero cambios"  onClick="javascript:eliminarFila(this);">' +
            '<div class="text-center"><i class="fa fa-close  text-danger" title="' + titulo + '"></i></div>' +
            ' </a>' +
            ' </td>';

    '</tr>'
    tabla.append(fila);
    selectEquipos(id, combo, 'nada');
}

function agregarFilaRecursoHumano(titulo) {
    var tabla = jQuery("#lista_recurso_humano tbody");
    var id = tabla.children().last().attr('id');
    var id = id.split('-');
    var id = (parseInt(id[1]) + 1);    
    var fila = '<tr id="H-' + id + '">' +
                            '<td> <input style = "width: 100%;" type="text"    class="form-control requerido cambios" id="H-profesion'+id+'" ></td>'+
                            '<td> <input style = "width: 100%;" type="number"    min="0" class="form-control requerido  cambios" id="H-cantidad'+id+'" value="" ></td>'+
                            '<td> <input style = "width: 100%;" type="text"    class="form-control requerido cambios" id="H-categoria'+id+'"  ></td>'+
                            '<td> <input style = "width: 100%;" type="text"     class="form-control requerido cambios" id="H-localizacion'+id+'" ></td>'+                           
                            '<td> <input style = "width: 100%;" type="text"    class="form-control requerido cambios" id="H-contacto'+id+'"  ></td>'+
                               '<td>' +
            '<a class="puntero cambios"  onClick="javascript:eliminarFila(this);">' +
            '<div class="text-center"><i class="fa fa-close  text-danger" title="' + titulo + '"></i></div>' +
            ' </a>' +
            ' </td>';

    '</tr>'
    tabla.append(fila);
   
}


function eliminarFila(event) {
    jQuery(event).trigger('change');
    var row = jQuery(event).parents("tr:first");
    row.remove();

}


function validate_Inventario(tabla) {
    var filas = jQuery(tabla + " tbody").children();
    for (var i = 0; i < filas.length; i++) {
        var inputs = jQuery(filas[i]).children("td").children(".requerido");
        for (var j = 0; j < inputs.length; j++) {
            var input = inputs[j];
            if (input.value == "") {
                jAlert("Es necesario rellenar los campos", "Dato Requerido");
                jQuery(input).css("background-color", "#EDF0FF");
                input.focus();
                return false;
            }
        }

    }
    return true;
}

function validado(tabla){
     var filas = jQuery(tabla + " tbody").children();
    for (var i = 0; i < filas.length; i++) {
        var inputs = jQuery(filas[i]).children("td").children(".requerido");
        for (var j = 0; j < inputs.length; j++) {
            var input = inputs[j];           
                jQuery(input).css("background-color", "#fff");            
              
        }

    }
  
}

function selectEquipos(id, combo, seleccion) {
    var td = jQuery("#E-categoria" + id);
    var fila = '';
    for (var i = 0; i < 3; i++) {
        fila += '<option';
        if (seleccion === combo[i]) {
            fila += ' selected ';
        }

        fila += ' value="' + combo[i] + '">' + combo[i];


        fila += ' </option>';
    }
    td.append(fila);
}

function guardarequipoMovil(idPlanEmergencia, pasar) {
    if (validate_Inventario("#lista_equipos")) {
         validado("#lista_equipos");
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        var ajax = NuevoAjax();

        var lista = new Array();
        var fila = document.getElementById("lista_equipos").firstElementChild.nextElementSibling;
        fila = fila.firstElementChild;
        var count = 0;
        while (fila != null) {
            lista.push({"tipo": jQuery("#E-tipoEquipo" + count).val(), "cantidad": jQuery("#E-cantidad" + count).val(),
                "capacidad": jQuery("#E-capacidad" + count).val(), "descripcion": jQuery("#E-caracteristica" + count).val(),
                "contacto": jQuery("#E-contacto" + count).val(), "ubicacion": jQuery("#E-ubicacion" + count).val(),
                "categoria": jQuery("#E-categoria" + count).val()});


            count++;
            fila = fila.nextElementSibling;
        }

        //Preparacion  llamada AJAX
        var _values_send =
                'idPlanEmergencia=' + idPlanEmergencia +
                '&lista=' + JSON.stringify(lista);

        var _URL_ = "mod/planEmergencia/ajax_equipoMovil.php?";
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
                    jAlert("el orden ya existe.\n Consulte a la USTDS", "Usuario ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }

            }
        };
        ajax.send(null);
        loading.innerHTML = "";
    }
}

function guardarRecursoHumano(idPlanEmergencia, pasar) {
    if (validate_Inventario("#lista_recurso_humano")) {
         validado("#lista_recurso_humano");
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        var ajax = NuevoAjax();

        var lista = new Array();
        var fila = document.getElementById("lista_recurso_humano").firstElementChild.nextElementSibling;
        fila = fila.firstElementChild;
        var count = 0;
        while (fila != null) {
            lista.push({"profesion": jQuery("#H-profesion" + count).val(), "cantidad": jQuery("#H-cantidad" + count).val(),
                "categoria": jQuery("#H-categoria" + count).val(), "localizacion": jQuery("#H-localizacion" + count).val(),
                "contacto": jQuery("#H-contacto" + count).val()});


            count++;
            fila = fila.nextElementSibling;
        }

        //Preparacion  llamada AJAX
        var _values_send =
                'idPlanEmergencia=' + idPlanEmergencia +
                '&lista=' + JSON.stringify(lista);

        var _URL_ = "mod/planEmergencia/ajax_recursoHumano.php?";
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
                    jAlert("el orden ya existe.\n Consulte a la USTDS", "Usuario ya existe");
                } else {
                    jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                }

            }
        };
        ajax.send(null);
        loading.innerHTML = "";
    }
}
