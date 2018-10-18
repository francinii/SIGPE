/*
 * Funcion que cambia el valor del criterio al hacer onchange en el selector
 * @param {event} event recibe el evento onchange del selector de probabilidad
 * o de gravedad o de consecuencia
 * @param {int} cod  corresponde al valor que determina si el selector es el selector
 * de probabilidad o el de consecuencia/gravedad: probabilidad (0) o consecuecia/gravedad (1)
 * @returns {undefined} Llama al método calcularTipoAlerta
 */
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

/*
 * Funcion que cambia el criterio al hacer onchange en el selector de valor de probabilidad
 * @param {int} opc recibe el valor del selector de probabilidad
 * @returns {String} retorna el criterio de la probabilidad: BAJA MEDIA o ALTA. En caso
 * de que opc no sea 1,2 o 3 retorna "".
 */
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

/*
 * Funcion que cambia el criterio al hacer onchange en el selector de valor Gravedad
 * o consecuencia.
 * @param {int} opc recibe el valor del selector de de gravedad o consecuena
 * @returns {String} retorna el criterio de la probabilidad: NINGUNA, BAJA, MEDIA o ALTA. En caso
 * de que opc no sea 1,2, 3 o 4 retorna "".
 */
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

/*
 * Funcion que calcula el valor tipo de alerta 
 * @param {event} event recibe el evento onchange del selector de probabilidad
 * o de gravedad o de consecuencia de amenaza
 * @returns {undefined} Llama al método calcularCriterioTipoAlerta
 */
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

/*
 * Funcion que calcula el criterio del tipo de alerta y cambia el color al td de 
 * criterio del tipo de alerta.
 * @param {String} criterioTipoAlerta: corresponde al Elemento (td) Criterio del tipo
 * de alerta.
 * @param {int} valor recibe el valor del Tipo de alerta para el calculo del 
 * criterio del tipo de alerta.
 * @returns {undefined}
 */
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


/*
 * Funcion que crea un vector con los datos de la tabla correspondiente a los
 * colores de la matriz.
 * @returns {Vector} retorna un vector con los criterio de los tipos de alerta 
 * de la matriz
 */
function crearVectorValores() {
    var criterio = [];
    jQuery("td.criterioAlerta").each(function () {
        criterio.push(jQuery(this).text());
    }).get();
    return criterio;
}

/*
 * Funcion que genera un arreglo con todos los registros de la matriz. y envia los
 * datos por ajax
 * @param {String} nombreCentro: corresponde al nombre del centro de trabajo
 * @param {String} idCentro corresponde al id del centro
 * @param {int} indica la pagina a la que sera redirigido.Pueden ser los valores
 * 1 o 2 
 * @param {String} idCentro corresponde al id del centro
 * @param {String} editar estado en que esta la pagina 
 * @returns {Undefined} 
 * de la matriz
 */
function generaVectorMatriz(nombreCentro, idCentro, clave, editar) {
   if(editar){
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
                datosGuardados();
                jAlert("Matriz guardada con exito", "Exito");
                if (clave == 1) {                    
                      OpcionMenu('mod/planEmergencia/plan_emergencia_matriz_grafico.php?', 'nombreCentro='+nombreCentro+'&idCentro='+idCentro+'&criterios=' + JSON.stringify(crearVectorValores()));
                }else if(clave==2){
                     OpcionMenu('mod/planEmergencia/plan_emergencia_inventario.php?', 'idCentro=' + idCentro + '&nombreCentro=' + nombreCentro);
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
   }else{
       OpcionMenu('mod/planEmergencia/plan_emergencia_matriz_grafico.php?', 'nombreCentro='+nombreCentro+'&idCentro='+idCentro+'&criterios=' + JSON.stringify(crearVectorValores()));
   }
}


