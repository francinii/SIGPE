<?php
include("../../../login/check.php");
include("../../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
?>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["categoria_amenaza_title"] ?></h2>
        <p><?= $vocab["list_categoria_amenaza_descripcion"] ?></p>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-8 col-xs-12">
        <form method="post" action="">
            <div class="form-group">
                <label  for="id_user"><?= $vocab["nombre_categoria_amenaza"] ?> </label>
                <input id="id_user" name="id_user" class="form-control" type="text" placeholder="<?= $vocab["nombre_categoria_amenaza"] ?>" onchange="javascrip:onchange_cedula();" onblur="javascrip:onchange_cedula();" /> 
                <p class="help-block"><small><?= $vocab["nombre_desc_categoria_amenaza"] ?></small></p> 
            </div>
            <div class="form-group">
                <label  for="id_user"><?= $vocab["nombre_categoria_amenaza"] ?> </label>
                <select class="form-control">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </select>
            </div>
            <div class="form-group">
                <label for="type-radio"><?= $vocab["list_categoria_amenaza_isActivo"] ?> </label>                    
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
                <p class="help-block"><small><?= $vocab["desc_categoria_isActivo"] ?></small></p> 
            </div>  
            <a class="btn btn-success" name="submit" onclick="new_user(1);"><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?>  <?= $vocab["categoria_amenaza_title"] ?>  </a>
        </form>

    </div>
</div>
