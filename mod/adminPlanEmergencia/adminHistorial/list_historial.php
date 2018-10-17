<?php
/**
 * historial de los palnes de emergencia
 */
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
/* * **************************select para llenar el combo de los centros de trabajo******************** */
if (check_permiso($mod4, $act2, $user_rol)) {
    $sql = "select sede.id as idSede, sede.nombreSede, ZonaTrabajo.id as idZona, ZonaTrabajo.nombreZonaTrabajo from ZonaTrabajo ,(SELECT `id`,`nombreSede`  FROM `Sede` WHERE `isActivo`=1) sede where  ZonaTrabajo.FKidSede = sede.id  and isActivo=1 order by idSede";
} else {
    $sql = "SELECT sede.id as idSede, sede.nombreSede,zona.id as idZona, zona.nombreZonaTrabajo FROM `Sede`,(SELECT `id`, `nombreZonaTrabajo`,`FKidSede` FROM `ZonaTrabajo`,(SELECT `FKidZona` From UsuarioZona where `FKidUsuario` = '$user_id') UsuZona WHERE ZonaTrabajo.id = UsuZona.FKidZona  and isActivo=1) zona  where sede.`id`= zona.FKidSede and isActivo=1 order by idSede";
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
/* * **************************select lista de historiales ******************** */
$sql = "SELECT `id`, `FKidZona`, `version`, `direccion` FROM `Historial`";
$find_keyCentro = '0';
if ((isset($_GET['find_keyCentro']))) {
    $find_keyCentro = $_GET['find_keyCentro'];
} else if (count($centros) > 0) {
    for($i=0;$i<count($centros);$i++){
        
        if($centros[$i]['idSede'] == $find_key){
            $find_keyCentro = $centros[$i]['id'];
            break;
        }
        
    }   
}
if ($find_keyCentro != "") {
    $sql .= "  WHERE  FKidZona =" . $find_keyCentro;
}
$order_key = (isset($_GET['order_key'])) ? $_GET['order_key'] : '';
if ($order_key != "") {
    $sql .= " ORDER BY " . $order_key;
} else {
    $sql .= " ORDER BY id";
}
$res = seleccion($sql);
$capituloNumero = 0;
?>
<!--***** Titulo ***** -->
<div class="well well-sm"><h1><?= $vocab["historial_titulo"] ?></h1>
    <p><?= $vocab["historial_titulo_desc"] ?></p>
</div>

<!-- div original anterior a integración bootstrap3 
<div style=" width: 800px; margin: 0 auto;"  class="ex_highlight_row"> -->

<div class="row">
    <div class=" col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
        <div class="form-group">
            <label class="control-label col-sm-3" for="selectHistorialsede"><?= $vocab["historial_sede"] ?></label>
            
                <div class="col-sm-9">
                    <select id="selectHistorialsede" class="form-control" onchange="javascript: cambiarCentroHistorial();">
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
                </div>
         
        </div>
         <div class="form-group">
            <label class="control-label col-sm-3" for="select_subcapitulos"><?= $vocab["historial_centro"] ?></label>
            
                <div class="col-sm-9">
                     <select id="selectHistorialcentro" class="form-control" onchange="javascript: cambiarHistorial();">
                        <?php
                        if (count($centros) > 0) {
                            for ($i = 0; $i < count($centros); $i++) {
                                if($centros[$i]['idSede']===$find_key){
                                ?>
                                <option <?= ($centros[$i]['id'] == $find_keyCentro) ? "selected" : ""; ?>  value='<?= $centros[$i]['id'] ?>'><?= $centros[$i]['nombreZonaTrabajo'] ?></option>
                                <?php
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
         
        </div>

    </div>
</div>
<br>
<div class="dataTables_wrapper form-inline dt-bootstrap">
    <!--/* * **************************Tabla de historiales ******************** */-->
    <table id="lista_subcapitulos" cellpadding="0" cellspacing="0" border="0" class="table table-bordered " >
        <thead>
            <tr>
                <th width="10%" hidden></th>                

                <th width="50%"><?= $vocab["historial_version"] ?></th>                
                <?php if (check_permiso($mod4, $act1, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-print fa-2x text-warning puntero" title="<?= $vocab["symbol_print"] ?>"></i></div></th>
                <?php } ?>               
                <?php if (check_permiso($mod4, $act5, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($res) > 0) {
                for ($i = 0; $i < count($res); $i++) {
                    ?>
                    <tr id="fila<?= $i ?>"  align='center'>
                        <td hidden><?= $res[$i]['id'] ?></td>                     

                        <td><?= $res[$i]['version'] ?></td>                     
                        <?php if (check_permiso($mod4, $act1, $user_rol)) { ?>
                            <td>                      
                                <a class="puntero" onClick="javascript:imprimierVersion('<?=$res[$i]['direccion']?>');">                                     
                                    <div class="text-center"><i class="fa fa-print text-warning" title="<?= $vocab["symbol_print"] ?>"></i></div>                                  
                                </a>                                  
                            </td>
                        <?php } ?>                       
                        <?php if (check_permiso($mod4, $act5, $user_rol)) { ?>
                            <td>              
                                <a class="puntero"  onClick="javascript:delete_historial(<?= $res[$i]['id']?> ,'<?= $res[$i]['version']?>','<?= $res[$i]['direccion']?>');">                                 
                                    <div class="text-center"><i class="fa fa-close text-danger" title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                                </a>                             
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr id="fila0" align='center'>
                    <td colspan="4"><?= $vocab["symbol_no_data"] ?></td>
                </tr>   
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th hidden></th>           

                <th width="50%"><?= $vocab["historial_version"] ?></th> 

                <?php if (check_permiso($mod4, $act1, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-print fa-2x text-warning puntero" title="<?= $vocab["symbol_print"] ?>"></i></div></th>
                <?php } ?>                
                <?php if (check_permiso($mod4, $act5, $user_rol)) { ?>
                    <th><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                        <?php } ?>
            </tr>
        </tfoot>
    </table>
    <?php /*     * ***************************************************************************************** */ ?>
    <br/>

</div>

