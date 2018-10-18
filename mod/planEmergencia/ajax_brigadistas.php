<?php
/*
 * Guarda los datos del formulario brigadistas en la base
 * 
 */
include("../login/check.php");
include("../../inc/db/db.php");
$idPlanEmergencia = $_GET['idPlanEmergencia'];
$lista = json_decode($_POST['lista'], true);

$sql_a = "CALL delete_brigadistas('$idPlanEmergencia',@res);";
$sql_b = "SELECT @res as res;";
$res = transaccion_verificada($sql_a, $sql_b);
if ($res[0]['res'] == 0) {
    foreach ($lista as $plan) {

        $sql_a = "CALL insert_brigadistas($idPlanEmergencia,'" . $plan['brigadista'] . "','" . $plan['puntoPartida'] . "','" . $plan['zonaEvacuar'] . "'," . $plan['numeroPersonas'] . "," . $plan['distancia'] ."," . $plan['tiempo'] .",@res);";
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
 