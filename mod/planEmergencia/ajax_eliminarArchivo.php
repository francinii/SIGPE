<?php
/* elimina un archivo  con la ruta */
/* para eliminar pdf*/
include("../login/check.php");
include("../../inc/db/db.php");
/* @var $ruta type */
$ruta = $_GET['ruta'];

$elminado= unlink('../versionesPDF/'.$ruta);
echo $elminado;

