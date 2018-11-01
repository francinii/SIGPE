<?php
/*
 * Formulario ingreso cuerpos de socorro
 */
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
include("plan_emergencia_menu.php");

/* * *******************************  select de los datos del formulario ingreso cuerpos de socorro********* */
$sql = "SELECT  `tipo`, `ubicacion`, `Distancia`, `Tiempo`"
        . " FROM `CuerposScorro` WHERE `FKidZonaTrabajo`=" . $idPlanEmergencia;
$resBase = seleccion($sql);


    $res = array($vocab["ingreso_cruzRoja"], $vocab["ingreso_Bomberos"], $vocab["ingreso_transito"]);


 for ($i = 0; $i < count($resBase); $i++) { 
        $ubicacion=array_search($resBase[$i]['tipo'], $res);
        if($ubicacion!==false){
           $res[$ubicacion]=$resBase[$i];
         }else{
          $res[]=$resBase[$i];  
        }       
    }
?>
<div class="well well-sm">
    <h2><?= $vocab["ingreso_titulo"] ?></h2>
    <p><?= $vocab["ingreso_titulo_desc"] ?></p>


    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
            <span class="text-center" >
                <a class="btn btn-success" onclick="javascript:agregarFilaIngresos('<?= $vocab["symbol_delete"] ?>', '<?= $vocab["Menu_Datos_sin_guardar"] ?>');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?>  </a>
            </span>
        <?php } ?>
    </div>
    <div   class="dataTables_wrapper   dt-bootstrap" style = "overflow-x:auto;">
        <table style = "width: 99%;" id="lista_ingreso" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center formulario" >
            <thead style="background-color: lightblue;">
                <tr>
                    <th  width="5%"><?= $vocab["ingreso_cuerpoRespuesta"] ?></th>
                    <th  width="5%"><?= $vocab["ingreso_ubicación"] ?></th>
                    <th  width="5%"><?= $vocab["ingreso_recorrido"] ?></th>                                
                    <th  width="5%"><?= $vocab["ingreso_tiempoRespuesta"] ?></th>                    
                  
                        <th width="2%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                   

                </tr>
            </thead>
            <tbody>
                <?php
                if (count($res) > 0) {
                    for ($i = 0; $i < count($res); $i++) {
                        $style = '';
                        $onclick = 'onClick="javascript:eliminarFilaIngreso(this);"';

                        if ($i < 3) {
                            $style = 'style="cursor:not-allowed"';
                            $onclick = '';
                        }
                        ?>
                        <tr id="<?= $i ?>">
                            <?php
                            if ($i < 3) {
                                ?>
                                <td><span id="tipo<?= $i ?>" ><?= (is_array($res[$i])) ? $res[$i]['tipo'] : $res[$i]; ?></span> </td>
                                <?php
                            } else {
                                ?>
                                <td> <input  type="text"  <?= (!$editar) ? "disabled" : ""; ?>  class="form-control  cambios" id="tipo<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['tipo'] : $res[$i]; ?>" ></td>
                                <?php
                            }
                            ?>
                            <td> <input  type="text"  <?= (!$editar) ? "disabled" : ""; ?>   class="form-control cambios" id="ubicacion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['ubicacion'] : ""; ?>" ></td>
                            <td> <input  type="number"  min="0" <?= (!$editar) ? "disabled" : ""; ?>   class="form-control requerido cambios" id="Distancia<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['Distancia'] : "0"; ?>" ></td>                            
                            <td> <input  type="number"  min="0" <?= (!$editar) ? "disabled" : ""; ?>  class="form-control requerido cambios" id="Tiempo<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['Tiempo'] : "0"; ?>" ></td>

                            <td>  

                                <?php if ($editar && check_permiso($mod5, $act5, $user_rol)) {
                                    ?>
                                    <a class="puntero cambios" <?= $style ?> <?= $onclick ?> >                                 
                                        <div class="text-center"><i class="fa fa-close  text-danger " title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                                    </a>
                                <?php } ?>
                            </td>

                        </tr>   
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div> 
    <!--/*  ********************************  Guarda datos de la tabla de tiempo de respuesta **********/-->
    <div class="text-center">
        <?php if ($editar) { ?>
            <span class="text-center">
                <a class="btn btn-warning"  onclick="javascript:guardarIncreso('<?= $idPlanEmergencia ?>', 0)" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["inventario_Datos"] ?></a>
            </span>                   
        <?php } ?>
    </div>
</div>

<!--********** Tabla increso cuerpos de socorro**************************************-->
<?php
$sql = "SELECT `dimensionAreaAcceso`, `radioGiro`, `caseta`, `plumas`, `anchoLibre` FROM `IngresoCuerpoSocorro` WHERE `FKidZonaTrabajo`=" . $idPlanEmergencia;
$res = seleccion($sql);
?>


<div class="well well-sm">
    <h2><?= $vocab["ingreso_subtitulo"] ?></h2>
    <p><?= $vocab["ingreso_cuerpo_socorro_desc"] ?></p>

    <form class="formulario" id="lista_ingreso_cuerposocorro" method="post" action="">
        <h4><?= $vocab["ingreso_Condiciones"] ?></h4>

        <div class="form-group row">
            <label for="area" class="col-sm-3 col-form-label"><?= $vocab["ingreso_dimensiones"] ?></label>
            <div class="col-sm-9">
                <input type="text"   <?= (!$editar) ? "disabled" : ""; ?> class="form-control cambios" id="dimensionAreaAcceso" value="<?= ( count($res) > 0) ? $res[0]['dimensionAreaAcceso'] : ""; ?>">                                 
            </div>
        </div>
        <div class="form-group row">
            <label for="instalaciones" class="col-sm-3 col-form-label"><?= $vocab["ingreso_radio"] ?></label>
            <div class="col-sm-9">
                <input type="text"   <?= (!$editar) ? "disabled" : ""; ?> class="form-control cambios" id="radioGiro" value="<?= ( count($res) > 0) ? $res[0]['radioGiro'] : ""; ?>">                                 
            </div>
        </div>
        <div class="form-group row">
            <label for="zona" class="col-sm-3 col-form-label"><?= $vocab["ingreso_caseta"] ?></label>
            <div class="col-sm-9">
                <input type="text"  <?= (!$editar) ? "disabled" : ""; ?> class="form-control cambios" id="caseta" value="<?= ( count($res) > 0) ? $res[0]['caseta'] : ""; ?>">                                 
            </div>
        </div>
        <div class="form-group row">
            <label for="topografica" class="col-sm-3 col-form-label"><?= $vocab["ingreso_plumas"] ?></label>
            <div class="col-sm-9">
                <input type="text"  <?= (!$editar) ? "disabled" : ""; ?> class="form-control cambios" id="plumas" value="<?= ( count($res) > 0) ? $res[0]['plumas'] : ""; ?>">                                 
            </div>
        </div>
        <div class="form-group row">
            <label for="terreno" class="col-sm-3 col-form-label"><?= $vocab["ingreso_ancho"] ?></label>
            <div class="col-sm-9">
                <input type="text"  <?= (!$editar) ? "disabled" : ""; ?> class="form-control cambios" id="anchoLibre" value="<?= ( count($res) > 0) ? $res[0]['anchoLibre'] : ""; ?>">                                 
            </div>
        </div>        
        <h4><?= $vocab["ingreso_protocolo"] ?></h4>


        <!--/*  ********************************  Guarda datos del formulario descripcion del ingreso **********/-->
        <?php if ($editar) { ?>
            <div class="text-center">
                <?php if ($editar) { ?>
                    <span class="text-center">
                        <a class="btn btn-warning"  onclick="javascript:guardarIncresoCuerpoSocorro('<?= $idPlanEmergencia ?>', 0)" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["inventario_Datos"] ?></a>
                    </span>
                    <span class="text-center">
                        <a class="btn btn-success"  onclick="javascript:guardarIncresoCuerpoSocorro('<?= $idPlanEmergencia ?>', 1)" name="submit"><i class="fa fa-rotate-right"></i> <?= $vocab["symbol_save"] . " " . $vocab["datos_generares_siguente"] ?></a>
                    </span>        
                <?php } ?>
            </div>


        <?php } ?>

    </form>
</div>




