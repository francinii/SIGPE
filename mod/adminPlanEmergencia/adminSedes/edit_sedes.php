<?php
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

$view_mode = $_GET['view_mode'];
$id = $_GET['id'];
$sql = "SELECT  id, nombreSede,descripcion,isActivo FROM Sede  WHERE id =" . $id;
$res = seleccion($sql);
?>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["sede_title"] ?></h2>        
    </div>
    <div class="col-lg-5 col-md-5 col-sm-8 col-xs-12">
        <form method="post" action="">            
            <div class="form-group">
                <label  for="sede_title"><?= $vocab["sede_title"] ?></label>
                <input <?= ($view_mode == 0) ? "readonly" : ""; ?> id="nombre" name="sede_title" class="form-control" type="text" value="<?= $res[0]["nombreSede"] ?>" /> 
                <p class="help-block"><small><?= $vocab["sede_title_Desc"] ?></small></p> 
            </div>
            <div class="form-group">
                <label  for="descripcion"><?= $vocab["symbol_desc"] ?> </label>                
                <textarea <?= ($view_mode == 0) ? "readonly" : ""; ?> class="ckeditor form-control" id="descripcion" name="descripcion" ><?= $res[0]["descripcion"] ?></textarea>
                <p class="help-block"><small><?= $vocab["sede_Descripcion"] ?></small></p> 
            </div>   
            <div class="form-group">
                <label for="type-radio"><?= $vocab["sede_activar"] ?> </label>                    
                <div class="radio radio_efect">
                    <label class="radio-inline">
                        <input <?= ($view_mode == 0) ? "disabled" : ""; ?><?= ($res[0]["isActivo"] == 1) ? "checked" : ""; ?> id="inlineCheckbox1" name="inlineCheckbox" type="radio" value="1" checked> <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                        <?= $vocab["isActivo"] ?>  
                    </label>
                    <label class="radio-inline">
                        <input <?= ($view_mode == 0) ? "disabled" : ""; ?> <?= ($res[0]["isActivo"] == 0) ? "checked" : ""; ?> id="inlineCheckbox2" name="inlineCheckbox" type="radio" value="0"> <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span> 
                        <?= $vocab["isInactivo"] ?> 
                    </label>
                </div>  
                <p class="help-block"><small><?= $vocab["desc_sede_isActivo"] ?></small></p> 
            </div>
            <?php
            if ($view_mode == 1) {
                if (check_permiso($mod1, $act4, $user_rol)) {
                    ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a <?= ($view_mode == 0) ? "readonly" : ""; ?> class="btn btn-success btn-group-justified"  name="submit" onclick="javascript:update_sede(<?= $res[0]['id'] ?>);" > 
                            <i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_update"] . " " . $vocab["permits_title"] ?>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminSedes/list_sedes.php?', '');"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminSedes/list_sedes.php?', '');"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
                </div>
            <?php } ?>          
        </form>
    </div>
</div>