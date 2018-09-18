<?php

include("../login/check.php");
include("../../inc/db/db.php");
$idPlanEmergencia = $_GET['idPlanEmergencia'];
$lista = json_decode($_GET['lista'], true);


foreach ($lista as $res) {
    //2018-01-01  recibe la fecha como anio mes dia
   // call insert_identificacion_peligro(4,0,'1',2,'3Heredia','4hacer las cosas mejor','2003-05-21','Francini',1,@res);
     $fecha = ($res[5] !="aaaa-mm-dd")? $res[5]: "1900-01-01";
    $sql_a = "CALL insert_identificacion_peligro($idPlanEmergencia,$res[0],'$res[1]',$res[2],'$res[3]', '$res[4]', '$fecha', '$res[6]', $res[7], @res);";
    $sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
    $res = transaccion_verificada($sql_a, $sql_b);

    if($res[0]['res']!=0){
        break;
    }
}
  echo $res[0]['res'];
?>

