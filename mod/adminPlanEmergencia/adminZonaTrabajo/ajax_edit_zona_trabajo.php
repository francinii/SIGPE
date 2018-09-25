<?php

include("../../login/check.php");
include("../../../inc/db/db.php");


$id = $_GET['id'];
$nombre = $_GET['nombre'];
$sede = $_GET['sede'];
$activo = $_GET['activo'];
$descripcion = $_GET['descripcion'];

$sql = "SELECT   nombreZonaTrabajo,logo,ubicacion FROM ZonaTrabajo  WHERE id =" . $id;
$res = seleccion($sql);

$rutavieja = "../../planEmergenciaPDF/img/imgPlanes/" . $res[0]['logo'];
$rutaviejaUbicacion = "../../planEmergenciaPDF/img/imgPlanes/" . $res[0]['ubicacion'];

$nombrearchivo = $res[0]['logo'];
if (isset($_FILES['archivo1'])) {
    $nombrearchivo = explode(".", $_FILES['archivo1']['name']);
    $nombrearchivo = str_replace(" ", "", $nombre) . "." . $nombrearchivo[count($nombrearchivo) - 1];
    $ruta = $_FILES['archivo1']['tmp_name'];
    $destino = "../../planEmergenciaPDF/img/imgPlanes/" . $nombrearchivo;
    $sirvio = move_uploaded_file($ruta, $destino);
    if ($res[0]['nombreZonaTrabajo'] != $nombre) {
        $sirvio = unlink($rutavieja);
    }
} else if ($res[0]['nombreZonaTrabajo'] != $nombre) {
    $nombrearchivo = explode(".", $res[0]['logo']);
    $nombrearchivo = str_replace(" ", "", $nombre) . "." . $nombrearchivo[count($nombrearchivo) - 1];
    $destino = "../../planEmergenciaPDF/img/imgPlanes/" . $nombrearchivo;
    $sirvio = copy($rutavieja, $destino);
    $sirvio = unlink($rutavieja);
}


$nombrearchivoUbicacion = $res[0]['ubicacion'];
if (isset($_FILES['archivo2'])) {
    $nombrearchivoUbicacion = explode(".", $_FILES['archivo2']['name']);
    $nombrearchivoUbicacion = str_replace(" ", "", $nombre) . "." . $nombrearchivoUbicacion[count($nombrearchivoUbicacion) - 1];
    $nombrearchivoUbicacion="GEO".$nombrearchivoUbicacion;
    $ruta = $_FILES['archivo2']['tmp_name'];
    $destino = "../../planEmergenciaPDF/img/imgPlanes/" . $nombrearchivoUbicacion;
    $sirvio = move_uploaded_file($ruta, $destino);
    if ($res[0]['nombreZonaTrabajo'] != $nombre) {
        $sirvio = unlink($rutaviejaUbicacion);
    }
} else if ($res[0]['nombreZonaTrabajo'] != $nombre) {
    $nombrearchivoUbicacion = explode(".", $res[0]['ubicacion']);
    $nombrearchivoUbicacion = str_replace(" ", "", $nombre) . "." . $nombrearchivoUbicacion[count($nombrearchivoUbicacion) - 1];
     $nombrearchivoUbicacion="GEO".$nombrearchivoUbicacion;
    $destino = "../../planEmergenciaPDF/img/imgPlanes/" . $nombrearchivoUbicacion;
    $sirvio = copy($rutaviejaUbicacion, $destino);
    $sirvio = unlink($rutaviejaUbicacion);
}

$sql_a = "CALL update_zona_trabajo('$id','$sede','$nombre','$activo','$nombrearchivo','$nombrearchivoUbicacion','$descripcion',@res);";
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


