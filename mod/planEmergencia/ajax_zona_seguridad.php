<?php
/**
 * Agrega y actualiza los registros de la Zona de seguridad en la base de datos
 */
include("../login/check.php");
include("../../inc/db/db.php");
$idPlanEmergencia = $_GET['idPlanEmergencia'];
$lista = json_decode($_POST['lista'], true);


$sql_a = "CALL delete_zona_seguridad('$idPlanEmergencia',@res);";
$sql_b = "SELECT @res as res;";
$res = transaccion_verificada($sql_a, $sql_b);



if ($res[0]['res'] == 0) {
    foreach ($lista as $plan) {
        $sql_a = "CALL insert_zona_seguridad($idPlanEmergencia,'" . $plan['nombre'] . "','" . $plan['ubicacion'] . "'," . $plan['capacidad'] . ",'" . $plan['observaciones'] . "','" . $plan['sector'] ."',@res);";
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
