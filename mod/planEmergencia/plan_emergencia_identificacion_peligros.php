<?php
/*
 * Formulario identificacion de peligro
 */
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
include("plan_emergencia_menu.php");

/*
 * select identificacion de peligros
 */
$sql = "SELECT  `id`, `peligro`, `presente`,`ubicacion`,`recomendacion`, `fecha`, `responsable`, `priorizacion` FROM `IdentificacionPeligro`  WHERE `FKidZonaTrabajo`=" . $idPlanEmergencia;
$resBase = seleccion($sql);


    $res = array(
        $vocab["peligro_1"], $vocab["peligro_2"], $vocab["peligro_3"],
        $vocab["peligro_4"], $vocab["peligro_6"], $vocab["peligro_7"],
        $vocab["peligro_8"], $vocab["peligro_9"], $vocab["peligro_10"], $vocab["peligro_11"], $vocab["peligro_5"],
        $vocab["peligro_12"], $vocab["peligro_13"], $vocab["peligro_14"], $vocab["peligro_15"],
        $vocab["peligro_16"], $vocab["peligro_17"], $vocab["peligro_18"], $vocab["peligro_19"],
        $vocab["peligro_20"], $vocab["peligro_21"], $vocab["peligro_22"], $vocab["peligro_23"],
        $vocab["peligro_24"], $vocab["peligro_25"], $vocab["peligro_26"], $vocab["peligro_27"],
        $vocab["peligro_28"], $vocab["peligro_29"], $vocab["peligro_30"], $vocab["peligro_31"],
        $vocab["peligro_32"], $vocab["peligro_33"], $vocab["peligro_34"], $vocab["peligro_35"],
        $vocab["peligro_36"], $vocab["peligro_37"]);

    for ($i = 0; $i < count($resBase); $i++) { 
        $ubicacion=array_search($resBase[$i]['peligro'], $res);
        if($ubicacion!==false){
           $res[$ubicacion]=$resBase[$i];
        }else{
          $res[]=$resBase[$i];  
        }        
    }
    
?>


<div class="well well-sm">
    <h2><?= $vocab["identifica_peligro_Titulo"] ?></h2>
    <p><?= $vocab["identifica_peligro_Titulo_Desc"] ?></p>
</div>
<div style="padding-right:0.5%;" align="right">
    <?php if ($editar) { ?>
    <span class="text-center">
        <a class="btn btn-success" onclick="javascript: agregarFilaIdentificacionPeligro('Eliminar');"><i class=" fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?> <?= $vocab["inventario_fila"] ?></a>
    </span>
    <?php } ?>
