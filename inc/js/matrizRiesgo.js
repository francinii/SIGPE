function cambiarCriterio(event, cod) {
    var opcion = event.value;
    var hermano = event.parentNode.nextElementSibling;
    if (cod == 0) { 
        hermano.innerHTML = selectorProbabilidad(opcion);
    } else {
        hermano.innerHTML = selectorGravedadConsecuencia(opcion);
    }
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


function calcularTipoAlerta(){
    
}
