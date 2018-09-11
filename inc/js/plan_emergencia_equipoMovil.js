function agregarFilaEquipo(titulo, combo) {
    var tabla = jQuery("#lista_equipos tbody");
    var id = tabla.children().last().attr('id')
    var id = (parseInt(id) + 1);
    var fila = '<tr id="' + id + '">' +
            '<td> <input style = "width: 100%;" type="text"    class="form-control cambios" id="tipoEquipo' + id + '"  ></td>' +
            '<td> <input style = "width: 100%;" type="number"   class="form-control cambios" id="cantidad' + id + '" value="0" ></td>' +
            '<td> <input style = "width: 100%;" type="number"   class="form-control cambios" id="capacidad' + id + '" value="0"></td>' +
            '<td><textarea rows="1" style ="width: 100%;"  type="text"   class="form-control cambios" id="caracteristica' + id + '"></textarea></td>' +
            '<td> <input style = "width: 100%;" type="text"     class="form-control cambios" id="contacto' + id + '"  ></td>' +
            '<td> <input style = "width: 100%;" type="text"  class="form-control cambios" id="ubicacion' + id + '" ></td>' +
            '<td> <select id="categoria' + id + '" name="select_subcapitulos" class="form-control cambios"></select></td>' +
            '<td>' +
            '<a class="puntero"  onClick="javascript:eliminarFilaEquipo(this);">' +
            '<div class="text-center"><i class="fa fa-close  text-danger" title="' + titulo + '"></i></div>' +
            ' </a>' +
            ' </td>';

    '</tr>'
    tabla.append(fila);
    selectEquipos(id, combo, 'nada');
}

function eliminarFilaEquipo(event) {
    var row = jQuery(event).parents("tr:first");
    row.remove();

}

function selectEquipos(id, combo, seleccion) {
    var td = jQuery("#categoria" + id);
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
    var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    var ajax = NuevoAjax();

    var lista = new Array();
    var fila = document.getElementById("lista_equipos").firstElementChild.nextElementSibling;
    fila = fila.firstElementChild;
    var count = 0;
    while (fila != null) {      
        lista.push({"tipo": jQuery("#tipoEquipo" + count).val(), "cantidad": jQuery("#cantidad" + count).val(),
            "capacidad": jQuery("#capacidad" + count).val(), "descripcion": jQuery("#caracteristica" + count).val(),
            "contacto": jQuery("#contacto" + count).val(), "ubicacion": jQuery("#ubicacion" + count).val(),
            "categoria": jQuery("#categoria" + count).val()});

       
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
