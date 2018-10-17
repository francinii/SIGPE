<?php
/**
 * agrega  los origenes de amenaza en  la base
 */
include("../../../login/check.php");
include("../../../../inc/db/db.php");

$nombre = $_GET['nombre'];
$activo = $_GET['inlineCheckbox'];
$sql_a = "CALL insert_origen_amenaza('$nombre','$activo',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);
echo $res[0]['res'];
?>