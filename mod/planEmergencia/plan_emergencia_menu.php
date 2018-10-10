<?php
$start = "0";
$sql = "SELECT `id`, `titulo` FROM `Formulario` order by id";

$res = seleccion($sql);
$idCentro = $_GET['idCentro'];
$nombreCentro = $_GET['nombreCentro'];
$editar = (check_permiso($mod5, $act4, $user_rol) || check_permiso($mod5, $act3, $user_rol) );

$idPlanEmergencia = $idCentro;
?>
<script>
    var idCentro =<?= $idCentro ?>;
    var nombreCentro = "<?= $nombreCentro ?>";
    document.getElementById("tituloGeneral").innerHTML = "<?= $vocab["Menu_Datos_Plan"] ?>" + nombreCentro;
</script>

<br/>
<div class="container">
    <div id="divalertaDatosSinGuardar" class="">
        <div class="panel-heading" id="alertaDatosSinGuardar"></div>     
    </div>
</div>
<div class="container">
    <div class="row" style="text-align:center">

        <?php
        if (count($res) > 0) {
            for ($i = 0; $i < count($res); $i++) {
                ?>
                <?php if ($i == 0 || $i == 7) { ?>
                    <div style="width: 100%; margin-bottom: 0.5%;" class="btn-group btn-group-sm btn-group-justified" role="group" >
                    <?php } ?>
                        <a title ="<?= $res[$i]["titulo"] ?>" style="overflow: hidden; margin-bottom: 0.5%; text-align: center;"href="#" onclick="javascript: cambiarMenu(<?= $res[$i]['id'] ?>, <?= $idCentro ?>, '<?= $nombreCentro ?>');"  class="btn btn-primary"><?= $res[$i]["titulo"] ?></a>
                    <?php if ($i == 6 || $i == (count($res)-1)) { ?> 
                    </div> 
                <?php } ?>
                <?php
            }
        }
        ?>

    </div>   
</div>
<br/>
<script>
    jQuery(document).ready(function () {
        IniciarGuardarCambios('<?= $vocab["Menu_Datos_sin_guardar"] ?>');
    });
</script>