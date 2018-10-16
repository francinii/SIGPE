<?php
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

$sql = "SELECT id, nombre FROM sis_user";
$comb = seleccion($sql);

$sql = "SELECT id, nombreSede FROM Sede where isActivo=1";
$sede = seleccion($sql);
?>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["zona_trabajo_title"] ?></h2>        
    </div>
    <div class="col-lg-5 col-md-5 col-sm-8 col-xs-12">
        <form method="post" action="" enctype="multipart/form-data">            
            <div class="form-group">
                <label  for="zona_trabajo_title"><?= $vocab["zona_trabajo_title"] ?></label>
                <input id="nombre" name="zona_trabajo_title" class="form-control" type="text" value=""/> 
                <p class="help-block"><small><?= $vocab["zona_trabajo_title_Desc"] ?></small></p> 
            </div>
            <div class="form-group">
                <div><label  for=""><?= $vocab["zona_trabajo_sede"] ?> </label></div> 
                <select class="form-control" id = "select_sede">
                    <?php
                    if (count($sede) > 0) {
                        for ($i = 0; $i < count($sede); $i++) {
                            ?>
                            <option value='<?= $sede[$i]['id'] ?>' selected><?= $sede[$i]['nombreSede'] ?></option>
                        <?php }
                    }else{?>
                          <script>                    
                            jAlert("No hay sedes en el sistema, debe agregar una", "Dato Requerido");
                    </script>
                     <?php       
                    }
                    ?>
                </select>
                <p class="help-block"><small><?= $vocab["zona_trabajo_sede_Desc"] ?></small></p> 
            </div>
            <div class="form-group">
                <label for="type-file"><?= $vocab["zona_trabajo_logo"] ?></label>
                <input id="type-file" accept="image/*" name="type-file" class="form-control filestyle" type="file" placeholder="propiedad placeholder" title="propiedad title"/>

                <p class="help-block"><?= $vocab["zona_trabajo_logo_desc"] ?></p>
            </div>
            <div class="form-group" id="logo">

            </div>
            <div class="form-group">
                <label for="type-file-ubicacion"><?= $vocab["zona_trabajo_Ubicacion"] ?></label>
                <input id="type-file-ubicacion" accept="image/*" name="type-file" class="form-control filestyle" type="file" placeholder="propiedad placeholder" title="propiedad title"/>

                <p class="help-block"><?= $vocab["zona_trabajo_Ubicacion_desc"] ?></p>
            </div>
            <div class="form-group" id="ubicacion">

            </div>

            <div class="form-group">
                <label  for="descripcion"><?= $vocab["symbol_desc"] ?> </label>                
                <textarea class="ckeditor form-control" id="descripcion" name="descripcion" ></textarea>
                <p class="help-block"><small><?= $vocab["zona_trabajo_Descripcion"] ?></small></p> 
            </div>   
            <div class="form-group">
                <label for="type-radio"><?= $vocab["zona_trabajo_activar"] ?> </label>                    
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
                <p class="help-block"><small><?= $vocab["desc_zona_trabajo_isActivo"] ?></small></p> 
            </div>   
            <div class="form-group"> 
                <div><label  for=""><?= $vocab["symbol_desc"] ?> </label></div> 
                <select  id = "select_usuario">
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
                    </tbody>
                </table>
            </div>  
            <?php if (check_permiso($mod4, $act3, $user_rol)) { ?>
                <div class="text-center"><a class="btn btn-success"  name="submit" onclick="new_zona_trabajo();"><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] . " " . $vocab["zona_trabajo_title"] ?>  </a></div>
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