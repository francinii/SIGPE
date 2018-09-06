<?php
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");


include("plan_emergencia_menu.php");
$sql = "SELECT `instalacionesDensidadOcupacion`, `instalacionesAreaConstruccion`, `instalacionesInstalaciones`, "
        . "`instalacionesCaracteristicasZona`, `instalacionesTopografia`, `instalacionesNivelTerreno`, `instalacionesColindates`,"
        . " `elementosConstructivosTipoConstruccion`, `elementosConstructivosAntiguedad`, `elementosConstructivosCimientos`,"
        . " `elementosConstructivosEstructura`, `elementosConstructivosParedes`, `elementosConstructivosEntrepiso`, `elementosConstructivosTecho`, "
        . "`elementosConstructivosCielos`, `elementosConstructivosPisos`, `elementosConstructivosAreaParqueo`, "
        . "`elementosConstructivosSistemaAguaPotable`, `elementosConstructivosAlcantarilladoSanitario`, `elementosConstructivosAlcantarilladoPluvial`,"
        . " `elementosConstructivosSistemaElectrico`, `elementosConstructivosSistemaTelefonico`, "
        . "`elementosConstructivosOtros` FROM `PlanEmergencia` WHERE `FKidZonaTrabajo`=".$idCentro;
$res = seleccion($sql);
?>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["instalaciones_Titulo"] ?></h2>
        <p><?= $vocab["instalaciones_Titulo_Desc"] ?></p>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
        <form method="post" action="">
            <h3><?= $vocab["instalaciones_subTitulo1"] ?></h3>
            <div class="form-group row">
                <label for="Densidad" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_Densidad"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="Densidad" value="<?= ( count($res) > 0) ? $res[0]['instalacionesDensidadOcupacion'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="area" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_Area"] ?></label>
                <div class="col-sm-9">
                    <input type="text"   <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="area" value="<?= ( count($res) > 0) ? $res[0]['instalacionesAreaConstruccion'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="instalaciones" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_Instalaciones"] ?></label>
                <div class="col-sm-9">
                    <input type="text"   <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="instalaciones" value="<?= ( count($res) > 0) ? $res[0]['instalacionesInstalaciones'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="zona" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_zona"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="zona" value="<?= ( count($res) > 0) ? $res[0]['instalacionesCaracteristicasZona'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="topografica" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_topografica"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="topografica" value="<?= ( count($res) > 0) ? $res[0]['instalacionesTopografia'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="terreno" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_terreno"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="terreno" value="<?= ( count($res) > 0) ? $res[0]['instalacionesNivelTerreno'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="colindantes" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_Colindantes"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="colindantes" value="<?= ( count($res) > 0) ? $res[0]['instalacionesColindates'] : ""; ?>">                                 
                </div>
            </div>
            <h3><?= $vocab["instalaciones_subTitulo2"] ?></h3>
            <div class="form-group row">
                <label for="tipo" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_Tipo"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="tipo" value="<?= ( count($res) > 0) ? $res[0]['elementosConstructivosTipoConstruccion'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="antiguedad" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_Antiguedad"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="antiguedad" value="<?= ( count($res) > 0) ? $res[0]['elementosConstructivosAntiguedad'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="cimientos" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_Cimientos"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="cimientos" value="<?= ( count($res) > 0) ? $res[0]['elementosConstructivosCimientos'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="estructura" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_Estructura"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="estructura" value="<?= ( count($res) > 0) ? $res[0]['elementosConstructivosEstructura'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="paredes" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_Paredes"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="paredes" value="<?= ( count($res) > 0) ? $res[0]['elementosConstructivosParedes'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="Entrepiso" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_Entrepiso"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="Entrepiso" value="<?= ( count($res) > 0) ? $res[0]['elementosConstructivosEntrepiso'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="techo" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_Techo"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="techo" value="<?= ( count($res) > 0) ? $res[0]['elementosConstructivosTecho'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="cielo" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_Cielos"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="cielo" value="<?= ( count($res) > 0) ? $res[0]['elementosConstructivosCielos'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="pisos" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_Pisos"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="pisos" value="<?= ( count($res) > 0) ? $res[0]['elementosConstructivosPisos'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="parqueo" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_parqueo"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="parqueo" value="<?= ( count($res) > 0) ? $res[0]['elementosConstructivosAreaParqueo'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="aguaPotable" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_aguapotable"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="aguaPotable" value="<?= ( count($res) > 0) ? $res[0]['elementosConstructivosSistemaAguaPotable'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="sanitario" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_sanitario"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="sanitario" value="<?= ( count($res) > 0) ? $res[0]['elementosConstructivosAlcantarilladoSanitario'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="pluvial" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_pluvial"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="pluvial" value="<?= ( count($res) > 0) ? $res[0]['elementosConstructivosAlcantarilladoPluvial'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="electrico" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_electrico"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="electrico" value="<?= ( count($res) > 0) ? $res[0]['elementosConstructivosSistemaElectrico'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="telefonico" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_telefónico"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="telefonico" value="<?= ( count($res) > 0) ? $res[0]['elementosConstructivosSistemaTelefonico'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="InstalacionesOtros" class="col-sm-3 col-form-label"><?= $vocab["instalaciones_Otros"] ?></label>
                <div class="col-sm-9">
                    <textarea   <?= (!$editar) ? "readonly" : ""; ?> type="text"  class="form-control cambios" id="InstalacionesOtros"><?= ( count($res) > 0) ? $res[0]['elementosConstructivosOtros'] : ""; ?></textarea>                                 
                </div>
            </div>


            <?php if ($editar) { ?>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn  btn-warning  btn-group-justified"  onclick="javascript:guardarDatosInstalaciones('<?=$idCentro?>',0)" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"]?>  <?= $vocab["instalaciones_Titulo"]?></a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn  btn-success btn-group-justified"  onclick="javascript:guardarDatosInstalaciones('<?=$idCentro?>',1)" name="submit"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_save"] . " " . $vocab["datos_generares_siguente"] ?></a>
                    </div>
            
         
            <?php } ?>

        </form>
    </div>
</div>
<script>
//IniciarGuardarCambios();
</script>




