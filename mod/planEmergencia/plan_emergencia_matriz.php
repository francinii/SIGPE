<?php
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

/* * *************************************************************************************** */
//Informacion requerida obtenida de la sesion
$ip = $mySessionController->getVar("cds_domain");
$ip .= $mySessionController->getVar("cds_locate");
$page_cant = $mySessionController->getVar("page_cant");

function consultaOrigenes() {
    return "SELECT id, descripcion FROM OrigenAmenaza";
}

function consultaTipos($idOrigen) {
    return "SELECT id, descripcion, FkidOrigen FROM TipoAmenaza where FkidOrigen=$idOrigen";
}

function consultaCategoriasPorTipo($idTipo) {
    return "SELECT  id, descripcion, FKidTipoAmenaza,isActivo FROM CategoriaTipoAmenaza where FKidTipoAmenaza=$idTipo";
}

//Selecciona todas las categorias
//SELECT origen.id as idOrigen, tipo.id as idTipo, categoria.id as idCategoria, tipo.FkidOrigen as fkOrigen,  origen.descripcion as origenDes,tipo.descripcion as tipoDes, categoria.descripcion as categoriaDes  FROM
//(SELECT  id, descripcion, isActivo, FkidOrigen FROM TipoAmenaza) tipo,(SELECT  id, descripcion  FROM OrigenAmenaza) origen,
//(SELECT  id, descripcion, FKidTipoAmenaza FROM CategoriaTipoAmenaza) categoria
//where tipo.FkidOrigen = origen.id and tipo.id = categoria.FKidTipoAmenaza
//Selecciona las categorias correspondientes a un tipo
//function consultaCategoriasPorTipo($idTipo) {
//    return "SELECT origen.id as idOrigen, tipo.id as idTipo, categoria.id as idCategoria, tipo.FkidOrigen as fkorigen, categoria.FKidTipoAmenaza as FKidTipoAmenaza,  origen.descripcion as origenDes,tipo.descripcion as tipoDes, categoria.descripcion as categoriaDes  FROM
//(SELECT  id, descripcion, isActivo, FkidOrigen FROM TipoAmenaza) tipo,(SELECT  id, descripcion,isActivo  FROM OrigenAmenaza) origen,
//(SELECT  id, descripcion, FKidTipoAmenaza,isActivo FROM CategoriaTipoAmenaza) categoria
//where tipo.FkidOrigen = origen.id and tipo.id = categoria.FKidTipoAmenaza and categoria.FKidTipoAmenaza = $idTipo";
//}

function consultaCategoriasPorOrigen($idOrigen) {
    return "SELECT origen.id as idOrigen, tipo.id as idTipo, categoria.id as idCategoria, tipo.FkidOrigen as fkorigen,  origen.descripcion as origenDes,tipo.descripcion as tipoDes, categoria.descripcion as categoriaDes  FROM
(SELECT  id, descripcion, isActivo, FkidOrigen FROM TipoAmenaza) tipo,(SELECT  id, descripcion,isActivo  FROM OrigenAmenaza) origen,
(SELECT  id, descripcion, FKidTipoAmenaza,isActivo FROM CategoriaTipoAmenaza) categoria
where tipo.FkidOrigen = origen.id and tipo.id = categoria.FKidTipoAmenaza and tipo.FkidOrigen = $idOrigen";
}

function consultaCategorias() {
    return "SELECT origen.id as idOrigen, tipo.id as idTipo, categoria.id as idCategoria, tipo.FkidOrigen as fkorigen,  origen.descripcion as origenDes,tipo.descripcion as tipoDes, categoria.descripcion as categoriaDes  FROM
(SELECT  id, descripcion, isActivo, FkidOrigen FROM TipoAmenaza) tipo,(SELECT  id, descripcion,isActivo  FROM OrigenAmenaza) origen,
(SELECT  id, descripcion, FKidTipoAmenaza,isActivo FROM CategoriaTipoAmenaza) categoria
where tipo.FkidOrigen = origen.id and tipo.id = categoria.FKidTipoAmenaza and tipo.FkidOrigen = origen.id";
}

$sql = "SELECT COUNT(id) AS cant
        FROM ZonaTrabajo";

