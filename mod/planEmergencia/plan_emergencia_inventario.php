<?php
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
include("plan_emergencia_menu.php");
?>
<!------------------------------------  Recurso Humano ----------------------------------- ------------------- ----------->
<?php
$sql = "SELECT  `cantidad`, `profesion`, `categorias`, `localizacion`,"
        . " `contacto` FROM `RecursoHumanos` WHERE `FKidZonaTrabajo`=" . $idPlanEmergencia;
$res = seleccion($sql);

if (count($res) <= 0) {
    $res = array('0');
}
?>
<div class="well well-sm">
    <p><b><?= $vocab["recurso_humano_titulo"] ?></b></p>
    <p><?= $vocab["recurso_humano_titulo_desc"] ?></p>
    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
            <span class="text-center" >
                <a class="btn btn-success" onclick="javascript:agregarFilaRecursoHumano('<?= $vocab["symbol_delete"] ?>','<?= $vocab["Menu_Datos_sin_guardar"] ?>');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?>  </a>
            </span>
        <?php } ?>
    </div>
    <div   class="dataTables_wrapper   dt-bootstrap" style = "overflow-x:auto;">
        <table style = "width: 99%;" id="lista_recurso_humano" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
            <thead style="background-color: lightblue;">
                <tr>
                    <th  width="5%"><?= $vocab["recurso_humano_Profesion"] ?></th>
                    <th  width="2%"><?= $vocab["recurso_humano_Cantidad"] ?></th>
                    <th  width="2%"><?= $vocab["recurso_humano_categoria"] ?></th>                
                    <th  width="5%"><?= $vocab["recurso_humano_Localizacion"] ?></th>   
                    <th  width="5%"><?= $vocab["recurso_humano_Contacto"] ?></th>                    
                    <?php if ($editar) { ?>
                        <th width="2%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody>
                <?php
                if (count($res) > 0) {
                    for ($i = 0; $i < count($res); $i++) {
                        ?>
                        <tr id="H-<?= $i ?>">
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="H-profesion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['profesion'] : ""; ?>" ></td>
                            <td> <input  type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control requerido  cambios" id="H-cantidad<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['cantidad'] : "0"; ?>" ></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control requerido cambios" id="H-categoria<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['categorias'] : ""; ?>" ></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control requerido cambios" id="H-localizacion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['localizacion'] : ""; ?>" ></td>                            
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="H-contacto<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['contacto'] : ""; ?>" ></td>

                            <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                                <td>              
                                    <a class="puntero cambios"  onClick="javascript:eliminarFila(this);">                                 
                                        <div class="text-center"><i class="fa fa-close  text-danger " title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                                    </a>                             
                                </td>
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
                <a class="btn btn-warning"  onclick="javascript:guardarRecursoHumano('<?= $idPlanEmergencia ?>', 0)" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["recurso_humano_titulo"] ?></a>
            </span>         
        <?php } ?>
    </div>
</div>


<!--------------------------------- Inventario equipo movil------------------------------- ------------------------------------->
<?php
$sql = "SELECT `cantidad`, `capacidad`, `tipo`, `caracteristicas`,"
        . " `contacto`, `ubicacion`, `categoria` FROM `EquipoMovil` WHERE `FKidZonaTrabajo`=" . $idPlanEmergencia;
$res = seleccion($sql);

if (count($res) <= 0) {
    $res = array('0');
}
?>

<script>
    var combo = ['<?= $vocab["equipo_moviles_Aereo"] ?>', '<?= $vocab["equipo_moviles_Acuático"] ?>', '<?= $vocab["equipo_moviles_terrestre"] ?>'];
</script>

<div class="well well-sm">
    <p><b><?= $vocab["equipo_moviles_titulo"] ?></b></p>
    <p><?= $vocab["equipo_moviles_titulo_desc"] ?></p>
    <div align="right" style = "padding-right:0.5%;">
          <?php if ($editar) { ?>
        <span class="text-center" >
            <a class="btn btn-success" onclick="javascript: agregarFilaEquipo('<?= $vocab["symbol_delete"] ?>', combo,'<?= $vocab["Menu_Datos_sin_guardar"] ?>');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?></a>
        </span>
  <?php } ?>
    </div>
    <div   class="dataTables_wrapper   dt-bootstrap" style = "overflow-x:auto;">
        <table style = "width: 99%;" id="lista_equipos" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
            <thead style="background-color: lightblue;">
                <tr>
                    <th  width="5%"><?= $vocab["equipo_moviles_tipo"] ?></th>
                    <th  width="2%"><?= $vocab["equipo_moviles_cantidad"] ?></th>
                    <th  width="2%"><?= $vocab["equipo_moviles_capacidad"] ?></th>                
                    <th  width="5%"><?= $vocab["equipo_moviles_caracteristicas"] ?></th>   
                    <th  width="5%"><?= $vocab["equipo_moviles_contacto"] ?></th>
                    <th  width="5%"><?= $vocab["equipo_moviles_ubicacion"] ?></th>                
                    <th  width="5%"><?= $vocab["equipo_moviles_categoria"] ?></th>
                    <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                        <th width="2%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($res) > 0) {
                    for ($i = 0; $i < count($res); $i++) {
                        ?>
                        <tr id="E-<?= $i ?>">
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="E-tipoEquipo<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['tipo'] : ""; ?>" ></td>
                            <td> <input  type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control requerido  cambios" id="E-cantidad<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['cantidad'] : "0"; ?>" ></td>
                            <td> <input  type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control requerido cambios" id="E-capacidad<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['capacidad'] : "0"; ?>" ></td>
                            <td><textarea rows="1" style ="width: 100%;"  type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="E-caracteristica<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['caracteristicas'] : ""; ?></textarea></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control  requerido cambios" id="E-contacto<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['contacto'] : ""; ?>" ></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control  requerido cambios" id="E-ubicacion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['ubicacion'] : ""; ?>" ></td>
                            <td> <select id="E-categoria<?= $i ?>" <?= (!$editar) ? "Disabled" : ""; ?> name="select_subcapitulos" class="form-control cambios"></select></td>
                    <script>
                        selectEquipos(<?= $i ?>, combo, '<?= (is_array($res[$i])) ? $res[$i]['categoria'] : 'nada'; ?>');
                    </script>                                                      
                    <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                        <td>              
                            <a class="puntero cambios"  onClick="javascript:eliminarFila(this);">                                 
                                <div class="text-center"><i class="fa fa-close  text-danger " title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                            </a>                             
                        </td>
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
                <a class="btn btn-warning"  onclick="javascript:guardarequipoMovil('<?= $idPlanEmergencia ?>', 0)" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["equipo_moviles_titulo"] ?></a>
            </span>         

        <?php } ?>
    </div>
</div>

<!---------------------------------Recurso intalaciones------------------------------- ------------------------------------->
<?php
$sql = "SELECT `tipo`, `cantidad`, `tamaño`, `distribucion`,"
        . " `contacto`, `ubicacion` FROM `RecursoIntalaciones` WHERE `FKidZonaTrabajo`=" . $idPlanEmergencia;
$res = seleccion($sql);

if (count($res) <= 0) {
    $res = array('0');
}
?>

<div class="well well-sm">
    <p><b><?= $vocab["instalaciones_titulo"] ?></b></p>
    <p><?= $vocab["instalaciones_titulo_desc"] ?></p>
    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
        <span class="text-center" >
            <a class="btn btn-success" onclick="javascript: agregarFilaRecursoInstalaciones('<?= $vocab["symbol_delete"] ?>','<?= $vocab["Menu_Datos_sin_guardar"] ?>');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?></a>
        </span>
<?php } ?>
    </div>
    <div   class="dataTables_wrapper  dt-bootstrap" style = "overflow-x:auto;">
        <table style = "width: 99%;" id="lista_Instalaciones" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
            <thead style="background-color: lightblue;">
                <tr>
                    <th  width="5%"><?= $vocab["instalaciones_tipo"] ?></th>
                    <th  width="2%"><?= $vocab["instalaciones_cantida"] ?></th>
                    <th  width="2%"><?= $vocab["instalaciones_tamaño"] ?></th>                
                    <th  width="5%"><?= $vocab["instalaciones_distribucion"] ?></th>   
                    <th  width="5%"><?= $vocab["instalaciones_encargada"] ?></th>
                    <th  width="5%"><?= $vocab["instalaciones_ubicacion"] ?></th>                                
                    <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                        <th width="2%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody>
                <?php
                if (count($res) > 0) {
                    for ($i = 0; $i < count($res); $i++) {
                        ?>
                        <tr id="I-<?= $i ?>">
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="I-tipo<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['tipo'] : ""; ?>" ></td>
                            <td> <input  type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control requerido  cambios" id="I-cantidad<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['cantidad'] : "0"; ?>" ></td>
                            <td> <input  type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control requerido cambios" id="I-tamano<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['tamaño'] : "0"; ?>" ></td>                                                      
                           <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control  requerido cambios" id="I-distribucion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['distribucion'] : ""; ?>" ></td>
                            <td><textarea rows="1" style ="width: 100%;"  type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="I-contacto<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['contacto'] : ""; ?></textarea></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control  requerido cambios" id="I-ubicacion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['ubicacion'] : ""; ?>" ></td>
                                                                                  
                    <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                        <td>              
                            <a class="puntero cambios"  onClick="javascript:eliminarFila(this);">                                 
                                <div class="text-center"><i class="fa fa-close  text-danger " title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                            </a>                             
                        </td>
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
                <a class="btn btn-warning"  onclick="javascript:guardarRecursoInstalaciones('<?= $idPlanEmergencia ?>', 0)" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["instalaciones_titulo"] ?></a>
            </span>         
        <?php } ?>
    </div>
</div>

<!------------------------------------  Recurso telecomunicaciones ----------------------------------- ------------------- ----------->
<?php
$categoria='telecomunicaciones';
$prefijo='T-';
$tablaID="lista_telecomunicaciones";
$sql = "SELECT  `cantidad`, `tipo`, `caracteristicas`, `contacto`,"
        . " `ubicacion`,`categoria`,`observaciones` FROM `InventarioOtros` WHERE `FKidZonaTrabajo`=$idPlanEmergencia and `categoria`='$categoria' ";
$res = seleccion($sql);

if (count($res) <= 0) {
    $res = array('0');
}
?>
<div class="well well-sm">
    <p><b><?= $vocab["otros_recursos_Telecomunicacion"] ?></b></p>
    <p><?= $vocab["otros_recursos_Telecomunicacion_desc"] ?></p>
    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
            <span class="text-center" >
                <a class="btn btn-success" onclick="javascript: agregarOtrosInventario('<?= $vocab["symbol_delete"] ?>','<?= $prefijo ?>','#<?=$tablaID?>','<?= $vocab["Menu_Datos_sin_guardar"] ?>');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?>  </a>
            </span>
        <?php } ?>
    </div>
    <div   class="dataTables_wrapper dt-bootstrap" style = "overflow-x:auto;">
        <table style = "width: 99%;" id="<?=$tablaID?>" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
            <thead style="background-color: lightblue;">
                <tr>
                    <th  width="5%"><?= $vocab["otros_recursos_tipo"] ?></th>
                    <th  width="2%"><?= $vocab["otros_recursos_cantidad"] ?></th>
                    <th  width="5%"><?= $vocab["otros_recursos_caracteristicas"] ?></th>                
                    <th  width="5%"><?= $vocab["otros_recursos_contacto"] ?></th>   
                    <th  width="5%"><?= $vocab["otros_recursos_ubicacion"] ?></th> 
                    <th  width="5%"><?= $vocab["otros_recursos_observaciones"] ?></th> 
                    <?php if ($editar) { ?>
                        <th width="2%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody>
                <?php
                if (count($res) > 0) {
                    for ($i = 0; $i < count($res); $i++) {
                        ?>
                        <tr id="<?= $prefijo.$i ?>">
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>tipo<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['tipo'] : ""; ?>" ></td>
                            <td> <input  type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control requerido  cambios" id="<?= $prefijo ?>cantidad<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['cantidad'] : "0"; ?>" ></td>
                             <td><textarea rows="1"   type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>caracteristicas<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['caracteristicas'] : ""; ?></textarea></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control requerido cambios" id="<?= $prefijo ?>contacto<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['contacto'] : ""; ?>" ></td>                            
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>ubicacion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['ubicacion'] : ""; ?>" ></td>
                             <td><textarea rows="1"  type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>observaciones<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['observaciones'] : ""; ?></textarea></td>

                            <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                                <td>              
                                    <a class="puntero cambios"  onClick="javascript:eliminarFila(this);">                                 
                                        <div class="text-center"><i class="fa fa-close  text-danger " title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                                    </a>                             
                                </td>
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
                <a class="btn btn-warning"  onclick="javascript:guardarOtrosInventario('<?= $idPlanEmergencia ?>', 0,'<?= $prefijo ?>','<?=$categoria?>','<?=$tablaID?>')" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["otros_recursos_Telecomunicacion"] ?></a>
            </span>         
        <?php } ?>
    </div>
</div>

<!------------------------------------  Recurso para repuestos ----------------------------------- ------------------- ----------->
<?php
$categoria='repuestos';
$prefijo='R-';
$tablaID="lista_repuestos";
$sql = "SELECT  `cantidad`, `tipo`, `caracteristicas`, `contacto`,"
        . " `ubicacion`,`categoria`,`observaciones` FROM `InventarioOtros` WHERE `FKidZonaTrabajo`=$idPlanEmergencia and `categoria`='$categoria' ";
$res = seleccion($sql);

if (count($res) <= 0) {
    $res = array('0');
}
?>
<div class="well well-sm">
    <p><b><?= $vocab["otros_recursos_equipo_repuestos"] ?></b></p>
    <p><?= $vocab["otros_recursos_equipo_repuestos_desc"] ?></p>
    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
            <span class="text-center" >
                <a class="btn btn-success" onclick="javascript: agregarOtrosInventario('<?= $vocab["symbol_delete"] ?>','<?= $prefijo ?>','#<?=$tablaID?>','<?= $vocab["Menu_Datos_sin_guardar"] ?>');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?>  </a>
            </span>
        <?php } ?>
    </div>
    <div   class="dataTables_wrapper dt-bootstrap" style = "overflow-x:auto;">
        <table style = "width: 99%;" id="<?=$tablaID?>" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
            <thead style="background-color: lightblue;">
                <tr>
                    <th  width="5%"><?= $vocab["otros_recursos_tipo"] ?></th>
                    <th  width="2%"><?= $vocab["otros_recursos_cantidad"] ?></th>
                    <th  width="5%"><?= $vocab["otros_recursos_caracteristicas"] ?></th>                
                    <th  width="5%"><?= $vocab["otros_recursos_contacto"] ?></th>   
                    <th  width="5%"><?= $vocab["otros_recursos_ubicacion"] ?></th> 
                    <th  width="5%"><?= $vocab["otros_recursos_observaciones"] ?></th> 
                    <?php if ($editar) { ?>
                        <th width="2%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody>
                <?php
                if (count($res) > 0) {
                    for ($i = 0; $i < count($res); $i++) {
                        ?>
                        <tr id="<?= $prefijo.$i ?>">
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>tipo<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['tipo'] : ""; ?>" ></td>
                            <td> <input  type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control requerido  cambios" id="<?= $prefijo ?>cantidad<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['cantidad'] : "0"; ?>" ></td>
                             <td><textarea rows="1"   type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>caracteristicas<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['caracteristicas'] : ""; ?></textarea></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control requerido cambios" id="<?= $prefijo ?>contacto<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['contacto'] : ""; ?>" ></td>                            
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>ubicacion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['ubicacion'] : ""; ?>" ></td>
                             <td><textarea rows="1"  type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>observaciones<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['observaciones'] : ""; ?></textarea></td>

                            <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                                <td>              
                                    <a class="puntero cambios"  onClick="javascript:eliminarFila(this);">                                 
                                        <div class="text-center"><i class="fa fa-close  text-danger " title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                                    </a>                             
                                </td>
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
                <a class="btn btn-warning"  onclick="javascript:guardarOtrosInventario('<?= $idPlanEmergencia ?>', 0,'<?= $prefijo ?>','<?=$categoria?>','<?=$tablaID?>')" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["otros_recursos_Telecomunicacion"] ?></a>
            </span>         
        <?php } ?>
    </div>
</div>
<!------------------------------------  Recurso para repuestos almacenaniento de agua ----------------------------------- ------------------- ----------->
<?php
$categoria='recursosAgua';
$prefijo='RA-';
$tablaID="lista_repuestosAgua";
$sql = "SELECT  `cantidad`, `tipo`, `caracteristicas`, `contacto`,"
        . " `ubicacion`,`categoria`,`observaciones` FROM `InventarioOtros` WHERE `FKidZonaTrabajo`=$idPlanEmergencia and `categoria`='$categoria' ";
$res = seleccion($sql);

if (count($res) <= 0) {
    $res = array('0');
}
?>
<div class="well well-sm">
    <p><b><?= $vocab["otros_recursos_equipo_repuestosAgua"] ?></b></p>
    <p><?= $vocab["otros_recursos_equipo_repuestosAgua_desc"] ?></p>
    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
            <span class="text-center" >
                <a class="btn btn-success" onclick="javascript: agregarOtrosInventario('<?= $vocab["symbol_delete"] ?>','<?= $prefijo ?>','#<?=$tablaID?>','<?= $vocab["Menu_Datos_sin_guardar"] ?>');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?>  </a>
            </span>
        <?php } ?>
    </div>
    <div   class="dataTables_wrapper dt-bootstrap" style = "overflow-x:auto;">
        <table style = "width: 99%;" id="<?=$tablaID?>" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
            <thead style="background-color: lightblue;">
                <tr>
                    <th  width="5%"><?= $vocab["otros_recursos_tipo"] ?></th>
                    <th  width="2%"><?= $vocab["otros_recursos_cantidad"] ?></th>
                    <th  width="5%"><?= $vocab["otros_recursos_caracteristicas"] ?></th>                
                    <th  width="5%"><?= $vocab["otros_recursos_contacto"] ?></th>   
                    <th  width="5%"><?= $vocab["otros_recursos_ubicacion"] ?></th> 
                    <th  width="5%"><?= $vocab["otros_recursos_observaciones"] ?></th> 
                    <?php if ($editar) { ?>
                        <th width="2%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody>
                <?php
                if (count($res) > 0) {
                    for ($i = 0; $i < count($res); $i++) {
                        ?>
                        <tr id="<?= $prefijo.$i ?>">
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>tipo<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['tipo'] : ""; ?>" ></td>
                            <td> <input  type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control requerido  cambios" id="<?= $prefijo ?>cantidad<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['cantidad'] : "0"; ?>" ></td>
                             <td><textarea rows="1"   type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>caracteristicas<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['caracteristicas'] : ""; ?></textarea></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control requerido cambios" id="<?= $prefijo ?>contacto<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['contacto'] : ""; ?>" ></td>                            
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>ubicacion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['ubicacion'] : ""; ?>" ></td>
                             <td><textarea rows="1"  type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>observaciones<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['observaciones'] : ""; ?></textarea></td>

                            <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                                <td>              
                                    <a class="puntero cambios"  onClick="javascript:eliminarFila(this);">                                 
                                        <div class="text-center"><i class="fa fa-close  text-danger " title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                                    </a>                             
                                </td>
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
                <a class="btn btn-warning"  onclick="javascript:guardarOtrosInventario('<?= $idPlanEmergencia ?>', 0,'<?= $prefijo ?>','<?=$categoria?>','<?=$tablaID?>')" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["otros_recursos_Telecomunicacion"] ?></a>
            </span>         
        <?php } ?>
    </div>
</div>
<!------------------------------------  Recurso para repuestos energia----------------------------------- ------------------- ----------->
<?php
$categoria='recursosEnergia';
$prefijo='RE-';
$tablaID="lista_recursosEnergia";
$sql = "SELECT  `cantidad`, `tipo`, `caracteristicas`, `contacto`,"
        . " `ubicacion`,`categoria`,`observaciones` FROM `InventarioOtros` WHERE `FKidZonaTrabajo`=$idPlanEmergencia and `categoria`='$categoria' ";
$res = seleccion($sql);

if (count($res) <= 0) {
    $res = array('0');
}
?>
<div class="well well-sm">
    <p><b><?= $vocab["otros_recursos_equipo_repuestosEnergia"] ?></b></p>
    <p><?= $vocab["otros_recursos_equipo_repuestosEnergia_desc"] ?></p>
    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
            <span class="text-center" >
                <a class="btn btn-success" onclick="javascript: agregarOtrosInventario('<?= $vocab["symbol_delete"] ?>','<?= $prefijo ?>','#<?=$tablaID?>','<?= $vocab["Menu_Datos_sin_guardar"] ?>');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?>  </a>
            </span>
        <?php } ?>
    </div>
    <div   class="dataTables_wrapper dt-bootstrap" style = "overflow-x:auto;">
        <table style = "width: 99%;" id="<?=$tablaID?>" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
            <thead style="background-color: lightblue;">
                <tr>
                    <th  width="5%"><?= $vocab["otros_recursos_tipo"] ?></th>
                    <th  width="2%"><?= $vocab["otros_recursos_cantidad"] ?></th>
                    <th  width="5%"><?= $vocab["otros_recursos_caracteristicas"] ?></th>                
                    <th  width="5%"><?= $vocab["otros_recursos_contacto"] ?></th>   
                    <th  width="5%"><?= $vocab["otros_recursos_ubicacion"] ?></th> 
                    <th  width="5%"><?= $vocab["otros_recursos_observaciones"] ?></th> 
                    <?php if ($editar) { ?>
                        <th width="2%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody>
                <?php
                if (count($res) > 0) {
                    for ($i = 0; $i < count($res); $i++) {
                        ?>
                        <tr id="<?= $prefijo.$i ?>">
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>tipo<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['tipo'] : ""; ?>" ></td>
                            <td> <input  type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control requerido  cambios" id="<?= $prefijo ?>cantidad<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['cantidad'] : "0"; ?>" ></td>
                             <td><textarea rows="1"   type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>caracteristicas<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['caracteristicas'] : ""; ?></textarea></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control requerido cambios" id="<?= $prefijo ?>contacto<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['contacto'] : ""; ?>" ></td>                            
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>ubicacion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['ubicacion'] : ""; ?>" ></td>
                             <td><textarea rows="1"  type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>observaciones<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['observaciones'] : ""; ?></textarea></td>

                            <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                                <td>              
                                    <a class="puntero cambios"  onClick="javascript:eliminarFila(this);">                                 
                                        <div class="text-center"><i class="fa fa-close  text-danger " title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                                    </a>                             
                                </td>
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
                <a class="btn btn-warning"  onclick="javascript:guardarOtrosInventario('<?= $idPlanEmergencia ?>', 0,'<?= $prefijo ?>','<?=$categoria?>','<?=$tablaID?>')" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["otros_recursos_Telecomunicacion"] ?></a>
            </span>         
        <?php } ?>
    </div>
</div>
<!------------------------------------   SISTEMAS FIJOS CONTRA INCENDIO----------------------------------- ------------------- ----------->
<?php
$categoria='sistemasIncendios';
$prefijo='SI-';
$tablaID="lista_sistemasIncendios";
$sql = "SELECT  `cantidad`, `tipo`, `caracteristicas`, `contacto`,"
        . " `ubicacion`,`categoria`,`observaciones` FROM `InventarioOtros` WHERE `FKidZonaTrabajo`=$idPlanEmergencia and `categoria`='$categoria' ";
$res = seleccion($sql);

if (count($res) <= 0) {
    $res = array('0');
}
?>
<div class="well well-sm">
    <p><b><?= $vocab["otros_recursos_sistemas_insendios"] ?></b></p>
    <p><?= $vocab["otros_recursos_sistemas_insendios_desc"] ?></p>
    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
            <span class="text-center" >
                <a class="btn btn-success" onclick="javascript: agregarOtrosInventario('<?= $vocab["symbol_delete"] ?>','<?= $prefijo ?>','#<?=$tablaID?>','<?= $vocab["Menu_Datos_sin_guardar"] ?>');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?>  </a>
            </span>
        <?php } ?>
    </div>
    <div   class="dataTables_wrapper dt-bootstrap" style = "overflow-x:auto;">
        <table style = "width: 99%;" id="<?=$tablaID?>" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
            <thead style="background-color: lightblue;">
                <tr>
                    <th  width="5%"><?= $vocab["otros_recursos_tipo"] ?></th>
                    <th  width="2%"><?= $vocab["otros_recursos_cantidad"] ?></th>
                    <th  width="5%"><?= $vocab["otros_recursos_caracteristicas"] ?></th>                
                    <th  width="5%"><?= $vocab["otros_recursos_contacto"] ?></th>   
                    <th  width="5%"><?= $vocab["otros_recursos_ubicacion"] ?></th> 
                    <th  width="5%"><?= $vocab["otros_recursos_observaciones"] ?></th> 
                    <?php if ($editar) { ?>
                        <th width="2%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody>
                <?php
                if (count($res) > 0) {
                    for ($i = 0; $i < count($res); $i++) {
                        ?>
                        <tr id="<?= $prefijo.$i ?>">
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>tipo<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['tipo'] : ""; ?>" ></td>
                            <td> <input  type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control requerido  cambios" id="<?= $prefijo ?>cantidad<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['cantidad'] : "0"; ?>" ></td>
                             <td><textarea rows="1"   type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>caracteristicas<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['caracteristicas'] : ""; ?></textarea></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control requerido cambios" id="<?= $prefijo ?>contacto<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['contacto'] : ""; ?>" ></td>                            
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>ubicacion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['ubicacion'] : ""; ?>" ></td>
                             <td><textarea rows="1"  type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>observaciones<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['observaciones'] : ""; ?></textarea></td>

                            <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                                <td>              
                                    <a class="puntero cambios"  onClick="javascript:eliminarFila(this);">                                 
                                        <div class="text-center"><i class="fa fa-close  text-danger " title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                                    </a>                             
                                </td>
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
                <a class="btn btn-warning"  onclick="javascript:guardarOtrosInventario('<?= $idPlanEmergencia ?>', 0,'<?= $prefijo ?>','<?=$categoria?>','<?=$tablaID?>')" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["otros_recursos_Telecomunicacion"] ?></a>
            </span>         
        <?php } ?>
    </div>
</div>
<!------------------------------------   EQUIPAMIENTO DE PRIMERA RESPUESTA----------------------------------- ------------------- ----------->
<?php
$categoria='EquipoPrimeraRespuesta';
$prefijo='EPR-';
$tablaID="lista_EquipoPrimeraRespuesta";
$sql = "SELECT  `cantidad`, `tipo`, `caracteristicas`, `contacto`,"
        . " `ubicacion`,`categoria`,`observaciones` FROM `InventarioOtros` WHERE `FKidZonaTrabajo`=$idPlanEmergencia and `categoria`='$categoria' ";
$res = seleccion($sql);

if (count($res) <= 0) {
    $res = array('0');
}
?>
<div class="well well-sm">
    <p><b><?= $vocab["otros_recursos_Equipo_primeraRespuesta"] ?></b></p>
    <p><?= $vocab["otros_recursos_Equipo_primeraRespuesta_desc"] ?></p>
    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
            <span class="text-center" >
                <a class="btn btn-success" onclick="javascript: agregarOtrosInventario('<?= $vocab["symbol_delete"] ?>','<?= $prefijo ?>','#<?=$tablaID?>','<?= $vocab["Menu_Datos_sin_guardar"] ?>');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?>  </a>
            </span>
        <?php } ?>
    </div>
    <div   class="dataTables_wrapper dt-bootstrap" style = "overflow-x:auto;">
        <table style = "width: 99%;" id="<?=$tablaID?>" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
            <thead style="background-color: lightblue;">
                <tr>
                    <th  width="5%"><?= $vocab["otros_recursos_tipo"] ?></th>
                    <th  width="2%"><?= $vocab["otros_recursos_cantidad"] ?></th>
                    <th  width="5%"><?= $vocab["otros_recursos_caracteristicas"] ?></th>                
                    <th  width="5%"><?= $vocab["otros_recursos_contacto"] ?></th>   
                    <th  width="5%"><?= $vocab["otros_recursos_ubicacion"] ?></th> 
                    <th  width="5%"><?= $vocab["otros_recursos_observaciones"] ?></th> 
                    <?php if ($editar) { ?>
                        <th width="2%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody>
                <?php
                if (count($res) > 0) {
                    for ($i = 0; $i < count($res); $i++) {
                        ?>
                        <tr id="<?= $prefijo.$i ?>">
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>tipo<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['tipo'] : ""; ?>" ></td>
                            <td> <input  type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control requerido  cambios" id="<?= $prefijo ?>cantidad<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['cantidad'] : "0"; ?>" ></td>
                             <td><textarea rows="1"   type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>caracteristicas<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['caracteristicas'] : ""; ?></textarea></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control requerido cambios" id="<?= $prefijo ?>contacto<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['contacto'] : ""; ?>" ></td>                            
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>ubicacion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['ubicacion'] : ""; ?>" ></td>
                             <td><textarea rows="1"  type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>observaciones<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['observaciones'] : ""; ?></textarea></td>

                            <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                                <td>              
                                    <a class="puntero cambios"  onClick="javascript:eliminarFila(this);">                                 
                                        <div class="text-center"><i class="fa fa-close  text-danger " title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                                    </a>                             
                                </td>
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
                <a class="btn btn-warning"  onclick="javascript:guardarOtrosInventario('<?= $idPlanEmergencia ?>', 0,'<?= $prefijo ?>','<?=$categoria?>','<?=$tablaID?>')" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["otros_recursos_Telecomunicacion"] ?></a>
            </span>         
        <?php } ?>
    </div>
</div>
<!------------------------------------   SEÑALIZACIÓN ----------------------------------- ------------------- ----------->
<?php
$categoria='señalizacion';
$prefijo='S-';
$tablaID="lista_señalizacion";
$sql = "SELECT  `cantidad`, `tipo`, `caracteristicas`, `contacto`,"
        . " `ubicacion`,`categoria`,`observaciones` FROM `InventarioOtros` WHERE `FKidZonaTrabajo`=$idPlanEmergencia and `categoria`='$categoria' ";
$res = seleccion($sql);

if (count($res) <= 0) {
    $res = array('0');
}
?>
<div class="well well-sm">
    <p><b><?= $vocab["otros_recursos_Señalizacion"] ?></b></p>
    <p><?= $vocab["otros_recursos_Señalizacion_desc"] ?></p>
    <div align="right" style = "padding-right:0.5%;">
        <?php if ($editar) { ?>
            <span class="text-center" >
                <a class="btn btn-success" onclick="javascript: agregarOtrosInventario('<?= $vocab["symbol_delete"] ?>','<?= $prefijo ?>','#<?=$tablaID?>','<?= $vocab["Menu_Datos_sin_guardar"] ?>');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?>  </a>
            </span>
        <?php } ?>
    </div>
    <div   class="dataTables_wrapper dt-bootstrap" style = "overflow-x:auto;">
        <table style = "width: 99%;" id="<?=$tablaID?>" cellpadding="0" cellspacing="0" border="0" class=" table table-striped table-bordered dataTable text-center" >
            <thead style="background-color: lightblue;">
                <tr>
                    <th  width="5%"><?= $vocab["otros_recursos_tipo"] ?></th>
                    <th  width="2%"><?= $vocab["otros_recursos_cantidad"] ?></th>
                    <th  width="5%"><?= $vocab["otros_recursos_caracteristicas"] ?></th>                
                    <th  width="5%"><?= $vocab["otros_recursos_contacto"] ?></th>   
                    <th  width="5%"><?= $vocab["otros_recursos_ubicacion"] ?></th> 
                    <th  width="5%"><?= $vocab["otros_recursos_observaciones"] ?></th> 
                    <?php if ($editar) { ?>
                        <th width="2%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody>
                <?php
                if (count($res) > 0) {
                    for ($i = 0; $i < count($res); $i++) {
                        ?>
                        <tr id="<?= $prefijo.$i ?>">
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>tipo<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['tipo'] : ""; ?>" ></td>
                            <td> <input  type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control requerido  cambios" id="<?= $prefijo ?>cantidad<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['cantidad'] : "0"; ?>" ></td>
                             <td><textarea rows="1"   type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>caracteristicas<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['caracteristicas'] : ""; ?></textarea></td>
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control requerido cambios" id="<?= $prefijo ?>contacto<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['contacto'] : ""; ?>" ></td>                            
                            <td> <input  type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>ubicacion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['ubicacion'] : ""; ?>" ></td>
                             <td><textarea rows="1"  type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="<?= $prefijo ?>observaciones<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['observaciones'] : ""; ?></textarea></td>

                            <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                                <td>              
                                    <a class="puntero cambios"  onClick="javascript:eliminarFila(this);">                                 
                                        <div class="text-center"><i class="fa fa-close  text-danger " title="<?= $vocab["symbol_delete"] ?>"></i></div>                                       
                                    </a>                             
                                </td>
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
                <a class="btn btn-warning"  onclick="javascript:guardarOtrosInventario('<?= $idPlanEmergencia ?>', 0,'<?= $prefijo ?>','<?=$categoria?>','<?=$tablaID?>')" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["otros_recursos_Telecomunicacion"] ?></a>
            </span>
            <span class="text-center">
                <a class="btn btn-success"  onclick="javascript:guardarRecursoInstalaciones('<?= $idPlanEmergencia ?>', 1)" name="submit"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_save"] . " " . $vocab["datos_generares_siguente"] ?></a>
            </span>
        <?php } ?>
    </div>
</div>