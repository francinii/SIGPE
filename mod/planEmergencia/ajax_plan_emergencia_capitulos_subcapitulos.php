<?php
/* **** guarda la descripcion del usuario en los capitulos y subcapitulos e la base */
include("../login/check.php");
include("../../inc/db/db.php");

$idPlanEmergencia = $_GET['idPlanEmergencia'];
$descripcion = $_POST['descripcion'];
$idCap_Sub;
$Prodecimeinto;
if (isset($_GET['idCapitulo'])) {
    $idCap_Sub = $_GET['idCapitulo'];
    $Prodecimeinto='insertar_info_usuario_capitulo';
}
else{
  $idCap_Sub = $_GET['idSubcapitulo'];  
  $Prodecimeinto='insertar_info_usuario_subcapitulo';
}


$sql_a = "CALL $Prodecimeinto($idPlanEmergencia,$idCap_Sub,'$descripcion',@res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);

echo $res[0]['res'];
