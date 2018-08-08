<?php

include("../../../login/check.php");
include("../../../../inc/db/db.php");

$id = $_GET['id'];
$titulo = $_GET['titulo'];
$descripcion= $_GET['descripcion'];

$sql_a = "CALL update_capitulo('$id','$titulo','$descripcion',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);
echo $res[0]['res'];
?>

