<?php

include("../../login/check.php");
include("../../../inc/db/db.php");

$lista = json_decode($_GET['lista'], true);
$orden = 1;

foreach ($lista as $id) {
    $sql_a = "CALL ordenar_capitulo('$id','$orden',@res);";
    $sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
    $res = transaccion_verificada($sql_a, $sql_b);
    $orden++;
    if ($res[0]['res'] != 0) {
        break;
    }
}

echo $res[0]['res'];
?>

