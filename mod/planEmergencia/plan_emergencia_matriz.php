<?php
/*
 * Matriz de Riesgo administrable
 * 
 */

include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

/* * *************************************************************************************** */
//Informacion requerida obtenida de la sesion
$ip = $mySessionController->getVar("cds_domain");
$ip .= $mySessionController->getVar("cds_locate");
$page_cant = $mySessionController->getVar("page_cant");
include("plan_emergencia_menu.php");

/**
 * seleciona los origenes de las amenazas
 * @returns {array} 
 */
function consultaOrigenes() {
    return "SELECT id, descripcion, isActivo FROM OrigenAmenaza where isActivo = 1";
}

/*
 * selecciona los tipos de amenaza
 * @param {int} $idOrigen id del origen de la amenaza
 * @returns {array} 
 */

function consultaTipos($idOrigen) {
    return "SELECT id, descripcion, FkidOrigen, isActivo FROM TipoAmenaza where FkidOrigen=$idOrigen and isActivo = 1";
}

/*
 * selecciona los categorias de amenaza por tipo
 * @param {int} $idTipo id del tipo de la amenaza
 * @returns {array} 
 */

function consultaCategoriasPorTipo($idTipo) {
    return "SELECT  id, descripcion, FKidTipoAmenaza,isActivo FROM CategoriaTipoAmenaza where FKidTipoAmenaza=$idTipo and isActivo = 1";
}

/*
 * selecciona los categorias de amenaza por origen
 * @param {int} $idOrigen id del origen de la amenaza
 * @returns {array} 
 */

function consultaCategoriasPorOrigen($idOrigen) {
    return "SELECT  categoria.id as idCategoria FROM
(SELECT  id, FkidOrigen FROM TipoAmenaza where isActivo = 1 ) tipo,
(SELECT  id  FROM OrigenAmenaza where isActivo = 1) origen,
(SELECT  id, FKidTipoAmenaza,isActivo FROM CategoriaTipoAmenaza where isActivo = 1) categoria
where tipo.FkidOrigen = origen.id and tipo.id = categoria.FKidTipoAmenaza and tipo.FkidOrigen = $idOrigen;";
}

/*
 * Funcion que genera un selector de valor para la matriz
 * @param {int} $cod corresponde al valor de  probabilidad (0) o consecuecia/gravedad (1)
 * @param {int} $opcion  selecionada
 * @param {int} $editar  estado en que esta la pagina 
 * @returns {String} HTML
 */

function selectorMatriz($cod, $opcion, $editar) {
    $valor = '<select    ' . (($editar) ? '' : 'disabled') . ' class="form-control cambios" onchange = "javascript:cambiarCriterio(this,' . $cod . ')">';
    $valor .= '  <option ' . (($opcion == 1) ? 'selected' : '') . '> 1</option>';
    $valor .= '  <option ' . (($opcion == 2) ? 'selected' : '') . '> 2</option>';
    $valor .= '  <option ' . (($opcion == 3) ? 'selected' : '') . '> 3</option>';
    if ($cod == 1) {
        $valor .= '  <option ' . (($opcion == 4) ? 'selected' : '') . '> 4</option>';
    }
    $valor .= ' </select>';
    return $valor;
}

/*
 * Funcion que busca un registro de una categoria especifica en la lista de 
 * registros de la matriz
 * @param {array} $matriz arreglo con los registros de la matriz
 * @param {int} id de la categoria a buscar en el array $matriz
 * @returns {Array} $mat array asociativo con keys "fuente", "probabilidad",
 *  "gravedad", "consecuenaAmenaza" en caso de no encontrarse retorna valores 
 * por defecto
 */

function buscarRegistro($matriz, $categoria) {
    for ($i = 0; $i < count($matriz); $i++) {
        if ($matriz[$i]['FKidCategoriaTipoAmenaza'] == $categoria) {
            // if ($matriz[$i]['id'] == $categoria) {
            return $matriz[$i];
        }
    }
    return $mat = ["fuente" => "", "probabilidad" => 1, "gravedad" => 1, "consecuenciaAmenaza" => 1];
}

/*
 * Funcion que determina el criterio de la probabilidad o gravedad de acuerdo al
 * valor de probabilidad y gravedad
 * @param {int} $opc corresponde al valor de  probabilidad o gravedad
 * @returns {String} HTML
 */

