<?php

include("../../login/check.php");
include("../../../inc/db/db.php");

$id = $_GET['id'];
$nombre = $_GET['nombre'];
$activo = $_GET['activo'];
$descripcion = $_GET['descripcion'];
$sql_a = "CALL update_zona_trabajo('$id','$nombre','$activo','$descripcion',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);
echo $res[0]['res'];


