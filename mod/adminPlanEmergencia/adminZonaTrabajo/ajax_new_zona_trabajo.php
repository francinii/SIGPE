<?php

include("../../login/check.php");
include("../../../inc/db/db.php");

$nombre = $_GET['nombre'];
$sede = $_GET['sede'];
$activo = $_GET['inlineCheckbox'];
$descripcion = $_GET['descripcion'];
$sql_a = "CALL insert_zona_trabajo('$nombre','$sede','$activo','$descripcion', @res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);
//echo $res[0]['res'];
$hay_Usuarios = false;

if ($res[0]['res'] != -1 && $res[0]['res'] != -2) {
    $lista = json_decode($_GET['lista'], true);
    foreach ($lista as $id) {
        $hay_Usuarios = true;
        $sql_a = "CALL insert_usuario_zona_trabajo('$id'," . $res[0]['res'] . ",@res);";
        // CALL insert_usuario_zona_trabajo('116650288',1,@res);
        $sql_b = "SELECT @res as res;";
        //echo $sql_a.$sql_b;
        $res1 = transaccion_verificada($sql_a, $sql_b);

        if ($res1[0]['res'] != 0) {
            break;
        }
    }

    if ($hay_Usuarios) {
        echo $res1[0]['res'];
    } else {
        echo 0;
    }
}else{
    echo $res[0]['res'];
}


