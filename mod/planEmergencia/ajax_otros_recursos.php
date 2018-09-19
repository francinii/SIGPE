<?php

include("../login/check.php");
include("../../inc/db/db.php");
$idPlanEmergencia = $_GET['idPlanEmergencia'];
$lista = json_decode($_POST['lista'], true);
$categoria=$_GET['categoria'];

$sql_a = "CALL delete_InventarioOtros('$idPlanEmergencia','$categoria',@res);";
$sql_b = "SELECT @res as res;";
$res = transaccion_verificada($sql_a, $sql_b);

if ($res[0]['res'] == 0) {
    foreach ($lista as $recurso) {
        $sql_a = "CALL insert_InventarioOtros($idPlanEmergencia,'" . $recurso['cantidad'] . "','" . $recurso['tipo'] . "','" . $recurso['caracteristicas'] . "','" . $recurso['contacto'] . "','" . $recurso['ubicacion'] ."','" . $recurso['categoria'] ."','" . $recurso['observaciones'] ."',@res);";
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