//$origenes = seleccion(consultaOrigenes());
//$tipos = seleccion(consultaTipos());
$origenes = seleccion(consultaOrigenes());
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
//
///* * ********************************************************************************************** */
//$sql = "SELECT  id, nombreZonaTrabajo FROM ZonaTrabajo";
//
//$find_key = (isset($_GET['find_key'])) ? $_GET['find_key'] : '';
//if ($find_key != "") {
//    $sql .= "  WHERE nombreZonaTrabajo LIKE '%" . $find_key . "%'";
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
?>
<!--  ****** Titulo ***** -->
<div class="well well-sm"><h1><?= $vocab["list_zona_trabajo_title"] ?></h1></div>
<div class="dataTables_wrapper form-inline dt-bootstrap">
    <table id="lista_usuarios" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable text-center" >
        <thead>
            <tr>
                <th rowspan="2" width="10%"><?= $vocab["td_origen"] ?></th>
                <th rowspan="2" width="10%"><?= $vocab["td_tipo"] ?></th>    
                <th rowspan="2" width="10%"><?= $vocab["td_categoria"] ?></th> 
                <th rowspan="2" width="10%"><?= $vocab["td_fuente"] ?></th> 
                <th colspan="2" width="10%"><?= $vocab["td_probabilidad"] ?></th> 
                <th colspan="2" width="10%"><?= $vocab["td_gravedad"] ?></th>
                <th colspan="2" width="10%"><?= $vocab["td_consecuencia_amenaza"] ?></th> 
                <th colspan="2" width="10%"><?= $vocab["td_tipo_alerta"] ?></th>                
            </tr>
            <tr>
                <th width="5%"><?= $vocab["td_valor"] ?></th> 
                <th width="5%"><?= $vocab["td_criterio"] ?></th>   
                <th width="5%"><?= $vocab["td_valor"] ?></th> 
                <th width="5%"><?= $vocab["td_criterio"] ?></th> 
                <th width="5%"><?= $vocab["td_valor"] ?></th> 
                <th width="5%"><?= $vocab["td_criterio"] ?></th>  
                <th width="5%"><?= $vocab["td_valor"] ?></th> 
                <th width="5%"><?= $vocab["td_criterio"] ?></th>   
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($origenes); $i++) {
                $idOrigen = $origenes[$i]['id'];
                $categorias = seleccion(consultaCategoriasPorOrigen($idOrigen)); //cambiar esta consulta
                $cantidadCategorias = count($categorias);
                $tipos = seleccion(consultaTipos($idOrigen));
                $cantidadTipos = count($tipos);
                ?>
                <?php // if ($origenes > 0) { ?>
                <?php if ($cantidadCategorias > 0) { ?>
                    <tr>
                        <td rowspan="<?= $cantidadCategorias ?>"> <?= $origenes[$i]['descripcion']; ?> </td>
                        <?php for ($j = 0; $j < $cantidadTipos; $j++) { ?>
                            <?php
                            $idTipo = $tipos[$j]['id'];
                            $categoriasPorTipo = seleccion(consultaCategoriasPorTipo($idTipo));
                            $cantidadCategoriasPorTipo = count($categoriasPorTipo);
                            ?>
                            <?php if ($j != 0 && $cantidadCategoriasPorTipo > 0) { ?>
                            <tr>
                            <?php } ?>
                            <?php if ($cantidadCategoriasPorTipo > 0) { ?>
                                <td rowspan="<?= $cantidadCategoriasPorTipo ?>"> <?= $tipos[$j]['descripcion']; ?> </td>
                                <?php for ($k = 0; $k < $cantidadCategoriasPorTipo; $k++) { ?>
                                    <?php if ($k != 0 && $j != 0) { ?>
                                    <tr>
                                    <?php } ?>
                                    <td> <?= $categoriasPorTipo[$k]['descripcion']; ?></td>
                                    <td> fuente</td>
                                    <td> valor</td>
                                    <td> criterio</td>
                                    <td> valor</td>
                                    <td> criterio</td>
                                    <td> valor</td>
                                    <td> criterio</td>
                                    <td> valor</td>
                                    <td> criterio</td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>  
            <?php } ?>
        </tbody>
    </table>

    <br/>
    <?php if (check_permiso($mod3, $act3, $user_rol)) { ?>
        <div class="text-center"><a class="btn btn-success" name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/new_zona_trabajo.php?', '');"><i class='fa fa-plus fa-inverse'></i> <?= $vocab["symbol_add"] ?> <?= $vocab["zona_trabajo_title"] ?></a></div>
    <?php } ?>
</div>

