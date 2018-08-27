<?php

$matriz = JSON_decode($_GET['matriz']);
$idCentro = $_GET['idCentro'];
foreach ($matriz as $fila) {
    $idCategoria = $fila["id"];
    $fuente = $fila["fuente"];
    $probabilidad = $fila["probabilidad"];
    $gravedad = $fila["gravedad"];
    $consecuencia = $fila["consecuencia"];    
    $sql_a = "CALL update_matriz($idCategoria,$idCentro,$fuente','$probabilidad','$gravedad','$consecuencia',@res);";
    $sql_b = "SELECT @res as res;";
    $res = transaccion_verificada($sql_a, $sql_b);
    if ($res[0]['res'] != 0) {
        break;
    }
}

echo $res[0]['res'];
