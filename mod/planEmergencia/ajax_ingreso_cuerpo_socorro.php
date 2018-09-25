<?php

include("../login/check.php");
include("../../inc/db/db.php");
$idPlanEmergencia=$_GET['idPlanEmergencia'];
$dimensionAreaAcceso = $_GET['dimensionAreaAcceso'];
$radioGiro = $_GET['radioGiro'];
$caseta = $_GET['caseta'];
$plumas = $_GET['plumas'];
$anchoLibre = $_GET['anchoLibre'];


$sql_a = "CALL insert_IngresoCuerpoSocorro($idPlanEmergencia,'$dimensionAreaAcceso','$radioGiro','$caseta','$plumas'"
        . ",'$anchoLibre',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);

echo $res[0]['res'];
?>

