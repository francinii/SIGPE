<?php
/**
 * Lista los tipos de amenaza
 */
include("../../../login/check.php");
include("../../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

/* * ************************ seleciona los tipo de amenaza ********************************** */


$sql = "SELECT tipo.id, tipo.isActivo, tipo.descripcion, origen.descripcion as origen  FROM
(SELECT  id, descripcion, isActivo, FkidOrigen FROM TipoAmenaza) tipo,
(SELECT  id, descripcion  FROM OrigenAmenaza) origen where tipo.FkidOrigen = origen.id";
$res = seleccion($sql);
?>
<!--  ****** Titulo ***** -->
<div class="well well-sm"><h1><?= $vocab["list_tipo_amenaza_title"] ?></h1></div>
<!-- div original anterior a integración bootstrap3 
<div style=" width: 800px; margin: 0 auto;"  class="ex_highlight_row"> -->
<div class="dataTables_wrapper form-inline dt-bootstrap">
    <!--/* * ************************ Tabla los tipo de amenaza ********************************** */-->
    <table id="lista_usuarios" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable" >
        <thead>
            <tr>
                <th width="10%"><?= $vocab["list_tipo_amenaza_id"] ?></th>
                <th width="45%"><?= $vocab["list_tipo_amenaza_descripcion"] ?></th> 
                <th width="15%"><?= $vocab["origen_amenaza_title"] ?></th>
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
                        <td><?= $res[$i]['origen'] ?></td>
                        <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                            <?php
                            $active = ($res[$i]['isActivo'] == 1) ? "text-success" : "text-danger";
                            $title = ($res[$i]['isActivo'] == 1) ? $vocab["isActivo"] : $vocab["isInactivo"];
                            ?>
                            <td><a class="puntero" onClick="javascript:active_tipo_amenaza(<?= $res[$i]['id'] . "," . $res[$i]['isActivo'] ?>);"><div class="text-center"><i title =" <?= $title ?>" class="fa fa-circle  <?= $active ?> puntero "></i></div></a></td>
                        <?php } ?>  
                        <?php if (check_permiso($mod4, $act1, $user_rol)) { ?>
                            <td>
                                <a class="puntero" onClick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminTipoAmenaza/edit_tipo_amenaza.php?', 'id=<?= $res[$i]["id"] ?>&view_mode=0');">                                     
                                    <div class="text-center">
                                        <i class="fa fa-eye text-primary" title="<?= $vocab["symbol_view"] ?>"></i>
                                    </div>                                  
                                </a>   
                            </td>
                        <?php } ?>
                        <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                            <td>
                                <a class="puntero" onClick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminTipoAmenaza/edit_tipo_amenaza.php?', 'id=<?= $res[$i]["id"] ?>&view_mode=1');">
                                    <div class="text-center">
                                        <i class="fa fa-pencil text-success puntero" title="<?= $vocab["symbol_edit"] ?>"></i>
                                    </div>
                                </a>
                            </td>
                        <?php } ?>
                        <?php if (check_permiso($mod4, $act5, $user_rol)) { ?>
                            <td><a class="puntero" onClick="javascript:delete_tipo_amenaza(<?= $res[$i]['id'] ?>,'<?= $res[$i]['descripcion'] ?>');"><div class="text-center"><i class="fa fa-close text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></a></td>
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
                <th width="45%"><?= $vocab["list_tipo_amenaza_descripcion"] ?></th>   
                <th width="15%"><?= $vocab["origen_amenaza_title"] ?></th>
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
                    <th><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                <?php } ?>
            </tr>
        </tfoot>
    </table>
    <?php /*     * ***************************************************************************************** */ ?>
    <br/>
     <?php /*     * **************************Agrega uno tipo de amenaza ********************************* */ ?>
    <?php if (check_permiso($mod4, $act3, $user_rol)) { ?>
        <div class="text-center"><a class="btn btn-success" name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminTipoAmenaza/new_tipo_amenaza.php?', '');"><i class='fa fa-plus fa-inverse'></i> <?= $vocab["symbol_add"] ?> <?= $vocab["tipo_amenaza_title"] ?></a></div>
    <?php } ?>
</div>

