<?php
$start = "0";
$sql = "SELECT `id`, `descripcion` FROM `Formulario` order by id";

$res = seleccion($sql);
$idCentro = $_GET['idCentro'];
$nombreCentro = $_GET['nombreCentro'];
$editar =(check_permiso($mod5, $act4, $user_rol) || check_permiso($mod5, $act3, $user_rol) );
?>
<script>
    var idCentro =<?= $idCentro ?>;
    var nombreCentro = "<?= $nombreCentro ?>";
   document.getElementById("tituloGeneral").innerHTML="<?= $vocab["Menu_Datos_Plan"] ?>"+nombreCentro;
</script>

<br/>
<div>

   
    <div class="btn-group btn-group-justified">

        <?php
        if (count($res) > 0) {
            for ($i = 0; $i < count($res); $i++) {
                ?>
                <a href="#" onclick="javascript: cambiarMenu(<?= $res[$i]['id'] ?>, <?= $idCentro ?>, '<?= $nombreCentro ?>');" class="btn btn-primary"><?= $res[$i]["descripcion"] ?></a>

                <?php
            }
        }
        ?>
    </div> 
</div>
<br/>
<div class="container">
    <div id="divalertaDatosSinGuardar" class="">
        <div class="panel-heading" id="alertaDatosSinGuardar"></div>     
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        IniciarGuardarCambios('<?= $vocab["Menu_Datos_sin_guardar"] ?>');
    });
</script>