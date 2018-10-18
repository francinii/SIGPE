<?php
/**
 * Lista los formulario del sistema
 */
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

/* * *************************************************************************************** */
//Informacion requerida obtenida de la sesion
$ip = $mySessionController->getVar("cds_domain");
$ip .= $mySessionController->getVar("cds_locate");




/* * ****************************** select formularios del sistema **************************************** */
$start = "0";
$sql = "SELECT  id, titulo,FKidSubcapitulos 
        FROM Formulario where id != 13 ORDER BY id ";
$res = seleccion($sql);

/* * ****************************** select capitulos y subcapitulos del sistema **************************************** */
$sql = "SELECT id,titulo FROM Capitulo WHERE isActivo=1";
$cap = seleccion($sql);
for ($i = 0; $i < count($cap); $i++) {
    $sql = "SELECT id,titulo FROM SubCapitulo WHERE isActivo=1 and FKidCapitulo =" . $cap[$i]['id'];
    $Cap[$i][0] = seleccion($sql);
}
?>
<!--  ****** Titulo ***** -->
<div class="well well-sm"><h1><?= $vocab["list_formulario"] ?></h1>
    <p><?= $vocab["formulario_admin_Desc"] ?></p>


</div>

<div class="dataTables_wrapper form-inline dt-bootstrap" >
    <!--************** tabla de formularios *********************-->
    <table   id="lista_capitulos" cellpadding="0" cellspacing="0" border="0" class="table  table-bordered " >
        <thead>
            <tr>
                <th  width="10%"><?= $vocab["formulario_id"] ?></th>
                <th width="20%"><?= $vocab["formulario_formulario"] ?></th>                
                <th width="40%"><?= $vocab["formulario_subcapitulo"] ?></th>
                <?php if (check_permiso($mod4, $act1, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-eye fa-2x text-primary puntero" title="<?= $vocab["symbol_view"] ?>"></i></div></th>
                <?php } ?>
                <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-pencil fa-2x text-success puntero" title="<?= $vocab["symbol_edit"] ?>"></i></div></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($res) > 0) {
                for ($i = 0; $i < count($res); $i++) {
                    $find_key = $res[$i]['FKidSubcapitulos'];
                    ?>
                    <tr id="fila<?= $i ?>"  align='center'>
                        <td><?= $res[$i]['id'] ?></td>                    
                        <td><?= $res[$i]['titulo'] ?></td> 
                        <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                            <td><select  id="select<?= $res[$i]['id']; ?>"  onchange="javascript:odenarFomulario(<?= $res[$i]['id']; ?>, '<?= $res[$i]['titulo']; ?>')" class="form-control selectpicker" data-live-search="true">
                                    <?php for ($a = 0; $a < count($cap); $a++) { ?>                           
                                        <optgroup label="<?=$a ?>-<?= $cap[$a]['titulo'] ?>">         
                                            <?php
                                            $subcapi = $Cap[$a][0];
                                            if (count($subcapi) > 0) {
                                                for ($j = 0; $j < count($subcapi); $j++) {
                                                    ?>                                      
                                                    <option value="<?= $subcapi[$j]['id']; ?>"  <?= ($subcapi[$j]['id'] == $find_key) ? "selected " : ""; ?> data-tokens="<?=$a ?>.<?=$j+1?>-<?= $subcapi[$j]['titulo'] ?> (<?=$cap[$a]["titulo"]?>)"><?=$a ?>.<?=$j+1?>-<?= $subcapi[$j]['titulo'] ?></option>                         
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </optgroup>
                                    <?php } ?>
                                </select></td>
                        <?php } else { ?>
                            <?php for ($a = 0; $a < count($cap); $a++) { ?>                          
                                <?php
                                $subcapi = $Cap[$a][0];
                                if (count($subcapi) > 0) {
                                    for ($j = 0; $j < count($subcapi); $j++) {

                                        if ($subcapi[$j]['id'] == $find_key) {
                                            ?>
                                            <td><?= $subcapi[$j]['titulo'] ?>(<?= $cap[$a]['titulo'] ?>)</td> 
                                            <?php
                                        }
                                    }
                                }
                                ?>

                            <?php } ?>

                        <?php } ?>
                        <?php if (check_permiso($mod4, $act1, $user_rol)) { ?>
                            <td>                      
                                <a class="puntero" onClick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminFormularios/edit_formulario.php?', 'id_for=<?= $res[$i]["id"] ?>&view_mode=0');">                                     
                                    <div class="text-center"><i class="fa fa-eye text-primary" title="<?= $vocab["symbol_view"] ?>"></i></div>                                  
                                </a>                                  
                            </td>
                        <?php } ?>
                        <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                            <td>                           
                                <a class="puntero"  onClick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminFormularios/edit_formulario.php?', 'id_for=<?= $res[$i]["id"] ?>&view_mode=1');">                                      
                                    <div class="text-center"><i class="fa fa-pencil text-success" title="<?= $vocab["symbol_edit"] ?>"></i></div>                                    
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
                <?php if (check_permiso($mod4, $act1, $user_rol)) { ?>
                    <th><div class="text-center"><i class="fa fa-eye fa-2x text-primary puntero" title="<?= $vocab["symbol_view"] ?>"></i></div></th>
                <?php } ?>
                <?php if (check_permiso($mod4, $act4, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-pencil fa-2x text-success puntero" title="<?= $vocab["symbol_edit"] ?>"></i></div></th>
                        <?php } ?>
            </tr>
        </tfoot>
    </table>
    <?php /*     * ***************************************************************************************** */ ?>
    <br/> 

</div>
<script>
    cargoAdminFormulario();

</script>


