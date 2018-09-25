<?php

include("../login/check.php");
include("../../inc/db/db.php");
$idPlanEmergencia = $_GET['idPlanEmergencia'];
$lista = json_decode($_POST['lista'], true);

$sql_a = "CALL delete_rutas_evacuacion('$idPlanEmergencia',@res);";
$sql_b = "SELECT @res as res;";
$res = transaccion_verificada($sql_a, $sql_b);
   //   INSERT INTO `RutaEvacuacion`(`FKidPlanEmergencias`, `nombreArea`, `personaPermanente`, 
   //     `personaFlotante`, `ruta1`, `distancia1`, `tiempo1`, `ruta2`, `distancia2`, `tiempo2`)
if ($res[0]['res'] == 0) {
    foreach ($lista as $plan) {        
        $sql_a = "CALL insert_rutas_evacuacion($idPlanEmergencia,'" . $plan['area'] . "','" . $plan['personasPermanentes'] . "','" . $plan['personasFlotantes'] . "','" . $plan['rutaP'] . "','" . $plan['distanciaP'] . "','" . $plan['tiempoP'] ."','" . $plan['rutaS'] . "','" . $plan['distanciaS'] . "','" . $plan['tiempoS'] ."',@res);";
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
