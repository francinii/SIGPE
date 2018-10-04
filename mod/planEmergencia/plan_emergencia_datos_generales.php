<?php
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

include("plan_emergencia_menu.php");
$sql = "SELECT `actividad`,`direccion`,`personaContactoGeneral`,`numeroTelefono`,`numeroFax`,`correo`,`categoriaNFPA`,"
        . "`usoInstalaciones`,`horarioJornada`,`seguridadInstitucional`,`servicioConsegeria`,`personalAdministrativo`,"
        . "`personalAcademico`, `presenciaEstudiantil` from ZonaTrabajo WHERE `id`=".$idCentro;
$res = seleccion($sql);

?>

<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["datos_generares_Titulo"] ?></h2>
        <p><?= $vocab["datos_generares_Desc"] ?></p>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
        <form method="post" action="">
            <div class="form-group row">
                <label for="institucion" class="col-sm-3 col-form-label"><?= $vocab["datos_generares_nombre"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  class="form-control cambios" id="institucion" readonly value="<?=$nombreCentro ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="actividad" class="col-sm-3 col-form-label"><?= $vocab["datos_generares_actividad"] ?></label>
                <div class="col-sm-9">
                    <input type="text"   <?= (!$editar) ? "readonly" : ""; ?>  class="form-control cambios" id="actividad" value="<?= ( count($res) > 0) ? $res[0]['actividad'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="direccion" class="col-sm-3 col-form-label"><?= $vocab["datos_generares_dirección"] ?></label>
                <div class="col-sm-9">
                    <input type="text" <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="direccion" value="<?= ( count($res) > 0) ? $res[0]['direccion'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="conctacto_general" class="col-sm-3 col-form-label"><?= $vocab["datos_generares_contacto"] ?></label>
                <div class="col-sm-9">
                    <input type="text" <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="conctacto_general" value="<?= ( count($res) > 0) ? $res[0]['personaContactoGeneral'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="telefono" class="col-sm-3 col-form-label"><?= $vocab["datos_generares_teléfono"] ?></label>
                <div class="col-sm-9">
                    <input type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control cambios" id="telefono" value="<?= ( count($res) > 0) ? $res[0]['numeroTelefono'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="fax" class="col-sm-3 col-form-label"><?= $vocab["datos_generares_fax"] ?></label>
                <div class="col-sm-9">
                    <input type="text" <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="fax" value="<?= ( count($res) > 0) ? $res[0]['numeroFax'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label"><?= $vocab["datos_generares_Correo"] ?></label>
                <div class="col-sm-9">
                    <input type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="email" value="<?= ( count($res) > 0) ? $res[0]['correo'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="NFPA" class="col-sm-3 col-form-label"><?= $vocab["datos_generares_NFPA"] ?></label>
                <div class="col-sm-9">
                    <input type="text" <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="NFPA" value="<?= ( count($res) > 0) ? $res[0]['categoriaNFPA'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="uso" class="col-sm-3 col-form-label"><?= $vocab["datos_generares_instalaciones"] ?></label>
                <div class="col-sm-9">
                    <input type="text" <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="uso" value="<?= ( count($res) > 0) ? $res[0]['usoInstalaciones'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="horarios" class="col-sm-3 col-form-label"><?= $vocab["datos_generares_Horarios"] ?></label>
                <div class="col-sm-9">
                    <input type="text" <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="horarios" value="<?= ( count($res) > 0) ? $res[0]['horarioJornada'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="seguridad" class="col-sm-3 col-form-label"><?= $vocab["datos_generares_Seguridad"] ?></label>
                <div class="col-sm-9">
                    <input type="text" <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="seguridad" value="<?= ( count($res) > 0) ? $res[0]['seguridadInstitucional'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="servicio" class="col-sm-3 col-form-label"><?= $vocab["datos_generares_Servicio"] ?></label>
                <div class="col-sm-9">
                    <input type="text" <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="servicio" value="<?= ( count($res) > 0) ? $res[0]['servicioConsegeria'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="administracion" class="col-sm-3 col-form-label"><?= $vocab["datos_generares_Administrativo"] ?></label>
                <div class="col-sm-9">
                    <input type="text" <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="administracion" value="<?= ( count($res) > 0) ? $res[0]['personalAdministrativo'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="academico" class="col-sm-3 col-form-label"><?= $vocab["datos_generares_Académico"] ?></label>
                <div class="col-sm-9">
                    <input type="text" <?= (!$editar) ? "readonly" : ""; ?> class="form-control cambios" id="academico" value="<?= ( count($res) > 0) ? $res[0]['personalAcademico'] : ""; ?>">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="estudiantil" class="col-sm-3 col-form-label"><?= $vocab["datos_generares_Estudiantil"] ?></label>
                <div class="col-sm-9">
                    <input type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control cambios" id="estudiantil" value="<?= ( count($res) > 0) ? $res[0]['presenciaEstudiantil'] : ""; ?>">                                 
                </div>
            </div>


            <?php if ($editar) { ?>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn  btn-warning  btn-group-justified"  onclick="javascript:guardarDatosGenerales('<?=$idPlanEmergencia?>',0)" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"]?> <?= $vocab["datos_generares_Titulo"]?></a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn  btn-success btn-group-justified"  onclick="javascript:guardarDatosGenerales('<?=$idPlanEmergencia?>',1)" name="submit"><i class="fa fa-rotate-right"></i> <?= $vocab["symbol_save"] . " " . $vocab["datos_generares_siguente"] ?></a>
                    </div>
            
         
            <?php } ?>

        </form>
    </div>
</div>



