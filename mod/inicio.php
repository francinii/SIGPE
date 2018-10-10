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
if (check_permiso($mod4, $act2, $user_rol)) {
    $sql = "select sede.id as idSede, sede.nombreSede, ZonaTrabajo.id as idZona, ZonaTrabajo.nombreZonaTrabajo from ZonaTrabajo ,(SELECT `id`,`nombreSede`  FROM `Sede` WHERE `isActivo`=1) sede where  ZonaTrabajo.FKidSede = sede.id  and isActivo=1 order by idSede";
} else {
    $sql = "SELECT Sede.id as idSede, Sede.nombreSede,zona.id as idZona, zona.nombreZonaTrabajo FROM `Sede`,(SELECT `id`, `nombreZonaTrabajo`,`FKidSede` FROM `ZonaTrabajo`,(SELECT `FKidZona` From UsuarioZona where `FKidUsuario` = '$user_id') UsuZona WHERE ZonaTrabajo.id = UsuZona.FKidZona  and isActivo=1) zona  where Sede.`id`= zona.FKidSede and isActivo=1 order by idSede";
}
$res = seleccion($sql);
$sedes = Array();
$sedeId;
$centros = Array();
$find_key;
if (count($res) > 0) {
    $sedeId = $res[0]['idSede'];
    if (isset($_GET['find_key'])) {
        $find_key = $_GET['find_key'];
    } else {
        $find_key = $res[0]['idSede'];
    }
    $sede = Array('id' => $res[0]['idSede'], 'nombreSede' => $res[0]['nombreSede']);
    $sedes[] = $sede;
}
foreach ($res as $value) {
    if ($sedeId != $value['idSede']) {
        $sede = Array('id' => $value['idSede'], 'nombreSede' => $value['nombreSede']);
        $sedes [] = $sede;
        $sedeId = $value['idSede'];
    }

    $centro = Array('id' => $value['idZona'], 'nombreZonaTrabajo' => $value['nombreZonaTrabajo'], 'idSede' => $sedeId);
    $centros[] = $centro;
}
?>
<!--  ****** Titulo ***** -->
<br/><br/>
<div style="text-align: center;" class=" well-sm">
    <div class="row" align="center">
        <div  style="align-items: center; width:60%">
            <img  style="align-items: center; width:100%"  src="img/logocieuna.png" class="img-rounded" alt="Cinque Terre"> 
        </div>
    </div>
    <br/>
    <h1 style="text-align: center;"><?= $vocab["inicio_Bienvenido"] ?></h1>
    <br/>
    <h2 style="text-align: center;"><?= $vocab["inicio_Titulo"] ?></h2>

</div>
<br/>
<!-- div original anterior a integración bootstrap3 
<div style=" width: 800px; margin: 0 auto;"  class="ex_highlight_row"> -->

<div  style="text-align: center;" >
    <form method="post" action="">
        <h2 style="text-align: center;"><?= $vocab["incio_labe"] ?></h2>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <div class="form-group">
                <br/>
                <?php if (check_permiso($mod5, $act1, $user_rol) || check_permiso($mod5, $act2, $user_rol)) { ?>
                    <h3 style="text-align: center;"><?= $vocab["zona_trabajo_sede"] ?></h3>

                    <select id="selectIniciosede" class="form-control" onchange="javascript: cambiarCentroInicio();">
                        <?php
                        if (count($sede) > 0) {
                            for ($i = 0; $i < count($sedes); $i++) {
                                ?>

                                <option  <?= ($sedes[$i]['id'] == $find_key) ? "selected " : ""; ?> value='<?= $sedes[$i]['id'] ?>'><?= $sedes[$i]['nombreSede'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                <?php } ?>
            </div>
            <?php if (check_permiso($mod5, $act1, $user_rol) || check_permiso($mod5, $act2, $user_rol)) { ?>
                <div class="form-group">                
                    <h3 style="text-align: center;"><?= $vocab["zona_trabajo_title"] ?></h3>
                    <select id="selectInicio" class="form-control">
                        <?php
                        if (count($centros) > 0) {
                            for ($i = 0; $i < count($centros); $i++) {
                                if ($centros[$i]['idSede'] === $find_key) {
                                    ?>
                                    <option value='<?= $centros[$i]['id'] ?>' selected><?= $centros[$i]['nombreZonaTrabajo'] ?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            <?php } ?>
            <br/>
            <br/>

            <div style="margin-bottom:1%" class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <?php if (check_permiso($mod5, $act1, $user_rol) || check_permiso($mod5, $act2, $user_rol)) { ?>
                    <a class="btn btn-success btn-group-justified" onclick="javascript:OpcionInicio(0);" name="submit" > <?= $vocab["inicio_Empezar"] ?></a>
                <?php } ?>
            </div>

            <div style="margin-bottom:1%" class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <?php if (check_permiso($mod4, $act3, $user_rol) && check_permiso($mod4, $act4, $user_rol) && check_permiso($mod4, $act5, $user_rol)) { ?>
                    <a class="btn btn-info btn-group-justified" onclick="javascript:nuevaVersionPlan();" name="submit" ><?= $vocab["inicio_Nueva_version"] ?></a>
                <?php } ?>
            </div>
            <div style="margin-bottom:1%" class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <?php if (check_permiso($mod4, $act6, $user_rol)) { ?>
                    <a class="btn btn-warning btn-group-justified" onclick="javascript:OpcionInicio(2);"
                       name="" ><i class="fa fa-print"></i> <?= $vocab["inicio_Imprimir"] ?></a>
                   <?php } else if (check_permiso($mod5, $act6, $user_rol)) { ?>
                    <a class="btn btn-warning btn-group-justified" onclick="javascript:OpcionInicio(1);"
                       name="" ><i class="fa fa-print"></i> <?= $vocab["inicio_Imprimir"] ?></a>

                <?php } ?>
            </div> 
        </div> 
    </form>
    <?php /*     * ***************************************************************************************** */ ?>
    <br/>
</div>







