<?php
/**
 * Activa/desactiva una  categorias de amenazas en la base
 */
include("../../../login/check.php");
include("../../../../inc/db/db.php");

$id = $_GET['id'];
$activo = $_GET['activo'];
$sql_a = "CALL active_categoria_amenaza('$id',$activo,@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);

echo $res[0]['res'];
?>