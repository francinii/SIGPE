<?php
/**
 * Lista los roles del sistema, no utilizar este tipo de tablas para los modulos
 */
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

/* * *************************************************************************************** */
//Informacion requerida obtenida de la sesion
$ip = $mySessionController->getVar("cds_domain");
$ip .= $mySessionController->getVar("cds_locate");

$page_cant = $mySessionController->getVar("page_cant");

//
//$sql = "SELECT COUNT(id) AS cant
//        FROM ZonaTrabajo";
//
//$find_key = (isset($_GET['find_key'])) ? $_GET['find_key'] : '';
//if ($find_key != "") {
//    $sql .= " WHERE roll_name LIKE  '%" . $find_key . "%'";
//}
//$sql .= ";";
//$res_cant = seleccion($sql);
//
//$cant_pagi = ceil((int) $res_cant[0]['cant'] / (int) $page_cant);
//$page = (isset($_GET["page"])) ? $_GET["page"] : "1";
//if (!$page) {
//    $start = 0;
//    $page = 1;
//} else {
//    $start = (isset($_GET["start"])) ? $_GET["start"] : "0";
//}

/* * ********************************************************************************************** */
$sql = "SELECT id, nombreSede FROM Sede where isActivo=1";
$comb = seleccion($sql);




$sql = "SELECT  id, nombreZonaTrabajo FROM ZonaTrabajo";

$find_key='0';
if ((isset($_GET['find_key'])) ){
$find_key =$_GET['find_key']; 
}else if (count($comb) > 0){
   $find_key = $comb[0]['id'];
}
if ($find_key != "") {    
    $sql .= "  WHERE  FKidSede =" . $find_key;
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
<div class="well well-sm"><h1><?= $vocab["list_zona_trabajo_title"] ?></h1></div>
<div class="row">
    <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
            <label class="control-label col-sm-2" for="select_sede"><?= $vocab["zona_trabajo_sede"] ?></label>
            <div class="col-sm-10">
                <select id="select_sede" name="select_sede" class="form-control" onchange="javascript: cambiarCentro();">
                 <?php
                   
                 if (count($comb) > 0) {
                     for ($i = 0; $i < count($comb); $i++) {
                          ?>
                    <option  <?= ($comb[$i]['id']==$find_key) ? "selected " : ""; ?> value='<?= $comb[$i]['id'] ?>' ><?= $comb[$i]['nombreSede'] ?></option>
                            
                 <?php
                  
                     }
                }
                 ?>
                   
                </select>
            </div>
        </div>


    </div>
</div>
<div class="dataTables_wrapper form-inline dt-bootstrap">
    <table id="lista_usuarios" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable" >
        <thead>
            <tr>
                <th width="10%"><?= $vocab["list_zona_trabajo_id"] ?></th>
                <th width="50%"><?= $vocab["list_zona_trabajo_descripcion"] ?></th>              
                <?php if (check_permiso($mod4, $act1, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-eye fa-2x text-primary puntero" title="<?= $vocab["symbol_view"] ?>"></i></div></th>
                <?php } ?>
                <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-pencil fa-2x text-success puntero" title="<?= $vocab["symbol_edit"] ?>"></i></div></th>
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
                            <td><?= $res[$i]['id'] ?></td>
                            <td><?= $res[$i]['nombreZonaTrabajo'] ?></td>                       
                        <?php if (check_permiso($mod4, $act1, $user_rol)) { ?>
                            <td>
                                <a class="puntero" onClick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/edit_zona_trabajo.php?', 'id=<?= $res[$i]["id"] ?>&view_mode=0');">                                     
                                    <div class="text-center"><i class="fa fa-eye text-primary" title="<?= $vocab["symbol_view"] ?>"></i></div>                                  
                                </a>   
                            </td>
                        <?php } ?>
                        <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                            <td><a class="puntero" onClick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/edit_zona_trabajo.php?', 'id=<?= $res[$i]["id"] ?>&view_mode=1');"><div class="text-center"><i class="fa fa-pencil text-success puntero" title="<?= $vocab["symbol_edit"] ?>"></i></div></a></td>
                        <?php } ?>

                        <?php if (check_permiso($mod4, $act5, $user_rol)) { ?>
                            <td><a class="puntero" onClick="javascript:delete_zona_trabajo(<?= $res[$i]['id'] ?>);"><div class="text-center"><i class="fa fa-close text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></a></td>
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
                <th><?= $vocab["list_zona_trabajo_id"] ?></th>
                <th><?= $vocab["list_zona_trabajo_descripcion"] ?></th>
                <?php if (check_permiso($mod4, $act1, $user_rol)) { ?>
                    <th><div class="text-center"><i class="fa fa-eye fa-2x text-primary puntero" title="<?= $vocab["symbol_view"] ?>"></i></div></th>
                <?php } ?>
                <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                    <th><div class="text-center"><i class="fa fa-pencil fa-2x text-success puntero" title="<?= $vocab["symbol_edit"] ?>"></i></div></th>
                <?php } ?>
                <?php if (check_permiso($mod4, $act5, $user_rol)) { ?>
                    <th><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                <?php } ?>
            </tr>
        </tfoot>
    </table>
    <?php /*     * ***************************************************************************************** */ ?>
    <br/>
    <?php if (check_permiso($mod4, $act3, $user_rol)) { ?>
        <div class="text-center"><a class="btn btn-success" name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/new_zona_trabajo.php?', '');"><i class='fa fa-plus fa-inverse'></i> <?= $vocab["symbol_add"] ?> <?= $vocab["zona_trabajo_title"] ?></a></div>
    <?php } ?>
</div>

