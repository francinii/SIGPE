<?php
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

$sql = "SELECT id, titulo FROM capitulo";
$comb = seleccion($sql);

$view_mode = $_GET['view_mode'];
$id_subcap= $_GET['id_subcap'];
$sql = "SELECT  id, descripcion,titulo,FKidCapitulo
        FROM subcapitulo  WHERE id =" . $id_subcap;
$res = seleccion($sql);

$find_key =$res[0]['FKidCapitulo']; 
?>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["subcapitulo_subcapitulo"] ?></h2>
        <p><?= $vocab["subcapitulo_subcapitulo_Desc"] ?></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-11 col-xs-12">
        <form method="post" action="">            
            <div class="form-group">
                <label  for="subcapitulo_title"><?= $vocab["capitulo_title"] ?></label>
                <input <?= ($view_mode == 0) ? "readonly" : ""; ?>  id="subcapitulo_title" name="subcapitulo_title" class="form-control" type="text"  value="<?= $res[0]['titulo'] ?>"/> 
                <p class="help-block"><small><?= $vocab["subcapitulo_title_Desc"] ?></small></p> 

            </div>
            <div class="form-group">
                <label  for="subcapitulo_capitulo"><?= $vocab["subcapitulo_capitulo"] ?></label>
                <select <?= ($view_mode == 0) ? "readonly" : ""; ?>  id= "subcapitulo_capitulo" name="subcapitulo_capitulo" class="form-control">
                    <?php
                    if (count($comb) > 0) {
                     for ($i = 0; $i < count($comb); $i++) {
                         if($comb[$i]['id']==$find_key){                       
                            ?>
                    <option value='<?= $comb[$i]['id'] ?>' selected><?= $comb[$i]['titulo'] ?></option>
                             <?php
                         }else{
                        ?>
                    <option value='<?= $comb[$i]['id'] ?>'><?= $comb[$i]['titulo'] ?></option>
                 <?php
                         }
                     }
                }
                 ?>
                    ?>
                </select>
                <p class="help-block"><small><?= $vocab["subcapitulo_capitulo_Desc"] ?></small></p> 
            </div>
            <div class="form-group">
                <label  for="Subcapitulo_Descripcion"><?= $vocab["symbol_desc"] ?> </label>                
                <textarea <?= ($view_mode == 0) ? "readonly" : ""; ?>  class="ckeditor form-control" id="Subcapitulo_Descripcion" name="Subcapitulo_Descripcion" ><?= $res[0]['descripcion'] ?></textarea>
                <p class="help-block"><small><?= $vocab["subcapitulo_Descripcion"] ?></small></p> 
            </div>            

                        <?php
            if ($view_mode == 1) {
                if (check_permiso($mod1, $act4, $user_rol)) {
                    ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a <?= ($view_mode == 0) ? "readonly" : ""; ?> class="btn btn-success btn-group-justified"  name="submit" onclick="update_subcapitulo(<?= $res[0]['id'] ?>);"><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_update"] . " " . $vocab["permits_title"] ?></a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/list_subcapitulos.php?', 'find_key='+<?=$find_key?>);"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/list_subcapitulos.php?', 'find_key='+<?=$find_key?>);"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
                </div>
            <?php } ?>


        </form>
    </div>
</div>
<script>
    CrearEditorSubcapitulos();
</script>

