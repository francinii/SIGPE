<?php
// agrega nuevas zonas o centro de trabajo a la base de datos
include("../../login/check.php");
include("../../../inc/db/db.php");

$nombre = $_GET['nombre'];
$sede = $_GET['sede'];
$activo = $_GET['inlineCheckbox'];
$descripcion = $_GET['descripcion'];

$nombrearchivo=null;
if(isset($_FILES['archivo1'])){
$nombrearchivo =explode(".",$_FILES['archivo1']['name']);
$nombrearchivo=str_replace(" ","",$nombre).".".$nombrearchivo[count($nombrearchivo)-1];
$tipo = $_FILES['archivo1']['type'];
$tamanio = $_FILES['archivo1']['size'];
$ruta = $_FILES['archivo1']['tmp_name'];
$destino = "../../planEmergenciaPDF/img/imgPlanes/" . $nombrearchivo;
$sirvio=move_uploaded_file($ruta,$destino);
}

$nombrearchivoUbicacion=null;
if(isset($_FILES['archivo2'])){
$nombrearchivoUbicacion =explode(".",$_FILES['archivo2']['name']);
$nombrearchivoUbicacion=str_replace(" ","",$nombre).".".$nombrearchivoUbicacion[count($nombrearchivoUbicacion)-1];
$nombrearchivoUbicacion="GEO".$nombrearchivoUbicacion;
$tipo = $_FILES['archivo2']['type'];
$tamanio = $_FILES['archivo2']['size'];
$ruta = $_FILES['archivo2']['tmp_name'];
$destino = "../../planEmergenciaPDF/img/imgPlanes/" . $nombrearchivoUbicacion;
$sirvio=move_uploaded_file($ruta,$destino);
}

$sql_a = "CALL insert_zona_trabajo('$nombre','$sede','$activo','$nombrearchivo','$nombrearchivoUbicacion','$descripcion', @res);";
$sql_b = "SELECT @res as res;";
//echo $sql_a.$sql_b;
$res = transaccion_verificada($sql_a, $sql_b);
//echo $res[0]['res'];
$hay_Usuarios = false;

if ($res[0]['res'] != -1 && $res[0]['res'] != -2) {
    $lista = json_decode($_GET['lista'], true);
    foreach ($lista as $id) {
        $hay_Usuarios = true;
        $sql_a = "CALL insert_usuario_zona_trabajo('$id'," . $res[0]['res'] . ",@res);";
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
}else{
    echo $res[0]['res'];
}


