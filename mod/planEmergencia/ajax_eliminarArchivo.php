<?php
include("../login/check.php");
include("../../inc/db/db.php");
/* @var $ruta type */
$ruta = $_GET['ruta'];
$elminado= unlink('../versionesPDF/'.$ruta);
echo $elminado;

