<?php

include("../login/check.php");
include("../../inc/db/db.php");

$idCentro = $_GET['idCentro'];
$Densidad = $_GET['Densidad'];
$area = $_GET['area'];
$instalaciones = $_GET['instalaciones'];
$zona = $_GET['zona'];
$topografica = $_GET['topografica'];
$terreno = $_GET['terreno'];
$colindantes = $_GET['colindantes'];
$tipo = $_GET['tipo'];
$antiguedad = $_GET['antiguedad'];
$cimientos = $_GET['cimientos'];
$estructura = $_GET['estructura'];
$paredes = $_GET['paredes'];
$Entrepiso= $_GET['Entrepiso'];
$techo = $_GET['techo'];
$cielo = $_GET['cielo'];
$pisos = $_GET['pisos'];
$parqueo = $_GET['parqueo'];
$aguaPotable = $_GET['aguaPotable'];
$sanitario= $_GET['sanitario'];
$pluvial = $_GET['pluvial'];
$electrico = $_GET['electrico'];
$telefonico = $_GET['pluvial'];
$InstalacionesOtros = $_GET['InstalacionesOtros'];

$sql_a = "CALL update_datos_Instalaciones($idCentro,'$Densidad','$area','$instalaciones','$zona','$topografica','$terreno','$colindantes','$tipo','$antiguedad',"
        . "'$cimientos','$estructura','$Entrepiso','$paredes','$techo','$cielo','$pisos','$parqueo','$aguaPotable','$sanitario',"
        . "'$pluvial','$electrico','$telefonico','$InstalacionesOtros',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);

echo $res[0]['res'];
?>

