<?php
//
require 'functions.php';
?>
<nav class="navbar navbar-inverse navbar-fixed-top" style="cursor: pointer;">
    <div class="container">

        <div class="navbar-header col-sm-4">
            <a href="#" class="navbar-brand" id="tituloGeneral"></a>   
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                <span class="sr-only">Alternar Navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>


        <div class="navbar-collapse collapse" id="navbar" aria-expanded="false" style="height: 1px;">
           
                <ul class="nav navbar-nav pull-right">
                    <li  class="nav-item "><a id="NombreUsuario"  href="#" class="navbar-brand"><span><?php echo $mySessionController->getVar("nombre") ?></a></span></li>

                </ul>
            
                <ul class="nav navbar-nav">
                     <li><a href='#' onclick="javascript:OpcionMenu('lib/tcpdf/examples/index.php?', '');"><span> <i class="fa fa-user fa-inverse"></i> <?= $vocab["menu_perfil"] ?></span></a></li>
                    <!-- INICIO -->
                    <li><a onclick="javascript:OpcionMenu('mod/inicio.php?', '');"><span><i class="fa fa-home fa-inverse"> <?= $vocab["menu_home"] ?></i> </span></a></li>
                    <!-- MODULOS DEL SISTEMA -->
                    <!-- ESPACIO -->
                    <li><a href="" style="width: 150px;"></a></li>
                    <!-- PERFIL -->
                    <li><a href='#' onclick="javascript:OpcionMenu('mod/admin/users/edit_perfil.php?', '');"><span> <i class="fa fa-user fa-inverse"></i> <?= $vocab["menu_perfil"] ?></span></a></li>


                    <!-- ADMINISTRACION -->
                    <?php if (check_permiso($mod1, $act1, $user_rol)) { ?>
                        <li class="dropdown">
                            <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><span><i class="fa fa-gears fa-inverse"></i> <?= $vocab["menu_admin"] ?></span> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php if (check_permiso($mod1, $act4, $user_rol)) { ?>
                                    <li><a onclick="javascript:OpcionMenu('mod/admin/param/edit_param.php?', '');"><span><i class="fa fa-gg text-warning"></i> <?= $vocab["menu_pram"] ?></span></a></li>
                                <?php } ?> 
                                <!-- MODULOS -->
                                <?php if (check_permiso($mod1, $act1, $user_rol)) { ?>
                                    <li class="dropdown-submenu">
                                        <a href="#"><span><i class="fa fa-puzzle-piece text-danger"></i> <?= $vocab["menu_mod"] ?></span></a>
                                        <ul class="dropdown-menu">
                                            <?php if (check_permiso($mod1, $act2, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/admin/permits/list_mod.php?', '');"><span> <i class="fa fa-list text-primary"></i> <?= $vocab["menu_list"] ?></span></a></li>
                                            <?php } ?>
                                            <?php if (check_permiso($mod1, $act3, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/admin/permits/new_mod.php?', '');"><span><i class="fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?></span></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>                                
                                <!-- ROLES -->
                                <?php if (check_permiso($mod2, $act1, $user_rol)) { ?>
                                    <li class="dropdown-submenu">
                                        <a href="#"><span><i class="fa fa-sitemap text-warning"></i> <?= $vocab["menu_roll"] ?></span></a>
                                        <ul class="dropdown-menu">
                                            <?php if (check_permiso($mod2, $act2, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/admin/rolls/list_roll.php?', '');"><span> <i class="fa fa-list text-primary"></i> <?= $vocab["menu_list"] ?></span></a></li>
                                            <?php } ?>
                                            <?php if (check_permiso($mod2, $act3, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/admin/rolls/new_roll.php?', '');"><span><i class="fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?></span></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                                <!-- USUARIOS -->
                                <?php if (check_permiso($mod3, $act1, $user_rol)) { ?>
                                    <li class="dropdown-submenu">
                                        <a href="#"><span><i class="fa fa-users text-primary"></i> <?= $vocab["menu_user"] ?></span></span></a>
                                        <ul class="dropdown-menu">
                                            <?php if (check_permiso($mod3, $act2, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/admin/users/list_user.php?', '');"><span> <i class="fa fa-list text-primary"></i>  <?= $vocab["menu_list"] ?></span></a></li>
                                            <?php } ?>
                                            <?php if (check_permiso($mod3, $act3, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/admin/users/new_user.php?', '');"><span><i class="fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?></span></a></li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <!-- ADMINISTRACION PLANES DE EMERGENCIA-->
                    <?php if (check_permiso($mod4, $act1, $user_rol)) { ?>
                        <li class="dropdown">
                            <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><span><i class="fa fa-gears fa-inverse"></i> <?= $vocab["menu_admin_planes_emergencia"] ?></span> <span class="caret"></span></a>
                            <ul class="dropdown-menu"> 
                                <!-- ADMINISTRAR ZONAS DE TRABAJO -->
                                <?php if (check_permiso($mod4, $act1, $user_rol)) { ?>
                                    <li class="dropdown-submenu">
                                        <a href="#"><span><i class="fa fa-puzzle-piece text-danger"></i> <?= $vocab["menu_admin_sede"] ?></span></a>
                                        <ul class="dropdown-menu">
                                            <?php if (check_permiso($mod4, $act2, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminSedes/list_sedes.php?', '');"><span> <i class="fa fa-list text-primary"></i>  <?= $vocab["menu_list"] ?></span></a></li>
                                            <?php } ?>
                                            <?php if (check_permiso($mod4, $act3, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminSedes/new_sedes.php?', '');"><span><i class="fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?></span></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?> 
                                <!-- ADMINISTRAR ZONAS DE TRABAJO -->
                                <?php if (check_permiso($mod1, $act1, $user_rol)) { ?>
                                    <li class="dropdown-submenu">
                                        <a href="#"><span><i class="fa fa-puzzle-piece text-danger"></i> <?= $vocab["menu_admin_zona_trabajo"] ?></span></a>
                                        <ul class="dropdown-menu">
                                            <?php if (check_permiso($mod3, $act2, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/list_zona_trabajo.php?', '');"><span> <i class="fa fa-list text-primary"></i>  <?= $vocab["menu_list"] ?></span></a></li>
                                            <?php } ?>
                                            <?php if (check_permiso($mod3, $act3, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminZonaTrabajo/new_zona_trabajo.php?', '');"><span><i class="fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?></span></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?> 

                                <!-- ADMINISTRAR CAPITULOS -->
                                <?php if (check_permiso($mod1, $act1, $user_rol)) { ?>
                                    <li class="dropdown-submenu">
                                        <a href="#"><span><i class="fa fa-puzzle-piece text-danger"></i> <?= $vocab["menu_admin_capitulos"] ?></span></a>
                                        <ul class="dropdown-menu">
                                            <?php if (check_permiso($mod3, $act2, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/list_capitulos.php?', '');"><span> <i class="fa fa-list text-primary"></i>  <?= $vocab["menu_list"] ?></span></a></li>
                                            <?php } ?>
                                            <?php if (check_permiso($mod3, $act3, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminCapitulos/new_capitulo.php?', '');"><span><i class="fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?></span></a></li>
                                            <?php } ?>                                        
                                        </ul>
                                    </li>
                                <?php } ?>                                
                                <!-- ADMINISTRAR  SUBCAPITULOS-->
                                <?php if (check_permiso($mod2, $act1, $user_rol)) { ?>
                                    <li class="dropdown-submenu">
                                        <a href="#"><span><i class="fa fa-sitemap text-warning"></i> <?= $vocab["menu_admin_subcapitulos"] ?></span></a>
                                        <ul class="dropdown-menu">
                                            <?php if (check_permiso($mod3, $act2, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/list_subcapitulos.php?', '');"><span> <i class="fa fa-list text-primary"></i>  <?= $vocab["menu_list"] ?></span></a></li>
                                            <?php } ?>
                                            <?php if (check_permiso($mod3, $act3, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminSubcapitulos/new_subcapitulo.php?', '');"><span><i class="fa fa-plus text-success"></i> <?= $vocab["menu_add"] ?></span></a></li>
                                            <?php } ?>                                        
                                        </ul>
                                    </li>
                                <?php } ?>
                                <!-- ADMINISTRAR  formulario-->
                                <?php if (check_permiso($mod2, $act1, $user_rol)) { ?>
                                    <li class="dropdown-submenu">
                                        <a href="#"><span><i class="fa fa-sitemap text-warning"></i> <?= $vocab["menu_admin_formulario"] ?></span></a>
                                        <ul class="dropdown-menu">
                                            <?php if (check_permiso($mod3, $act2, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminFormularios/list_formulario.php?', '');"><span> <i class="fa fa-list text-primary"></i>  <?= $vocab["formulario_admin"] ?></span></a></li>
                                            <?php } ?>                                                                             
                                        </ul>
                                    </li>
                                <?php } ?>
                                <!-- ADMINISTRAR MATRIZ DE RIESGOS -->
                                <?php if (check_permiso($mod3, $act1, $user_rol)) { ?>
                                    <li class="dropdown-submenu">
                                        <a href="#"><span><i class="fa fa-users text-primary"></i> <?= $vocab["menu_matriz_riesgos"] ?></span></span></a>
                                        <ul class="dropdown-menu">
                                            <?php if (check_permiso($mod3, $act2, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminOrigenAmenaza/list_origen_amenaza.php?', '');"><span> <i class="fa fa-list text-primary"></i>  <?= $vocab["menu_admin_origen_amenaza"] ?></span></a></li>
                                            <?php } ?>
                                            <?php if (check_permiso($mod3, $act3, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminTipoAmenaza/list_tipo_amenaza.php?', '');"><span><i class="fa fa-plus text-success"></i> <?= $vocab["menu_admin_tipo_amenaza"] ?></span></a></li>
                                            <?php } ?>
                                            <?php if (check_permiso($mod3, $act3, $user_rol)) { ?>
                                                <li><a onclick="javascript:OpcionMenu('mod/adminPlanEmergencia/adminMatriz/adminCategoriaAmenaza/list_categoria_amenaza.php?', '');"><span><i class="fa fa-plus text-success"></i> <?= $vocab["menu_admin_categoria_amenaza"] ?></span></a></li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <li><a onclick="javascript:OpcionMenu('home.php?', '');"><span><i class="fa fa-question fa-inverse"></i> <?= $vocab["menu_help"] ?></span></a></li>
                <!--<li><a href="http://www.soporteinf.una.ac.cr" target="_blank"><span><i class="fa fa-question fa-inverse"></i> <?= $vocab["menu_help"] ?></span></a></li>-->
                    <li><a href='#' onclick="window.location = document.getElementById('cds_domain_locate').value + 'mod/login/logout.php'"><span><i class="fa fa-sign-out fa-inverse"></i> <?= $vocab["menu_logout"] ?></span></a></li>
                </ul>

        </div><!--/.nav-collapse -->
    </div>
</nav>
