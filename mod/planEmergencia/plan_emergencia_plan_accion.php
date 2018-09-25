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
$sql = "SELECT  `id`, `FKidPlanEmergencias`, `area`, `peligro`,"
        . " `accionPorRealizar`,`recomendaciones`,`fechaEjecucion`,`responsable` FROM `PlanAccion` WHERE `FKidPlanEmergencias`=$idPlanEmergencia";
$res = seleccion($sql);

if (count($res) <= 0) {
    $res = array('0');
}
?>

<script>
    var comboArea = ['<?= $vocab["plan_de_accion_interior"] ?>', '<?= $vocab["plan_de_accion_exterior"] ?>'];
    var comboAccion = ['<?= $vocab["plan_de_accion_anclar"] ?>', '<?= $vocab["plan_de_accion_reparar"] ?>', '<?= $vocab["plan_de_accion_remover"] ?>'];
</script>
<div class="well well-sm">
    <p><b><?= $vocab["plan_de_accion_title"] ?></b></p>
    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
            <span class="text-center" >
                <a class="btn btn-success" onclick="javascript: agregarPlanAccion('<?= $vocab["symbol_delete"] ?>', '#<?= $tablaID ?>', '<?= $vocab["Menu_Datos_sin_guardar"] ?>', comboArea, comboAccion);"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?>  </a>
            </span>
        <?php } ?>
    </div>
    <div   class="dataTables_wrapper dt-bootstrap" style = "overflow-x:auto;">
        <table style = "width: 99%;" id="<?= $tablaID ?>" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
            <thead style="background-color: lightblue;">
                <tr>
                    <th  width="5%"><?= $vocab["plan_de_accion_area"] ?></th>
                    <th  width="5%"><?= $vocab["plan_de_accion_peligro"] ?></th>
                    <th  width="5%"><?= $vocab["plan_de_accion_acciones"] ?></th>                
                    <th  width="5%"><?= $vocab["plan_de_accion_recomendaciones"] ?></th>   
                    <th  width="5%"><?= $vocab["plan_de_accion_fecha"] ?></th> 
                    <th  width="5%"><?= $vocab["plan_de_accion_responsable"] ?></th> 
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
                            <td> 
                                <select id="area<?= $i ?>" <?= (!$editar) ? "Disabled" : ""; ?> class="form-control cambios"></select>
                            </td>
                    <script>
                        llenarSelect(<?= $i ?>, comboArea, '<?= (is_array($res[$i])) ? $res[$i]['area'] : 'nada'; ?>', 0);
                    </script> 
                    <td><textarea rows="1"   type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="peligro<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['peligro'] : ""; ?></textarea></td>
                    <td>  
                        <select id="accion<?= $i ?>" <?= (!$editar) ? "Disabled" : ""; ?> class="form-control cambios"></select>
                    </td>
                    <script>
                        llenarSelect(<?= $i ?>, comboAccion, '<?= (is_array($res[$i])) ? $res[$i]['accionPorRealizar'] : 'nada'; ?>', 1);
                    </script> 
                    <td><textarea rows="1"  type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="recomendaciones<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['recomendaciones'] : ""; ?></textarea></td>
                    <td> <input  type="date" value ="1900-01-01" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="fecha<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['fechaEjecucion'] : ""; ?>" ></td>
                    <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="responsable<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['responsable'] : ""; ?>" ></td>
                    <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                        <td>              
                            <a class="puntero cambios"  onClick="javascript:eliminarFilaPlanAccion(this);">                                 
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
                <a class="btn btn-warning"  onclick="javascript:guardarPlanAccion('<?= $idPlanEmergencia ?>', 0, '<?= $tablaID ?>')" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["plan_de_accion"] ?></a>
            </span>         
        <?php } ?>
    </div>
</div>

