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
    return "SELECT id, descripcion, isActivo FROM OrigenAmenaza where isActivo = 1";
}

function consultaTipos($idOrigen) {
    return "SELECT id, descripcion, FkidOrigen, isActivo FROM TipoAmenaza where FkidOrigen=$idOrigen and isActivo = 1";
}

function consultaCategoriasPorTipo($idTipo) {
    return "SELECT  id, descripcion, FKidTipoAmenaza,isActivo FROM CategoriaTipoAmenaza where FKidTipoAmenaza=$idTipo and isActivo = 1";
}

// Funcion que genera un selector de valor para la matriz
function selectorMatriz($cod) { // cod corresponde a si es probabilidad (0) o consecuecia/gravedad (1)
    echo '<select class="form-control" onchange = "javascript:cambiarCriterio(this)">
            <option>1</option>
            <option>2</option>
            <option>3</option>  ';
    if ($cod == 1) {
        echo '  <option>4</option>';
    }
    echo ' </select>';
}


function consultaCategoriasPorOrigen($idOrigen) {
    return "SELECT  categoria.id as idCategoria FROM
(SELECT  id, FkidOrigen FROM TipoAmenaza where isActivo = 1 ) tipo,
(SELECT  id  FROM OrigenAmenaza where isActivo = 1) origen,
(SELECT  id, FKidTipoAmenaza,isActivo FROM CategoriaTipoAmenaza where isActivo = 1) categoria
where tipo.FkidOrigen = origen.id and tipo.id = categoria.FKidTipoAmenaza and tipo.FkidOrigen = $idOrigen;";
}

$origenes = seleccion(consultaOrigenes());

?>
<!--  ****** Titulo ***** -->

<?php
include("plan_emergencia_menu.php");
?>
<div class="well well-sm">

    <h1><?= $vocab["matriz_title"] ?></h1></div>
<div class="dataTables_wrapper form-inline dt-bootstrap">
    <table id="lista_usuarios" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable text-center" >
        <thead>
            <tr>
                <th rowspan="2" width="10%"><?= $vocab["td_origen"] ?></th>
                <th rowspan="2" width="8%"><?= $vocab["td_tipo"] ?></th>    
                <th rowspan="2" width="20%"><?= $vocab["td_categoria"] ?></th> 
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
                                    <td> <div class="form-group">                                            
                                            <input id="type-text" name="type-text" class="form-control" placeholder="fuente" title="propiedad title" type="text">
                                            
                                        </div></td>
                                    <td> <?= selectorMatriz(0); ?></td>
                                    <td id = "criterioProbabilidad"> BAJA</td>
                                    <td> <?= selectorMatriz(1); ?></td>
                                    <td id = "criterioGravedad"> BAJA</td>
                                    <td> <?= selectorMatriz(1); ?></td>
                                    <td id = "criterioConsecuencia"> BAJA </td>
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
        <div class="text-center"><a class="btn btn-success" name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/new_zona_trabajo.php?', '');"><i class='fa fa-plus fa-inverse'></i> <?= $vocab["symbol_save"] ?> <?= $vocab["matriz_title"] ?></a></div>
    <?php } ?>
</div>

