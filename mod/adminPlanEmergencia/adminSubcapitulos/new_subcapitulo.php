<?php
/**
 * Agrega  los subcapitulos al sistema
 */
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

$sql = "SELECT id, titulo FROM Capitulo";
$comb = seleccion($sql);

$find_key = '';
if ((isset($_GET['find_key']))) {
    $find_key = $_GET['find_key'];
}

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
                    <option value='<?= $comb[$i]['id'] ?>' <?=($find_key==$comb[$i]['id'])? 'selected': '' ?> ><?= $comb[$i]['titulo'] ?></option>
                            <?php
                        }
                    }else{?>
                    <script>                    
                    jAlert("No hay capitulos en el sistema, debe agregar uno", "Dato Requerido");
                    </script>
                    <?php
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
            <div class="form-group">
                <label for="type-radio"><?= $vocab["subcapitulo_requiere_Descripcion_usuario"] ?> </label>                    
                <div class="radio radio_efect">
                    <label class="radio-inline">
                        <input id="inlineCheckbox1" onclick="activarDescripcionUsuarioSubCapitulo(1, '<?= $vocab["subcapitulo_Descripcion_usuario"] ?>','<?= $vocab["subcapitulo_Descripcion_usuario_desc"] ?>');" name="inlineCheckbox" type="radio" value="1" checked> <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span> 
                        <?= $vocab["isActivo"] ?>  
                    </label>
                    <label class="radio-inline">
                        <input id="inlineCheckbox2" onclick="activarDescripcionUsuarioSubCapitulo(0,'', '');" name="inlineCheckbox" type="radio" value="0"> <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span> 
                        <?= $vocab["isInactivo"] ?> 
                    </label>
                </div> 
                <p class="help-block"><small><?= $vocab["subcapitulo_requiere_Descripcion_usuario_desc"] ?></small></p> 
            </div>
            <div id="div-subcapitulo_Descripcion_usuario" class="form-group">
                <label  for="subcapitulo_Descripcion_usuario"><?= $vocab["subcapitulo_Descripcion_usuario"] ?> </label>                
                <textarea class="form-control"  id="subcapitulo_Descripcion_usuario" name="subcapitulo_Descripcion_usuario" ></textarea>
                <p class="help-block"><small><?= $vocab["subcapitulo_Descripcion_usuario_desc"] ?></small></p> 
            </div> 
            <?php if (check_permiso($mod4, $act3, $user_rol)) { ?>
                <div class="text-center"><a class="btn btn-success"  name="submit" onclick="new_subcapitulo();"><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] . " " . $vocab["add_subcapitulo"] ?>  </a></div>
            <?php } ?>


        </form>
    </div>
</div>
<script>
    CrearEditorSubcapitulos(1);
</script>
