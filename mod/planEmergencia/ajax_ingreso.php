<?php
/*
 * Guarda los datos del formulario ingreso de curpos de socorro en la base
 */
include("../login/check.php");
include("../../inc/db/db.php");

$idPlanEmergencia = $_GET['idPlanEmergencia'];
$lista = json_decode($_POST['lista'], true);


$sql_a = "CALL delete_CuerposScorro('$idPlanEmergencia',@res);";
$sql_b = "SELECT @res as res;";
$res = transaccion_verificada($sql_a, $sql_b);

if ($res[0]['res'] == 0) {
    foreach ($lista as $recurso) {
        $sql_a = "CALL insert_CuerposScorro($idPlanEmergencia,'" . $recurso['tipo'] . "','" . $recurso['ubicacion'] . "','" . $recurso['Distancia'] . "','" . $recurso['Tiempo'] . "',@res);";
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

