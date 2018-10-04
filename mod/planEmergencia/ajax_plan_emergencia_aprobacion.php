<?php

include("../login/check.php");
include("../../inc/db/db.php");

$id = $_GET['id'];
$aprobadoPor = $_GET['aprobadoPor'];
$codigoZona = $_GET['codigoZona'];
$sql_a = "CALL update_aprobacion($id,'$aprobadoPor','$codigoZona',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);
echo $res[0]['res'];


