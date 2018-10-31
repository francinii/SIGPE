
<?php
include("mod/login/check.php");
include("functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
$user_id = $mySessionController->getVar("usuario");
/* * *************************************************************************************** */
//Informacion requerida obtenida de la sesion
$ip = $mySessionController->getVar("cds_domain");
$ip .= $mySessionController->getVar("cds_locate");
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Plan de emergencia borrador</title>  
        <?php
        include('includes.php');
        ?>
    </head>
    <?php
    $ruta = $_GET['ruta'];
    ?>
    <body>

        <iframe src="mod/versionesPDF/<?=$ruta?>"

                width="100%" height="100%" scrolling="auto">

             El borrador ya fue eliminado

        </iframe>
    </body>
    <script>
        var nombreDoc='<?=$ruta?>'        
        jQuery('iframe').  on('load',function () {
             EliminarPlanVistazo(nombreDoc);
        });
    </script>
</html>

