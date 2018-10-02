<?php

include("../login/check.php");
include("../../inc/db/db.php");
$idCentro = $_GET['idCentro'];
$actividad = $_GET['actividad'];
$direccion = $_GET['direccion'];
$conctacto = $_GET['conctacto_general'];
$telefono = $_GET['telefono'];
$fax = $_GET['fax'];
$email = $_GET['email'];
$NFPA = $_GET['NFPA'];
$uso = $_GET['uso'];
$horarios = $_GET['horarios'];
$seguridad = $_GET['seguridad'];
$servicio = $_GET['servicio'];
$administracion = $_GET['administracion'];
$academico = $_GET['academico'];
$estudiantil = $_GET['estudiantil'];

$sql_a = "CALL update_datos_generales($idCentro,'$actividad','$direccion','$conctacto','$telefono','$fax','$email','$NFPA','$uso','$horarios'"
        . ",'$seguridad','$servicio','$administracion','$academico','$estudiantil',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);

echo $res[0]['res'];
?>
