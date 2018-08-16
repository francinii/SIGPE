<?php
$start = "0";
$sql = "SELECT `id`, `descripcion` FROM `formulario`";

$res = seleccion($sql);
?>
<br/>
<div>
    
    <h4><?= $vocab["incio_labe"]  ?></h4>
    <div class="btn-group btn-group-justified">
        
        <?php
        if (count($res) > 0) {
            for ($i = 0; $i < count($res); $i++) {
                ?>
                <a href="#" class="btn btn-primary"><?= $res[$i]["descripcion"] ?></a>
            <?php }
        }
        ?>
    </div> 

</div>
<br/>

