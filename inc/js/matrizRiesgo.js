//Selector que cambia el valor del criterio

function cambiarCriterio(event, cod) {
    var opcion = event.value; //selector
    var hermano = event.parentNode.nextElementSibling; //td hermano al td del selector
    if (cod == 0) {
        hermano.innerHTML = selectorProbabilidad(opcion);
    } else {
        hermano.innerHTML = selectorGravedadConsecuencia(opcion);
    }
    calcularTipoAlerta(event);
}

function selectorProbabilidad(opc) {
    if (opc == 1) {
        return "BAJA";
    } else if (opc == 2) {
        return "MEDIA";
    } else if (opc == 3) {
        return "ALTA";
    }
    return "";
}

function selectorGravedadConsecuencia(opc) {
    if (opc == 1) {
        return "NINGUNA";
    } else if (opc == 2) {
        return "BAJA";
    } else if (opc == 3) {
        return "MEDIA";
    } else if (opc == 4) {
        return "ALTA";
    }
    return "";
}


function obtenerCriterioAlerta() {
    // var tr = JQuery("#matriz_riesgos tbody")
    //var criterioTipoAlerta = tr.lastElementChild;
}

function calcularTipoAlerta(event) {
    var opcion = event.value;
    var tr = event.parentNode.parentNode; //td hermano al td del selector
    var criterioTipoAlerta = tr.lastElementChild; //td criterio de tipo de alerta
    var valorTipoAlerta = criterioTipoAlerta.previousElementSibling;  //td valor de tipo de alerta
    var valorConsecuencia = valorTipoAlerta.previousElementSibling.previousElementSibling;
    var valorGravedad = valorConsecuencia.previousElementSibling.previousElementSibling;
    var valorProbabilidad = valorGravedad.previousElementSibling.previousElementSibling;
    //criterioTipoAlerta    
    var probabilidad = parseInt(valorProbabilidad.firstElementChild.value);
    var gravedad = parseInt(valorGravedad.firstElementChild.value);
    var consecuencia = parseInt(valorConsecuencia.firstElementChild.value);
    valorTipoAlerta.innerHTML = probabilidad * (gravedad + consecuencia);
    calcularCriterioTipoAlerta(criterioTipoAlerta, valorTipoAlerta);
}

function calcularCriterioTipoAlerta(criterioTipoAlerta, valor) {
    var valorTipoAlerta = valor.innerHTML;
    if (valorTipoAlerta <= 3) {
        criterioTipoAlerta.style.backgroundColor = "#828282";
        criterioTipoAlerta.innerHTML = "NINGUNA";
    } else if (valorTipoAlerta > 3 && valorTipoAlerta <= 12) {
        criterioTipoAlerta.style.backgroundColor = "#5cb85c";
        criterioTipoAlerta.innerHTML = "VERDE";
    } else if (valorTipoAlerta > 12 && valorTipoAlerta < 24) {
        criterioTipoAlerta.style.backgroundColor = "#f0ad4e";
        criterioTipoAlerta.innerHTML = "AMARILLA";
    } else if (valorTipoAlerta >= 24) {
        criterioTipoAlerta.style.backgroundColor = "#d9534f";
        criterioTipoAlerta.innerHTML = "ROJA";

    }
}

//Crea un vector con los datos de la tabla correspondiente a los colores de la 
//matriz
function crearVectorValores() {
    var criterio = [];
    jQuery("td.criterioAlerta").each(function () {
        criterio.push(jQuery(this).text());
    }).get();
    return criterio;

}

//Crea un vector con los datos de la tabla correspondiente a los colores de la 
//matriz
function generaVectorMatriz(nombreCentro, idCentro, clave) {
    var matriz = jQuery("#matriz_riesgos tbody tr");
    var arreglo = new Array();
    matriz.each(function () {
        var categoria = jQuery(this).find("td input.idCategoria").val();
        var fuente = jQuery(this).find("td div input.fuente").val();
        var probabilidad = jQuery(this).find("td.criterioProbabilidad option:selected").val();
        var gravedad = jQuery(this).find("td.criterioGravedad option:selected").val();
        var consecuencia = jQuery(this).find("td.criterioConsecuencia option:selected").val();
        arreglo.push({"id": categoria, "fuente": fuente, "probabilidad": probabilidad, "gravedad": gravedad, "consecuencia": consecuencia});
    });
    var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    var ajax = NuevoAjax();
    var _values_send =
            'idCentro=' + idCentro +
            '&nombreCentro=' + nombreCentro +
            '&matriz=' + JSON.stringify(arreglo);
    var _URL_ = "mod/planEmergencia/ajax_plan_emergencia_matriz.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) { //Nada
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                jAlert("Matriz guardada con exito", "Exito");
                if (clave == 0) {                    
                    OpcionMenu('mod/planEmergencia/plan_emergencia_matriz.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
                }else {
                    OpcionMenu('mod/planEmergencia/plan_emergencia_matriz_grafico.php?', 'nombreCentro='+nombreCentro+'&idCentro='+idCentro+'&criterios=' + JSON.stringify(crearVectorValores()));
                }
            } else if (response == 1 || response == 2) {
                jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
            } else {
                jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
            }
        }
    };
    ajax.send(null);
    loading.innerHTML = "";
}


