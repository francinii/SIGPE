<?php
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
?>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["sede_title"] ?></h2>        
    </div>
    <div class="col-lg-5 col-md-5 col-sm-8 col-xs-12">
        <form method="post" action="">            
            <div class="form-group">
                <label  for="nombre"><?= $vocab["sede_title"] ?></label>
                <input id="nombre" name="sede_title" class="form-control" type="text" value=""/> 
                <p class="help-block"><small><?= $vocab["sede_title_Desc"] ?></small></p> 
            </div>
            <div class="form-group">
                <label  for="descripcion"><?= $vocab["symbol_desc"] ?> </label>                
                <textarea class="ckeditor form-control" id="descripcion" name="descripcion" ></textarea>
                <p class="help-block"><small><?= $vocab["sede_Descripcion"] ?></small></p> 
            </div>   
            <div class="form-group">
                <label for="type-radio"><?= $vocab["sede_activar"] ?> </label>                    
                <div class="radio radio_efect">
                    <label class="radio-inline">
                        <input id="inlineCheckbox1" name="inlineCheckbox" type="radio" value="1" checked> <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                        <?= $vocab["isActivo"] ?>  
                    </label>
                    <label class="radio-inline">
                        <input id="inlineCheckbox2" name="inlineCheckbox" type="radio" value="0"> <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span> 
                        <?= $vocab["isInactivo"] ?> 
                    </label>
                </div> 
                <p class="help-block"><small><?= $vocab["desc_sede_isActivo"] ?></small></p> 
            </div>   
            <?php if (check_permiso($mod4, $act3, $user_rol)) { ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-success btn-group-justified"  name="submit" onclick="new_sede();"><i class="fa fa-save fa-inverse"> </i> <?= $vocab["symbol_save"] . " " . $vocab["sede_title"] ?>  </a>
                </div>
            <?php } ?>                   
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminSedes/list_sedes.php?', '');"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
                </div>
        </form>
    </div>
</div>