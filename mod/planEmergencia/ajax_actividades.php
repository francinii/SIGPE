<?php
/* guarda los datos del formulario tipo de pobalcion actividades de brigada en la base*/
include("../login/check.php");
include("../../inc/db/db.php");
$idPlanEmergencia = $_GET['idPlanEmergencia'];
$lista = json_decode($_GET['lista'], true);



foreach ($lista as $Poblacion) {
    $sql_a = "CALL update_tipo_poblacion($idPlanEmergencia,'$Poblacion[0]','$Poblacion[1]','$Poblacion[2]','$Poblacion[3]',@res);";
    $sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
    $res = transaccion_verificada($sql_a, $sql_b);

    if($res[0]['res']!=0){
        break;
    }
}
  echo $res[0]['res'];
?>

