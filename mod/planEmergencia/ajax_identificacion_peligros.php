<?php

include("../login/check.php");
include("../../inc/db/db.php");
$idPlanEmergencia = $_GET['idPlanEmergencia'];
$lista = json_decode($_GET['lista'], true);


foreach ($lista as $res) {
    $sql_a = "CALL insert_identificacion_peligro($idPlanEmergencia,'$res[0]','$res[1]','$res[2]','$res[3]', '$res[4]', '$res[5]', '$res[6]', '$res[7]', @res);";
    $sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
    $res = transaccion_verificada($sql_a, $sql_b);

    if($res[0]['res']!=0){
        break;
    }
}
  echo $res[0]['res'];
?>

