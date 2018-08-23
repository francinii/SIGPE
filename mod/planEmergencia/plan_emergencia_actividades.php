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
<script>
    var idCentro =<?= $idCentro ?>;
    var nombreCentro = "<?= $nombreCentro ?>";
    document.getElementById("tituloGeneral").innerHTML = "<?= $nombreCentro ?>";
</script>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["actividades_Titulo"] ?></h2>
        <p><?= $vocab["actividades_Titulo_Desc"] ?></p>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="dataTables_wrapper form-inline dt-bootstrap">
            <table id="lista_usuarios" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable text-center" >
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
                                <td><textarea  type="text"  class="form-control cambios" id="descripcion<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['descripcion'] : ""; ?></textarea></td>
                                <td> <input type="number"  class="form-control cambios" id="total<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['total'] : ""; ?>" ></td>
                                <td><textarea  type="text"  class="form-control cambios" id="discapacidad<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['representacionDe'] : ""; ?></textarea></td> 
                            </tr>   
                        <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-11 col-xs-12">
<?php if (check_permiso($mod3, $act3, $user_rol)) { ?>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a class="btn  btn-warning  btn-group-justified"  onclick="javascript:guardarDatosActividades('<?= $idPlanEmergencia ?>', 0,<?= count($res) ?>)" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?></a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a class="btn  btn-success btn-group-justified"  onclick="javascript:guardarDatosActividades('<?= $idPlanEmergencia ?>', 1,<?= count($res) ?>)" name="submit"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_save"] . " " . $vocab["datos_generares_siguente"] ?></a>
            </div>


<?php } ?>
    </div>   
</div>
<script>
    IniciarGuardarCambios();
</script>




