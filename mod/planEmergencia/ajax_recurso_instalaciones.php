<?php
/*** guarda los datos de la tabla recursos instalaciones de inventario en la base */
include("../login/check.php");
include("../../inc/db/db.php");
$idPlanEmergencia = $_GET['idPlanEmergencia'];
$lista = json_decode($_POST['lista'], true);


$sql_a = "CALL delete_RecursoInstalaciones('$idPlanEmergencia',@res);";
$sql_b = "SELECT @res as res;";
$res = transaccion_verificada($sql_a, $sql_b);

if ($res[0]['res'] == 0) {
    foreach ($lista as $recurso) {
        $sql_a = "CALL insert_RecursoInstalaciones($idPlanEmergencia,'" . $recurso['tipo'] . "','" . $recurso['cantidad'] . "','" . $recurso['tamano'] . "','" . $recurso['distribucion'] . "','" . $recurso['contacto'] ."','" . $recurso['ubicacion'] ."',@res);";
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
