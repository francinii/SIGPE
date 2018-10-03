<?php
include("../login/check.php");
include("../../inc/db/db.php");

$idPeligro = $_GET['idPeligro'];
$idPlan = $_GET['idPlan'];
$sql_a = "CALL delete_identificacion_peligros($idPeligro,$idPlan,@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);

echo $res[0]['res'];

