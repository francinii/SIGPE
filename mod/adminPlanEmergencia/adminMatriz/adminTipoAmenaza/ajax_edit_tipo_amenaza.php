<?php
/**
 * actualiza  tipo de amenaza en la base
 */
include("../../../login/check.php");
include("../../../../inc/db/db.php");

$id = $_GET['id'];
$nombre= $_GET['nombre'];
$activo = $_GET['activo'];
$fkid = $_GET['fkid'];
$sql_a = "CALL update_tipo_amenaza('$id','$nombre','$activo','$fkid',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);
echo $res[0]['res'];
?>

