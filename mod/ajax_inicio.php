<?php
include("login/check.php");
include("../inc/db/db.php");

$sql_a = "CALL new_version(@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);

echo $res[0]['res'];
?>

