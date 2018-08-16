<?php
/**
 * Lista los roles del sistema, no utilizar este tipo de tablas para los modulos
 */
include("login/check.php");
include("../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
$user_id = $mySessionController->getVar("usuario");
/* * *************************************************************************************** */
//Informacion requerida obtenida de la sesion
$ip = $mySessionController->getVar("cds_domain");
$ip .= $mySessionController->getVar("cds_locate");




/* * ********************************************************************************************** */
$start = "0";
$sql = "SELECT `id`, `nombreZonaTrabajo`FROM `ZonaTrabajo`,(SELECT `FKidZona` From UsuarioZona where `FKidUsuario` = '" . $user_id . "') UsuZona WHERE ZonaTrabajo.id = UsuZona.FKidZona  ";

$res = seleccion($sql);
?>
<!--  ****** Titulo ***** -->
<br/><br/>
<div style="text-align: center;" class=" well-sm">
    <img style="align-items: center;" src="img/logocieuna.png" class="img-rounded" alt="Cinque Terre"> 
    <br/>
    <h1 style="text-align: center;"><?= $vocab["inicio_Bienvenido"] ?></h1>
    <br/>
    <h2 style="text-align: center;"><?= $vocab["inicio_Titulo"] ?></h2>

</div>
<br/>
<!-- div original anterior a integración bootstrap3 
<div style=" width: 800px; margin: 0 auto;"  class="ex_highlight_row"> -->
<div class="container">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">

    </div>
    <div class="col-lg-6 col-md-6 col-sm-9 col-xs-10">
        <form method="post" action="">
            <div class="form-group">
                <h2 style="text-align: center;"><?= $vocab["incio_labe"]  ?></h2>
                <br/>
                <select id="selectInicio" class="form-control">
                    <?php 
                    if (count($res) > 0) {
                        for ($i = 0; $i < count($res); $i++) {               
                                ?>
                                <option value='<?= $res[$i]['id'] ?>' selected><?= $res[$i]['nombreZonaTrabajo'] ?></option>
                                <?php                             
                        }
                    }
                    ?>
                </select>
            </div>
            <br/>
            <br/>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a class="btn btn-success btn-group-justified"  name="submit" > <?= $vocab["inicio_Empezar"] ?></a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a class="btn btn-warning btn-group-justified"  name="submit" ><i class="fa fa-print"></i> <?= $vocab["inicio_Imprimir"] ?></a>
            </div>                
        </form>
        <?php /*         * ***************************************************************************************** */ ?>
        <br/>
    </div>

</div>





