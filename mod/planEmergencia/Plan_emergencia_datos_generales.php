<?php
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
$idCentro= $_GET['idCentro'];
$nombreCentro= $_GET['nombreCentro'];
?>
<?php
include("plan_emergencia_menu.php");
?>
<script>
document.getElementById("tituloGeneral").innerHTML="<?=$nombreCentro?>";
</script>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["datos_generares_Titulo"] ?></h2>
        <p><?= $vocab["datos_generares_Desc"] ?></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-11 col-xs-12">
        <form method="post" action="">
            <div class="form-group row">
                <label for="institucion" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_nombre"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="institucion">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="actividad" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_actividad"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="actividad">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="direccion" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_dirección"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="direccion">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="conctacto_general" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_contacto"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="conctacto_general">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="fax" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_fax"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="fax">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_Correo"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="email">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="NFPA" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_NFPA"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="NFPA">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="uso" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_instalaciones"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="uso">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="horarios" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_Horarios"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="horarios">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="seguridad" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_Seguridad"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="seguridad">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="servicio" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_Servicio"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="servicio">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="administracion" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_Administrativo"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="administracion">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="academico" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_Académico"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="academico">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="estudiantil" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_Estudiantil"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="staticEmail">                                 
                </div>
            </div>


            <?php if (check_permiso($mod3, $act3, $user_rol)) { ?>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn  btn-warning  btn-group-justified"  onclick="javascript:guardarDatosGenerales('<?=$idCentro?>')" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"]?></a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn  btn-success btn-group-justified"  name="submit"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_save"] . " " . $vocab["datos_generares_siguente"] ?></a>
                    </div>
            
         
            <?php } ?>

        </form>
    </div>
</div>


