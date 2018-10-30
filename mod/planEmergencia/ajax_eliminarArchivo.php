<?php
/* elimina un archivo  con la ruta */
/* para eliminar pdf*/
include("../login/check.php");
include("../../inc/db/db.php");
/* @var $ruta type */
$ruta = $_GET['ruta'];

$gestor = fopen('../versionesPDF/'.$ruta, "r");

//$elminado= unlink('../versionesPDF/'.$ruta);
echo $elminado;