function selectorProbabilidad($opc) {
    if ($opc == 1) {
        return "BAJA";
    } else if ($opc == 2) {
        return "MEDIA";
    } else if ($opc == 3) {
        return "ALTA";
    }
    return "";
}

/*
 * Funcion que determina el criterio de la consecuencia de amenaza de acuerdo al
 * valor de  de la consecuencia de amenaza 
 * @param {int} $opc corresponde a la consecuencia de amenaza
 * @returns {String} HTML
 */

function selectorGravedadConsecuencia($opc) {
    if ($opc == 1) {
        return "NINGUNA";
    } else if ($opc == 2) {
        return "BAJA";
    } else if ($opc == 3) {
        return "MEDIA";
    } else if ($opc == 4) {
        return "ALTA";
    }
    return "";
}

/*
 * Funcion que calcula el valor correspondiente al tipo de alerta 
 * @param {array} $registros corresponde a un arreglo asociativo que posee los valores
 * de la fila de la matriz (probabilidad, gravedad, consecuenciaAmenaza)
 * @returns {String} HTML
 */

function calcularValorAlerta($registro) {
    return $registro['probabilidad'] * ( $registro['gravedad'] + $registro['consecuenciaAmenaza'] );
}

/*
 * Funcion que calcula el criterio correspondiente al tipo de alerta. Si el valor ($valor)del
 * tipo de alerta es menor o igual a 3 el criterio es "NINGUNA", si es mayor que 3
 * y menor o igual a 12 el criterio es "VERDE", si es mayor que 12 y menor o igual que 24 el 
 * criterio es "AMARILLA" y si es mayor o igual que 24, el criterio es "ROJA"
 * @param {array} $registros corresponde a un arreglo asociativo que posee los valores
 * de la fila de la matriz (probabilidad, gravedad, consecuenciaAmenaza)
 * @param {array} $vocab corresponde al vocabulario del sistema
 * @returns {array} $mat array asociativo con keys "criterio", "color"
 */

function calcularCriterioAlertaColor($registro, $vocab) {
    $valor = calcularValorAlerta($registro);
    if ($valor <= 3) {
        return $mat = ["color" => "#828282", "criterio" => $vocab["criterio_ninguna"]];
    } else if ($valor > 3 && $valor <= 12) {
        return $mat = ["color" => "#5cb85c", "criterio" => $vocab["criterio_verde"]];
    } else if ($valor > 12 && $valor < 24) {
        return $mat = ["color" => "#f0ad4e", "criterio" => $vocab["criterio_amarilla"]];
    } else if ($valor >= 24) {
        return $mat = ["color" => "#d9534f", "criterio" => $vocab["criterio_roja"]];
    }
}

$origenes = seleccion(consultaOrigenes());
$sql = "SELECT id, FKidCategoriaTipoAmenaza, FKidZonaTrabajo, fuente,
 probabilidad,gravedad,consecuenciaAmenaza FROM Matriz 
WHERE `FKidZonaTrabajo`=" . $idPlanEmergencia;
$matriz = seleccion($sql);


//function buscar($color, $criterios) {
//    $total = 0;
//    foreach ($criterios as $criterio) {
//        $total = ($criterio == $color) ? $total + 1 : $total;
//    }
//    return $total;
//}
?>

<div class="well well-sm">
    <h1><?= $vocab["matriz_title"] ?></h1></div>

