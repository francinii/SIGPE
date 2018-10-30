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
                
                 window.open('visualizarPDF.php?ruta='+nombreDoc);
                
               // window.open('mod/versionesPDF/' + nombreDoc, '_blank');
            }

        },
        error: function (data,error,algomas) {
            alert("error "+error);

        },
        complete: function (data) {
            //alert("completo"+data);
            jQuery('#CargandoModal').modal('hide');
         
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
      
}

"<br />\n<font size='1'><table class='xdebug-error xe-warning' dir='ltr' border='1' cellspacing='0' cellpadding='1'>\n<tr><th align='left' bgcolor='#f57900' colspan=\"5\"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Warning: fopen(file://C:/wamp64/www/mod/versionesPDF/planEmergencias227.pdf): failed to open stream: No such file or directory in C:\\wamp64\\www\\SIGPE\\lib\\tcpdf\\include\\tcpdf_static.php on line <i>1854</i></th></tr>\n<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>\n<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>\n<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0000</td><td bgcolor='#eeeeec' align='right'>549512</td><td bgcolor='#eeeeec'>{main}( )</td><td title='C:\\wamp64\\www\\SIGPE\\mod\\planEmergenciaPDF\\planEmergenciaPDF.php' bgcolor='#eeeeec'>...\\planEmergenciaPDF.php<b>:</b>0</td></tr>\n<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>4.3388</td><td bgcolor='#eeeeec' align='right'>22233648</td><td bgcolor='#eeeeec'>TCPDF->Output( )</td><td title='C:\\wamp64\\www\\SIGPE\\mod\\planEmergenciaPDF\\planEmergenciaPDF.php' bgcolor='#eeeeec'>...\\planEmergenciaPDF.php<b>:</b>1288</td></tr>\n<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>4.3856</td><td bgcolor='#eeeeec' align='right'>21218480</td><td bgcolor='#eeeeec'>TCPDF_STATIC::fopenLocal( )</td><td title='C:\\wamp64\\www\\SIGPE\\lib\\tcpdf\\tcpdf.php' bgcolor='#eeeeec'>...\\tcpdf.php<b>:</b>7673</td></tr>\n<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>4.3856</td><td bgcolor='#eeeeec' align='right'>21218656</td><td bgcolor='#eeeeec'><a href='http://www.php.net/function.fopen' target='_new'>fopen</a>\n( )</td><td title='C:\\wamp64\\www\\SIGPE\\lib\\tcpdf\\include\\tcpdf_static.php' bgcolor='#eeeeec'>...\\tcpdf_static.php<b>:</b>1854</td></tr>\n</table></font>\n<strong>TCPDF ERROR: </strong>Unable to create output file: C:/wamp64/www/mod/versionesPDF/planEmergencias227.pdf"
