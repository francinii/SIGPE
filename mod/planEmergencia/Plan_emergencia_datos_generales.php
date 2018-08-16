<?php
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
?>
<?php
include("plan_emergencia_menu.php");
?>
<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["datos_generares_Titulo"] ?></h2>
        <p><?= $vocab["datos_generares_Desc"] ?></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-11 col-xs-12">
        <form method="post" action="">
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_nombre"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="staticEmail">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_actividad"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="staticEmail">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_dirección"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="staticEmail">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_contacto"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="staticEmail">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_fax"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="staticEmail">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_Correo"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="staticEmail">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_NFPA"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="staticEmail">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_instalaciones"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="staticEmail">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_Horarios"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="staticEmail">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_Seguridad"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="staticEmail">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_Servicio"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="staticEmail">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_Administrativo"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="staticEmail">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_Académico"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="staticEmail">                                 
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"><?= $vocab["datos_generares_Estudiantil"] ?></label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="staticEmail">                                 
                </div>
            </div>


            <?php if (check_permiso($mod3, $act3, $user_rol)) { ?>
                <div class="text-center"><a class="btn btn-success"  name="submit" onclick="new_capitulo();"><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] . " " . $vocab["capitulo_capitulo"] ?>  </a></div>
            <?php } ?>

        </form>
    </div>
</div>


