<?php
/*
 * Informacion extra que debe agregar un usuario en los capitulos y subcapitulos
 * 
 */
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");


/* * ********************************  select de los capitulos ***************************************** */
include("plan_emergencia_menu.php");
$sql = "SELECT `id`, `descripcion`, `descripcionParaUsuario`, `isDescripcionParaUsuario`, `titulo`, `orden`
        FROM Capitulo WHERE isActivo=1  ORDER BY orden";

$cap = seleccion($sql);

/**
 * crea un capitulo en el html
 *  llamado en  plan_emergencia_capitulos_subcapitulos.php
 * @param {Array} $cap infromacion del capitulo
 * @param {Array} $vocab lista de vocabulario del sistema
 * @param {int} $idPlanEmergencia id del pan de emergencia
 * @param {int} $i numero de capitulo
 * @param {boolean} $editar estado en que esta la pagina 
 * @returns {undefined} recarga la pagina a list_capitulos.php
 */
function capitulo($cap, $vocab, $idPlanEmergencia, $i, $editar) {
    ?>  
    <div   class="well well-sm">
        <div style = "padding:2%" id="capitulo<?= $cap['id'] ?>" class="formulario">    
            <div class='row'>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <label  for="subcapitulo_Descripcion_usuario"><?= $vocab["capitulos_subcapitulos_capitulo"] ?> <?= ($i == 0) ? "INICIO" : ($i) ?>: <?= $cap['titulo'] ?> </label>
                </div>

                <div align="right" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <?php if ($editar) { ?>
                        <span class="text-center">
                            <a class="btn btn-warning"  onclick="javascript:guardarCapituloUsuario('<?= $idPlanEmergencia ?>', '<?= $cap['id'] ?>',<?= $i ?>, 0)" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> </a>
                        </span>
                    <?php } ?>
                </div>
            </div>
            <div class='row'>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">


                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <label  for="subcapitulo_Descripcion_usuario"><?= $vocab["capitulos_subcapitulos_indicaciones"] ?> <?= $cap['descripcionParaUsuario'] ?> </label>

                </div>
            </div>
            <div class='row'>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">                    

                    <label  for="subcapitulo_Descripcion_usuario"> <?= $vocab['capitulos_subcapitulos_info_admin'] ?> </label>
                    <textarea class="form-control"  disabled id="capitulo_Descripcion_admin<?= $i ?>" name="subcapitulo_Descripcion_admin" ><?= $cap['descripcion'] ?></textarea>
                </div> 
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <label  for="subcapitulo_Descripcion_usuario"> <?= $vocab['capitulos_subcapitulos_info_usuario'] ?> </label>
                    <textarea   <?= (!$editar) ? "disabled" : ""; ?> class="form-control cambios"  id="capitulo_Descripcion_usuario<?= $i ?>" name="subcapitulo_Descripcion_usuario" ><?= descripcionCapitulo($cap['id'], $idPlanEmergencia) ?></textarea>
                </div> 
            </div>
        </div>
    </div>
    <script>
        CrearEditorCapitulosSubcapitulos(0, 'capitulo_Descripcion_admin<?= $i ?>');
        CrearEditorCapitulosSubcapitulos(1, 'capitulo_Descripcion_usuario<?= $i ?>');
    </script>


    <?php
}

/**
 * crea un capitulo en el html
 *  llamado en  plan_emergencia_capitulos_subcapitulos.php
 * @param {Array} $cap infromacion del capitulo
 * @param {Array} $listaFormularios lista de formularios asociados a un capitulo
 * @param {Array} $vocab lista de vocabulario del sistema
 * @param {int} $idPlanEmergencia id del pan de emergencia
 * @param {int} $i numero de capitulo
 * @param {int} $i numero de subcapitulo
 * @param {boolean} $editar estado en que esta la pagina 
 * @returns {undefined} recarga la pagina a list_capitulos.php
 */
