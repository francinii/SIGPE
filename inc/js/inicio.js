/**
 * Opciones del inicio para los botones
 *  llamado en  inicio.php
 * @param {int} opc opcion del Inicio selecionada
 * @returns {undefined} redirrige la pagina dependiendo de la opcion
 */
function OpcionInicio(opc) {
    var selecion = jQuery("#selectInicio").val();
    var centro = jQuery('#selectInicio option:selected').text();

    if (selecion != null) {
        if (opc == 0) {
            OpcionMenu('mod/planEmergencia/plan_emergencia_datos_generales.php?', 'idCentro=' + selecion + '&nombreCentro=' + centro);
        } else if (opc == 1) {
            imprimirPlanVistazo(centro,selecion);
            //window.open("mod/planEmergenciaPDF/planEmergenciaPDF.php?idCentro=" + selecion + "&nombreCentro=" + centro, '_blank');
            //   location.href ="mod/planEmergenciaPDF/planEmergenciaPDF.php?idCentro= "+ selecion +" &nombreCentro= "+ centro;
        } else if (opc == 2) {
            
            OpcionMenu('mod/planEmergencia/plan_emergencia_aprobacion.php?', 'idCentro=' + selecion + '&nombreCentro=' + centro);
       }
    }
}

/**
 * COnfirma el inicio de una nueva version
 *  llamado en  inicio.php
 * @returns {undefined}
 */
function nuevaVersionPlan(){
    jConfirm("Al crear una nueva versión, la anterior queda obsoleta, ¿Desea continuar?", "Nueva versión", function (r) {
        if (r) {
            nuevaVersionPlan_accion();
        } 
    });    
}
/**
 *  inicia una nueva version, conecta con el servidor
 *  llamado en  inicio.php
 * @returns {undefined}
 */
function nuevaVersionPlan_accion(){
     var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    //Obtener Valores

    var ajax = NuevoAjax();
    var _values_send ='';
    var _URL_ = "mod/ajax_inicio.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {

            //Nada
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                jAlert("Versión creada con exito", "Exito");
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

/**
 *  cambia el centro en base a la sede
 *  llamado en  inicio.php
 * @returns {undefined}
 */
function cambiarCentroInicio() {
    var find_key = jQuery("#selectIniciosede").val();
    OpcionMenu('mod/inicio.php?', 'find_key=' + find_key)
}

/**
 *  imprime el pdf temporal o para simplemente para visualizar una vez , conecta con servidor
 *  llamado en  inicio.php y plan_emergencia_aprobacion.php
 *  @param {String} centro nombre del centro seleccionado
 *  @param {int} id del centro seleccionado
 * @returns {undefined} abre un pdf
 */
function imprimirPlanVistazo(centro,id){
     var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    var nombreDoc;
     var version =  Math.floor(Math.random() * 1001); 
    jQuery('#CargandoModal').modal('show');
    jQuery.ajax({
        data: {"idCentro": id, "nombreCentro": centro, "random": version, "visualizarpdf": 1},
        url: 'mod/planEmergenciaPDF/planEmergenciaPDF.php',
        type: "GET",

        success: function (data) {
            if (data == 'Generado') {
                 nombreDoc = 'planEmergencias' + version + '.pdf';
                
                window.open('mod/versionesPDF/' + nombreDoc, '_blank');
            }

        },
        error: function (data,error,algomas) {
            alert("error "+error);

        },
        complete: function (data) {
            //alert("completo"+data);
            jQuery('#CargandoModal').modal('hide');
          EliminarPlanVistazo(nombreDoc);
        }

    });
    loading.innerHTML = "";   
}

/**
 *  Elimina el pdf temporar , conecta con el servidor
 *  llamado en  inicio.php y plan_emergencia_aprobacion.php
 *  @param {String} ruta  del pdf a eliminar
 * @returns {undefined} abre un pdf
 */
function EliminarPlanVistazo(ruta){
     var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    //Obtener Valores

    var ajax = NuevoAjax();
    var _values_send ='ruta=' + ruta ;
    var _URL_ = "mod/planEmergencia/ajax_eliminarArchivo.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
       
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
             
            if (response == true) {
                jAlert("Generado corractamente");
            } else if (response==false) {
                jAlert("Error en el proceso, intente nuevamente.\n Si persiste informe a la USTDS", "Error");                
            }
               
           
        }
    };
  
    ajax.send(null);
    loading.innerHTML = "";    
}