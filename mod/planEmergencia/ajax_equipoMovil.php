<?php

include("../login/check.php");
include("../../inc/db/db.php");
$idPlanEmergencia = $_GET['idPlanEmergencia'];
$lista = json_decode($_POST['lista'], true);


$sql_a = "CALL delete_equipoMovil('$idPlanEmergencia',@res);";
$sql_b = "SELECT @res as res;";
$res = transaccion_verificada($sql_a, $sql_b);

if ($res[0]['res'] == 0) {
    foreach ($lista as $equipo) {
        $sql_a = "CALL insert_equipoMovil($idPlanEmergencia,'" . $equipo['cantidad'] . "','" . $equipo['capacidad'] . "','" . $equipo['tipo'] . "','" . $equipo['descripcion'] . "','" . $equipo['contacto'] . "'"
                . ",'" . $equipo['ubicacion'] . "','" . $equipo['categoria'] . "',@res);";
        $sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
        $res = transaccion_verificada($sql_a, $sql_b);

        if ($res[0]['res'] != 0) {
            break;
        }
    }
}
echo $res[0]['res'];
?>

