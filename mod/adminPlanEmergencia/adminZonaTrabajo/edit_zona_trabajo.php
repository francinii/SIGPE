<?php
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

$view_mode = $_GET['view_mode'];
$id = $_GET['id'];
$sql = "SELECT  id, nombreZonaTrabajo,FKidSede,descripcion,isActivo,logo,ubicacion FROM ZonaTrabajo  WHERE id =" . $id;
$res = seleccion($sql);
//$sql = "SELECT id, nombre FROM sis_user";
//$comb = seleccion($sql);
//

$sql = "SELECT id, nombreSede FROM Sede where isActivo=1";
$sede = seleccion($sql);

$sql = "SELECT id, nombre FROM sis_user";
$comb = seleccion($sql);

$sql = "SELECT usuario.id, usuario.nombre FROM
(SELECT id, nombre FROM sis_user ) usuario,
(SELECT FKidUsuario, FKidZona FROM UsuarioZona where FKidZona = " . $id . ") usuariozona
where usuario.id = usuariozona.FKidUsuario";
$usuarios = seleccion($sql);

$find_key = $res[0]['FKidSede'];
?>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["zona_trabajo_title"] ?></h2>        
    </div>
    <div class="col-lg-5 col-md-5 col-sm-8 col-xs-12">
        <form method="post" action="" enctype="multipart/form-data">            
            <div class="form-group">
                <label  for="zona_trabajo_title"><?= $vocab["zona_trabajo_title"] ?></label>
                <input <?= ($view_mode == 0) ? "disabled" : ""; ?> id="nombre" name="zona_trabajo_title" class="form-control" type="text" value="<?= $res[0]["nombreZonaTrabajo"] ?>" /> 
                <p class="help-block"><small><?= $vocab["zona_trabajo_title_Desc"] ?></small></p> 
            </div>
            <div class="form-group">
                <div><label  for=""><?= $vocab["zona_trabajo_sede"] ?> </label></div> 
                <select  <?= ($view_mode == 0) ? "disabled" : ""; ?> class="form-control" id = "select_sede">
                    <?php for ($i = 0; $i < count($sede); $i++) { ?>
                        <option <?= ($res[0]['FKidSede'] == $sede[$i]['id']) ? "selected " : ""; ?> value='<?= $sede[$i]['id'] ?>'><?= $sede[$i]['nombreSede'] ?></option>
                    <?php } ?>
                </select>
                <p class="help-block"><small><?= $vocab["zona_trabajo_sede_Desc"] ?></small></p> 
            </div>

            <div class="form-group">
                <label for="type-file"><?= $vocab["zona_trabajo_logo"] ?></label>
                <?php if ($view_mode == 1) { ?>
                <input  id="type-file" value="<?= $res[0]['logo'] ?>" accept="image/*" name="type-file" class="form-control filestyle"  type="file" placeholder="propiedad placeholder" title="propiedad title"/>
                    
                <?php } else { ?>
                    <input disabled id="type-file" name="type-file" class="form-control" type="text" value="<?= $res[0]["logo"] ?>" /> 
                <?php } ?>
                <p class="help-block"><?= $vocab["zona_trabajo_logo_desc"] ?></p>
            </div>
            <div class="form-group" id="logo">
                <img src="../SIGPE/mod/planEmergenciaPDF/img/imgPlanes/<?= $res[0]['logo'] ?>?time=<?= time() ?>" style="max-width:100%" class="img-rounded" alt="Sin logo"> 
            </div>
            <div class="form-group">
                <label for="type-file-ubicacion"><?= $vocab["zona_trabajo_Ubicacion"] ?></label>
                <?php if ($view_mode == 1) { ?>
                    <input  id="type-file-ubicacion" value="<?= $res[0]['ubicacion'] ?>" accept="image/*" name="type-file" class="form-control filestyle"  type="file" placeholder="propiedad placeholder" title="propiedad title"/>

                <?php } else { ?>
                    <input disabled id="type-file" name="type-file" class="form-control" type="text" value="<?= $res[0]["ubicacion"] ?>" /> 
                <?php } ?>
                <p class="help-block"><?= $vocab["zona_trabajo_Ubicacion_desc"] ?></p>
            </div>
            <div class="form-group" id="ubicacion">
                <img src="../SIGPE/mod/planEmergenciaPDF/img/imgPlanes/<?= $res[0]['ubicacion'] ?>?time=<?= time() ?>"  style="max-width:100%" class="img-rounded" alt="Sin ubicación"> 
            </div>

            <div class="form-group">
                <label  for="descripcion"><?= $vocab["symbol_desc"] ?> </label>                
                <textarea <?= ($view_mode == 0) ? "disabled" : ""; ?> class="ckeditor form-control" id="descripcion" name="descripcion" ><?= $res[0]["descripcion"] ?></textarea>
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
                        <input <?= ($view_mode == 0) ? "disabled" : ""; ?> <?= ($res[0]["isActivo"] == 0) ? "checked" : ""; ?> id="inlineCheckbox2" name="inlineCheckbox" type="radio" value="0"> <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span> 
                        <?= $vocab["isInactivo"] ?> 
                    </label>
                </div>  
                <p class="help-block"><small><?= $vocab["desc_origen_isActivo"] ?></small></p> 
            </div> 
            <?php if ($view_mode != 0) { ?>
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
            <?php } ?>
            <div class="form-group"> 
                <div><label  for=""><?= $vocab["symbol_desc"] ?> </label></div> 
                <table <?= ($view_mode == 0) ? "disabled" : ""; ?> id = "tabla_usuario_zona" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                    <thead>
                    <th><?= $vocab["symbol_desc"] ?> </th>
                    <th><?= $vocab["symbol_desc"] ?> </th>
                    <?php if ($view_mode != 0) { ?>
                        <th><i class="fa fa-close fa-2x text-danger" title="Eliminar"></i> </th>
                    <?php } ?>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($usuarios); $i++) { ?>
                            <tr id ="<?= $usuarios[$i]['id'] ?>" >
                                <td><?= $usuarios[$i]['id'] ?> </td>
                                <td><?= $usuarios[$i]['nombre'] ?> </td>
                                <?php if ($view_mode != 0) { ?>
                                    <td <?= ($view_mode == 0) ? "disabled" : ""; ?>  onclick = "eliminar_usuario_zona(<?= $usuarios[$i]['id'] ?>);"> <i class='fa fa-close text-danger puntero' title='Eliminar'></i></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>  
            <?php
            if ($view_mode == 1) {
                if (check_permiso($mod4, $act4, $user_rol)) {
                    ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a  class="btn btn-success btn-group-justified"  name="submit" onclick="update_zona_trabajo(<?= $res[0]['id'] ?>);"><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_update"] . " " . $vocab["permits_title"] ?></a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/list_zona_trabajo.php?', 'find_key=' +<?= $find_key ?>);"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
                <div  class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-warning btn-group-justified"  name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/list_zona_trabajo.php?', 'find_key=' +<?= $find_key ?>);"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_return"] ?></a>
                </div>
            <?php } ?>          
        </form>
    </div>
</div>
<script>
    function archivoLogo(evt) {
        var files = evt.target.files; // FileList object

        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {
                    // Insertamos la imagen
                    document.getElementById("logo").innerHTML = ['<img class="thumb" style="max-width:100%" " src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);

            reader.readAsDataURL(f);
        }
    }
    function archivoUbicacion(evt) {
        var files = evt.target.files; // FileList object

        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {
                    // Insertamos la imagen
                    document.getElementById("ubicacion").innerHTML = ['<img class="thumb" style="max-width:100%"  src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);

            reader.readAsDataURL(f);
        }
    }
    document.getElementById('type-file').addEventListener('change', archivoLogo, false);
    document.getElementById('type-file-ubicacion').addEventListener('change', archivoUbicacion, false);
    jQuery(document).ready(function () {
        jQuery(":file").filestyle();
    });
</script>