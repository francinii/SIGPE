<?php
/**
 * actualiza  los origenes de amenaza al sistema 
 */
include("../../../login/check.php");
include("../../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");



$view_mode = $_GET['view_mode'];
$id = $_GET['id'];
$sql = "SELECT  id, descripcion,isActivo FROM OrigenAmenaza  WHERE id =" . $id;
$res = seleccion($sql);
?>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["origen_amenaza_title"] ?></h2>
        <p><?= $vocab["list_origen_amenaza_descripcion"] ?></p>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
        <form method="post" action="">
            <div class="form-group">
                <label  for="nombre"><?= $vocab["nombre_origen_amenaza"] ?> </label>
                <input <?= ($view_mode == 0) ? "readonly" : ""; ?> id="nombre" name="nombre" class="form-control" type="text" value="<?= $res[0]["descripcion"] ?>" /> 
                <p class="help-block"><small><?= $vocab["nombre_desc_origen_amenaza"] ?></small></p> 
            </div>
            <div class="form-group">
                <label for="type-radio"><?= $vocab["list_origen_amenaza_isActivo"] ?> </label>                    
                <div class="radio radio_efect">                  
                        <label class="radio-inline">
                            <input <?= ($view_mode == 0) ? "disabled" : ""; ?><?= ($res[0]["isActivo"] == 1) ? "checked" : ""; ?> id="inlineCheckbox1" name="inlineCheckbox" type="radio" value="1" checked> <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                            <?= $vocab["isActivo"] ?> 
                        </label>                
                        <label class="radio-inline">
                            <input <?= ($view_mode == 0) ? "disabled" : ""; ?><?= ($res[0]["isActivo"] == 0) ? "checked" : ""; ?>  id="inlineCheckbox2" name="inlineCheckbox" type="radio" value="0"> <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                            <?= $vocab["isInactivo"] ?> 
                        </label>       
                </div>  
                <p class="help-block"><small><?= $vocab["desc_origen_isActivo"] ?></small></p> 
            </div>  
           <?php
            if ($view_mode == 1) {
                if (check_permiso($mod4, $act4, $user_rol)) {
                    ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a <?= ($view_mode == 0) ? "readonly" : ""; ?> class="btn btn-success btn-group-justified"  name="submit" onclick="update_origen_amenaza(<?= $res[0]['id'] ?>);"><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_update"] . " " .  $vocab["origen_amenaza_title"] ?>  </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminOrigenAmenaza/list_origen_amenaza.php?', '');"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminOrigenAmenaza/list_origen_amenaza.php?', '');"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
                </div>
            <?php } ?>
        </form>
    </div></div>
