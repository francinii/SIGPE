<?php
include("../login/check.php");
include("../../functions.php");

$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
include("plan_emergencia_menu.php");
/* * *************************************************************************************** */
//Informacion requerida obtenida de la sesion
$ip = $mySessionController->getVar("cds_domain");
$ip .= $mySessionController->getVar("cds_locate");
$page_cant = $mySessionController->getVar("page_cant");

$criterios = $_GET['criterios'];
$criterios = JSON_decode($criterios);


/*
 * Funcion que calcula el porcentaje de amenaza
 * @param {Array} $criterios corresonde a un array con los colores de los 
 * criterios de tipo de alerta
 * @param {Array} $color corresonde a un array con los colores "VERDE", "AMARILLA"
 * "NINGUNA", "ROJA"
 * @returns {} HTML
 */

function cacularPorcentajeAmenaza($color, $criterios) {
    $cantidadAmenazas = count($criterios);
    $totalPorTipoAmenaza = buscar($color, $criterios);
    if ($cantidadAmenazas > 0) {
        return ($totalPorTipoAmenaza / $cantidadAmenazas) * 100;
    }
    return 0;
}

/*
 * Funcion que calcula el total de elementos que tienen un cierto color
 * @param {Array} $criterios corresonde a un array con los colores de los 
 * criterios de tipo de alerta
 * @param {Array} $color corresonde a un array con los colores "VERDE", "AMARILLA"
 * "NINGUNA", "ROJA"
 * @returns {int} regresa el total al contar la cantidad de colores de un mismo tipo
 * (Ej: cuantos "VERDE" hay: 2)
 */

function buscar($color, $criterios) {
    $total = 0;
    foreach ($criterios as $criterio) {
        $total = ($criterio == $color) ? $total + 1 : $total;
    }
    return $total;
}

//$criterios = str_replace('"',"\'",$prueba);
?>
<!--  ****** Titulo ***** -->
<div class="well well-sm">
    <h1><?= $vocab["matriz_title"] ?></h1>
</div>
<div class="dataTables_wrapper form-inline dt-bootstrap">    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div  class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
            <table id="matriz_riesgos" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable text-center" >
                <thead>
                    <tr>
                        <th width="10%"><?= $vocab["tipo_alerta_nombre"] ?></th>
                        <th width="5%"><?= $vocab["tipo_alerta_cantidad"] ?></th>    
                        <th width="5%"><?= $vocab["tipo_alerta_porcentaje"] ?></th>
                              
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $colores = array($vocab["criterio_ninguna"], $vocab["criterio_verde"],
                        $vocab["criterio_amarilla"], $vocab["criterio_roja"]);
                    for ($i = 0; $i < count($colores); $i++) {
                        ?>
                        <tr>
                            <td><?= $colores[$i] ?></td>
    <?php $cantidad[] = buscar($colores[$i], $criterios); ?>
                            <td><?= $cantidad[$i] ?></td>
                            <td><?= cacularPorcentajeAmenaza($colores[$i], $criterios); ?></td>                            
                        </tr>
<?php } ?>
                </tbody>
            </table>
        </div>
        <div  class=" text-center col-lg-6 col-md-6 col-sm-8 col-xs-12">
            <?php
            $prueba = JSON_encode($cantidad);
            $valores = str_replace('"', "'", $prueba);
            $color = JSON_encode($colores);
            $color = str_replace('"', "'", $color);
            ?>
            <img class="img_fix_grap" src="mod/planEmergencia/grafico.php?criterios=<?= $valores ?>&colores=<?= $color ?>&time=<?= time() ?>">
        </div>
        <div class="text-center"><a class="btn btn-warning" name="" onclick="javascript:OpcionMenu('mod/planEmergencia/plan_emergencia_matriz.php?', 'nombreCentro=<?= $nombreCentro ?>&idCentro=<?= $idCentro ?>');"><i class='fa fa-rotate-left fa-inverse'></i> <?= $vocab["symbol_return"] ?></a></div>
    </div>
</div>

