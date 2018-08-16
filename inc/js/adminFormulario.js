var selectAnteriorFormulario=null;
function cargoAdminFormulario(){
    jQuery('.selectpicker').selectpicker();
    jQuery(".selectpicker").on("shown.bs.select", function (e,a) {
         selectAnteriorFormulario=e.currentTarget.value;
        });
}
function reCargarAdminFormulario(select){
    select.value=selectAnteriorFormulario;
             selectAnteriorFormulario=null;
             jQuery(select).selectpicker('destroy');
             jQuery(select).selectpicker();
              jQuery(select).on("shown.bs.select", function (e,a) {
         selectAnteriorFormulario=e.currentTarget.value;
        });
}
function odenarFomulario(numero,titulo){
    var select= document.getElementById('select'+numero);
    var opcion=select[select.selectedIndex].text;
    jConfirm("Desea mover el formulario '"+titulo+"' a '"+opcion+"'", "Ordenar", function (r) {
        if (r) {
           guardarOrdenFormulario(numero,select.value,select);
        }else if(selectAnteriorFormulario!=null){
             reCargarAdminFormulario(select);
        }
    });    
}

function guardarOrdenFormulario(id,subcapitulo,select){
    var loading = document.getElementById('loading_container');
    loading.innerHTML = cargando_bar;
    //Obtener Valores

    var ajax = NuevoAjax();
    var _values_send =
            'id=' + id +
            '&subcapitulo=' + subcapitulo;
    var _URL_ = "mod/adminPlanEmergencia/adminFormularios/ajax_edit_formulario.php?";
    //alert(_URL_ + _values_send); //DEBUG
    ajax.open("GET", _URL_ + _values_send, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {

            //Nada
        } else if (ajax.readyState == 4) {
            var response = ajax.responseText;
            //alert(response); //DEBUG
            if (response == 0) {
                jAlert("Ordenado  con exito", "Exito");
               
            } else if (response == 1 || response == 2) {
                jAlert("Error en la Base de Datos, intente nuevamente.\n Si persiste informe a la USTDS", "Error");
                reCargarAdminFormulario(select);
            } else if (response == 3) {
                jAlert("el orden ya existe.\n Consulte a la USTDS", "Usuario ya existe");
                reCargarAdminFormulario(select);;
            } else {
                jAlert("Ocurrio un error inesperado.\n Consulte a la USTDS", "Error inesperado");
                 reCargarAdminFormulario(select);
            }
        }
    };
    ajax.send(null);
    loading.innerHTML = "";

}

