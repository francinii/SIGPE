<?php
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
include("plan_emergencia_menu.php");
?>
<!--------- Recurso Humano----------->
<?php
$sql = "SELECT  `cantidad`, `profesion`, `categorias`, `localizacion`,"
        . " `contacto` FROM `RecursoHumanos` WHERE `FKidPlanEmergencias`=" . $idPlanEmergencia;
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
                <a class="btn btn-success" onclick="javascript: agregarFilaRecursoHumano('<?= $vocab["symbol_delete"] ?>');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?>  </a>
            </span>
        <?php } ?>
    </div>
    <div   class="dataTables_wrapper  form-inline dt-bootstrap" style = "overflow-x:auto;">
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
                            <td> <input style = "width: 100%;" type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="H-profesion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['profesion'] : ""; ?>" ></td>
                            <td> <input style = "width: 100%;" type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control requerido  cambios" id="H-cantidad<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['cantidad'] : "0"; ?>" ></td>
                            <td> <input style = "width: 100%;" type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control requerido cambios" id="H-categoria<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['categorias'] : ""; ?>" ></td>
                            <td> <input style = "width: 100%;" type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control requerido cambios" id="H-localizacion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['localizacion'] : ""; ?>" ></td>                            
                            <td> <input style = "width: 100%;" type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="H-contacto<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['contacto'] : ""; ?>" ></td>

                            <?php if (check_permiso($mod5, $act5, $user_rol)) { ?>
                                <td>              
                                    <a class="puntero cambios"  onClick="javascript:eliminarFilaEquipo(this);">                                 
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


<!--------------------------------- Inventario equipo movil----------------------------------------->
<?php
$sql = "SELECT `cantidad`, `capacidad`, `tipo`, `caracteristicas`,"
        . " `contacto`, `ubicacion`, `categoria` FROM `EquipoMovil` WHERE `FKidPlanEmergencias`=" . $idPlanEmergencia;
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
        <span class="text-center" >
            <a class="btn btn-success" onclick="javascript: agregarFilaEquipo('<?= $vocab["symbol_delete"] ?>', combo);"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?></a>
        </span>

    </div>
    <div   class="dataTables_wrapper  form-inline dt-bootstrap" style = "overflow-x:auto;">
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
                            <td> <input style = "width: 100%;" type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="E-tipoEquipo<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['tipo'] : ""; ?>" ></td>
                            <td> <input style = "width: 100%;" type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control requerido  cambios" id="E-cantidad<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['cantidad'] : "0"; ?>" ></td>
                            <td> <input style = "width: 100%;" type="number"  <?= (!$editar) ? "readonly" : ""; ?>  min="0" class="form-control requerido cambios" id="E-capacidad<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['capacidad'] : "0"; ?>" ></td>
                            <td><textarea rows="1" style ="width: 100%;"  type="text" <?= (!$editar) ? "readonly" : ""; ?>  class="form-control requerido cambios" id="E-caracteristica<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['caracteristicas'] : ""; ?></textarea></td>
                            <td> <input style = "width: 100%;" type="text"  <?= (!$editar) ? "readonly" : ""; ?>   class="form-control  requerido cambios" id="E-contacto<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['contacto'] : ""; ?>" ></td>
                            <td> <input style = "width: 100%;" type="text"  <?= (!$editar) ? "readonly" : ""; ?> class="form-control  requerido cambios" id="E-ubicacion<?= $i ?>" value="<?= (is_array($res[$i])) ? $res[$i]['ubicacion'] : ""; ?>" ></td>
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
            <span class="text-center">
                <a class="btn btn-success"  onclick="javascript:guardarequipoMovil('<?= $idPlanEmergencia ?>', 1)" name="submit"><i class="fa fa-rotate-left"></i> <?= $vocab["symbol_save"] . " " . $vocab["datos_generares_siguente"] ?></a>
            </span>


        <?php } ?>
    </div>
</div>