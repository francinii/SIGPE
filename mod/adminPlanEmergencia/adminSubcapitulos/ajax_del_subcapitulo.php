<?php
/**
 * elimina  los  subcapitulos en la  base
 */
include("../../login/check.php");
include("../../../inc/db/db.php");

$id = $_GET['id'];
$sql_a = "CALL delete_subcapitulo('$id',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);

echo $res[0]['res'];
?>

