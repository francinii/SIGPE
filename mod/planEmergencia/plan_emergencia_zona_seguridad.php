<?php
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
include("plan_emergencia_menu.php");
?>
<!------------------------------------  Recurso telecomunicaciones ----------------------------------- ------------------- ----------->
<?php
//$categoria = 'telecomunicaciones';
//$prefijo = 'PA-';
$tablaID = "lista_plan_accion";
$sql = "SELECT  `id`, `FKidZonaTrabajo`, `Nombre`, `ubicacion`,"
        . " `capacidad`,`observaciones`,`sector` FROM `ZonaSeguridad` WHERE `FKidZonaTrabajo`=$idPlanEmergencia";
$res = seleccion($sql);

if (count($res) <= 0) {
    $res = array('0');
}
?>

<div class="well well-sm">
    <p><b><?= $vocab["zona_seguridad_title"] ?></b></p>
    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
            <span class="text-center" >
                <a class="btn btn-success" onclick="javascript: agregarZonaSeguridad('<?= $vocab["symbol_delete"] ?>', '#<?= $tablaID ?>', '<?= $vocab["Menu_Datos_sin_guardar"] ?>');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?>  </a>
            </span>
        <?php } ?>
    </div>
    <div   class="dataTables_wrapper dt-bootstrap" style = "overflow-x:auto;">
        <table style = "width: 99%;" id="<?= $tablaID ?>" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
            <thead style="background-color: lightblue;">
                <tr>
                    <th  width="5%"><?= $vocab["zona_seguridad_nombre"] ?></th>
                    <th  width="5%"><?= $vocab["zona_seguridad_ubicacion"] ?></th>
                    <th  width="5%"><?= $vocab["zona_seguridad_capacidad"] ?></th>                
                    <th  width="5%"><?= $vocab["zona_seguridad_observaciones"] ?></th>   
                    <th  width="5%"><?= $vocab["zona_seguridad_sector"] ?></th> 
                    <?php if ($editar) { ?>
                        <th width="2%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($res) > 0) {
                    for ($i = 0; $i < count($res); $i++) {
                        ?>
                        <tr id="<?= $i ?>">                             
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="nombre<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['Nombre'] : ""; ?>" ></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="ubicacion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['ubicacion'] : ""; ?>" ></td>
                            <td> <input  type="number" min ="0"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="capacidad<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['capacidad'] : "0"; ?>" ></td>
                            <td><textarea rows="1"   type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="observaciones<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['observaciones'] : ""; ?></textarea></td>
                            <td> <input  type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="sector<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['sector'] : ""; ?>" ></td>
                            <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                                <td>              
                                    <a class="puntero cambios"  onClick="javascript:eliminarFilaZonaSeguridad(this);">                                 
                                        <div class="text-center"><i class="fa fa-close  text-danger " title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                                    </a>                             
                                </td>
                            <?php } ?>
                        </tr>   
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>  
    <div class="text-center">
        <?php if ($editar) { ?>
            <span class="text-center">
                <a class="btn btn-warning"  onclick="javascript:guardarZonaSeguridad('<?= $idPlanEmergencia ?>', 0, '<?= $tablaID ?>')" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["zona_seguridad"] ?></a>
            </span> 
 <span class="text-center">
                <a class="btn btn-success"  onclick="javascript:guardarZonaSeguridad('<?= $idPlanEmergencia ?>', 1, '<?= $tablaID ?>')" name="submit" ><i class="fa fa-rotate-right"></i> <?= $vocab["symbol_save"] . " " . $vocab["datos_generares_siguente"] ?></a>
            </span>        
        <?php } ?>
    </div>
</div>

