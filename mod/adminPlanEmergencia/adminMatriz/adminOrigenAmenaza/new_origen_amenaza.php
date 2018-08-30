<?php
include("../../../login/check.php");
include("../../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
?>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["origen_amenaza_title"] ?></h2>
        <p><?= $vocab["list_origen_amenaza_descripcion"] ?></p>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-8 col-xs-12">
        <form method="post" action="">
            <div class="form-group">
                <label  for="nombre"><?= $vocab["nombre_origen_amenaza"] ?> </label>
                <input id="nombre" name="nombre" class="form-control" type="text" placeholder="<?= $vocab["nombre_origen_amenaza"] ?>" /> 
                <p class="help-block"><small><?= $vocab["nombre_desc_origen_amenaza"] ?></small></p> 
            </div>
            <div class="form-group">
                <label for="type-radio"><?= $vocab["list_origen_amenaza_isActivo"] ?> </label>                    
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
                <p class="help-block"><small><?= $vocab["desc_origen_isActivo"] ?></small></p> 
            </div>
            <?php if (check_permiso($mod4, $act3, $user_rol)) { ?>
            <a class="btn btn-success" name="submit" onclick="new_origen_amenaza();"><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?>  <?= $vocab["origen_amenaza_title"] ?>  </a>
            <?php } ?>
        </form>
    </div></div>
