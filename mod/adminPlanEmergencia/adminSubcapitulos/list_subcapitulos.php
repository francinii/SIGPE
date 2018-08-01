<?php
/** Develop Info
 * IMPORTANTE !!!
 *    Utilice este archivo como ejemplo para crear las tablas de nuevos modulos.
 * 
 * Este archivo genera una tabla utilizando la libreria DataTables,
 * para esto necesitamos 3 componentes principales:
 *  1. El origen de los datos: es otro archivo php que nos traer un JSON con los
 *      datos para mostrar, Data Tables controla la paginación, navegación, busqueda
 *      y el orden.  Para más información 
 *  2. La inicialización de la tabla
 *  3. La estructura de la tabla en HTML
 * 
 */
include("../../login/check.php");
include("../../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
$sAjaxSource = $mySessionController->getVar('cds_domain') . $mySessionController->getVar('cds_locate') . 'mod/admin/users/ajax_list_user.php';
?>
<!--  ****** Titulo ***** -->
<div class="well well-sm"><h1><?= $vocab["list_subcapitulo"] ?></h1></div>
<script type="text/javascript" charset="utf-8">
    var asInitVals = new Array();   //Se utiliza para almacenar la llave del filtro para cada columna.
    jQuery(document).ready(function () {
//        var oTable = jQuery('#lista_usuarios').dataTable({
//        //"sPaginationType": "full_numbers",
//        "bProcessing": true,
//                "bServerSide": true,
//                "aaSorting": [[1, 'asc']],
//                "aoColumns": [
//                {"bSortable": true},
//                        null,
//                        null
//<?php if (check_permiso($mod3, $act1, $user_rol)) { ?>
    //                    , {"bSortable": false}
    //<?php } ?>
//<?php if (check_permiso($mod3, $act4, $user_rol)) { ?>
    //                    , {"bSortable": false}
    //<?php } ?>
//<?php if (check_permiso($mod3, $act5, $user_rol)) { ?>
    //                    , {"bSortable": false}
    //<?php } ?>
//                ],
//                "sAjaxSource"
//                : "<?php //echo $sAjaxSource;  ?>"
//    });
        jQuery("tfoot input").keyup(function () {
            /* Filter on the column (the index) of this element */
            oTable.fnFilter(this.value, jQuery("tfoot input").index(this) + 1);
        });
        jQuery("tfoot input").each(function (i) {
            asInitVals[i] = this.value;
        });

        jQuery("tfoot input").focus(function () {
            if (this.className == "search_init")
            {
                this.className = "";
                this.value = "";
            }
        });
        jQuery("tfoot input").blur(function (i) {
            if (this.value == "")
            {
                this.className = "search_init";
                this.value = asInitVals[jQuery("tfoot input").index(this)];
            }
        });
    });</script>
<!-- div original anterior a integración bootstrap3 
<div style=" width: 800px; margin: 0 auto;"  class="ex_highlight_row"> -->

<div class="row">
    <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
            <label class="control-label col-sm-2" for="list_subcapitulo_capitulo"><?= $vocab["subcapitulo_capitulo"] ?></label>
            <div class="col-sm-10">
                <select id="list_subcapitulo_capitulo" class="form-control">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </select>
            </div>
        </div>


    </div>
</div>
<div class="dataTables_wrapper form-inline dt-bootstrap">
    <table id="lista_usuarios" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable" >
        <thead>
            <tr>
                <th width="10%"><?= $vocab["list_subcapitulo_id"] ?></th>
                <th width="10%"><?= $vocab["list_subcapitulo_order"] ?></th>
                <th width="50%"><?= $vocab["list_subcapitulo_title"] ?></th>
                <th width="50%"><?= $vocab["list_subcapitulo_Descripcion"] ?></th> 
                <?php if (check_permiso($mod3, $act1, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-eye fa-2x text-primary puntero" title="<?= $vocab["symbol_view"] ?>"></i></div></th>
                <?php } ?>
                <?php if (check_permiso($mod3, $act4, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-pencil fa-2x text-success puntero" title="<?= $vocab["symbol_edit"] ?>"></i></div></th>
                <?php } ?>
                <?php if (check_permiso($mod3, $act5, $user_rol)) { ?>
                    <th width="5%"><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6" class="dataTables_empty"><?= $vocab["symbol_no_data"] ?>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th><?= $vocab["list_capitulo_id"] ?></th>
                <th><input type="text" name="nombre_search" id="nombre_search" value="<?= $vocab["symbol_name"] ?>" class="search_init" /></th>
                <th width="50%"><?= $vocab["list_capitulo_title"] ?></th> 
                <th width="50%"><?= $vocab["list_subcapitulo_Descripcion"] ?></th> 
                <?php if (check_permiso($mod3, $act1, $user_rol)) { ?>
                    <th><div class="text-center"><i class="fa fa-eye fa-2x text-primary puntero" title="<?= $vocab["symbol_view"] ?>"></i></div></th>
                <?php } ?>
                <?php if (check_permiso($mod3, $act4, $user_rol)) { ?>
                    <th><div class="text-center"><i class="fa fa-pencil fa-2x text-success puntero" title="<?= $vocab["symbol_edit"] ?>"></i></div></th>
                <?php } ?>
                <?php if (check_permiso($mod3, $act5, $user_rol)) { ?>
                    <th><div class="text-center"><i class="fa fa-close fa-2x text-danger puntero" title="<?= $vocab["symbol_delete"] ?>"></i></div></th>
                <?php } ?>
            </tr>
        </tfoot>
    </table>
    <?php /*     * ***************************************************************************************** */ ?>
    <br/>
    <?php if (check_permiso($mod3, $act3, $user_rol)) { ?>
        <div class="text-center"><a class="btn btn-success" name="submit" onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/new_capitulo.php?', '');"><i class='fa fa-plus fa-inverse'></i> <?= $vocab["symbol_add"] ?> <?= $vocab["add_subcapitulo"] ?></a></div>
    <?php } ?>
</div>
