
function agregarFilaSector(titulo, alert, agregar,descripcion) {
    var tabla = jQuery("#lista_poblacion tbody");
    var id = tabla.children().last().attr('id');
    if (typeof id == 'undefined') {
        id = 0;
    } else {
        var id = id.split('-');
        var id = (parseInt(id[1]) + 1);
    }
    var fila = '<tr class="seccionPoblacion" id="Sec-' + id + '">' +
            '<td  style="align-items:center; background-color:lightblue" colspan="10">' +
            '<input style="width:40%; margin: 0 auto;" type="text"  class="form-control requerido cambios" id="Sector' + id + '" value="'+descripcion+'" ></td>' +
            '<td  style="background-color:lightblue">' +
            '<a class="puntero cambios"  onClick="javascript:eliminarFila(this);">' +
            '<div class="text-center"><i class="fa fa-close  text-danger" title="' + titulo + '"></i></div>' +
            ' </a>' +
            ' </td>' +
            '<td  style="background-color:lightblue">' +
            '<a class="puntero cambios"  onclick="javascript: agregarFilaPoblacion(\'' + titulo + '\',\'' + alert + '\',\'Sec-' + id + '\');">' +
            '<div class="text-center"><i class="fa fa-plus  text-success " title="' + agregar + '"></i></div>' +
            '</a>' +
            '</td>';

    '</tr>'
    tabla.append(fila);
    IniciarGuardarCambios(alert);
    jQuery("#Sector" + id).focus();
}
function agregarFilaPoblacion(titulo, alert, Idselec) {
    var Sector = jQuery("#" + Idselec);
    var tabla = jQuery("#lista_poblacion tbody");
    var hasnext = true;
    var nextsector = Sector.next();
    while (!nextsector.hasClass('seccionPoblacion')) {
        nextsector = nextsector.next();
        if (nextsector.length == 0) {
            hasnext = false;
            break;
        }
    }
    
    var id = tabla.children().last().attr('id');
    if (typeof id == 'undefined') {
        id = 1;
        agregarFilaSector(titulo, alert);
    } else {
        var id = id.split('-');
        id = (parseInt(id[1]) + 1);
    }
    var fila = '<tr id="fil-' + id + '">' +
            '<td> <input  type="text"    class="form-control requerido cambios" id="nombreOficina' + id + '" value="" ></td>' +
            '<td> <input  type="number"    min="0" class="form-control requerido  cambios" id="capacidadPermanente' + id + '" value="0" ></td>' +
            '<td> <input  type="number"   min="0"  class="form-control requerido cambios" id="capacidadTemporal' + id + '" value="0" ></td>' +
            '<td> <input  type="text"     class="form-control requerido cambios" id="representanteComite' + id + '" value="" ></td>' +
            '<td> <input  type="text"    class="form-control requerido cambios" id="representanteBrigadaEfectiva' + id + '" value="" ></td>' +
            '<td> <input  type="text"    class="form-control requerido cambios" id="representantePrimerosAuxilios' + id + '" value="" ></td>' +
            '<td> <input  type="text"     class="form-control requerido  cambios" id="telefonoOficina' + id + '" value="" ></td>' +
            '<td> <input  type="text"    class="form-control requerido cambios" id="contactoEmergencia' + id + '" value="" ></td>' +
            '<td> <input  type="text"    class="form-control requerido cambios" id="telefonoPersonal' + id + '" value="" ></td>' +
            '<td> <input  type="text"    class="form-control requerido cambios" id="correoElectronico' + id + '" value="" ></td>' +
            '<td>' +
            '<a class="puntero cambios"  onClick="javascript:eliminarFilaPoblacion(this);">' +
            '<div class="text-center"><i class="fa fa-close  text-danger" title="' + titulo + '"></i></div>' +
            ' </a>' +
            ' </td>' +
            '<td></td>';

    '</tr>'
    if (hasnext) {
        nextsector.before(fila);
    } else {
        tabla.append(fila);
    }
    IniciarGuardarCambios(alert);
    jQuery("#nombreOficina" + id).focus();
}

function eliminarFilaPoblacion(event) {
    jQuery(event).trigger('change');
    var row = jQuery(event).parents("tr:first");
    row.remove();

}
function validate_InventarioPoblacion(tabla) {
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

function validadoPoblacion(tabla) {
    var filas = jQuery(tabla + " tbody").children();
    for (var i = 0; i < filas.length; i++) {
        var inputs = jQuery(filas[i]).children("td").children(".requerido");
        for (var j = 0; j < inputs.length; j++) {
            var input = inputs[j];
            jQuery(input).css("background-color", "#fff");

        }

    }

}

function guardarPoblacion(idPlanEmergencia, pasar) {
    if (validate_InventarioPoblacion("#lista_poblacion")) {
        validadoPoblacion("#lista_poblacion");
        var loading = document.getElementById('loading_container');
        loading.innerHTML = cargando_bar;
        var ajax = NuevoAjax();
        var id;
        var sectorActual = "";
        var sector;
        var lista = new Array();       
        var body =  jQuery("#lista_poblacion tbody")[0];
        var fila = body.firstElementChild;
        var count = 0;
        while (fila != null) {
            id = fila.id;
            id = id.split('-');
            count=id[1];
            if (id[0] == "Sec") {
                sector = jQuery("#Sector" + count).val();                
                fila = fila.nextElementSibling;
                id = fila.id;
                id = id.split('-');
                count=id[1];
                if (sector != sectorActual) {

                    sectorActual = sector;
                }
            }
            lista.push({"nombreOficina": jQuery("#nombreOficina" + count).val(), "capacidadPermanente": jQuery("#capacidadPermanente" + count).val(),
                "capacidadTemporal": jQuery("#capacidadTemporal" + count).val(), "representanteComite": jQuery("#representanteComite" + count).val(),
                "representanteBrigadaEfectiva": jQuery("#representanteBrigadaEfectiva" + count).val(),
                "representantePrimerosAuxilios": jQuery("#representantePrimerosAuxilios" + count).val(),
                "telefonoOficina": jQuery("#telefonoOficina" + count).val(), "contactoEmergencia": jQuery("#contactoEmergencia" + count).val(),
                "telefonoPersonal": jQuery("#telefonoPersonal" + count).val(), "correoElectronico": jQuery("#correoElectronico" + count).val(),
                "sector": sectorActual});
            fila = fila.nextElementSibling;
        }
        var formData = new FormData();
        formData.append('lista', JSON.stringify(lista));
        //Preparacion  llamada AJAX
        var _values_send =
                'idPlanEmergencia=' + idPlanEmergencia;

        var _URL_ = "mod/planEmergencia/ajax_poblacion.php?";
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