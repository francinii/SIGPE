<?php
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

include("plan_emergencia_menu.php");


    $sql = "SELECT  `tipoPoblacion`, `descripcion`, `total`, `representacionDe` FROM 
    `TipoPoblacion` WHERE  `FKidZonaTrabajo`=" . $idPlanEmergencia;
    $res = seleccion($sql);

if (count($res) <= 0) {
    $res = array($vocab["actividades_administrativo"], $vocab["actividades_académico"],
        $vocab["actividades_Estudiantes"], $vocab["actividades_Visitantes"]);
}
?>


<div class="well well-sm">

    <h2><?= $vocab["actividades_Titulo"] ?></h2>
    <p><?= $vocab["actividades_Titulo_Desc"] ?></p>

</div>

<div class="dataTables_wrapper form-inline dt-bootstrap" style=overflow-x:auto;"> 
    <table style = "width: 99%;" id="lista_usuarios" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable text-center" >
        <thead>
            <tr>
                <th rowspan="2" width="10%"><?= $vocab["actividades_Titulo"] ?></th>
                <th rowspan="2" width="20%"><?= $vocab["actividades_Descripcion"] ?></th>
                <th rowspan="2" width="10%"><?= $vocab["actividades_total"] ?></th>                
                <th rowspan="2" width="20%"><?= $vocab["actividades_Discapacidad"] ?></th>                        
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($res) > 0) {
                for ($i = 0; $i < count($res); $i++) {
                    ?>
                    <tr>
                        <td id="tipo<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['tipoPoblacion'] : "$res[$i]"; ?></td>
                        <td><textarea  type="text"  <?= (!$editar) ? "disabled" : ""; ?>  class="form-control cambios" id="descripcion<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['descripcion'] : ""; ?></textarea></td>
                        <td> <input type="number"  <?= (!$editar) ? "disabled" : ""; ?>  min="0" class="form-control cambios" id="total<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['total'] : "0"; ?>" ></td>
                        <td><textarea  type="text"   <?= (!$editar) ? "disabled" : ""; ?>  class="form-control cambios" id="discapacidad<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['representacionDe'] : ""; ?></textarea></td> 
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
                <a class="btn btn-warning   "  onclick="javascript:guardarDatosActividades('<?= $idPlanEmergencia ?>', 0,<?= count($res) ?>)" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["actividades_Titulo"] ?></a>
            </span>
            <span class="text-center">
                <a class="btn  btn-success"  onclick="javascript:guardarDatosActividades('<?= $idPlanEmergencia ?>', 1,<?= count($res) ?>)" name="submit"><i class="fa fa-rotate-right"></i> <?= $vocab["symbol_save"] . " " . $vocab["datos_generares_siguente"] ?></a>
            </span>

        <?php } ?>
    </div>








