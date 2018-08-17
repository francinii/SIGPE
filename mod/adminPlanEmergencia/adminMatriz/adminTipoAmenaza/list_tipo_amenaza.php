<?php
/**
 * Lista los roles del sistema, no utilizar este tipo de tablas para los modulos
 */
include("../../../login/check.php");
include("../../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

/* * *************************************************************************************** */
//Informacion requerida obtenida de la sesion
//$ip = $mySessionController->getVar("cds_domain");
//$ip .= $mySessionController->getVar("cds_locate");
//
//$page_cant = $mySessionController->getVar("page_cant");
//
////
//$sql = "SELECT COUNT(id) AS cant FROM TipoAmenaza";
//
//$find_key = (isset($_GET['find_key'])) ? $_GET['find_key'] : '';
//if ($find_key != "") {
//    $sql .= " WHERE descripcion LIKE  '%" . $find_key . "%'";
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
//$sql = "SELECT  id, descripcion, isActivo, FkidOrigen FROM TipoAmenaza";
//$sql2 = "SELECT  id, descripcion, FROM Origen";

$sql = "SELECT tipo.id, tipo.isActivo, tipo.descripcion, origen.descripcion as origen  FROM
(SELECT  id, descripcion, isActivo, FkidOrigen FROM TipoAmenaza) tipo,
(SELECT  id, descripcion  FROM OrigenAmenaza) origen where tipo.FkidOrigen = origen.id";

//$find_key = (isset($_GET['find_key'])) ? $_GET['find_key'] : '';
//if ($find_key != "") {
//    $sql .= "  WHERE descripcion LIKE '%" . $find_key . "%'";
//}
//
//$order_key = (isset($_GET['order_key'])) ? $_GET['order_key'] : '';
//if ($order_key != "") {
//    $sql .= " ORDER BY " . $order_key;
//} else {
//    $sql .= " ORDER BY id";
//}
//
//$sql .= " limit " . (int) $start . "," . (int) $page_cant . ";";
$res = seleccion($sql);
?>
<!--  ****** Titulo ***** -->
<div class="well well-sm"><h1><?= $vocab["list_tipo_amenaza_title"] ?></h1></div>
<!-- div original anterior a integración bootstrap3 
<div style=" width: 800px; margin: 0 auto;"  class="ex_highlight_row"> -->
<div class="dataTables_wrapper form-inline dt-bootstrap">
    <table id="lista_usuarios" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable" >
        <thead>
            <tr>
                <th width="10%"><?= $vocab["list_tipo_amenaza_id"] ?></th>
                <th width="50%"><?= $vocab["list_tipo_amenaza_descripcion"] ?></th> 
                <th width="10%"><?= $vocab["list_tipo_amenaza_descripcion"] ?></th>
                <th width="5%"><?= $vocab["isActivo"] ?></th>
                <?php if (check_permiso($mod3, $act1, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-eye fa-2x text-primary puntero" title="<?= $vocab["symbol_view"] ?>"></i></div></th>
                <?php } ?>
                <?php if (check_permiso($mod3, $act4, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-pencil fa-2x text-success puntero" title="<?= $vocab["symbol_edit"] ?>"></i></div></th>
                <?php } ?>
                <?php if (check_permiso($mod3, $act5, $user_rol)) { ?>
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
                        <?php if (check_permiso($act2, $act1, $user_rol)) { ?>
                            <td><?= $res[$i]['id'] ?></td>
                            <td><?= $res[$i]['descripcion'] ?></td>
                            <td><?= $res[$i]['origen'] ?></td>
                            <?php
                            $active = ($res[$i]['isActivo'] == 1) ? "text-success" : "text-danger";
                            $title = ($res[$i]['isActivo'] == 1) ? $vocab["isActivo"] : $vocab["isInactivo"];
                            ?>
                            <td><a class="puntero" onClick="javascript:active_tipo_amenaza(<?= $res[$i]['id'] . "," . $res[$i]['isActivo'] ?>);"><div class="text-center"><i title =" <?= $title ?>" class="fa fa-circle  <?= $active ?> puntero "></i></div></a></td>
                        <?php } ?>  
                        <?php if (check_permiso($act2, $act1, $user_rol)) { ?>
                            <td>
                                <a class="puntero" onClick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminTipoAmenaza/edit_tipo_amenaza.php?', 'id=<?= $res[$i]["id"] ?>&view_mode=0');">                                     
                                    <div class="text-center">
                                        <i class="fa fa-eye text-primary" title="<?= $vocab["symbol_view"] ?>"></i>
                                    </div>                                  
                                </a>   
                            </td>
                        <?php } ?>
                        <?php if (check_permiso($mod1, $act4, $user_rol)) { ?>
                            <td>
                                <a class="puntero" onClick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminTipoAmenaza/edit_tipo_amenaza.php?', 'id=<?= $res[$i]["id"] ?>&view_mode=1');">
                                    <div class="text-center">
                                        <i class="fa fa-pencil text-success puntero" title="<?= $vocab["symbol_edit"] ?>"></i>
                                    </div>
                                </a>
                            </td>
                        <?php } ?>
                        <?php if (check_permiso($mod1, $act5, $user_rol)) { ?>
                            <td><a class="puntero" onClick="javascript:delete_tipo_amenaza(<?= $res[$i]['id'] ?>);"><div class="text-center"><i class="fa fa-close text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></a></td>
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
                <th><?= $vocab["list_tipo_amenaza_id"] ?></th>
                <th width="50%"><?= $vocab["list_tipo_amenaza_descripcion"] ?></th>   
                <th width="10%"><?= $vocab["origen_amenaza_title"] ?></th>
                <th width="5%"><?= $vocab["isActivo"] ?></th>                
                <?php if (check_permiso($mod3, $act1, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-eye fa-2x text-primary puntero" title="<?= $vocab["symbol_view"] ?>"></i></div></th>
                <?php } ?>
                <?php if (check_permiso($mod3, $act4, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-pencil fa-2x text-success puntero" title="<?= $vocab["symbol_edit"] ?>"></i></div></th>
                <?php } ?>
                <?php if (check_permiso($mod3, $act5, $user_rol)) { ?>
                    <th><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                <?php } ?>
            </tr>
        </tfoot>
    </table>
    <?php /*     * ***************************************************************************************** */ ?>
    <br/>
    <?php if (check_permiso($mod3, $act3, $user_rol)) { ?>
        <div class="text-center"><a class="btn btn-success" name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminTipoAmenaza/new_tipo_amenaza.php?', '');"><i class='fa fa-plus fa-inverse'></i> <?= $vocab["symbol_add"] ?> <?= $vocab["origen_amenaza_title"] ?></a></div>
    <?php } ?>
</div>