</div>
<div class="dataTables_wrapper dt-bootstrap" style=overflow-x:auto;"> 
    <table  style = "width: 99%;" id="lista_identificacion_peligros" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable text-center formulario" >
        <thead>
            <tr>
                <th  style= "width:30%"><?= $vocab["identifica_peligro_lugar"] ?></th>
                <th  style= "width:8%"><?= $vocab["identifica_peligro_presente"] ?></th>
                <th  style= "width:10%"><?= $vocab["identifica_peligro_ubicacion"] ?></th>                
                <th style= "width:15%"><?= $vocab["identifica_peligro_recomendacion"] ?></th> 
                <th style= "width:15%"><?= $vocab["identifica_peligro_fecha"] ?></th> 
                <th  style= "width:15%"><?= $vocab["identifica_peligro_responsable"] ?></th>
                <th style= "width:2%"><?= $vocab["identifica_peligro_priorizacion"] ?></th> 
                <?php if ($editar) { ?>
                    <th style= "width:5%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($res); $i++) { ?>
                <?php if ($i == 0) { ?>
                    <tr style="background-color: lightblue;"> <td colspan="8" >  <b> <?= $vocab["identifica_peligro_aula"]; ?>  </b> </td></tr>  
                <?php } else if ($i == 12) { ?>
                    <tr style="background-color: lightblue">  <td colspan="8"> <b>  <?= $vocab["identifica_peligro_edificio"] ?> </b> </td></tr>  
                <?php } else if ($i == 23) { ?>
                    <tr style="background-color: lightblue"> <td colspan="8">  <b> <?= $vocab["identifica_peligro_electrica"] ?> </b> </td></tr>  
                <?php } else if ($i == 30) { ?>
                    <tr style="background-color: lightblue">  <td colspan="8"> <b>  <?= $vocab["identifica_peligro_agua"] ?>  </b></td></tr>  
                <?php } else if ($i == 35) { ?>
                    <tr style="background-color: lightblue">  <td colspan="8"> <b>  <?= $vocab["identifica_peligro_gas"]; ?> </b> </td></tr>  
                <?php } ?>
                <tr class ="trInformacion" id="tr<?= $i ?>"> 
            <input type ="hidden" id ="idPeligro<?= $i ?>" value ="<?= (is_array($res[$i])) ? $res[$i]['id'] : -1; ?>" >

            <?php if ($i < 37) { ?>
                <td  id = "peligro<?= $i ?>"> 
                    <?= (is_array($res[$i])) ? $res[$i]['peligro'] : $res[$i]; ?>
                <?php } else { ?>
                <td>
                    <textarea  <?= (!$editar) ? "readonly" : ""; ?> class="form-control habilitar requerido  cambios" id = "peligro<?= $i ?>"><?= (is_array($res[$i])) ? $res[$i]['peligro'] : $res[$i]; ?></textarea>
                <?php } ?>
                </td>
                <td>    
                <select class="form-control cambios" onchange ="cambioCalcularSiPresente(this)" name="presente"   <?= (!$editar) ? 'disabled  style="cursor: not-allowed;"' : ""; ?> id ="presente<?= $i ?>">
                    <?php if (is_array($res[$i])) { ?>
                        <option <?= ($res[$i]['presente'] == 1) ? "selected" : ""; ?> >SI</option>
                        <option <?= ($res[$i]['presente'] == 0) ? "selected" : ""; ?> >NO</option> 
                    <?php } else { ?>
                        <option>SI</option>
                        <option selected >NO</option> 
                    <?php } ?>
                </select>    
            </td>
            <td>  
                <input class = "habilitar cambios form-control" id ="ubicacion<?= $i ?>" type="text"  <?= (!$editar) ? "readonly" : ""; ?>  class="form-control cambios" value="<?= (is_array($res[$i])) ? $res[$i]['ubicacion'] : ""; ?>">
            </td>
            <td>
                <textarea class = "habilitar cambios form-control"  id ="recomendacion<?= $i ?>"  type="text"<?= (!$editar) ? "readonly" : ""; ?>  class="form-control cambios"> <?= (is_array($res[$i])) ? $res[$i]['recomendacion'] : ""; ?></textarea>
            </td> 
            <td>
                <input class = "habilitar cambios form-control" id ="fecha<?= $i ?>" type="date"   <?= (!$editar) ? "readonly" : ""; ?>  class="form-control cambios" value="<?= (is_array($res[$i])) ? $res[$i]['fecha'] : "1900-01-01"; ?>">
            </td> 
            <td>
                <input class = "habilitar cambios form-control" id ="responsable<?= $i ?>" type="text"   <?= (!$editar) ? "readonly" : ""; ?>  class="form-control cambios" value="<?= (is_array($res[$i])) ? $res[$i]['responsable'] : ""; ?>"> 
            </td> 
          
            <td  id ='priorizaciontd<?=$i?>' >  
                <select  class = "habilitar cambios form-control"  onchange="cambiarCalcularPriorizacion2(this,'<?= 'priorizaciontd'.$i?>')" <?= (!$editar) ? 'disabled  style="cursor: not-allowed;"' : ""; ?> id ="priorizacion<?= $i ?>" name="priorizacion">
                    <?php if (is_array($res[$i])) { ?>
                        <option <?= ($res[$i]['priorizacion'] == 1) ? "selected" : ""; ?> >1</option>
                        <option <?= ($res[$i]['priorizacion'] == 2) ? "selected" : ""; ?> >2</option> 
                        <option <?= ($res[$i]['priorizacion'] == 3) ? "selected" : ""; ?> >3</option>
                       
                    <?php } else { ?>
                        <option>1</option>
                        <option>2</option> 
                        <option selected>3</option>
                        
                   
                        
                    <?php } ?>
                </select>    
            </td>
      <script> 
          calcularPriorizacion2(<?= (is_array($res[$i]))? $res[$i]['priorizacion']: 3?>, '<?= 'priorizaciontd'.$i?>');
        
      </script>
            <?php if ($i < 37 || !$editar) { ?>
                <td style="background-color: #ededed;"><a style="cursor: not-allowed;"  class="puntero ">
                        <div class="text-center"><i class="fa fa-close  text-danger" title="Eliminar fila"></i></div>
                    </a>
                </td>
            <?php } else  { ?>
                <td><a class="puntero" onclick="javascript:eliminarFilaPeligros(this,'<?= $idPlanEmergencia ?>');">
                        <div class="text-center"><i class="fa fa-close  text-danger" title="Eliminar fila"></i></div>
                    </a>
                </td>
            <?php } ?>
            </tr>   
            <?php if ($i == 36) { ?>
                <tr id = "trfinal" style="background-color: lightblue">  <td colspan="8"> <b>  <?= $vocab["identifica_peligro_adicionales"]; ?> </b> </td></tr>  
                <?php
            }
        }
        ?>
                <script>
                    calcularSiPresente();
                </script>
        </tbody>
    </table> 
</div>
<div class="text-center">
    <?php if ($editar) { ?>
        <span class="text-center">
            <a class="btn btn-warning" onclick="javascript:guardarDatosIdentificacionPeligros('<?= $idPlanEmergencia ?>', 0)" name="submit" ><i class="fa fa-save fa-inverse"></i> <?= $vocab["symbol_save"] ?> <?= $vocab["actividades_Titulo"] ?></a>
        </span>
        <span class="text-center">
            <a class="btn  btn-success"  onclick="javascript:guardarDatosIdentificacionPeligros('<?= $idPlanEmergencia ?>', 1)" name="submit"><i class="fa fa-rotate-right"></i> <?= $vocab["symbol_save"] . " " . $vocab["datos_generares_siguente"] ?></a>
        </span>
    <?php } ?>
</div>








