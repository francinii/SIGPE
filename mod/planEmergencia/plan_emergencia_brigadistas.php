<?php
/*
 * Formulario brigadistas
 * 
 */
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
include("plan_emergencia_menu.php");
?>

<?php
/************** select de los datos del formulario brigadistas ****/
$tablaID = "lista_plan_accion";
$sql = "SELECT  `id`, `FKidZonaTrabajo`, `brigadista`, `puntoPartida`,"
        . " `zonaEvacuar`,`numPersonasEvacuar`,`distancia`,`tiempo` FROM `Brigada` WHERE `FKidZonaTrabajo`=$idPlanEmergencia";
$res = seleccion($sql);
if (count($res) <= 0) {
    $res = array('0');
}
?>

<div class="well well-sm">
    <h2><?= $vocab["brigadista_title"] ?></h2>
    <p><?= $vocab["brigadista_title_desc"] ?></p>
    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
            <span class="text-center" >
                <a class="btn btn-success" onclick="javascript: agregarBrigadistas('<?= $vocab["symbol_delete"] ?>', '#<?= $tablaID ?>', '<?= $vocab["Menu_Datos_sin_guardar"] ?>');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?>  </a>
            </span>
        <?php } ?>
    </div>
    <div   class="dataTables_wrapper dt-bootstrap" style = "overflow-x:auto;">
        <table  style = "width: 99%;" id="<?= $tablaID ?>" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center formulario" >
            <thead style="background-color: lightblue;">
                <tr>
                    <th  width="5%"><?= $vocab["brigadista_nombre"] ?></th>
                    <th  width="5%"><?= $vocab["brigadista_punto_partida"] ?></th>
                    <th  width="5%"><?= $vocab["brigadista_zona_asignada"] ?></th>                
                    <th  width="5%"><?= $vocab["brigadista_numero_personas"] ?></th>   
                    <th  width="5%"><?= $vocab["brigadista_distancia_total"] ?></th> 
                    <th  width="5%"><?= $vocab["brigadista_tiempo_evacuacion"] ?></th> 
                    
                        <th width="2%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                   
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($res) > 0) {
                    for ($i = 0; $i < count($res); $i++) {
                        ?>
                        <tr id="<?= $i ?>">
                            <td>
                                <input  type="text"  <?= (!$editar) ? "disabled" : ""; ?>  class="form-control requerido cambios" id="brigadista<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['brigadista'] : ""; ?>" >
                            </td>                    
                            <td>   
                                <input  type="text"  <?= (!$editar) ? "disabled" : ""; ?>  class="form-control requerido cambios" id="puntoPartida<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['puntoPartida'] : ""; ?>" >
                            </td>          
                            <td>   
                                <input  type="text"  <?= (!$editar) ? "disabled" : ""; ?>  class="form-control requerido cambios" id="zonaEvacuar<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['zonaEvacuar'] : ""; ?>" >
                            </td>    
                            <td> <input  type="number"  min="0"<?= (!$editar) ? "disabled" : ""; ?>  class="form-control requerido cambios" id="numeroPersonas<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['numPersonasEvacuar'] : "0"; ?>" ></td>
                            <td> <input  type="number"  min="0"<?= (!$editar) ? "disabled" : ""; ?>  class="form-control requerido cambios" id="distancia<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['distancia'] : "0"; ?>" ></td>
                            <td> <input  type="number"  min="0"<?= (!$editar) ? "disabled" : ""; ?>  class="form-control requerido cambios" id="tiempo<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['tiempo'] : "0"; ?>" ></td>

                            
                                <td>  
                                    <?php if ($editar && check_permiso($mod5, $act5, $user_rol)) { ?>
                                    <a class="puntero cambios"  onClick="javascript:eliminarFilaBrigadistas(this);">                                 
                                        <div class="text-center"><i class="fa fa-close  text-danger " title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                                    </a>
                                    <?php } ?>
                                </td>
                            
                        </tr>   
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>  
    <div class="text-center">
        <!--/************** guardar datos ****/-->
        <?php if ($editar) { ?>
            <span class="text-center">
                <a class="btn btn-warning"  onclick="javascript:guardarBrigadistas('<?= $idPlanEmergencia ?>', 0, '<?= $tablaID ?>')" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["brigadista_title"] ?></a>
            </span> 
<span class="text-center">
                <a class="btn btn-success"  onclick="javascript:guardarBrigadistas('<?= $idPlanEmergencia ?>', 1, '<?= $tablaID ?>')" name="submit" ><i class="fa fa-rotate-right"></i> <?= $vocab["symbol_save"] . " " . $vocab["datos_generares_siguente"] ?></a>
            </span>        
        <?php } ?>
    </div>
</div>