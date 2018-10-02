<?php
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

include("plan_emergencia_menu.php");
$sql = "SELECT `id`, `descripcion`, `descripcionParaUsuario`, `isDescripcionParaUsuario`, `titulo`, `orden`
        FROM Capitulo WHERE isActivo=1 ORDER BY orden";

$cap = seleccion($sql);

function capitulo($cap, $vocab, $i) {
    ?>  
    <div class="well well-sm">
        <div class='row'>
            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                <label  for="subcapitulo_Descripcion_usuario"><?= $vocab["capitulos_subcapitulos_capitulo"] ?> <?= ($i == 0) ? "Inicio" : ($i) ?>: <?= $cap['titulo'] ?> </label>
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
                <textarea class="form-control"  readonly id="capitulo_Descripcion_admin<?= $i ?>" name="subcapitulo_Descripcion_admin" ><?= $cap['descripcion'] ?></textarea>
            </div> 
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label  for="subcapitulo_Descripcion_usuario"> <?= $vocab['capitulos_subcapitulos_info_usuario'] ?> </label>
                <textarea class="form-control"  id="capitulo_Descripcion_usuario<?= $i ?>" name="subcapitulo_Descripcion_usuario" ></textarea>
            </div> 
        </div>
    </div>
    <script>
        CrearEditorCapitulosSubcapitulos(0, 'capitulo_Descripcion_admin<?= $i ?>');
        CrearEditorCapitulosSubcapitulos(1, 'capitulo_Descripcion_usuario<?= $i ?>');
    </script>


    <?php
}

function subcapitulo($subcap, $listaFormularios, $vocab, $i, $j) {
    ?>  
    <div class="well well-sm" >
        <div class='row'>
            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                <label  for="capitulo_Descripcion_usuario"><?= $vocab["capitulos_subcapitulos_subcapitulo"] ?> <?= ($i == 0) ? "Inicio" : ($i ) ?>.<?= $j + 1 ?>: <?= $subcap['titulo'] ?> </label>
            </div>
        </div>
        <div class='row'>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label  for="capitulo_Descripcion_usuario"><?= $vocab["capitulos_subcapitulos_formularios"] ?>
                    <p>
                        <?php
                        for ($a = 0; $a < count($listaFormularios); $a++) {
                            ?>                    
                            <?= $a + 1 ?>. <?= $listaFormularios[$a]['descripcion'] ?><br>
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
                <textarea class="form-control"  readonly id="subcapitulo_Descripcion_admin<?= $i ?>.<?= $j ?>" name="capitulo_Descripcion_usuario" ><?= $subcap['descripcion'] ?></textarea>
            </div> 
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label  for="capitulo_Descripcion_usuario"> <?= $vocab['capitulos_subcapitulos_info_usuario'] ?> </label>
                <textarea class="form-control"  id="subcapitulo_Descripcion_usuario<?= $i ?>.<?= $j ?>" name="capitulo_Descripcion_usuario" ></textarea>
            </div> 
        </div>
    </div>
    <script>
        CrearEditorCapitulosSubcapitulos(0, 'subcapitulo_Descripcion_admin<?= $i ?>.<?= $j ?>');
        CrearEditorCapitulosSubcapitulos(1, 'subcapitulo_Descripcion_usuario<?= $i ?>.<?= $j ?>');
    </script>


    <?php
}

function subcapitulos($id) {
    $sql = "SELECT `id`, `descripcion`, `descripcionParaUsuario`, `isDescripcionParaUsuario`, `titulo`, `isActivo`,"
            . " `FKidCapitulo`, `orden` FROM `SubCapitulo` WHERE `FKidCapitulo`=" . $id;
    return seleccion($sql);
}

function listaFormularios($id) {
    $sql = "SELECT `id`, `descripcion` FROM `Formulario` WHERE `FKidSubcapitulos`=" . $id;
    return seleccion($sql);
}
?>


<div class="container">
    <div class="well well-sm">
        <h2><?= $vocab["capitulos_subcapitulos_title"] ?></h2>
        <p><?= $vocab["capitulos_subcapitulos_title_desc"] ?></p>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php
        for ($i = 0; $i < count($cap); $i++) {
            $subcap = subcapitulos($cap[$i]['id']);
            ?>
            <?= capitulo($cap[$i], $vocab, $i) ?>
            <?php
            for ($j = 0; $j < count($subcap); $j++) {
                $listaFormularios = listaFormularios($subcap[$j]['id'])
                ?>
                <?= subcapitulo($subcap[$j], $listaFormularios, $vocab, $i, $j) ?>
                <?php
            }
        }
        ?>
    </div>
</div>




