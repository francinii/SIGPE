<?php
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");


$view_mode = $_GET['view_mode'];
$id_for = $_GET['id_for'];
$sql = "SELECT  `id`,`titulo`, `descripcionArriba`, `descripcionAbajo` "
        . "FROM `formulario` WHERE id =" . $id_for;
$res = seleccion($sql);
?>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["formulario_formulario"] ?></h2>
        <p><?= $vocab["formulario_formulario_desc"] ?></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-11 col-xs-12">
        <form method="post" action="">            
            <div class="form-group">
                <label  for="capitulo_title"><?= $vocab["formulario_titulo"] ?></label>
                <input <?= ($view_mode == 0) ? "disabled" : ""; ?>  id="formulario_title" name="formulario_title" class="form-control" type="text" value="<?= $res[0]['titulo'] ?>"/> 
                <p class="help-block"><small><?= $vocab["formulario_titulo_desc"] ?></small></p> 
            </div>
            <div class="form-group">
                <label  for="DescripcionArriba"><?= $vocab["formulario_descripcion_arriba"] ?> </label>                
                <textarea <?= ($view_mode == 0) ? "disabled" : ""; ?>  class="ckeditor form-control" id="DescripcionArriba" name="DescripcionArriba" ><?= $res[0]['descripcionArriba'] ?></textarea>
                <p class="help-block"><small><?= $vocab["symbol_desc"] ?></small></p> 
            </div>
            <div class="form-group">
                <label  for="DescripcionAbajo"><?= $vocab["formulario_descripcion_abajo"] ?> </label>                
                <textarea <?= ($view_mode == 0) ? "disabled" : ""; ?>  class="ckeditor form-control" id="DescripcionAbajo" name="DescripcionAbajo" ><?= $res[0]['descripcionAbajo'] ?></textarea>
                <p class="help-block"><small><?= $vocab["symbol_desc"] ?></small></p> 
            </div>                       
            <?php
            if ($view_mode == 1) {
                if (check_permiso($mod4, $act4, $user_rol)) {
                    ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a <?= ($view_mode == 0) ? "disabled" : ""; ?> class="btn btn-success btn-group-justified"  name="submit" onclick="update_formulario(<?= $res[0]['id'] ?>);"><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_update"] . " " . $vocab["permits_title"] ?></a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminFormularios/list_formulario.php?', '');"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminFormularios/list_formulario.php?', '');"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
                </div>
            <?php } ?>

        </form>
    </div>
</div>
<script>
    CrearEditorFormulario(<?=$view_mode?>);
</script>

