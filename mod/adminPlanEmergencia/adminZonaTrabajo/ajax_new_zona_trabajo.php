<?php
include("../../login/check.php");
include("../../../inc/db/db.php");

$nombre = $_GET['nombre'];
$activo = $_GET['inlineCheckbox'];
$descripcion = $_GET['descripcion'];
$sql_a = "CALL insert_zona_trabajo('$nombre','$activo','$descripcion', @res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);
echo $res[0]['res'];
