<?php
/**
 * Lista de las categorias de amenazas
 */
include("../../../login/check.php");
include("../../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

/* * *************************************************************************************** */
//Informacion requerida obtenida de la sesion
$ip = $mySessionController->getVar("cds_domain");
$ip .= $mySessionController->getVar("cds_locate");

$page_cant = $mySessionController->getVar("page_cant");


/* * ********************************************************************************************** */
$sql = "SELECT id,descripcion FROM TipoAmenaza";
$comb = seleccion($sql);


/* * ********************************************************************************************** */
$sql = "SELECT  id, descripcion, isActivo FROM CategoriaTipoAmenaza";

$find_key = '';
if ((isset($_GET['find_key']))) {
    $find_key = $_GET['find_key'];
} else if (count($comb) > 0) {
    $find_key = $comb[0]['id'];
}
if ($find_key != "") {
    $sql .= "  WHERE FKidTipoAmenaza =" . $find_key . "";
}
$res=seleccion($sql);
?>
<!--  ****** Titulo ***** -->
<div class="well well-sm"><h1><?= $vocab["list_categoria_amenaza_title"] ?></h1></div>

<div class="row">
    <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
            <label class="control-label col-sm-2" for="select_tipo_amenaza"><?= $vocab["list_tipo_amenaza_title"] ?></label>
            <div class="col-sm-10">
                <select id="select_tipo_amenaza" name="select_tipo_amenaza" class="form-control" onchange="javascript: cambiarTipoAmenaza();">
                    <?php
                    if (count($comb) > 0) {
                        for ($i = 0; $i < count($comb); $i++) {
                            if ($comb[$i]['id'] == $find_key) {
                                ?>
                                <option value='<?= $comb[$i]['id'] ?>' selected><?= $comb[$i]['descripcion'] ?></option>
                                <?php
                            } else {
                                ?>
                                <option value='<?= $comb[$i]['id'] ?>'><?= $comb[$i]['descripcion'] ?></option>
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
<div class="dataTables_wrapper form-inline dt-bootstrap">
<!--/* * *****************tabla categorias de amenaza*********************************** */-->    
    <table id="lista_usuarios" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable" >
        <thead>
            <tr>
                <th width="10%"><?= $vocab["list_categoria_amenaza_id"] ?></th>
                <th width="50%"><?= $vocab["list_categoria_amenaza_descripcion"] ?></th>    
                <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                    <th width="5%"><?= $vocab["isActivo"] ?></th>
                <?php } ?>
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
                        <td><?= $res[$i]['descripcion'] ?></td>
                        <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                            <?php
                            $active = ($res[$i]['isActivo'] == 1) ? "text-success" : "text-danger";
                            $title = ($res[$i]['isActivo'] == 1) ? $vocab["isActivo"] : $vocab["isInactivo"];
                            ?>
                            <td><a class="puntero" onClick="javascript:active_categoria_amenaza(<?= $res[$i]['id'] . "," . $res[$i]['isActivo'] ?>);"><div class="text-center"><i title =" <?= $title ?>" class="fa fa-circle  <?= $active ?> puntero "></i></div></a></td>
                        <?php } ?>
                        <?php if (check_permiso($mod4, $act1, $user_rol)) { ?>
                            <td>
                                <a class="puntero" onClick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/edit_categoria_amenaza.php?', 'id=<?= $res[$i]["id"] ?>&view_mode=0');">                                     
                                    <div class="text-center">
                                        <i class="fa fa-eye text-primary" title="<?= $vocab["symbol_view"] ?>"></i>
                                    </div>                                  
                                </a>   
                            </td>
                        <?php } ?>
                        <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                            <td>
                                <a class="puntero" onClick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/edit_categoria_amenaza.php?', 'id=<?= $res[$i]["id"] ?>&view_mode=1');">
                                    <div class="text-center">
                                        <i class="fa fa-pencil text-success puntero" title="<?= $vocab["symbol_edit"] ?>"></i>
                                    </div>
                                </a>
                            </td>
                        <?php } ?>
                        <?php if (check_permiso($mod4, $act5, $user_rol)) { ?>
                            <td><a class="puntero" onClick="javascript:delete_categoria_amenaza(<?= $res[$i]['id'] ?>,'<?= $res[$i]['descripcion'] ?>');"><div class="text-center"><i class="fa fa-close text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></a></td>
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
                <th><?= $vocab["list_categoria_amenaza_id"] ?></th>
                <th><?= $vocab["list_categoria_amenaza_descripcion"] ?></th>
                <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                    <th><?= $vocab["isActivo"] ?></th>
                <?php } ?>
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
    <!--/*     * ****************************Agregar nueva categoria************************************* */-->
    <?php if (check_permiso($mod4, $act3, $user_rol)) { ?>
        <div class="text-center"><a class="btn btn-success" name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/new_categoria_amenaza.php?', 'find_key=<?= $find_key ?>');"><i class='fa fa-plus fa-inverse'></i> <?= $vocab["symbol_add"] ?> <?= $vocab["categoria_amenaza_title"] ?></a></div>
    <?php } ?>
</div>

