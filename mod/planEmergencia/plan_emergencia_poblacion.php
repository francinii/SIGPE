<?php
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
include("plan_emergencia_menu.php");
?>
<!------------------------------------  Recurso Humano ----------------------------------- ------------------- ----------->
<?php
$sql = "SELECT  `nombreOficina`, `capacidadPermanente`, `capacidadTemporal`, `representanteComite`,"
        . " `representanteBrigadaEfectiva`,`representantePrimerosAuxilios`,`telefonoOficina`,`contactoEmergencia`,`telefonoPersonal`,`correoElectronico`"
        . ",`correoElectronico`,`sector` FROM `FormularioPoblacion` WHERE `FKidZonaTrabajo`=" . $idPlanEmergencia . " order by `sector` ";
$res = seleccion($sql);

if (count($res) <= 0) {
    $res = array('0');
}
?>
<div class="well well-sm">
    <h2><?= $vocab["poblacion_titulo"] ?></h2>
    <p><?= $vocab["poblacion_titulo_desc"] ?></p>
    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
            <span class="text-center" >
                <a class="btn btn-info" onclick="javascript: agregarFilaSector('<?= $vocab["symbol_delete"] ?>', '<?= $vocab["Menu_Datos_sin_guardar"] ?>','<?= $vocab["symbol_add"] ?>','<?= $vocab["poblacion_sectorNuevo"]?>','<?= $vocab["inventario_sector"] ?>');"><i class=" fa fa-plus text-info"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_sector"] ?>  </a>
            </span>            
        <?php } ?>
    </div>
</div>
    <div   class="dataTables_wrapper   dt-bootstrap" style = "overflow-x:auto;">
        <table  style = "width: 99%" id="lista_poblacion" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
            <thead >
                <tr>
                    <th  width="10%"><?= $vocab["poblacion_oficina"] ?></th>
                    <th  width="2%"><?= $vocab["poblacion_ocuapcional"] ?></th>
                    <th  width="2%"><?= $vocab["poblacion_temporal"] ?></th>                
                    <th  width="5%"><?= $vocab["poblacion_representante_comite"] ?></th>   
                    <th  width="5%"><?= $vocab["poblacion_representante_brigada"] ?></th>   
                    <th  width="5%"><?= $vocab["poblacion_representante_primerosAuxilios"] ?></th>  
                    <th  width="5%"><?= $vocab["poblacion_telefono_oficina"] ?></th>  
                    <th  width="5%"><?= $vocab["poblacion_contactoEmergencia"] ?></th>  
                    <th  width="5%"><?= $vocab["poblacion_telefono_personal"] ?></th>
                    <th  width="5%"><?= $vocab["poblacion_correo"] ?></th>                     
                    <?php if ($editar) { ?>
                        <th width="2%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                        <th width="2%"><div class="text-center"><i class="fa fa-plus  fa-2x text-success puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody>
                <?php
                if (count($res) > 0) {
                    $sectorActual = "";                  
                    ?>
                    <?php
                    for ($i = 0, $id = 0; $i < count($res); $i++, $id++) {
                        $sector = ((is_array($res[$i])) ? $res[$i]['sector'] :  $vocab["poblacion_sectorNuevo"]);
                        if ($sectorActual != $sector) {
                            $sectorActual = $sector;
                            ?>
                            <tr class="seccionPoblacion" id="Sec-<?= $id ?>">                   
                                <td style="align-items:center; background-color:lightblue" colspan="10">
                                    <label style="text-align:right; margin: 0 auto; " for="Sector<?= $id ?>" class="col-sm-3 col-form-label"><?= $vocab["inventario_sector"] ?>:</label>
                                    <input style="width:40%;" type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="Sector<?= $id ?>" value="<?= (is_array($res[$i])) ? $res[$i]['sector'] : $vocab["poblacion_sectorNuevo"] ?>" >
                                </td>                                
                                <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                                    <td  style="background-color:lightblue">              
                                        <a class="puntero cambios"  onClick="javascript:eliminarFilaPoblacion(this);">                                 
                                            <div class="text-center"><i class="fa fa-close  text-danger " title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                                        </a>                             
                                    </td>
                                    <td  style="background-color:lightblue">                                        
                                        <a class="puntero cambios"  onclick="javascript: agregarFilaPoblacion('<?= $vocab["symbol_delete"] ?>', '<?= $vocab["Menu_Datos_sin_guardar"] ?>','Sec-<?= $id ?>');">                                 
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
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="nombreOficina<?= $id ?>" value="<?= (is_array($res[$i])) ? $res[$i]['nombreOficina'] : ""; ?>" ></td>
                            <td> <input  type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control requerido  cambios" id="capacidadPermanente<?= $id ?>" value="<?= (is_array($res[$i])) ? $res[$i]['capacidadPermanente'] : "0"; ?>" ></td>
                            <td> <input  type="number"  <?= (!$editar) ? "readonly" : ""; ?> min="0"  class="form-control requerido cambios" id="capacidadTemporal<?= $id ?>" value="<?= (is_array($res[$i])) ? $res[$i]['capacidadTemporal'] : "0"; ?>" ></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control requerido cambios" id="representanteComite<?= $id ?>" value="<?= (is_array($res[$i])) ? $res[$i]['representanteComite'] : ""; ?>" ></td>                            
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="representanteBrigadaEfectiva<?= $id ?>" value="<?= (is_array($res[$i])) ? $res[$i]['representanteBrigadaEfectiva'] : ""; ?>" ></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="representantePrimerosAuxilios<?= $id ?>" value="<?= (is_array($res[$i])) ? $res[$i]['representantePrimerosAuxilios'] : ""; ?>" ></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control requerido  cambios" id="telefonoOficina<?= $id ?>" value="<?= (is_array($res[$i])) ? $res[$i]['telefonoOficina'] : ""; ?>" ></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control requerido cambios" id="contactoEmergencia<?= $id ?>" value="<?= (is_array($res[$i])) ? $res[$i]['contactoEmergencia'] : ""; ?>" ></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control requerido cambios" id="telefonoPersonal<?= $id ?>" value="<?= (is_array($res[$i])) ? $res[$i]['telefonoPersonal'] : ""; ?>" ></td>                            
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="correoElectronico<?= $id ?>" value="<?= (is_array($res[$i])) ? $res[$i]['correoElectronico'] : ""; ?>" ></td>

                            <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                                <td>              
                                    <a class="puntero cambios"  onClick="javascript:eliminarFila(this);">                                 
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
                <a class="btn btn-warning"  onclick="javascript:guardarPoblacion('<?= $idPlanEmergencia ?>', 0)" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["datos_generares_datos"] ?></a>
            </span>   
            <span class="text-center">
                <a class="btn btn-success"  onclick="javascript:guardarPoblacion('<?= $idPlanEmergencia ?>', 1)" name="submit"><i class="fa fa-rotate-right"></i> <?= $vocab["symbol_save"] . " " . $vocab["datos_generares_siguente"] ?></a>
            </span>
        <?php } ?>
    </div>


