<?php
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

$view_mode = $_GET['view_mode'];
$id = $_GET['id'];
$sql = "SELECT  id, nombreZonaTrabajo,descripcion,isActivo FROM ZonaTrabajo  WHERE id =" . $id;
$res = seleccion($sql);
//$sql = "SELECT id, nombre FROM sis_user";
//$comb = seleccion($sql);
//
$sql = "SELECT id, nombre FROM sis_user";
$comb = seleccion($sql);

$sql = "SELECT usuario.id, usuario.nombre FROM
(SELECT id, nombre FROM sis_user ) usuario,
(SELECT FKidUsuario, FKidZona FROM UsuarioZona where FKidZona = " . $id . ") usuariozona
where usuario.id = usuariozona.FKidUsuario";
$usuarios = seleccion($sql);
?>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["zona_trabajo_title"] ?></h2>        
    </div>
    <div class="col-lg-5 col-md-5 col-sm-8 col-xs-12">
        <form method="post" action="">            
            <div class="form-group">
                <label  for="zona_trabajo_title"><?= $vocab["zona_trabajo_title"] ?></label>
                <input <?= ($view_mode == 0) ? "readonly" : ""; ?> id="nombre" name="zona_trabajo_title" class="form-control" type="text" value="<?= $res[0]["nombreZonaTrabajo"] ?>" /> 
                <p class="help-block"><small><?= $vocab["zona_trabajo_title_Desc"] ?></small></p> 
            </div>
            <div class="form-group">
                <label  for="descripcion"><?= $vocab["symbol_desc"] ?> </label>                
                <textarea <?= ($view_mode == 0) ? "readonly" : ""; ?> class="ckeditor form-control" id="descripcion" name="descripcion" ><?= $res[0]["descripcion"] ?></textarea>
                <p class="help-block"><small><?= $vocab["zona_trabajo_Descripcion"] ?></small></p> 
            </div>   
            <div class="form-group">
                <label for="type-radio"><?= $vocab["list_origen_amenaza_isActivo"] ?> </label>                    
                <div class="radio radio_efect">
                    <label class="radio-inline">
                        <input <?= ($view_mode == 0) ? "disabled" : ""; ?><?= ($res[0]["isActivo"] == 1) ? "checked" : ""; ?> id="inlineCheckbox1" name="inlineCheckbox" type="radio" value="1" checked> <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                        <?= $vocab["isActivo"] ?>  
                    </label>
                    <label class="radio-inline">
                        <input <?= ($view_mode == 0) ? "disabled" : ""; ?><?= ($res[0]["isActivo"] == 0) ? "checked" : ""; ?> id="inlineCheckbox2" name="inlineCheckbox" type="radio" value="0"> <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span> 
                        <?= $vocab["isInactivo"] ?> 
                    </label>
                </div>  
                <p class="help-block"><small><?= $vocab["desc_origen_isActivo"] ?></small></p> 
            </div> 
           
            <div class="form-group"> 
                <div><label  for=""><?= $vocab["symbol_desc"] ?> </label></div> 
                <select id = "select_usuario">
                    <?php for ($i = 0; $i < count($comb); $i++) { ?>
                        <option value='<?= $comb[$i]['id'] ?>' selected><?= $comb[$i]['nombre'] ?></option>
                    <?php } ?>
                </select>
                <span class="text-center"><a class="btn btn-success" onclick="asociar_usuario_zona_trabajo();"><i class="fa fa-save fa-inverse"></i>Add</a></span>
                <p class="help-block"><small><?= $vocab["zona_trabajo_Descripcion"] ?></small></p> 
            </div>
            <div class="form-group"> 
                <div><label  for=""><?= $vocab["symbol_desc"] ?> </label></div> 
                <table  id = "tabla_usuario_zona" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                    <thead>
                    <th><?= $vocab["symbol_desc"] ?> </th>
                    <th><?= $vocab["symbol_desc"] ?> </th>
                    <th><i class="fa fa-close fa-2x text-danger" title="Eliminar"></i> </th>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($usuarios); $i++) { ?>
                        <tr>
                        <td><?= $usuarios[$i]['id'] ?> </td>
                        <td><?= $usuarios[$i]['nombre'] ?> </td>
                        <td onclick = 'eliminar_usuario_zona(" + cedula + ");'><i class='fa fa-close text-danger puntero' title='Eliminar'></i></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>  
            <?php
            if ($view_mode == 1) {
                if (check_permiso($mod1, $act4, $user_rol)) {
                    ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a <?= ($view_mode == 0) ? "readonly" : ""; ?> class="btn btn-success btn-group-justified"  name="submit" onclick="update_zona_trabajo(<?= $res[0]['id'] ?>);"><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_update"] . " " . $vocab["permits_title"] ?></a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/list_zona_trabajo.php?', '');"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/list_zona_trabajo.php?', '');"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
                </div>
            <?php } ?>          
        </form>
    </div>
</div>