function subcapitulo($subcap, $listaFormularios, $vocab, $idPlanEmergencia, $i, $j, $editar) {
    ?>  
    <div  class="well well-sm" >
        <div style = "padding:2%" id="<?= $subcap['id'] ?>" class="formulario" >
            <div class='row'>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <label  for="capitulo_Descripcion_usuario"><?= $vocab["capitulos_subcapitulos_subcapitulo"] ?> <?= ($i == 0) ? "INICIO" : ($i ) ?>.<?= $j + 1 ?>: <?= $subcap['titulo'] ?> </label>
                </div>
                <div align="right" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <?php if ($editar) { ?>
                        <span class="text-center">
                            <a class="btn btn-warning   "  onclick="javascript:guardarSubCapituloUsuario('<?= $idPlanEmergencia ?>', '<?= $subcap['id'] ?>', '<?= $i ?>.<?= $j ?>', 0)" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> </a>
                        </span>
                    <?php } ?>
                </div>
            </div>
            <div class='row'>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <label  for="capitulo_Descripcion_usuario"><?= $vocab["capitulos_subcapitulos_formularios"] ?>
                        <p>
                            <?php
                            for ($a = 0; $a < count($listaFormularios); $a++) {
                                ?>                    
                                <?= $a + 1 ?>. <?= $listaFormularios[$a]['titulo'] ?><br>
                            <?php }
                            ?>
                        </p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <label  for="capitulo_Descripcion_usuario"><?= $vocab["capitulos_subcapitulos_indicaciones"] ?> <?= $subcap['descripcionParaUsuario'] ?> </label>
                </div>
            </div>
            <div class='row'>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">                    

                    <label  for="capitulo_Descripcion_usuario"> <?= $vocab['capitulos_subcapitulos_info_admin'] ?> </label>
                    <textarea class="form-control"  disabled id="subcapitulo_Descripcion_admin<?= $i ?>.<?= $j ?>" name="capitulo_Descripcion_usuario" ><?= $subcap['descripcion'] ?></textarea>
                </div> 
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <label  for="capitulo_Descripcion_usuario"> <?= $vocab['capitulos_subcapitulos_info_usuario'] ?> </label>
                    <textarea   style="background-color: yellowgreen;" <?= (!$editar) ? "disabled" : ""; ?> class="form-control cambios"  id="subcapitulo_Descripcion_usuario<?= $i ?>.<?= $j ?>" name="capitulo_Descripcion_usuario" ><?= descripcionSubcapitulo($subcap['id'], $idPlanEmergencia) ?></textarea>
                </div> 
            </div>
        </div>
    </div>
    <script>
        CrearEditorCapitulosSubcapitulos(0, 'subcapitulo_Descripcion_admin<?= $i ?>.<?= $j ?>');
        CrearEditorCapitulosSubcapitulos(1, 'subcapitulo_Descripcion_usuario<?= $i ?>.<?= $j ?>');
    </script>


    <?php
}

/**
 *  descripcion de los usuarios en los capitulos
 *  llamado en  plan_emergencia_capitulos_subcapitulos.php
 * @param {int} $idcapitulo id del capitulo
 * @param {int} $idZona id de la zona de trabajo
 * @returns {undefined} recarga la pagina a list_capitulos.php
 */
function descripcionCapitulo($idcapitulo, $idZona) {
    $sql = "SELECT `descripcion` FROM `CapituloPlan` WHERE  `FKidCapitulo`=" . $idcapitulo . " and `FKidZonaTrabajo`=" . $idZona;
    $res = seleccion($sql);
    if (count($res) > 0) {
        return $res[0]['descripcion'];
    }
    return "";
}

/**
 *  descripcion de los usuarios en los subcapitulos
 *  llamado en  plan_emergencia_capitulos_subcapitulos.php
 * @param {int} $idcapitulo id del subcapitulo
 * @param {int} $idZona id de la zona de trabajo
 * @returns {undefined} recarga la pagina a list_capitulos.php
 */
function descripcionSubcapitulo($idSubcapitulo, $idZona) {
    $sql = "SELECT `descripcion` FROM `SubCapituloPlan` WHERE  `FKidSubCapitulo`=" . $idSubcapitulo . " and `FKidZonaTrabajo`=" . $idZona;
    $res = seleccion($sql);
    if (count($res) > 0) {
        return $res[0]['descripcion'];
    }
    return "";
}

/**
 *  seleciona subcapitulos de la base
 *  llamado en  plan_emergencia_capitulos_subcapitulos.php
 * @param {int} $id id del capitulo
 * @returns {Array} lista de subcapitulos
 */
function subcapitulos($id) {
    $sql = "SELECT `id`, `descripcion`, `descripcionParaUsuario`, `isDescripcionParaUsuario`, `titulo`, `isActivo`,"
            . " `FKidCapitulo`, `orden` FROM `SubCapitulo` WHERE `FKidCapitulo`=" . $id;
    return seleccion($sql);
}

/**
 *  seleciona lista formularios de la base
 *  llamado en  plan_emergencia_capitulos_subcapitulos.php
 * @param {int} $id id del subcapitulo
 * @returns {Array} lista de formularios
 */
function listaFormularios($id) {
    $sql = "SELECT `id`, `titulo` FROM `Formulario` WHERE `FKidSubcapitulos`=" . $id;
    return seleccion($sql);
}
?>


<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["capitulos_subcapitulos_title"] ?></h2>
        <p><?= $vocab["capitulos_subcapitulos_title_desc"] ?></p>
    </div>
    <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php
        for ($i = 0; $i < count($cap); $i++) {
            $subcap = subcapitulos($cap[$i]['id']);
            if ($cap[$i]['isDescripcionParaUsuario'] == 1) {
                ?>
                <?= capitulo($cap[$i], $vocab, $idPlanEmergencia, $i, $editar) ?>
                <?php
            }
            for ($j = 0; $j < count($subcap); $j++) {
                if ($subcap[$j]['isDescripcionParaUsuario'] == 1) {
                    $listaFormularios = listaFormularios($subcap[$j]['id'])
                    ?>
                    <?= subcapitulo($subcap[$j], $listaFormularios, $vocab, $idPlanEmergencia, $i, $j, $editar) ?>
                    <?php
                }
            }
        }
        ?>
    </div>
     
</div>