<div class="dataTables_wrapper form-inline dt-bootstrap" style=overflow-x:auto;">
    <table style = "width: 99%;" id="matriz_riesgos" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable text-center formulario" >
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
            $bandera = 0;
            $criterios = null;
            for ($i = 0; $i < count($origenes); $i++) {
                $idOrigen = $origenes[$i]['id'];
                $categorias = seleccion(consultaCategoriasPorOrigen($idOrigen)); //cambiar esta consulta
                $cantidadCategorias = count($categorias);
                $tipos = seleccion(consultaTipos($idOrigen));
                $cantidadTipos = count($tipos);
                ?>
                <?php // if ($origenes > 0) {  ?>
    <?php if ($cantidadCategorias > 0) { ?>
                    <tr>
                        <td rowspan="<?= $cantidadCategorias ?>"> <?= $origenes[$i]['descripcion']; ?> </td>
                        <?php for ($j = 0; $j < $cantidadTipos; $j++) { ?>
                            <?php
                            $idTipo = $tipos[$j]['id'];
                            $categoriasPorTipo = seleccion(consultaCategoriasPorTipo($idTipo));
                            $cantidadCategoriasPorTipo = count($categoriasPorTipo);
                            $a = count($categoriasPorTipo);
                            $bandera = (count($categoriasPorTipo) > 0) ? $bandera + 1 : $bandera;
                            ?>
                            <?php if ($j != 0 && $cantidadCategoriasPorTipo > 0 && $bandera > 1) { ?>
                            <tr>
                            <?php } ?>
                            <?php if ($cantidadCategoriasPorTipo > 0) { ?>
                                <td rowspan="<?= $cantidadCategoriasPorTipo ?>"> <?= $tipos[$j]['descripcion']; ?> </td>
                                <?php for ($k = 0; $k < $cantidadCategoriasPorTipo; $k++) { ?>
                                    <?php if ($k != 0 && $j != 0) { ?>
                                    <tr>
                    <?php } ?>                                   
                                    <td class ="categoria"> <?= $categoriasPorTipo[$k]['descripcion']; ?>
                                        <input   type="hidden" class ="idCategoria" value="<?= $categoriasPorTipo[$k]['id']; ?>" />
                                    </td>

                    <?php $registroMatriz = buscarRegistro($matriz, $categoriasPorTipo[$k]['id']); ?>  
                                    <td> <div class="form-group">                                            
                                            <input <?= (!$editar) ? "disabled" : ""; ?> id="type-text" name="type-text" class="form-control fuente cambios" placeholder="fuente"value ="<?= $registroMatriz['fuente'] ?>"  title="propiedad title" type="text">
                                        </div>
                                    </td>
                                    <td class = "criterioProbabilidad" > <?= selectorMatriz(0, $registroMatriz['probabilidad'], $editar); ?></td>
                                    <td id = "criterioProbabilidad"> <?= selectorProbabilidad($registroMatriz['probabilidad']) ?> </td>
                                    <td class = "criterioGravedad"> <?= selectorMatriz(1, $registroMatriz['gravedad'], $editar); ?></td>
                                    <td  id = "criterioGravedad"> <?= selectorGravedadConsecuencia($registroMatriz['gravedad']) ?></td>
                                    <td class = "criterioConsecuencia"> <?= selectorMatriz(1, $registroMatriz['consecuenciaAmenaza'], $editar); ?></td>
                                    <td  id = "criterioConsecuencia"> <?= selectorGravedadConsecuencia($registroMatriz['consecuenciaAmenaza']) ?> </td>
                                    <td><?= calcularValorAlerta($registroMatriz); ?> </td>
                                    <?php
                                    $criterio = calcularCriterioAlertaColor($registroMatriz, $vocab)['criterio'];
                                    $criterios[] = $criterio; //arreglo que guardar los criterios (VERDE, NINGUNA,AMARILLA,ROJA)
                                    ?>                                    
                                    <td class = "criterioAlerta" style="background-color: <?= calcularCriterioAlertaColor($registroMatriz, $vocab)['color']; ?> "><?= $criterio ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if ($bandera > 1) { ?>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    <?php } $bandera = 0; ?>
                <?php } ?>  
<?php } ?>
        </tbody>
    </table>
    <br/>
</div>
<br>
<div class="text-center">
    <?php if ($criterios != null) { ?> 
    <?php if ($editar) { ?>  
            <span class="text-center"><a class="btn btn-warning" name="submit" onclick="javascript:generaVectorMatriz('<?= $nombreCentro ?>', '<?= $idCentro ?>', '0', <?= $editar ?>);"><i class='fa fa-plus fa-inverse'></i> <?= $vocab["symbol_save"] ?> <?= $vocab["matriz_title"] ?></a></span>
            <span class="text-center"><a class="btn btn-success" name="submit" onclick="javascript:generaVectorMatriz('<?= $nombreCentro ?>', '<?= $idCentro ?>', '2', <?= $editar ?>);"><i class='fa fa-rotate-right fa-inverse'></i> <?= $vocab["symbol_save"] ?> <?= $vocab["datos_generares_siguente"] ?></a></span>
    <?php } ?>

        <span class="text-center"><a class="btn btn-warning" name="" onclick="javascript:generaVectorMatriz('<?= $nombreCentro ?>', '<?= $idCentro ?>', '1', <?= $editar ?>);"><i class='fa fa-plus fa-inverse'></i>  <?= $vocab["graficar_matriz"] ?></a></span>

<?php } ?>
</div>
