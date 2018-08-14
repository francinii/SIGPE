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




/* * ********************************************************************************************** */
$start = "0";
$sql = "SELECT  id, descripcion,FKidSubcapitulos 
        FROM FOrmulario ORDER BY id";

$res = seleccion($sql);
?>
<!--  ****** Titulo ***** -->
<div class="well well-sm"><h1><?= $vocab["list_formulario"] ?></h1>
 <p><?= $vocab["formulario_admin_Desc"] ?></p>
 

</div>
<!-- div original anterior a integración bootstrap3 
<div style=" width: 800px; margin: 0 auto;"  class="ex_highlight_row"> -->
<div class="dataTables_wrapper form-inline dt-bootstrap">
    <table id="lista_capitulos" cellpadding="0" cellspacing="0" border="0" class="table  table-bordered " >
        <thead>
            <tr>
                <th  width="10%"><?= $vocab["formulario_id"] ?></th>
                <th width="50%"><?= $vocab["formulario_formulario"] ?></th>                
                <th width="30%"><?= $vocab["formulario_subcapitulo"] ?></th>
                <?php if (check_permiso($mod3, $act4, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-pencil fa-2x text-success puntero" title="<?= $vocab["symbol_edit"] ?>"></i></div></th>
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
                        <td ><a href="#" class="up "><span class="glyphicon glyphicon-triangle-top"></span></a> <a href="#" class="down">&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-triangle-bottom"></span></a></td>
                        <td><?= $res[$i]['titulo'] ?></td>                      
                       
                        <?php if (check_permiso($act2, $act1, $user_rol)) { ?>
                            <td>                      
                                <a class="puntero" onClick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/edit_capitulo.php?', 'id_cap=<?= $res[$i]["id"] ?>&view_mode=0');">                                     
                                    <div class="text-center"><i class="fa fa-eye text-primary" title="<?= $vocab["symbol_view"] ?>"></i></div>                                  
                                </a>                                  
                            </td>
                        <?php } ?>
                        <?php if (check_permiso($act2, $act4, $user_rol)) { ?>
                            <td>                           
                                <a class="puntero"  onClick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/edit_capitulo.php?', 'id_cap=<?= $res[$i]["id"] ?>&view_mode=1');">                                      
                                    <div class="text-center"><i class="fa fa-pencil text-success" title="<?= $vocab["symbol_edit"] ?>"></i></div>                                    
                                </a>
                            </td>
                        <?php } ?>
                        <?php if (check_permiso($act2, $act5, $user_rol)) { ?>
                            <td>              
                                <a class="puntero"  onClick="javascript:delete_capitulo(<?= $res[$i]['id'].",'".$res[$i]['titulo'] ."'"?>);">                                 
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
                <th width="10%"><?= $vocab["formulario_id"] ?></th>
                <th width="50%"><?= $vocab["formulario_formulario"] ?></th>                
                <th width="30%"><?= $vocab["formulario_subcapitulo"] ?></th>             
                <?php if (check_permiso($mod3, $act4, $user_rol)) { ?>
                    <th><div class="text-center"><i class="fa fa-pencil fa-2x text-success puntero" title="<?= $vocab["symbol_edit"] ?>"></i></div></th>
                <?php } ?>               
            </tr>
        </tfoot>
    </table>
    <?php /*     * ***************************************************************************************** */ ?>
    <br/>
    <?php if (check_permiso($mod3, $act3, $user_rol)) { ?>
        <div class="text-center"><a id="boton" class="btn btn-success" name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/new_capitulo.php?', '');"><i class='fa fa-plus fa-inverse'></i> <?= $vocab["symbol_add"] ?> <?= $vocab["add_capitulo"] ?></a></div>
    <?php } ?>   

</div>


