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
$sql = "SELECT  `id`, `FKidZonaTrabajo`, `nombreArea`, `personaPermanente`,"
        . " `personaFlotante`,`ruta1`,`distancia1`,`tiempo1`,`ruta2`,`distancia2`,`tiempo2` FROM `RutaEvacuacion` WHERE `FKidZonaTrabajo`=$idPlanEmergencia";
$res = seleccion($sql);

if (count($res) <= 0) {
    $res = array('0');
}
?>
<div class="well well-sm">
    <h2><?= $vocab["rutas_evacuacion"] ?></h2>
    <p><?= $vocab["rutas_evacuacion_desc"] ?></p>
    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
            <span class="text-center" >
                <a class="btn btn-success" onclick="javascript: agregarRutasEvacuacion('<?= $vocab["symbol_delete"] ?>', '#<?= $tablaID ?>', '<?= $vocab["Menu_Datos_sin_guardar"] ?>');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?>  </a>
            </span>
        <?php } ?>
    </div>
    <div   class="dataTables_wrapper dt-bootstrap" style = "overflow-x:auto;">
        <table style = "width: 99%;" id="<?= $tablaID ?>" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
            <thead style="background-color: lightblue;">
                <tr>
                    <th  width="5%"><?= $vocab["rutas_evacuacion_nombre"] ?></th>
                    <th  width="5%"><?= $vocab["rutas_evacuacion_personas_permanentes"] ?></th>
                    <th  width="5%"><?= $vocab["rutas_evacuacion_personas_flotantes"] ?></th>                
                    <th  width="5%"><?= $vocab["rutas_evacuacion_ruta1"] ?></th>   
                    <th  width="5%"><?= $vocab["rutas_evacuacion_distancia1"] ?></th> 
                    <th  width="5%"><?= $vocab["rutas_evacuacion_tiempo1"] ?></th> 
                    <th  width="5%"><?= $vocab["rutas_evacuacion_ruta2"] ?></th>   
                    <th  width="5%"><?= $vocab["rutas_evacuacion_distancia2"] ?></th> 
                    <th  width="5%"><?= $vocab["rutas_evacuacion_tiempo2"] ?></th> 
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
                                <input  type="text"  <?= (!$editar) ? "disabled" : ""; ?>  class="form-control requerido cambios" id="area<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['nombreArea'] : ""; ?>" >
                            </td>
                            <td>  
                                <input  type="text"  <?= (!$editar) ? "disabled" : ""; ?>  class="form-control requerido cambios" id="personasPermanentes<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['personaPermanente'] : ""; ?>" >
                            </td>
                            <td>  
                                <input  type="text"  <?= (!$editar) ? "disabled" : ""; ?>  class="form-control requerido cambios" id="personasFlotantes<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['personaFlotante'] : ""; ?>" >
                            </td>
                            <td>  
                                <input  type="text"  <?= (!$editar) ? "disabled" : ""; ?>  class="form-control requerido cambios" id="rutaP<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['ruta1'] : ""; ?>" >
                            </td>              
                            <td> <input  type="number" min="0" <?= (!$editar) ? "disabled" : ""; ?>  class="form-control requerido cambios" id="distanciaP<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['distancia1'] : 0; ?>" ></td>
                            <td> <input  type="number" min="0" <?= (!$editar) ? "disabled" : ""; ?>  class="form-control requerido cambios" id="tiempoP<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['tiempo1'] : 0; ?>" ></td>
                            <td>  
                                <input  type="text"  <?= (!$editar) ? "disabled" : ""; ?>  class="form-control requerido cambios" id="rutaS<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['ruta2'] : ""; ?>" >
                            </td>  
                            <td> <input  type="number"  min="0" <?= (!$editar) ? "disabled" : ""; ?>  class="form-control requerido cambios" id="distanciaS<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['distancia2'] : 0; ?>" ></td>
                            <td> <input  type="number"  min="0" <?= (!$editar) ? "disabled" : ""; ?>  class="form-control requerido cambios" id="tiempoS<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['tiempo2'] : 0; ?>" ></td>
                            <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                                <td>              
                                    <a class="puntero cambios"  onClick="javascript:eliminarFilaRutasEvacuacion(this);">                                 
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
                <a class="btn btn-warning"  onclick="javascript:guardarRutasEvacuacion('<?= $idPlanEmergencia ?>', 0, '<?= $tablaID ?>')" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["rutas_evacuacion"] ?></a>
            </span>
        <span class="text-center">
                <a class="btn btn-success"  onclick="javascript:guardarRutasEvacuacion('<?= $idPlanEmergencia ?>', 1, '<?= $tablaID ?>')" name="submit" ><i class="fa fa-rotate-right"></i> <?= $vocab["symbol_save"] . " " . $vocab["datos_generares_siguente"] ?></a>
            </span> 
        <?php } ?>
    </div>
</div>

