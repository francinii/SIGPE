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
$sql = "SELECT COUNT(id) AS cant
        FROM capitulo";

$find_key = (isset($_GET['find_key'])) ? $_GET['find_key'] : '';
if ($find_key != "") {
    $sql.=" WHERE titulo LIKE  '%" . $find_key . "%'";
}
$sql.=";";
$res_cant = seleccion($sql);

$cant_pagi = ceil((int) $res_cant[0]['cant'] / (int) $page_cant);
$page = (isset($_GET["page"])) ? $_GET["page"] : "1";
if (!$page) {
    $start = 0;
    $page = 1;
} else {
    $start = (isset($_GET["start"])) ? $_GET["start"] : "0";
}

/* * ********************************************************************************************** */
$sql = "SELECT  id, orden,titulo
        FROM capitulo";

$find_key = (isset($_GET['find_key'])) ? $_GET['find_key'] : '';
if ($find_key != "") {
    $sql.="  WHERE titulo LIKE '%" . $find_key . "%'";
}

$order_key = (isset($_GET['order_key'])) ? $_GET['order_key'] : '';
if ($order_key != "") {
    $sql.=" ORDER BY " . $order_key;
} else {
    $sql.=" ORDER BY id";
}

$sql.=" limit " . (int) $start . "," . (int) $page_cant . ";";
$res = seleccion($sql);


?>
<!--  ****** Titulo ***** -->
<div class="well well-sm"><h1><?= $vocab["list_capitulo"] ?></h1></div>
<!-- div original anterior a integración bootstrap3 
<div style=" width: 800px; margin: 0 auto;"  class="ex_highlight_row"> -->
<div class="dataTables_wrapper form-inline dt-bootstrap">
    <table id="lista_usuarios" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered " >
        <thead>
            <tr>
                <th width="10%"><?= $vocab["list_capitulo_id"] ?></th>
                <th width="50%"><?= $vocab["list_capitulo_order"] ?></th>
                <th width="50%"><?= $vocab["list_capitulo_title"] ?></th> 
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
                            <td><?= $res[$i]['id'] ?></td>
                            <td><?= $res[$i]['orden'] ?></td>
                            <td><?= $res[$i]['titulo'] ?></td>
                            <?php if (check_permiso($act2, $act1, $user_rol)) { ?>
                                <td>
                                    <?php if ($res[$i]['id'] != 1) { ?>
                                        <a class="puntero" onClick="javascript:OpcionMenu('mod/admin/rolls/edit_roll.php?', 'id_roll=<?= $res[$i]["id"] ?>&view_mode=0');">
                                        <?php } else { ?>
                                            <a style="cursor: not-allowed; ">
                                        <?php }?>
                                        <div class="text-center"><i class="fa fa-eye text-primary" title="<?= $vocab["symbol_view"] ?>"></i></div>
                                        <?php if ($res[$i]['id'] != 1) { ?>
                                        </a>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                            <?php if (check_permiso($act2, $act4, $user_rol)) { ?>
                                <td>
                                    <?php if ($res[$i]['id'] != 1) { ?>
                                        <a class="puntero" " onClick="javascript:OpcionMenu('mod/admin/rolls/edit_roll.php?', 'id_roll=<?= $res[$i]["id_roll"] ?>&view_mode=1');">
                                        <?php } else { ?>
                                            <a style="cursor: not-allowed; ">
                                        <?php }?>
                                        <div class="text-center"><i class="fa fa-pencil text-success" title="<?= $vocab["symbol_edit"] ?>"></i></div>
                                        <?php if ($res[$i]['id'] != 1) { ?>
                                        </a>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                            <?php if (check_permiso($act2, $act5, $user_rol)) { ?>
                                <td>
                                    <?php if ($res[$i]['id'] != 1) { ?>
                                        <a class="puntero"  onClick="javascript:delete_roll(<?= $res[$i]['id'] ?>);">
                                        <?php } else { ?>
                                            <a style="cursor: not-allowed; ">
                                        <?php }?>
                                        <div class="text-center"><i class="fa fa-close text-danger" title="<?= $vocab["symbol_delete"] ?>"></i></div>
                                        <?php if ($res[$i]['id'] != 1) { ?>
                                        </a>
                                    <?php } ?>
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
                <th><?= $vocab["list_capitulo_id"] ?></th>
                <th><input type="text" name="nombre_search" id="nombre_search" value="<?= $vocab["symbol_name"] ?>" class="search_init" /></th>
               <th width="50%"><?= $vocab["list_capitulo_title"] ?></th> 
                <?php if (check_permiso($mod3, $act1, $user_rol)) { ?>
                    <th><div class="text-center"><i class="fa fa-eye fa-2x text-primary puntero" title="<?= $vocab["symbol_view"] ?>"></i></div></th>
                <?php } ?>
                <?php if (check_permiso($mod3, $act4, $user_rol)) { ?>
                    <th><div class="text-center"><i class="fa fa-pencil fa-2x text-success puntero" title="<?= $vocab["symbol_edit"] ?>"></i></div></th>
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
    <div class="text-center"><a class="btn btn-success" name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/new_capitulo.php?', '');"><i class='fa fa-plus fa-inverse'></i> <?= $vocab["symbol_add"] ?> <?= $vocab["add_capitulo"] ?></a></div>
    <?php } ?>   
    
</div>


