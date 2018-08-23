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


function crearVectorValores() {
    var criterio = [];
    jQuery("td.criterioAlerta").each(function () {
        criterio.push(jQuery(this).text());
    }).get();
    return criterio;

}
