<?php
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

$sql = "SELECT id, titulo FROM capitulo";
$comb = seleccion($sql);
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
                <input id="subcapitulo_title" name="subcapitulo_title" class="form-control" type="text" value=""/> 
                <p class="help-block"><small><?= $vocab["subcapitulo_title_Desc"] ?></small></p> 

            </div>
            <div class="form-group">
                <label  for="subcapitulo_capitulo"><?= $vocab["subcapitulo_capitulo"] ?></label>
                <select id= "subcapitulo_capitulo" name="subcapitulo_capitulo" class="form-control">
                    <?php
                    if (count($comb) > 0) {
                        for ($i = 0; $i < count($comb); $i++) {               
                                ?>
                                <option value='<?= $comb[$i]['id'] ?>' selected><?= $comb[$i]['titulo'] ?></option>
                                <?php                             
                        }
                    }
                    ?>
                </select>
                <p class="help-block"><small><?= $vocab["subcapitulo_capitulo_Desc"] ?></small></p> 
            </div>
            <div class="form-group">
                <label  for="Subcapitulo_Descripcion"><?= $vocab["symbol_desc"] ?> </label>                
                <textarea class="ckeditor form-control" id="Subcapitulo_Descripcion" name="Subcapitulo_Descripcion" ></textarea>
                <p class="help-block"><small><?= $vocab["subcapitulo_Descripcion"] ?></small></p> 
            </div>            

            <?php if (check_permiso($mod3, $act3, $user_rol)) { ?>
                <div class="text-center"><a class="btn btn-success"  name="submit" onclick="new_subcapitulo();"><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] . " " . $vocab["add_subcapitulo"] ?>  </a></div>
            <?php } ?>


        </form>
    </div>
</div>
<script>
    CrearEditorSubcapitulos();
</script>
