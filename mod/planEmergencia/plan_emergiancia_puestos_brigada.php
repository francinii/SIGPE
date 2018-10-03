<?php
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
include("plan_emergencia_menu.php");
?>
<!------------------------------------  Recurso Humano ----------------------------------- ------------------- ----------->
<?php
$sql = "SELECT `puesto`, `funcion`, `plazoEjecucion` FROM `FormularioPuestoBrigada` WHERE `FKidZonaTrabajo`=" . $idPlanEmergencia . " order by `puesto` ";
$res = seleccion($sql);

if (count($res) <= 0) {
    $res = array($vocab["puestos_brigada_ejemplo1"],$vocab["puestos_brigada_ejemplo2"],$vocab["puestos_brigada_ejemplo3"],
       $vocab["puestos_brigada_ejemplo4"],$vocab["puestos_brigada_ejemplo5"],$vocab["puestos_brigada_ejemplo6"],$vocab["puestos_brigada_ejemplo7"] );
}
?>
<div class="well well-sm">
    <h2><?= $vocab["puestos_brigada_title"] ?></h2>    
    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
            <span class="text-center" >
                <a class="btn btn-info" onclick="javascript: agregarFilaPuesto('<?= $vocab["symbol_delete"] ?>', '<?= $vocab["Menu_Datos_sin_guardar"] ?>','<?= $vocab["symbol_add"] ?>','<?= $vocab["puestos_brigada_puestoNuevo"] ?>');"><i class=" fa fa-plus text-info"></i> <?= $vocab["menu_add"] ?> <?= $vocab["puestos_brigada_puesto"] ?>  </a>
            </span>            
        <?php } ?>
    </div>
</div>
    <div   class="dataTables_wrapper   dt-bootstrap" style = "overflow-x:auto;">
        <table  style = "width: 99%" id="lista_puestoBrigada" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
            <thead >
                <tr>
                    <th  width="45%"><?= $vocab["puestos_brigada_funciones"] ?></th>
                    <th  width="45%"><?= $vocab["puestos_brigada_plazos_ejecución"] ?></th>                                       
                    <?php if ($editar) { ?>
                        <th width="1%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                        <th width="1%"><div class="text-center"><i class="fa fa-plus  fa-2x text-success puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody>
                <?php
                if (count($res) > 0) {
                    $puestoActual = "";                  
                    ?>
                    <?php
                    for ($i = 0, $id = 0; $i < count($res); $i++, $id++) {
                        $puesto = ((is_array($res[$i])) ? $res[$i]['puesto'] : $res[$i]);
                        if ($puestoActual != $puesto) {
                            $puestoActual = $puesto;
                            ?>
                            <tr class="seccionPuesto" id="Pues-<?= $id ?>">                   
                                <td style="align-items:center; background-color:lightblue" colspan="2">
                                    <input style="width: 40%; margin: 0 auto;" type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="Puesto<?= $id ?>" value="<?= (is_array($res[$i])) ? $res[$i]['puesto'] : $res[$i] ?>" >
                                </td>                                
                                <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                                    <td  style="background-color:lightblue">              
                                        <a class="puntero cambios"  onClick="javascript:eliminarFilafuncion(this);">                                 
                                            <div class="text-center"><i class="fa fa-close  text-danger " title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                                        </a>                             
                                    </td>
                                    <td  style="background-color:lightblue">                                        
                                        <a class="puntero cambios"  onclick="javascript: agregarFilafuncion('<?= $vocab["symbol_delete"] ?>', '<?= $vocab["Menu_Datos_sin_guardar"] ?>','Pues-<?= $id ?>');">                                 
                                            <div class="text-center"><i class="fa fa-plus  text-success " title="<?= $vocab["symbol_add"] ?>"></i></div>                                       
                                        </a> 
                                    </td> 
                                    <?php
                                    $id++;
                                }
                                ?>
                            </tr>

                            <?php
                        }
                        ?>

                        <tr id="fil-<?= $id ?>">
                            <td> <textarea  rows="1" type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="funcion<?= $id ?>" ><?= (is_array($res[$i])) ? $res[$i]['funcion'] : ""; ?></textarea></td>
                            <td> <textarea rows="1" type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido  cambios" id="plazo<?= $id ?>" ><?= (is_array($res[$i])) ? $res[$i]['plazoEjecucion'] : ""; ?></textarea></td>
                           

                            <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                                <td>              
                                    <a class="puntero cambios"  onClick="javascript:eliminarFilafuncion(this);">                                 
                                        <div class="text-center"><i class="fa fa-close  text-danger " title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                                    </a>                             
                                </td>
                                <td></td>
                            <?php } ?>
                        </tr>   
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>  
    <div class="text-center">
        <?php if ($editar) { ?>
            <span class="text-center">
                <a class="btn btn-warning"  onclick="javascript:guardarPuestoBrigada('<?= $idPlanEmergencia ?>', 0)" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["datos_generares_datos"] ?></a>
            </span>   
            <span class="text-center">
                <a class="btn btn-success"  onclick="javascript:guardarPuestoBrigada('<?= $idPlanEmergencia ?>', 1)" name="submit"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_save"] . " " . $vocab["datos_generares_siguente"] ?></a>
            </span>
        <?php } ?>
    </div>


