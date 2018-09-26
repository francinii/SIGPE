<?php
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
 $_SESSION['ckfinder_baseUrl']='img/';
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
                <input id="capitulo_title" name="capitulo_title" class="form-control" type="text" value=""/> 
                <p class="help-block"><small><?= $vocab["capitulo_title_Desc"] ?></small></p> 
            </div>
            <div class="form-group">
                <label  for="capitulo_Descripcion"><?= $vocab["symbol_desc"] ?> </label>                
                <textarea class="ckeditor form-control" id="capitulo_Descripcion" name="capitulo_Descripcion" ></textarea>
                <div id="toolbar-container"></div>

                <!-- This container will become the editable. -->
                <div id="editor">
                    <p></p>
                </div>
                <p class="help-block"><small><?= $vocab["capitulo_Descripcion"] ?></small></p> 
            </div>            

            <?php if (check_permiso($mod4, $act3, $user_rol)) { ?>
                <div class="text-center"><a class="btn btn-success"  name="submit" onclick="new_capitulo();"><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] . " " . $vocab["capitulo_capitulo"] ?>  </a></div>
            <?php } ?>

        </form>
    </div>
</div>
<script>
    CrearEditorCapitulos();
</script>
