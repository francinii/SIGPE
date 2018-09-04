<?php

include("../../login/check.php");
include("../../../inc/db/db.php");

$id = $_GET['id'];
$nombre = $_GET['nombre'];
$sede = $_GET['sede'];
$activo = $_GET['activo'];
$descripcion = $_GET['descripcion'];
$sql_a = "CALL update_zona_trabajo('$id','$sede','$nombre','$activo','$descripcion',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);

if ($res[0]['res'] == 0) {
    $sql_a = "CALL delete_usuario_zona_trabajo('$id',@res);";
    $sql_b = "SELECT @res as res;";
    $res = transaccion_verificada($sql_a, $sql_b);
}

$hay_Usuarios = false;
if ($res[0]['res'] == 0) {
    $lista = json_decode($_GET['lista'], true);
    foreach ($lista as $id_usuario) {
        $hay_Usuarios = true;
        $sql_a = "CALL insert_usuario_zona_trabajo('$id_usuario','$id',@res);";
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
} else {
    echo $res[0]['res'];
}


