<?php
/**
 *agrega nueva   categorias de amenazas en la base
 */
include("../../../login/check.php");
include("../../../../inc/db/db.php");

$nombre = $_GET['nombre'];
$activo = $_GET['inlineCheckbox'];
$tipoAmenaza = $_GET['select_tipo'];

$sql_a = "CALL insert_categoria_amenaza('$nombre','$activo','$tipoAmenaza',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);
echo $res[0]['res'];
?>
