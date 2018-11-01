<?php
// elimina  zonas o centro de trabajo en la base de datos
include("../../login/check.php");
include("../../../inc/db/db.php");

$id = $_GET['id'];
$sql = "SELECT   logo,ubicacion FROM ZonaTrabajo  WHERE id =".$id;
$res = seleccion($sql);

$rutavieja = "../../planEmergenciaPDF/img/imgPlanes/" . $res[0]['logo'];
$rutaviejaUbicacion = "../../planEmergenciaPDF/img/imgPlanes/" . $res[0]['ubicacion'];

$sirvio=true;
if($res[0]['logo']!=""){  
$sirvio = unlink($rutavieja);
}
if($sirvio && $res[0]['ubicacion']!=""){
$sirvio = unlink($rutaviejaUbicacion);}

if($sirvio){

$sql_a = "CALL delete_zona_trabajo('$id',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);

echo $res[0]['res'];
}else{
    echo 1;
}
?>