<?php

include("../../login/check.php");
include("../../../inc/db/db.php");


$titulo = $_GET['titulo'];
$activo = $_GET['inlineCheckbox'];
$fkcapitulo = $_GET['select_tipo'];// llave foranea del capitulo
$descripcion= $_POST['descripcion'];

$sql_a = "CALL insert_subcapitulo('$titulo','$activo','$fkcapitulo','$descripcion',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);
echo $res[0]['res'];
?>
