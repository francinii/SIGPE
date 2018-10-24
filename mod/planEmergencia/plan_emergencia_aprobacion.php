<?php
/**
 * pagina de aprovacion de plan de emergencia
 */
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
$id = "";
if (isset($_GET['idCentro'])) {
    $id = $_GET['idCentro'];
}
if (isset($_GET['nombreCentro'])) {
    $centro = $_GET['nombreCentro'];
}

if (isset($_GET['version'])) {
    $version = $_GET['version'];
}
$sqlZonas = "(SELECT  id, version,revisadoPor,codigoZonaTrabajo FROM ZonaTrabajo where id =" . $id . ")";
$zonas = seleccion($sqlZonas);
$version = $zonas[0]['version'];
?>
<script>

    var nombreCentro = "<?= $centro ?>";
    document.getElementById("tituloGeneral").innerHTML = "<?= $vocab["Menu_Datos_Plan"] ?>" + nombreCentro;
</script>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["aprobacion_title"] ?></h2>        
    </div>
    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
        <form method="post" action="">
            <div class="form-group">
                <label  for="aprobadoPor"><?= $vocab["aprobado_por"] ?></label>
                <input id="aprobadoPor" name="aprobado_por" class="form-control" type="text" value="<?= (count($zonas) > 0) ? $zonas[0]['revisadoPor'] : "" ?>"/> 
                <p class="help-block"><small><?= $vocab["aprobado_plan_desc"] ?></small></p> 
            </div>  
            <div class="form-group">
                <label  for="codigoZona"><?= $vocab["codigo_plan"] ?></label>
                <input  id="codigoZona" name="codigoZona" class="form-control" type="text" value="<?= (count($zonas) > 0) ? $zonas[0]['codigoZonaTrabajo'] : "" ?>"/> 
                <p class="help-block"><small><?= $vocab["codigo_plan_desc"] ?></small></p> 
            </div>   
            <?php if (check_permiso($mod4, $act3, $user_rol)) { ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-success btn-group-justified"  name="submit" onclick="javascript:update_aprobacion(<?= $id ?>, '<?= $centro ?>',<?= $version ?>);"><i class="fa fa-save fa-inverse"> </i> <?=$vocab["inicio_save_print"] ?>  </a>
                </div>
            <?php } ?> 
            <?php if (check_permiso($mod4, $act6, $user_rol)) { ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-info btn-group-justified"  name="submit" onclick="javascript:visualizarPDF(<?= $id ?>, '<?= $centro ?>');"><i class="fa fa-print fa-eye"> </i> <?= $vocab["aprobacion_visualizar"] ?>  </a>
                </div>
            <?php } ?>              
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
               <br> <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/inicio.php?', '');"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
            </div>
        </form>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="CargandoModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">                
                <h3 class="modal-title" id="exampleModalLabel"><?= $vocab['cargando_plan'] ?></h3>

            </div>
            <div class="modal-body">
                <img  width="100%" src="img/espera.gif" alt="cargando...">
            </div>      
        </div>
    </div>
</div>