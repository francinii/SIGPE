<?php
/** Develop Info
 * IMPORTANTE !!!
 *    Utilice este archivo como ejemplo para crear las tablas de nuevos modulos.
 * 
 * Este archivo genera una tabla utilizando la libreria DataTables,
 * para esto necesitamos 3 componentes principales:
 *  1. El origen de los datos: es otro archivo php que nos traer un JSON con los
 *      datos para mostrar, Data Tables controla la paginación, navegación, busqueda
 *      y el orden.  Para más información 
 *  2. La inicialización de la tabla
 *  3. La estructura de la tabla en HTML
 * 
 */
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

/* * *************************************************************************************** */
//Informacion requerida obtenida de la sesion
$ip = $mySessionController->getVar("cds_domain");
$ip .= $mySessionController->getVar("cds_locate");


// para realizar la busqueda
//$sql = "SELECT COUNT(idCapitulo) AS cant
//        FROM capitulo";
//
//$find_key = (isset($_GET['find_key'])) ? $_GET['find_key'] : '';
//if ($find_key != "") {
//    $sql.=" WHERE titulo LIKE  '%" . $find_key . "%'";
//}
//$sql.=";";
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
$start = "0";


// select para llenar el combo
$sql = "SELECT id,titulo FROM capitulo";


$order_key = (isset($_GET['order_key'])) ? $_GET['order_key'] : 'orden';
if ($order_key != "") {
    $sql .= " ORDER BY " . $order_key;
} else {
    $sql .= " ORDER BY id";
}


$comb = seleccion($sql);

// select lista
$sql = "SELECT  id, orden,titulo,isActivo
        FROM subcapitulo";
$find_key='0';
if ((isset($_GET['find_key'])) ){
$find_key =$_GET['find_key']; 
}else if (count($comb) > 0){
   $find_key = $comb[0]['id'];
}
if ($find_key != "") {    
    $sql .= "  WHERE FKidCapitulo =" . $find_key;
}
$order_key = (isset($_GET['order_key'])) ? $_GET['order_key'] : '';
if ($order_key != "") {
    $sql .= " ORDER BY " . $order_key;
} else {
    $sql .= " ORDER BY orden";
}
$res = seleccion($sql);

?>
<!--***** Titulo ***** -->
<div class="well well-sm"><h1><?= $vocab["list_subcapitulo"] ?></h1></div>

<!-- div original anterior a integración bootstrap3 
<div style=" width: 800px; margin: 0 auto;"  class="ex_highlight_row"> -->

<div class="row">
    <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
            <label class="control-label col-sm-2" for="select_capitulos"><?= $vocab["subcapitulo_capitulo"] ?></label>
            <div class="col-sm-10">
                <select id="select_capitulos" name="select_capitulos" class="form-control" onchange="javascript: cambiarSubcapitulos();">
                 <?php
                   
                 if (count($comb) > 0) {
                     for ($i = 0; $i < count($comb); $i++) {
                          ?>
                    <option  <?= ($comb[$i]['id']==$find_key) ? "selected " : ""; ?> value='<?= $comb[$i]['id'] ?>' ><?= $comb[$i]['titulo'] ?></option>
                            
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
    <table id="lista_subcapitulos" cellpadding="0" cellspacing="0" border="0" class="table table-bordered " >
        <thead>
            <tr>
                <th width="10%" hidden><?= $vocab["list_subcapitulo_id"] ?></th>
                <th width="10%"><?= $vocab["list_subcapitulo_orden"] ?></th> 
                <th width="50%"><?= $vocab["list_subcapitulo_title"] ?></th>
               <?php if (check_permiso($mod3, $act4, $user_rol)) { ?>
                 <th width="5%"><?= $vocab["isActivo"] ?></th>
                 <?php } ?>
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
                        <td hidden><?= $res[$i]['id'] ?></td>
                        <td><a href="#" class="up "><span class="glyphicon glyphicon-triangle-top"></span></a> <a href="#" class="down">&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-triangle-bottom"></span></a></td>

                        <td><?= $res[$i]['titulo'] ?></td>
                        
                         <?php
                            $active = ($res[$i]['isActivo'] == 1) ? "text-success" : "text-danger";
                            $title = ($res[$i]['isActivo'] == 1) ? $vocab["isActivo"] : $vocab["isInactivo"];
                            ?>
                            <td><a class="puntero" onClick="javascript:active_subcapitulo(<?= $res[$i]['id'] . "," . $res[$i]['isActivo']. ",'" . $res[$i]['titulo']."'". "," . $find_key ?>);"><div class="text-center"><i title =" <?= $title ?>" class="fa fa-circle  <?= $active ?> puntero "></i></div></a></td>

                        <?php if (check_permiso($act2, $act1, $user_rol)) { ?>
                            <td>                      
                                <a class="puntero" onClick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/edit_subcapitulo.php?', 'id_subcap=<?= $res[$i]["id"] ?>&view_mode=0');">                                     
                                    <div class="text-center"><i class="fa fa-eye text-primary" title="<?= $vocab["symbol_view"] ?>"></i></div>                                  
                                </a>                                  
                            </td>
                        <?php } ?>
                        <?php if (check_permiso($act2, $act4, $user_rol)) { ?>
                            <td>                           
                                <a class="puntero"  onClick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/edit_subcapitulo.php?', 'id_subcap=<?= $res[$i]["id"] ?>&view_mode=1');">                                      
                                    <div class="text-center"><i class="fa fa-pencil text-success" title="<?= $vocab["symbol_edit"] ?>"></i></div>                                    
                                </a>

                            </td>
                        <?php } ?>
                        <?php if (check_permiso($act2, $act5, $user_rol)) { ?>
                            <td>              
                                <a class="puntero"  onClick="javascript:delete_subcapitulo(<?= $res[$i]['id'].",'".$res[$i]['titulo'] ."'".",".$find_key?>);">                                 
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
                <th hidden><?= $vocab["list_capitulo_id"] ?></th>
                <th width="10%">
                <a class="btn btn-success" name="submit" onclick="javascript:ordenarSubCapitulos();"><?= $vocab["symbol_save"] ?> <?= $vocab["list_capitulo_orden"] ?></a>
                </th>
                <th width="50%"><?= $vocab["list_capitulo_title"] ?></th> 
               <?php if (check_permiso($mod3, $act4, $user_rol)) { ?>
                 <th width="5%"><?= $vocab["isActivo"] ?></th>
                 <?php } ?>
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
        <div class="text-center"><a class="btn btn-success" name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/new_subcapitulo.php?', '');"><i class='fa fa-plus fa-inverse'></i> <?= $vocab["symbol_add"] ?> <?= $vocab["add_subcapitulo"] ?></a></div>
    <?php } ?>
</div>

<script>
    
flechasSubCapitulos();

</script>

