<?php
/**
 * actualiza los  subcapitulos en la  base
 */
include("../../login/check.php");
include("../../../inc/db/db.php");

$id =$_GET['id'];
$titulo = $_GET['titulo'];
$fkcapitulo = $_GET['select_tipo'];// llave foranea del capitulo
$descripcion= $_POST['descripcion'];
$isdescripcion= $_GET['isdescripcion'];
$descripcionUsuario= $_GET['descripcionUsuario'];

$sql_a = "CALL update_subcapitulo('$id','$titulo','$fkcapitulo','$descripcion',$isdescripcion,'$descripcionUsuario',@res);";

$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);
echo $res[0]['res'];
?>

