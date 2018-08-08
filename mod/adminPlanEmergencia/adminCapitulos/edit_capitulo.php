<?php
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");


$view_mode = $_GET['view_mode'];
$id_cap= $_GET['id_cap'];
$sql = "SELECT  id, descripcion,titulo
        FROM capitulo  WHERE id =" . $id_cap;
$res = seleccion($sql);

?>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["capitulo_capitulo"] ?></h2>
        <p><?= $vocab["capitulo_capitulo_Desc"] ?></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-11 col-xs-12">
        <form method="post" action="">            
            <div class="form-group">
                <label  for="capitulo_title"><?= $vocab["capitulo_title"] ?></label>
                <input <?= ($view_mode == 0) ? "readonly" : ""; ?>  id="capitulo_title" name="capitulo_title" class="form-control" type="text" value="<?= $res[0]['titulo'] ?>"/> 
                <p class="help-block"><small><?= $vocab["capitulo_title_Desc"] ?></small></p> 
            </div>
            <div class="form-group">
                <label  for="capitulo_Descripcion"><?= $vocab["symbol_desc"] ?> </label>                
                <textarea <?= ($view_mode == 0) ? "readonly" : ""; ?>  class="ckeditor form-control" id="capitulo_Descripcion" name="capitulo_Descripcion" ><?= $res[0]['descripcion'] ?></textarea>
                <p class="help-block"><small><?= $vocab["capitulo_Descripcion"] ?></small></p> 
            </div>            
                       <?php
            if ($view_mode == 1) {
                if (check_permiso($mod1, $act4, $user_rol)) {
                    ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a <?= ($view_mode == 0) ? "readonly" : ""; ?> class="btn btn-success btn-group-justified"  name="submit" onclick="update_capitulo();"><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_update"] . " " . $vocab["permits_title"] ?></a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/list_capitulos.php?', '');"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/list_capitulos.php?', '');"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
                </div>
            <?php } ?>
            
        </form>
    </div>
</div>
<script>
CrearEditorCapitulos();
</script>

