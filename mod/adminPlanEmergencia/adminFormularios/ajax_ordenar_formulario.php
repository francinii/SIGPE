<?php
/**
 * ordena   los formulario en la base 
 * */

include("../../login/check.php");
include("../../../inc/db/db.php");

$id = $_GET['id'];
$subcapitulo = $_GET['subcapitulo'];
$sql_a = "CALL ordenar_formulario('$id','$subcapitulo',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);

echo $res[0]['res'];
?>

