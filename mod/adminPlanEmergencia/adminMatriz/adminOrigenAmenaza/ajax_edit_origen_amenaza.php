<?php

include("../../../login/check.php");
include("../../../../inc/db/db.php");

$id = $_GET['id'];
$nombre= $_GET['nombre'];
$activo = $_GET['activo'];
$sql_a = "CALL update_origen_amenaza('$id','$nombre','$activo',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);
echo $res[0]['res'];
?>

