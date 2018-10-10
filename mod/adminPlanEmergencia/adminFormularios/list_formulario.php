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
$sql = "SELECT  id, titulo,FKidSubcapitulos 
        FROM Formulario ORDER BY id";
$res = seleccion($sql);

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
<!-- div original anterior a integración bootstrap3 
<div style=" width: 800px; margin: 0 auto;"  class="ex_highlight_row"> -->
<div class="dataTables_wrapper form-inline dt-bootstrap" >
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
                                        <optgroup label="<?= $cap[$a]['titulo'] ?>">         
                                            <?php
                                            $subcapi = $Cap[$a][0];
                                            if (count($subcapi) > 0) {
                                                for ($j = 0; $j < count($subcapi); $j++) {
                                                    ?>                                      
                                                    <option value="<?= $subcapi[$j]['id']; ?>"  <?= ($subcapi[$j]['id'] == $find_key) ? "selected " : ""; ?> data-tokens="<?= $subcapi[$j]['titulo'] ?>"><?= $subcapi[$j]['titulo'] ?> (<?= $cap[$a]['titulo'] ?>)</option>                         
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


