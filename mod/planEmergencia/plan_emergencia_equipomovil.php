<?php
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

include("plan_emergencia_menu.php");

$sql = "SELECT  `id` FROM `PlanEmergencia`  WHERE `FKidZonaTrabajo`=" . $idCentro;
$res = seleccion($sql);

if (count($res) > 0) {
    $idPlanEmergencia = $res[0]['id'];

    $sql = "SELECT  `tipoPoblacion`, `descripcion`, `total`, `representacionDe` FROM 
    `TipoPoblacion` WHERE  `FKidPlanEmergencias`=" . $idPlanEmergencia;
    $res = seleccion($sql);
}
if (count($res) <= 0) {
    $res = array($vocab["actividades_administrativo"], $vocab["actividades_académico"],
        $vocab["actividades_Estudiantes"], $vocab["actividades_Visitantes"]);
}
?>

<div class="well well-sm">

    <h2><?= $vocab["equipo_moviles_titulo"] ?></h2>
    <p><?= $vocab["equipo_moviles_titulo_desc"] ?></p>
    

</div>
<div align="right">
    <span class="text-center" >
        <a class="btn btn-success" onclick="javascript: agregarFila();"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?></a>
    </span>
</div>
<div   class="dataTables_wrapper  form-inline dt-bootstrap" style = "overflow-x:auto;">
    <table style = "width: 99%;" id="lista_equipos" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
        <thead>
            <tr>
                <th  width="5%"><?= $vocab["equipo_moviles_tipo"] ?></th>
                <th  width="2%"><?= $vocab["equipo_moviles_cantidad"] ?></th>
                <th  width="2%"><?= $vocab["equipo_moviles_capacidad"] ?></th>                
                <th  width="5%"><?= $vocab["equipo_moviles_caracteristicas"] ?></th>   
                <th  width="5%"><?= $vocab["equipo_moviles_contacto"] ?></th>
                <th  width="5%"><?= $vocab["equipo_moviles_ubicacion"] ?></th>                
                <th  width="5%"><?= $vocab["equipo_moviles_categoria"] ?></th>
                <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                <?php } ?>
                
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($res) > 0) {
                for ($i = 0; $i < count($res); $i++) {
                    ?>
                    <tr>
                        <td> <input style = "width: 100%;" type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control cambios" id="total<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['total'] : "0"; ?>" ></td>
                        <td> <input style = "width: 100%;" type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control cambios" id="total<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['total'] : "0"; ?>" ></td>
                        <td> <input style = "width: 100%;" type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control cambios" id="total<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['total'] : "0"; ?>" ></td>
                        <td><textarea style ="width: 100%;"  type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control cambios" id="descripcion<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['descripcion'] : ""; ?></textarea></td>
                        <td> <input style = "width: 100%;" type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control cambios" id="total<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['total'] : "0"; ?>" ></td>
                        <td> <input style = "width: 100%;" type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="total<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['total'] : "0"; ?>" ></td>
                        <td> <input style = "width: 100%;" type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control cambios" id="total<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['total'] : "0"; ?>" ></td>                               
                    <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                            <td>              
                                <a class="puntero"  onClick="javascript:delete_capitulo();">                                 
                                    <div class="text-center"><i class="fa fa-close fa-2x text-danger" title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
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
            <a class="btn btn-warning"  onclick="javascript:guardarDatosActividades('<?= $idPlanEmergencia ?>', 0,<?= count($res) ?>)" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["equipo_moviles_titulo"] ?></a>
        </span>
        <span class="text-center">
            <a class="btn btn-success"  onclick="javascript:guardarDatosActividades('<?= $idPlanEmergencia ?>', 1,<?= count($res) ?>)" name="submit"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_save"] . " " . $vocab["datos_generares_siguente"] ?></a>
    </div></span>


<?php } ?>
</div>   

