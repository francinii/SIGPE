<?php
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
include("plan_emergencia_menu.php");

$sql = "SELECT  `tipo`, `ubicacion`, `Distancia`, `Tiempo`"
        . " FROM `CuerposScorro` WHERE `FKidPlanEmergencias`=" . $idPlanEmergencia;
$res = seleccion($sql);

if (count($res) <= 0) {
    $res = array($vocab["ingreso_cruzRoja"], $vocab["ingreso_Bomberos"], $vocab["ingreso_transito"]);
}
?>
<div class="well well-sm">
    <h2><?= $vocab["ingreso_titulo"] ?></h2>

    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
            <span class="text-center" >
                <a class="btn btn-success" onclick="javascript:agregarFilaIngresos('<?= $vocab["symbol_delete"] ?>', '<?= $vocab["Menu_Datos_sin_guardar"] ?>');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?>  </a>
            </span>
        <?php } ?>
    </div>
    <div   class="dataTables_wrapper   dt-bootstrap" style = "overflow-x:auto;">
        <table style = "width: 99%;" id="lista_ingreso" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
            <thead style="background-color: lightblue;">
                <tr>
                    <th  width="5%"><?= $vocab["ingreso_cuerpoRespuesta"] ?></th>
                    <th  width="5%"><?= $vocab["ingreso_ubicación"] ?></th>
                    <th  width="5%"><?= $vocab["ingreso_recorrido"] ?></th>                                
                    <th  width="5%"><?= $vocab["ingreso_tiempoRespuesta"] ?></th>                    
                    <?php if ($editar) { ?>
                        <th width="2%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody>
                <?php
                if (count($res) > 0) {
                    for ($i = 0; $i < count($res); $i++) {
                        $style = '';
                        $onclick = 'onClick="javascript:eliminarFilaIngreso(this);"';

                        if ($i < 3) {
                            $style = 'style="cursor:not-allowed"';
                            $onclick = '';
                        }
                        ?>
                        <tr id="<?= $i ?>">
                            <?php
                            if ($i < 3) {
                                ?>
                                <td><span id="tipo<?= $i ?>" ><?= (is_array($res[$i])) ? $res[$i]['tipo'] : $res[$i]; ?></span> </td>
                                <?php
                            } else {
                                ?>
                                <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control  cambios" id="tipo<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['tipo'] : $res[$i]; ?>" ></td>
                                <?php
                            }
                            ?>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control cambios" id="ubicacion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['ubicacion'] : ""; ?>" ></td>
                            <td> <input  type="number"  min="0" <?= (!$editar) ? "readonly" : ""; ?>   class="form-control requerido cambios" id="Distancia<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['Distancia'] : "0"; ?>" ></td>                            
                            <td> <input  type="number"  min="0" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="Tiempo<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['Tiempo'] : "0"; ?>" ></td>

                            <?php if (check_permiso($mod5, $act5, $user_rol)) {
                                ?>
                                <td>              
                                    <a class="puntero cambios" <?= $style ?> <?= $style ?> >                                 
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
                <a class="btn btn-warning"  onclick="javascript:guardarIncreso('<?= $idPlanEmergencia ?>', 0)" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["inventario_Datos"] ?></a>
            </span>
            <span class="text-center">
                <a class="btn btn-success"  onclick="javascript:guardarIncreso('<?= $idPlanEmergencia ?>', 1)" name="submit"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_save"] . " " . $vocab["datos_generares_siguente"] ?></a>
            </span>        
        <?php } ?>
    </div>
</div>

