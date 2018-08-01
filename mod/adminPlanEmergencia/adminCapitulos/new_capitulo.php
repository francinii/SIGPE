<?php
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
?>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["capitulo_capitulo"] ?></h2>
        <p><?= $vocab["user_title_desc"] ?></p>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-8 col-xs-12">
        <form method="post" action="">            
            <div class="form-group">
                <label  for="capitulo_title"><?= $vocab["capitulo_title"] ?></label>
                <input id="capitulo_title" name="capitulo_title" class="form-control" type="text" value=""/> 
                <p class="help-block"><small><?= $vocab["capitulo_title_Desc"] ?></small></p> 
            </div>
            <div class="form-group">
                <label  for="capitulo_Descripcion"><?= $vocab["symbol_desc"] ?> </label>                
                <textarea class="ckeditor form-control" id="capitulo_Descripcion" name="capitulo_Descripcion" ></textarea>
                <p class="help-block"><small><?= $vocab["capitulo_Descripcion"] ?></small></p> 
            </div>            
           
                <?php if (check_permiso($mod3, $act3, $user_rol)) { ?>
                    <div class="text-center"><a class="btn btn-success"  name="submit" onclick="new_user(1);"><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] . " " . $vocab["capitulo_capitulo"] ?>  </a></div>
                <?php } ?>

            
        </form>
    </div>
</div>