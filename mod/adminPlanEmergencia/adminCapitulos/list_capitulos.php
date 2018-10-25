<?php
/**
 * Lista los capitulos del sistema 
 */
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

/* * *************************************************************************************** */
//Informacion requerida obtenida de la sesion
$ip = $mySessionController->getVar("cds_domain");
$ip .= $mySessionController->getVar("cds_locate");




/* * ****************************selecciona los capitulos *********************************** */
$start = "0";
$sql = "SELECT  id, orden,titulo,isActivo
        FROM Capitulo ORDER BY orden";

$res = seleccion($sql);
?>
<!--  ****** Titulo ***** -->
<div class="well well-sm"><h1><?= $vocab["list_capitulo"] ?></h1></div>
<!--/* * ****************************tabla de capitulos *********************************** */-->
<div class="dataTables_wrapper form-inline dt-bootstrap">
    <table id="lista_capitulos" cellpadding="0" cellspacing="0" border="0" class="table  table-bordered " >
        <thead>
            <tr>
                <th hidden width="10%"><?= $vocab["list_capitulo_id"] ?></th>

                <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                    <th width="10%"><?= $vocab["list_capitulo_orden"] ?></th> 
                <?php } ?> 
                <th width="5%" ><?= $vocab["capitulo_capitulo"] ?></th>
                <th width="50%"><?= $vocab["list_capitulo_title"] ?></th>

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
                        <td hidden><?= $res[$i]['id'] ?></td>
                        <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                            <td ><a href="#" class="up "><span id="up<?= $i ?>" class="glyphicon glyphicon-triangle-top"></span></a> <a href="#" class="down">&nbsp;&nbsp;&nbsp;<span id="down<?= $i ?>" class="glyphicon glyphicon-triangle-bottom"></span></a></td>
                        <?php } ?>
                        <td class="numeroCapitulo"><?= ($i == 0) ? "INICIO" : $i; ?></td>
                        <td><?= $res[$i]['titulo'] ?></td>
                        <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                            <?php
                            $active = ($res[$i]['isActivo'] == 1) ? "text-success" : "text-danger";
                            $title = ($res[$i]['isActivo'] == 1) ? $vocab["isActivo"] : $vocab["isInactivo"];
                            ?>
                            <td><a class="puntero" onClick="javascript:active_capitulo(<?= $res[$i]['id'] . "," . $res[$i]['isActivo'] . ",'" . $res[$i]['titulo'] . "'" ?>);"><div class="text-center"><i title =" <?= $title ?>" class="fa fa-circle  <?= $active ?> puntero "></i></div></a></td>
                        <?php } ?>
                        <?php if (check_permiso($mod4, $act1, $user_rol)) { ?>
                            <td>                      
                                <a class="puntero" onClick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/edit_capitulo.php?', 'id_cap=<?= $res[$i]["id"] ?>&view_mode=0');">                                     
                                    <div class="text-center"><i class="fa fa-eye text-primary" title="<?= $vocab["symbol_view"] ?>"></i></div>                                  
                                </a>                                  
                            </td>
                        <?php } ?>
                        <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                            <td>                           
                                <a class="puntero"  onClick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/edit_capitulo.php?', 'id_cap=<?= $res[$i]["id"] ?>&view_mode=1');">                                      
                                    <div class="text-center"><i class="fa fa-pencil text-success" title="<?= $vocab["symbol_edit"] ?>"></i></div>                                    
                                </a>
                            </td>
                        <?php } ?>
                        <?php if (check_permiso($mod4, $act5, $user_rol)) { ?>
                            <td>              
                                <a class="puntero"  onClick="javascript:delete_capitulo(<?= $res[$i]['id'] . ",'" . $res[$i]['titulo'] . "'" ?>);">                                 
                                    <div class="text-center"><i class="fa fa-close text-danger" title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                                </a>                             
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr id="fila0" align='center'>
                    <td colspan="7"><?= $vocab["symbol_no_data"] ?></td>
                </tr>   
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th hidden width="10%"><?= $vocab["list_capitulo_id"] ?></th>
                <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                    <th width="10%">
                        <a class="btn btn-success" name="submit" onclick="javascript:ordenarCapitulos();"><?= $vocab["symbol_save"] ?> <?= $vocab["list_capitulo_orden"] ?></a>
                    </th> 
                <?php } ?>
                <th width="5%"><?= $vocab["capitulo_capitulo"] ?></th>
                <th width="50%"><?= $vocab["list_capitulo_title"] ?></th>
                <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                    <th width="5%"><?= $vocab["isActivo"] ?></th>
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
    <?php if (check_permiso($mod4, $act3, $user_rol)) { ?>

        <div class="text-center"><a id="boton" class="btn btn-success" name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/new_capitulo.php?', '');"><i class='fa fa-plus fa-inverse'></i> <?= $vocab["symbol_add"] ?> <?= $vocab["add_capitulo"] ?></a></div>
    <?php } ?>   

</div>

<script>
 
    flechasCapitulos();

</script>


