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

function nuevaVersionPlan(){
    jConfirm("Al crear una nueva versión, la anterior queda obsoleta, ¿Desea continuar?", "Nueva versión", function (r) {
        if (r) {
            nuevaVersionPlan_accion();
        } 
    });    
}
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

function cambiarCentroInicio() {
    var find_key = jQuery("#selectIniciosede").val();
    OpcionMenu('mod/inicio.php?', 'find_key=' + find_key)
}

function imprimirPlanVistazo(centro,id){
     var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    var random =  Math.floor(Math.random() * 1001); 
    jQuery('#CargandoModal').modal('show');
    jQuery.ajax({
        data: {"idCentro": id, "nombreCentro": centro,'visualizarpdf':1,'random':random},
        url: 'mod/planEmergenciaPDF/planEmergenciaPDF.php',
        type: "GET",

        success: function (data) {
            //someOtherFunc(data.leader);
//            var response = data;
//            
//            jAlert("Generado corractamente");
//            window.open('mod/versionesPDF/' + response, '_blank');
        },
        error: function (data) {
//            alert("error "+data);

        },
        complete: function(data){
            //alert("completo"+data);
//            jQuery('#CargandoModal').modal('hide');
        ver(id,random,1);
        }
        
    });
    loading.innerHTML = "";   
}
function EliminarPlanVistazo(ruta){
     var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    //Obtener Valores

    var ajax = NuevoAjax();
    var _values_send ='ruta=' + ruta ;
    var _URL_ = "mod/planEmergencia/ajax_eliminarArchivo?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
         //window.open('mod/versionesPDF/' + ruta, '_blank');  
            //Nada
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
             
            if (response == true) {
                jAlert("Generado corractamente");
            } else if (response==false) {
                jAlert("Error en el proceso, intente nuevamente.\n Si persiste informe a la USTDS", "Error");                
            }
               
           
        }
    };
    ajax.
    ajax.send(null);
    loading.innerHTML = "";    
}
function ver(id,version,borrar){
    if(borrar){
        var nombreDoc='planEmergencias' + version+ '.pdf'; 
         
    }else{
          var nombreDoc=id+'-'+version+'.pdf'; 
    }

   jQuery.ajax({
    url:'mod/versionesPDF/' + nombreDoc,
    type:'HEAD',
    error: function()
    {
         setTimeout (  ver(id,version,borrar),100000); 
       
    },
    success: function()
    {
        jQuery('#CargandoModal').modal('hide');
        
    window.open('mod/versionesPDF/' + nombreDoc, '_blank');  
       if(borrar){
       EliminarPlanVistazo(nombreDoc);
       }
            
      
    }
}); 

    
}