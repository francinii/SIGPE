<?php

include("../login/check.php");
include("../../inc/db/db.php");
$idPlanEmergencia = $_GET['idPlanEmergencia'];
$lista = json_decode($_POST['lista'], true);


$sql_a = "CALL delete_rutas_evacuacion('$idPlanEmergencia',@res);";
$sql_b = "SELECT @res as res;";
$res = transaccion_verificada($sql_a, $sql_b);



      
if ($res[0]['res'] == 0) {
    foreach ($lista as $plan) {
        $fecha = ($plan['fecha'] !="")? $plan['fecha']: "1900-01-01";   
        $sql_a = "CALL insert_rutas_evacuacion($idPlanEmergencia,'" . $plan['area'] . "','" . $plan['peligro'] . "','" . $plan['accion'] . "','" . $plan['recomendaciones'] . "','" .$fecha."','" . $plan['responsable'] ."',@res);";
        $sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
        $res = transaccion_verificada($sql_a, $sql_b);

        if ($res[0]['res'] != 0) {
            break;
        }
    }
}
echo $res[0]['res'];
?>
