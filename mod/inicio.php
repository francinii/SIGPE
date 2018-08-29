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
$sql = "SELECT id, nombreSede FROM Sede";
$sede = seleccion($sql);

$start = "0";
if (check_permiso($mod3, $act3, $user_rol)) {
    $sql = "SELECT `id`, `nombreZonaTrabajo`FROM `ZonaTrabajo` WHERE isActivo=1";
}else{ 
    $sql = "SELECT `id`, `nombreZonaTrabajo`FROM `ZonaTrabajo`,(SELECT `FKidZona` From UsuarioZona where `FKidUsuario` = '" . $user_id . "') UsuZona WHERE ZonaTrabajo.id = UsuZona.FKidZona  and isActivo=1";
}
$find_key='0';
if ((isset($_GET['find_key'])) ){
$find_key =$_GET['find_key']; 
}else if (count($sede) > 0){
   $find_key = $sede[0]['id'];
}
if ($find_key != "") {    
    $sql .= " and  FKidSede =" . $find_key;
}
$order_key = (isset($_GET['order_key'])) ? $_GET['order_key'] : '';
if ($order_key != "") {
    $sql .= " ORDER BY " . $order_key;
} else {
    $sql .= " ORDER BY id";
}
//$sql .= " limit " . (int) $start . "," . (int) $page_cant . ";";
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
                <h3 style="text-align: center;"><?= $vocab["zona_trabajo_sede"] ?></h3>
                <select id="selectIniciosede" class="form-control" onchange="javascript: cambiarCentroInicio();">
                    <?php 
                    if (count($sede) > 0) {
                        for ($i = 0; $i < count($sede); $i++) {               
                                ?>
                                <option  <?= ($sede[$i]['id']==$find_key) ? "selected " : ""; ?> value='<?= $sede[$i]['id'] ?>'><?= $sede[$i]['nombreSede'] ?></option>
                                <?php                             
                        }
                    }
                    ?>
                </select>
            </div>
             <div class="form-group">                
                <h3 style="text-align: center;"><?= $vocab["zona_trabajo_title"] ?></h3>
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
                <a class="btn btn-success btn-group-justified" onclick="javascript:OpcionInicio();" name="submit" > <?= $vocab["inicio_Empezar"] ?></a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a class="btn btn-warning btn-group-justified"  name="submit" ><i class="fa fa-print"></i> <?= $vocab["inicio_Imprimir"] ?></a>
            </div>                
        </form>
        <?php /*         * ***************************************************************************************** */ ?>
        <br/>
    </div>

</div>





