<?php
include("../../login/check.php");
include("../../../inc/db/db.php");
$id = $_GET['id'];
$direccion=$_GET['direccion'];
$sql_a = "CALL delete_historial('$id',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);
if($res[0]['res']==0){
    unlink('../../versionesPDF/'.$direccion);
}
echo $res[0]['res'];
?>