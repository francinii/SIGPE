<?php
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
$sqlZonas = "(SELECT  id, version, FROM ZonaTrabajo where id =" . $id . ")";
$zonas = seleccion($sqlZonas);
$version = $zonas[0]['version']
?>

<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["sede_title"] ?></h2>        
    </div>
    <div class="col-lg-5 col-md-5 col-sm-8 col-xs-12">
        <form method="post" action="">           
           
            <div class="form-group">
                 <label  for="aprobadoPor"><?= $vocab["aprobado_por"] ?></label>
                 <input id="aprobadoPor" name="aprobado_por" class="form-control" type="text" value=""/> 
                <p class="help-block"><small><?= $vocab["aprobado_plan_desc"] ?></small></p> 
            </div>  
             <div class="form-group">
                  <label  for="codigoZona"><?= $vocab["codigo_plan"] ?></label>
                  <input  id="codigoZona" name="codigoZona" class="form-control" type="text" value=""/> 
                <p class="help-block"><small><?= $vocab["codigo_plan_desc"] ?></small></p> 
            </div>   
            <?php if (check_permiso($mod4, $act3, $user_rol)) { ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-success btn-group-justified"  name="submit" onclick="javascript:update_aprobacion(<?=$id ?>,'<?=$centro?>',<?=$version?>);"><i class="fa fa-save fa-inverse"> </i> <?= $vocab["symbol_save"]  ?>  </a>
                </div>
            <?php } ?> 
            <?php if (check_permiso($mod4, $act6, $user_rol)) { ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-info btn-group-justified"  name="submit" onclick="javascript:OpcionInicio(1);"><i class="fa fa-print fa-inverse"> </i> <?= $vocab["symbol_print"]  ?>  </a>
                </div>
            <?php } ?>  
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/inicio.php?', '');"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
                </div>
        </form>
    </div>
</div>