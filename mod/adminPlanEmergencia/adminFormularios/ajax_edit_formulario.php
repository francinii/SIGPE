<?php
/**
 * actualiza   los formulario en la base 
 * */
include("../../login/check.php");
include("../../../inc/db/db.php");

$id = $_GET['id'];
$titulo = $_GET['titulo'];
$descripcionArriba= $_POST['descripcionArriba'];
$descripcionAbajo= $_POST['descripcionAbajo'];


$sql_a = "CALL update_formulario('$id','$titulo','$descripcionArriba','$descripcionAbajo',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);
echo $res[0]['res'];
?>
