<?php

//============================================================+
// File name   : planEmergenciaPDP.php
// Begin       : 2018-07-23
// Last Update : 2013-11-13
//
// Description : Creacion de un plan de emergencias
//
// Author: Francini Corrales & Danny Valerio
//
//============================================================+

include("../login/check.php");
include("../../functions.php");
include_once('../../lib/tcpdf/examples/tcpdf_include.php');
require_once ('../../lib/jpgraph/src/jpgraph.php');
require_once ('../../lib/jpgraph/src/jpgraph_pie.php');


$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");

$id = $_GET['idCentro'];

if (isset($_GET['version'])) {
    $version = $_GET['version'];
    $nombreDoc = $id . "-" . $version . '.pdf';
    //unlink($_SERVER['DOCUMENT_ROOT'] . 'SIGPE/mod/versionesPDF/' . $nombreDoc);
}
if (isset($_GET['random'])) {
    $random = $_GET['random'];
}
$sqlPlan = "(SELECT `id`, `revisadoPor`, `codigoZonaTrabajo`, `actividad`, `direccion`, `personaContactoGeneral`, `numeroTelefono`, `numeroFax`, `correo`, `categoriaNFPA`, `usoInstalaciones`, `horarioJornada`, `seguridadInstitucional`, `servicioConsegeria`, `personalAdministrativo`, `personalAcademico`, `presenciaEstudiantil`, `instalacionesDensidadOcupacion`, `instalacionesAreaConstruccion`, `instalacionesInstalaciones`, `instalacionesCaracteristicasZona`, `instalacionesTopografia`, `instalacionesNivelTerreno`, `instalacionesColindates`, `elementosConstructivosTipoConstruccion`, `elementosConstructivosAntiguedad`, `elementosConstructivosCimientos`, `elementosConstructivosEstructura`, `elementosConstructivosParedes`, `elementosConstructivosEntrepiso`, `elementosConstructivosTecho`, `elementosConstructivosCielos`, `elementosConstructivosPisos`, `elementosConstructivosAreaParqueo`, `elementosConstructivosSistemaAguaPotable`, `elementosConstructivosAlcantarilladoSanitario`, `elementosConstructivosAlcantarilladoPluvial`, `elementosConstructivosSistemaElectrico`, `elementosConstructivosSistemaTelefonico`, `elementosConstructivosOtros` FROM `ZonaTrabajo` where id =" . $id . ")";
$sqlCapitulos = "(SELECT  id, descripcion, orden,titulo,isActivo FROM Capitulo where isActivo = 1 ORDER BY orden)";


$sqlZonas = "(SELECT  id, nombreZonaTrabajo, logo FROM ZonaTrabajo where id =" . $id . ")";
$zonas = seleccion($sqlZonas);

$sql = "(SELECT  id, descripcionArriba, descripcionAbajo, FKidSubcapitulos FROM Formulario)";
$formularios = seleccion($sql);

$sql = "(SELECT  tipoPoblacion, descripcion, total, representacionDe FROM TipoPoblacion)";
$resTipoPoblacion = seleccion($sql);


$idPlanEmergencia = $id;
//$res = seleccion($sql);
$resPlan = seleccion($sqlPlan);
$rescapitulos = seleccion($sqlCapitulos);
global $datosCabecera;
$dirImages = "img/";
$centroTrabajo = $zonas[0]["nombreZonaTrabajo"];
$logoUNA = $dirImages . "logo_una.jpg";
$logoCentro = $dirImages . "imgPlanes/" . $zonas[0]["logo"];
$logoCIEUNA = $dirImages . "logo_cieuna.png";
$codigo = "";
$revisadoPor = "";
if (check_permiso($mod4, $act2, $user_rol) && !isset($_GET['visualizarpdf'])) { 
$codigo = $resPlan[0]['codigoZonaTrabajo'];
$revisadoPor = $resPlan[0]['revisadoPor'];
}
$datosCabecera = array(
    "centroTrabajo" => $centroTrabajo,
    "logoUNA" => $logoUNA,
    "logoCIEUNA" => $logoCIEUNA,
    "logoCentro" => $logoCentro,
    "codigo" => $codigo,
    "revisado" => $revisadoPor);

/**
 * Clase MYPDF que hereda de la clase TCPDF
 * Sobreescribre el método Header de la clase padre
 */
class MYPDF extends TCPDF {

    public function Header() {
        $a = $this->getAliasNbPages();
        $b = $this->getAliasNumPage();
        global $datosCabecera;
        $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
                . '<tr style = "text-align:center;">'
                . '<td rowspan="3"><img src= "' . $datosCabecera['logoUNA'] . '" width="60" height="60" ></td>'
                . '<td><b>' . $datosCabecera['centroTrabajo'] . '</b></td>'
                . '<td rowspan="3"><img src= "' . $datosCabecera['logoCentro'] . '" width="60" height="60" ></td>'
                . '<td><b>Código:</b> ' . $datosCabecera['codigo'] . '</td>'
                . '</tr>'
                . '<tr style = "text-align:center;">'
                . '<td rowspan="2"><b>Plan de preparativos de respuesta ante emergencias</b></td>'
                . '<td><b>Revisado por:</b><br>' . $datosCabecera['revisado'] . '</td>'
                . '</tr>'
                . '<tr style = "text-align:center;">'
                . '<td><b>Página: </b>' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages() . '</td>'
                . '</tr>'
                . '</table>';
        $this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
    }

}

/*
 * Se crea un nuevo objeto de tipo MYPDF
 */
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


/*
 * Modificar la informacion general del documento
 */
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Francini Corrales Garro & Danny Valerio Ramírez');
$pdf->SetTitle('Plan de emergencias');
$pdf->SetSubject('Plan de emergencias');
$pdf->SetKeywords('Plan, PDF, emergencias, CIEUNA, UNA');

/*
 * Modificar la fuente monospaced
 */
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

/*
 * Modifica  margenes del documento
 */
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + PDF_MARGIN_HEADER, PDF_MARGIN_RIGHT); // 
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

/*
 * Modifica  la fuente del documento
 */
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$font = array(PDF_FONT_MONOSPACED, '', 9);
$pdf->SetHeaderFont($font);

/*
 * Modifica la escala de las imagenes 
 */
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

/*
 * Verifica si se debe imprimir o no el documento
 */
$pdf->setPrintFooter(false);

/*
 * Modifica la unidad con la que el documento trabaja (modificado para trabajar en mm)
 */
$pdf->setPageUnit(PDF_UNIT);


/*
 * Llamada de las funciones que crean el pdf: portada, capitulos y tabla de contenidos
 *  */
portada($pdf);
capitulos($pdf, $rescapitulos, $resPlan, $resTipoPoblacion, $formularios, $vocab, $idPlanEmergencia);
tablaContenidos($pdf);


/*
 * Funcion que remplaza una cadena de caracteres por otra cadena 
 * @param {String} $cadena corresponde a una cadena de caracteres
 * @returns {String} $cadena con los datos remplzadados
 */

function remplazar($cadena) {
    global $datosCabecera;
    $centro = $datosCabecera['centroTrabajo'];
    return str_replace("&lt;&amp;nombreZonaTrabajo&amp;&gt;", $centro, $cadena);
}

/*
 * Funcion que crea la tabla de contenidos en el PDF 
 * @param {MYPDF} $pdf corresponde a un objeto de la clase MYPDF
 * @returns {Undefined}
 */

function tablaContenidos($pdf) {
    $pdf->setPrintHeader(false);
    $pdf->addTOCPage();
    $pdf->SetFont(PDF_FONT_MONOSPACED, 'B', 16);
    $pdf->MultiCell(0, 0, 'Tabla de contenido', 0, 'L', 0, 1, '', '', true, 0);
    $pdf->Ln();
    $bookmark_templates = array();
    $bookmark_templates[0] = '<table border="0" cellpadding="0" cellspacing="0"><tr>'
            . '<td width="145mm"><span style="font-family:helvetica;font-weight:bold;font-size:12pt;color:black;">#TOC_DESCRIPTION#</span></td>'
            . '<td width="13mm"><span style="font-family:courier;font-weight:bold;font-size:11pt;color:black;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';
    $bookmark_templates[1] = '<table border="0" cellpadding="0" cellspacing="0"><tr>'
            . '<td width="5mm">&nbsp;</td>  '
            . '<td width="140mm"><span style="font-family:helvetica;font-size:11pt;color:black;">#TOC_DESCRIPTION#</span></td> '
            . ' <td width="13mm"><span style="font-family:courier;font-weight:bold;font-size:11pt;color:black;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';
    $bookmark_templates[2] = '<table border="0" cellpadding="0" cellspacing="0"><tr>'
            . '<td width="10mm">&nbsp;</td> '
            . '<td width="135mm"><span style="font-family:helvetica;font-size:10pt;color:#666666;"><i>#TOC_DESCRIPTION#</i></span></td> '
            . '<td width="13mm"><span style="font-family:courier;font-weight:bold;font-size:11pt;color:#666666;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';
    $pdf->addHTMLTOC(2, 'Indice', $bookmark_templates, true, 'B', array(128, 0, 0));

// end of TOC page
    $pdf->endTOCPage();
}

/*
 * Funcion que crea los capitulos en el PDF
 * @param {MYPDF} $pdf corresponde a un objeto de la clase MYPDF
 * @param {Array} $capitulos corresponde a un array asociativo con los registros 
 * de los capítulos.
 * @param {Array} $resPlan corresponde a un array asociativo con los registros del 
 * plan de emergencia
 * @param {Array} $resTipoPoblacion corresponde a un array asociativo con los registros del 
 *  tipo de población de un plan de emergencia  
 * @param {Array} $formularios corresponde a un array asociativo con los registros de la tabla Formulario
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @param {int} $idPlanEmergencia cooresponde al id del plan de emergencias
 * @returns {Undefined}
 */

function capitulos($pdf, $capitulos, $resPlan, $resTipoPoblacion, $formularios, $vocab, $idPlanEmergencia) {
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + PDF_MARGIN_HEADER, PDF_MARGIN_RIGHT);
    //Empieza a mostrar el header
    $pdf->setPrintHeader(true);
    $orden = 0;
    // $html = '<div style = "height: 250px;"><div>';
    foreach ($capitulos as $cap) {
        //carga una nueva página
        cargarNuevaPagina($pdf);
        if ($orden == 0) {
            $pdf->Bookmark($cap['titulo'], 0, 0, '', '', array(0, 64, 128));
            $html = '<h2><b>' . $cap['titulo'] . '</b></h2>';
        } else {
            $pdf->Bookmark($orden . ". " . $cap['titulo'], 0, 0, '', '', array(0, 64, 128));
            $html = '<h2><b>' . $orden . ". " . $cap['titulo'] . '</b></h2>';
        }
        $html .= remplazar($cap['descripcion']);
        $sql = "(SELECT  FKidCapitulo, FKidZonaTrabajo,descripcion FROM CapituloPlan where FKidCapitulo = " . $cap['id'] . " and FKidZonaTrabajo = " . $idPlanEmergencia . " )";
        $infoUsuario = seleccion($sql);
        if (count($infoUsuario) > 0) {
            $html .= remplazar($infoUsuario[0]['descripcion']);
        }
        $pdf->writeHTML($html, true, false, false, false, '');
        subCapitulos($pdf, $cap['id'], $orden, $resPlan, $resTipoPoblacion, $formularios, $vocab, $idPlanEmergencia);
        $orden += 1;
    }
}

/*
 * Funcion que crea los subcapitulos en el PDF
 * @param {MYPDF} $pdf corresponde a un objeto de la clase MYPDF
 * @param {int} $id corresponde al id del Capitulo
 * @param {int} $ordenCapitulo corresponde al numero del orden del capitulo
 * @param {Array} $resPlan corresponde a un array asociativo con los registros del 
 * plan de emergencia
 * @param {Array} $resTipoPoblacion corresponde a un array asociativo con los registros del 
 *  tipo de población de un plan de emergencia  
 * @param {Array} $formularios corresponde a un array asociativo con los registros de la tabla Formulario
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @param {int} $idPlanEmergencia cooresponde al id del plan de emergencias
 * @returns {Undefined}
 */

function subCapitulos($pdf, $id, $ordenCapitulo, $resPlan, $resTipoPoblacion, $formularios, $vocab, $idPlanEmergencia) {
    // $pdf->SetFont(PDF_FONT_MONOSPACED, '', 12);
    $sql = "(SELECT  id, descripcion, orden,titulo,isActivo FROM SubCapitulo where FKidCapitulo = $id and isActivo = 1 ORDER BY orden)";
    $subcapitulos = seleccion($sql);
    $subOrden = 1;
    foreach ($subcapitulos as $sub) {
        if ($ordenCapitulo == 0) {
            $pdf->Bookmark($sub['titulo'], 1, 0, '', '', array(128, 0, 0));
            $html = '<h3><b>' . $sub['titulo'] . '</b></h3>';
        } else {
            $pdf->Bookmark($ordenCapitulo . "." . $subOrden . " " . $sub['titulo'], 1, 0, '', '', array(128, 0, 0));
            $html = '<h3><b>' . $ordenCapitulo . "." . $subOrden . " " . $sub['titulo'] . '</b></h3>';
        }
        $html .= remplazar($sub['descripcion']);
        $sql = "(SELECT  FKidSubCapitulo, FKidZonaTrabajo,descripcion FROM SubCapituloPlan where FKidSubCapitulo = " . $sub['id'] . " and FKidZonaTrabajo = " . $idPlanEmergencia . " )";
        $infoUsuario = seleccion($sql);
        if (count($infoUsuario) > 0) {
            $html .= remplazar($infoUsuario[0]['descripcion']);
        }
        $pdf->writeHTML($html, true, false, false, false, '');

        listarFormularios($sub['id'], $formularios, $resPlan, $resTipoPoblacion, $vocab, $idPlanEmergencia, $pdf);
        $subOrden += 1;
    }
}

/*
 * Funcion que creala portada en el PDF
 * @param {MYPDF} $pdf corresponde a un objeto de la clase MYPDF
 * @returns {Undefined}
 */

function portada($pdf) {
    $pdf->setPrintHeader(false);
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    global $datosCabecera;
    cargarNuevaPagina($pdf);
    $logo = '<img src= "' . $datosCabecera['logoUNA'] . '"  width="100" height="100" >';
    $logo2 = '<img style = "margin:right:1000px;" src= "' . $datosCabecera['logoCIEUNA'] . '"width="100" height="100" >';
    $y = $pdf->getY();

    $pdf->writeHTMLCell(150, '', '', $y, $logo, 0, 0, false, true, 'J', true);
    $pdf->writeHTMLCell(30, '', '155', '', $logo2, 0, 1, false, true, '', true);
    $hoy = date("d-m-Y");
    $html = '<div style = "text-align:center;"><br>
            <h2>PLAN DE PREPARATIVOS DE RESPUESTA ANTE EMERGENCIAS</h2><br>
            <h3>' . $datosCabecera["centroTrabajo"] . ' </h3><br>
            <h3>   UNIVERSIDAD NACIONAL DE COSTA RICA </h3><br>
             <img src= "' . $datosCabecera['logoCentro'] . '" width="250" height="250" >
            <h3>   Fecha:  ' . $hoy . ' </h3><br>
            <div>
            <h6 style="border: 1px solid black; padding: 10px 20px 30px 40px; text-align: center;">
            Este documento tiene como objeto cumplir con los requisitos y contenidos que debe
            cumplir un plan de preparativos y respuesta ante emergencias en centros laborales y 
            de ocupación pública. Se basa en la Norma <br> CNE-NA- INTE-DN-01:2014, la cual se sustenta 
            en el artículo 12 de la Ley Nacional de Emergencias y Prevención del Riesgo Nº 8488 y 
            el artículo 4 de la Ley del Benemérito Cuerpo de Bomberos de Costa Rica Nº 8228
            </h6>
        </div>';
    $pdf->writeHTML($html, true, false, true, false, '');
}

/*
 * Formulario idForm = 1 Formulario de datos generales
 * Funcion que crea el formulario de datos generales en el plan * 
 * @param {Array} $resPlan corresponde a un array asociativo con los registros del 
 * plan de emergencia
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @returns {Undefined}
 */

function formularioDatosGenerales($resPlan, $vocab) {
    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<tr>'
            . '<td>' . $vocab["datos_generares_nombre"] . '</td>'
            . '<td>' . $resPlan[0]['actividad'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab["datos_generares_actividad"] . '</td>'
            . '<td>' . $resPlan[0]['actividad'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab["datos_generares_dirección"] . 'n</td>'
            . '<td>' . $resPlan[0]['direccion'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab["datos_generares_contacto"] . '</td>'
            . '<td>' . $resPlan[0]['personaContactoGeneral'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab["datos_generares_teléfono"] . '</td>'
            . '<td>' . $resPlan[0]['numeroTelefono'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab["datos_generares_fax"] . '</td>'
            . '<td>' . $resPlan[0]['numeroFax'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab["datos_generares_Correo"] . '</td>'
            . '<td>' . $resPlan[0]['correo'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab["datos_generares_NFPA"] . '</td>'
            . '<td>' . $resPlan[0]['categoriaNFPA'] . '</td>'
            . '</tr>'
            . '<tr >'
            . '<td>' . $vocab["datos_generares_instalaciones"] . '</td>'
            . '<td>' . $resPlan[0]['usoInstalaciones'] . '</td>'
            . '</tr>'
            . '<tr >'
            . '<td>' . $vocab["datos_generares_Horarios"] . '</td>'
            . '<td>' . $resPlan[0]['horarioJornada'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab["datos_generares_Horarios"] . '</td>'
            . '<td>' . $resPlan[0]['seguridadInstitucional'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab["datos_generares_Servicio"] . '</td>'
            . '<td>' . $resPlan[0]['servicioConsegeria'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab["datos_generares_Administrativo"] . '</td>'
            . '<td>' . $resPlan[0]['personalAdministrativo'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab["datos_generares_Académico"] . '</td>'
            . '<td>' . $resPlan[0]['personalAcademico'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab["datos_generares_Estudiantil"] . '</td>'
            . '<td>' . $resPlan[0]['presenciaEstudiantil'] . '</td>'
            . '</tr>'
            . '</table>';
    return $html;
}

/*
 * //Formulario idForm = 2 Formulario de actividades
 * Funcion que crea el formulario de actividades * 
 * @param {Array} $resTipoPoblacion corresponde a un array asociativo con los registros del 
 * tipo de poblacion
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @returns {Undefined}
 */

function formularioActividades($resTipoPoblacion, $vocab) {
    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<thead><tr style = "text-align:center;">'
            . '<th>' . $vocab['actividades_Titulo'] . '</th>'
            . '<th>' . $vocab['actividades_Descripcion'] . '</th>'
            . '<th>' . $vocab['actividades_total'] . '</th>'
            . '<th>' . $vocab['actividades_Discapacidad'] . '</th>'
            . '</tr></thead><tbody>';
    foreach ($resTipoPoblacion as $res) {
        $html .= '<tr>'
                . '<td>' . $res['tipoPoblacion'] . '</td>'
                . '<td>' . $res['descripcion'] . '</td>'
                . '<td>' . $res['total'] . '</td>'
                . '<td>' . $res['representacionDe'] . '</td>'
                . '</tr>';
    }
    $html .= '</tbody></table>';
    return $html;
}

/*
 * Formulario idForm = 3 Formulario de instalaciones
 * Funcion que crea el formulario de instalaciones * 
 * @param {Array} $resPlan corresponde a un array asociativo con los registros del 
 * plan de emergencia
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @returns {Undefined}
 */

function formularioInstalaciones($resPlan, $vocab) {
    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<tr style = "text-align:center;">'
            . '<td>' . $vocab['instalaciones_Densidad'] . '</td>'
            . '<td>' . $resPlan[0]['instalacionesDensidadOcupacion'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_Area'] . '</td>'
            . '<td>' . $resPlan[0]['instalacionesAreaConstruccion'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_Instalaciones'] . '</td>'
            . '<td>' . $resPlan[0]['instalacionesInstalaciones'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_zona'] . '</td>'
            . '<td>' . $resPlan[0]['instalacionesCaracteristicasZona'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_topografica'] . '</td>'
            . '<td>' . $resPlan[0]['instalacionesTopografia'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_terreno'] . '</td>'
            . '<td>' . $resPlan[0]['instalacionesNivelTerreno'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_Colindantes'] . '</td>'
            . '<td>' . $resPlan[0]['instalacionesColindates'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td colspan = "2"><b>' . $vocab['instalaciones_subTitulo2'] . '</b></td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_Tipo'] . '</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosTipoConstruccion'] . '</td>'
            . '</tr>'
            . '<tr >'
            . '<td>' . $vocab['instalaciones_Antiguedad'] . '</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosAntiguedad'] . '</td>'
            . '</tr>'
            . '<tr >'
            . '<td>' . $vocab['instalaciones_Cimientos'] . '</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosCimientos'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_Estructura'] . '</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosEstructura'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_Paredes'] . '</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosParedes'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_Entrepiso'] . '</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosEntrepiso'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_Techo'] . '</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosTecho'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_Cielos'] . '</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosCielos'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_Pisos'] . '</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosPisos'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_parqueo'] . '</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosSistemaAguaPotable'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_aguapotable'] . '</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosSistemaAguaPotable'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_sanitario'] . '</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosAlcantarilladoSanitario'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_pluvial'] . '</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosAlcantarilladoPluvial'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_electrico'] . '</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosSistemaElectrico'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_telefónico'] . '</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosSistemaTelefonico'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>' . $vocab['instalaciones_Otros'] . '</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosOtros'] . '</td>'
            . '</tr>'
            . '</table>';
    return $html;
}

/*
 * Formulario idForm = 5 Formulario de recursos humanos
 * Funcion que crea el formulario de recursos humanos * 
 * @param {int} $idPlanEmergencia corresponde al id del plna de emergencia
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @returns {Undefined}
 */

function formularioRecursosHumanos($idPlanEmergencia, $vocab) {
    //Recursos Humanos
    $sql = "SELECT  `cantidad`, `profesion`, `categorias`, `localizacion`,"
            . " `contacto` FROM `RecursoHumanos` WHERE `FKidZonaTrabajo`=" . $idPlanEmergencia;
    $respuesta = seleccion($sql);

    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<thead><tr style = "text-align:center;">'
            . '<th>' . $vocab['recurso_humano_Profesion'] . '</th>'
            . '<th>' . $vocab['recurso_humano_Cantidad'] . '</th>'
            . '<th>' . $vocab['recurso_humano_categoria'] . '</th>'
            . '<th>' . $vocab['recurso_humano_Localizacion'] . '</th>'
            . '<th>' . $vocab['recurso_humano_Contacto'] . '</th>'
            . '</tr></thead><tbody>';
    foreach ($respuesta as $res) {
        $html .= '<tr>'
                . '<td>' . $res['profesion'] . '</td>'
                . '<td>' . $res['cantidad'] . '</td>'
                . '<th>' . $res['categorias'] . '</th>'
                . '<td>' . $res['localizacion'] . '</td>'
                . '<td>' . $res['contacto'] . '</td>'
                . '</tr>';
    }
    $html .= '</tbody></table>';
    return $html;
}

/*
 * Formulario idForm = 5 Formulario de equipo movil
 * Funcion que crea el formulario de equipo movil de tipo aereo acuatico y terrestre* 
 * @param {int} $idPlanEmergencia corresponde al id del plna de emergencia
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @param {String} $categoria corresponde a la categoria a la que pertenece el equipo
 * (terrestre, aereo o acuatico)
 * @returns {Undefined}
 */

function formularioEquipoMovil($idPlanEmergencia, $vocab, $categoria) {
//Equipo movil
    $sql = "SELECT `cantidad`, `capacidad`, `tipo`, `caracteristicas`,"
            . " `contacto`, `ubicacion`, `categoria` FROM `EquipoMovil` WHERE  `categoria`= '" . $categoria . "' and `FKidZonaTrabajo`=" . $idPlanEmergencia;
    $respuesta = seleccion($sql);

    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<thead><tr style = "text-align:center;">'
            . '<th>' . $vocab['equipo_moviles_tipo'] . '</th>'
            . '<th>' . $vocab['equipo_moviles_cantidad'] . '</th>'
            . '<th>' . $vocab['equipo_moviles_capacidad'] . '</th>'
            . '<th>' . $vocab['equipo_moviles_caracteristicas'] . '</th>'
            . '<th>' . $vocab['equipo_moviles_contacto'] . '</th>'
            . '<th>' . $vocab['equipo_moviles_ubicacion'] . '</th>'
            . '</tr></thead><tbody>';
    foreach ($respuesta as $res) {
        $html .= '<tr>'
                . '<td>' . $res['tipo'] . '</td>'
                . '<td>' . $res['cantidad'] . '</td>'
                . '<th>' . $res['capacidad'] . '</th>'
                . '<td>' . $res['caracteristicas'] . '</td>'
                . '<td>' . $res['contacto'] . '</td>'
                . '<td>' . $res['ubicacion'] . '</td>'
                . '</tr>';
    }
    $html .= '</tbody></table>';
    return $html;
}

//Formulario recursos instalaciones

/*
 * Formulario idForm = 5 Formulario de recursos de las intalaciones
 * Funcion que crea el  Formulario de recursos de las intalaciones 
 * @param {int} $idPlanEmergencia corresponde al id del plna de emergencia
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @returns {Undefined}
 */
function formularioRecursosInstalaciones($idPlanEmergencia, $vocab) {
//Recurso de instalaciones
    $sql = "SELECT `tipo`, `cantidad`, `tamaño`, `distribucion`,"
            . " `contacto`, `ubicacion` FROM `RecursoIntalaciones` WHERE `FKidZonaTrabajo`=" . $idPlanEmergencia;
    $respuesta = seleccion($sql);


    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<thead><tr style = "text-align:center;">'
            . '<th>' . $vocab['instalaciones_tipo'] . '</th>'
            . '<th>' . $vocab['instalaciones_cantida'] . '</th>'
            . '<th>' . $vocab['instalaciones_tamaño'] . '</th>'
            . '<th>' . $vocab['instalaciones_distribucion'] . '</th>'
            . '<th>' . $vocab['instalaciones_encargada'] . '</th>'
            . '<th>' . $vocab['instalaciones_ubicacion'] . '</th>'
            . '</tr></thead><tbody>';
    foreach ($respuesta as $res) {
        $html .= '<tr>'
                . '<td>' . $res['tipo'] . '</td>'
                . '<td>' . $res['cantidad'] . '</td>'
                . '<th>' . $res['tamaño'] . '</th>'
                . '<td>' . $res['distribucion'] . '</td>'
                . '<td>' . $res['contacto'] . '</td>'
                . '<td>' . $res['ubicacion'] . '</td>'
                . '</tr>';
    }
    $html .= '</tbody></table>';
    return $html;
}

/*
 * Formulario idForm = 5 Formulario de inventarioOtros
 * Funcion que crea el  Formulario de otros inventarios 
 * @param {int} $idPlanEmergencia corresponde al id del plna de emergencia
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @param {String} $categoria corresponde a la categoria a la que pertenece el equipo
 * @returns {Undefined}
 */

function formularioInventarioOtros($idPlanEmergencia, $vocab, $categoria) {
//Recursos de telecomunicaciones
    $sql = "SELECT  `cantidad`, `tipo`, `caracteristicas`, `contacto`,"
            . " `ubicacion`,`categoria`,`observaciones` FROM `InventarioOtros` WHERE `FKidZonaTrabajo`=$idPlanEmergencia and `categoria`='$categoria' ";
    $respuesta = seleccion($sql);

    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<thead><tr style = "text-align:center;">'
            . '<th>' . $vocab['otros_recursos_tipo'] . '</th>'
            . '<th>' . $vocab['otros_recursos_cantidad'] . '</th>'
            . '<th>' . $vocab['otros_recursos_caracteristicas'] . '</th>'
            . '<th>' . $vocab['otros_recursos_contacto'] . '</th>'
            . '<th>' . $vocab['otros_recursos_ubicacion'] . '</th>'
            . '<th>' . $vocab['otros_recursos_observaciones'] . '</th>'
            . '</tr></thead><tbody>';
    foreach ($respuesta as $res) {
        $html .= '<tr>'
                . '<td>' . $res['tipo'] . '</td>'
                . '<td>' . $res['cantidad'] . '</td>'
                . '<th>' . $res['caracteristicas'] . '</th>'
                . '<td>' . $res['contacto'] . '</td>'
                . '<td>' . $res['ubicacion'] . '</td>'
                . '<td>' . $res['observaciones'] . '</td>'
                . '</tr>';
    }
    $html .= '</tbody></table>';
    return $html;
}

/*
 * Formulario idForm = 6 Formulario de peligros identificados
 * Funcion que crea el  Formulario de peligros identificados
 * @param {int} $idPlanEmergencia corresponde al id del plna de emergencia
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @returns {Undefined}
 */

function formularioPeligrosIdentificados($idPlanEmergencia, $vocab) {
    $sql = "SELECT  `id`, `peligro`, `presente`,`ubicacion`,`recomendacion`, `fecha`, `responsable`, `priorizacion` FROM `IdentificacionPeligro`  WHERE `presente`  = 1 and `FKidZonaTrabajo`=" . $idPlanEmergencia . " order by  priorizacion ASC";
    $respuesta = seleccion($sql);

    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<thead><tr style = "text-align:center;">'
            . '<th>' . $vocab['identifica_peligro_lugar'] . '</th>'
            . '<th>' . $vocab['identifica_peligro_ubicacion'] . '</th>'
            . '<th>' . $vocab['identifica_peligro_recomendacion'] . '</th>'
            . '<th>' . $vocab['identifica_peligro_fecha'] . '</th>'
            . '<th>' . $vocab['identifica_peligro_responsable'] . '</th>'
            . '<th>' . $vocab['identifica_peligro_priorizacion'] . '</th>'
            . '</tr></thead><tbody>';
    foreach ($respuesta as $res) {
        $color = "";
        if ($res['priorizacion'] == 1) {
            $color = "#d9534f"; //rojo
        } else if ($res['priorizacion'] == 2) {
            $color = "#f0ad4e"; //amarillo
        } else if ($res['priorizacion'] == 3) {
            $color = "#5cb85c"; //verde           
        }
        $html .= '<tr style = "text-align:center;">'
                . '<td>' . $res['peligro'] . '</td>'
                . '<td>' . $res['ubicacion'] . '</td>'
                . '<th>' . $res['recomendacion'] . '</th>'
                . '<td>' . $res['fecha'] . '</td>'
                . '<td>' . $res['responsable'] . '</td>'
                . '<td style="background-color: ' . $color . ' ;">' . $res['priorizacion'] . '</td>'
                . '</tr>';
    }
    $html .= '</tbody></table>';
    return $html;
}

/*
 * Formulario idForm = 7 Formulario de poblacion 
 * Funcion que crea el  Formulario de poblacion 
 * @param {int} $idPlanEmergencia corresponde al id del plna de emergencia
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @returns {Undefined}
 */

function formularioPoblacion($idPlanEmergencia, $vocab) {

    $sql = "SELECT  `nombreOficina`, `capacidadPermanente`, `capacidadTemporal`, `representanteComite`,"
            . " `representanteBrigadaEfectiva`,`representantePrimerosAuxilios`,`telefonoOficina`,`contactoEmergencia`,`telefonoPersonal`,`correoElectronico`"
            . ",`correoElectronico`,`sector` FROM `FormularioPoblacion` WHERE `FKidZonaTrabajo`=" . $idPlanEmergencia . " order by `sector` ";
    $respuesta = seleccion($sql);
    $html = "";
    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<thead><tr style = "text-align:center;">'
            . '<th>' . $vocab['poblacion_oficina'] . '</th>'
            . '<th>' . $vocab['poblacion_ocuapcional'] . '</th>'
            . '<th>' . $vocab['poblacion_temporal'] . '</th>'
            . '<th>' . $vocab['poblacion_representante_comite'] . '</th>'
            . '<th>' . $vocab['poblacion_representante_brigada'] . '</th>'
            . '<th>' . $vocab['poblacion_representante_primerosAuxilios'] . '</th>'
            . '<th>' . $vocab['poblacion_telefono_oficina'] . '</th>'
            . '<th>' . $vocab['poblacion_contactoEmergencia'] . '</th>'
            . '<th>' . $vocab['poblacion_telefono_personal'] . '</th>'
            . '<th>' . $vocab['poblacion_correo'] . '</th>'
            . '</tr></thead><tbody>';

    //pintamos el primer sector
    if (count($respuesta) > 0) {
        $sector = $respuesta[0]['sector'];
        $html .= '<tr style = "text-align:center;" ><td colspan = "10"><b>' . $respuesta[0]['sector'] . '</b></td></tr>';
    }
    foreach ($respuesta as $res) {
        if ($res['sector'] != $sector) {
            $html .= '<tr  style = "text-align:center;"><td colspan = "10"><b>' . $res['sector'] . '</b></td></tr>';
            $sector = $res['sector'];
        }
        $html .= '<tr style = "text-align:center;">'
                . '<td>' . $res['nombreOficina'] . '</td>'
                . '<td>' . $res['capacidadPermanente'] . '</td>'
                . '<th>' . $res['capacidadTemporal'] . '</th>'
                . '<td>' . $res['representanteComite'] . '</td>'
                . '<td>' . $res['representanteBrigadaEfectiva'] . '</td>'
                . '<td>' . $res['representantePrimerosAuxilios'] . '</td>'
                . '<td>' . $res['telefonoOficina'] . '</td>'
                . '<td>' . $res['contactoEmergencia'] . '</td>'
                . '<td>' . $res['telefonoPersonal'] . '</td>'
                . '<td>' . $res['correoElectronico'] . '</td>'
                . '</tr>';
    }
    $html .= '</tbody></table>';

    return $html;
}

/*
 * Formulario idForm = 8 //Formulario de rutas de evaciocion 
 * Funcion que crea el  //Formulario de rutas de evaciocion
 * @param {int} $idPlanEmergencia corresponde al id del plna de emergencia
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @returns {Undefined}
 */

function formularioRutaEvacuacion($idPlanEmergencia, $vocab) {
    $sql = "SELECT  `id`, `FKidZonaTrabajo`, `nombreArea`, `personaPermanente`,"
            . " `personaFlotante`,`ruta1`,`distancia1`,`tiempo1`,`ruta2`,`distancia2`,`tiempo2` FROM `RutaEvacuacion` WHERE `FKidZonaTrabajo`=$idPlanEmergencia";
    $respuesta = seleccion($sql);
    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<thead><tr style = "text-align:center;">'
            . '<th>' . $vocab['rutas_evacuacion_nombre'] . '</th>'
            . '<th>' . $vocab['rutas_evacuacion_personas_permanentes'] . '</th>'
            . '<th>' . $vocab['rutas_evacuacion_personas_flotantes'] . '</th>'
            . '<th>' . $vocab['rutas_evacuacion_ruta1'] . '</th>'
            . '<th>' . $vocab['rutas_evacuacion_distancia1'] . '</th>'
            . '<th>' . $vocab['rutas_evacuacion_tiempo1'] . '</th>'
            . '<th>' . $vocab['rutas_evacuacion_ruta2'] . '</th>'
            . '<th>' . $vocab['rutas_evacuacion_distancia2'] . '</th>'
            . '<th>' . $vocab['rutas_evacuacion_tiempo2'] . '</th>'
            . '</tr></thead><tbody>';
    foreach ($respuesta as $res) {
        $html .= '<tr style = "text-align:center;">'
                . '<td>' . $res['nombreArea'] . '</td>'
                . '<td>' . $res['personaPermanente'] . '</td>'
                . '<th>' . $res['personaFlotante'] . '</th>'
                . '<td>' . $res['ruta1'] . '</td>'
                . '<td>' . $res['distancia1'] . '</td>'
                . '<td>' . $res['tiempo1'] . '</td>'
                . '<td>' . $res['ruta2'] . '</td>'
                . '<td>' . $res['distancia2'] . '</td>'
                . '<td>' . $res['tiempo2'] . '</td>'
                . '</tr>';
    }
    $html .= '</tbody></table>';
    return $html;
}

/*
 * Formulario idForm = 9 //Formulario de rutas de evacuacion 
 * Funcion que crea el  //Formulario de rutas de evacuacion
 * @param {int} $idPlanEmergencia corresponde al id del plna de emergencia
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @returns {Undefined}
 */

function formularioBrigadistas($idPlanEmergencia, $vocab) {
    $sql = "SELECT  `id`, `FKidZonaTrabajo`, `brigadista`, `puntoPartida`,"
            . " `zonaEvacuar`,`numPersonasEvacuar`,`distancia`,`tiempo` FROM `Brigada` WHERE `FKidZonaTrabajo`=$idPlanEmergencia";
    $respuesta = seleccion($sql);
    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<thead><tr style = "text-align:center;">'
            . '<th>' . $vocab['brigadista_nombre'] . '</th>'
            . '<th>' . $vocab['brigadista_punto_partida'] . '</th>'
            . '<th>' . $vocab['brigadista_zona_asignada'] . '</th>'
            . '<th>' . $vocab['brigadista_numero_personas'] . '</th>'
            . '<th>' . $vocab['brigadista_distancia_total'] . '</th>'
            . '<th>' . $vocab['brigadista_tiempo_evacuacion'] . '</th>'
            . '</tr></thead><tbody>';
    foreach ($respuesta as $res) {
        $html .= '<tr style = "text-align:center;">'
                . '<td>' . $res['brigadista'] . '</td>'
                . '<td>' . $res['puntoPartida'] . '</td>'
                . '<th>' . $res['zonaEvacuar'] . '</th>'
                . '<td>' . $res['numPersonasEvacuar'] . '</td>'
                . '<td>' . $res['distancia'] . '</td>'
                . '<td>' . $res['tiempo'] . '</td>'
                . '</tr>';
    }
    $html .= '</tbody></table>';
    return $html;
}

/*
 * Formulario idForm = 10 //Formulario de atención de emergencias
 * Funcion que crea el  //Formulario de atención de emergencias
 * @param {int} $idPlanEmergencia corresponde al id del plna de emergencia
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @returns {Undefined}
 */

function formularioIngresoAtencionEmergencias($idPlanEmergencia, $vocab) {
    $sql = "SELECT  `tipo`, `ubicacion`, `Distancia`, `Tiempo`"
            . " FROM `CuerposScorro` WHERE `FKidZonaTrabajo`=" . $idPlanEmergencia;
    $respuesta = seleccion($sql);
    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<thead><tr style = "text-align:center;">'
            . '<th>' . $vocab['ingreso_cuerpoRespuesta'] . '</th>'
            . '<th>' . $vocab['ingreso_ubicación'] . '</th>'
            . '<th>' . $vocab['ingreso_recorrido'] . '</th>'
            . '<th>' . $vocab['ingreso_tiempoRespuesta'] . '</th>'
            . '</tr></thead><tbody>';
    foreach ($respuesta as $res) {
        $html .= '<tr style = "text-align:center;">'
                . '<td>' . $res['tipo'] . '</td>'
                . '<td>' . $res['ubicacion'] . '</td>'
                . '<th>' . $res['Distancia'] . '</th>'
                . '<td>' . $res['Tiempo'] . '</td>'
                . '</tr>';
    }
    $html .= '</tbody></table>';
    return $html;
}

/*
 * Formulario idForm = 10 //Formulario de cuerpos de socorro
 * Funcion que crea el  //Formulario de cuerpos de socorro
 * @param {int} $idPlanEmergencia corresponde al id del plna de emergencia
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @returns {Undefined}
 */

function formularioIngresoCuerposSocorro($idPlanEmergencia, $vocab) {
    $sql = "SELECT `dimensionAreaAcceso`, `radioGiro`, `caseta`, `plumas`, `anchoLibre` FROM `IngresoCuerpoSocorro` WHERE `FKidZonaTrabajo`=" . $idPlanEmergencia;
    $res = seleccion($sql);
    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<thead><tr style = "text-align:center;">'
            . '<th><b>' . $vocab['ingreso_Condiciones'] . '</b></th>'
            . '<th><b>' . $vocab['ingreso_descripcion'] . '</b></th>'
            . '</tr></thead><tbody>';
    //foreach ($respuesta as $res) {
    if (count($res) > 0) {
        $html .= '<tr style = "text-align:center;">'
                . '<td>' . $vocab['ingreso_dimensiones'] . '</td>'
                . '<td>' . $res[0]['dimensionAreaAcceso'] . '</td>'
                . '</tr><tr style = "text-align:center;">'
                . '<td>' . $vocab['ingreso_radio'] . '</td>'
                . '<td>' . $res[0]['radioGiro'] . '</td>'
                . '</tr><tr style = "text-align:center;">'
                . '<td>' . $vocab['ingreso_caseta'] . '</td>'
                . '<td>' . $res[0]['caseta'] . '</td>'
                . '</tr><tr style = "text-align:center;">'
                . '<td>' . $vocab['ingreso_plumas'] . '</td>'
                . '<td>' . $res[0]['plumas'] . '</td>'
                . '</tr><tr style = "text-align:center;">'
                . '<td>' . $vocab['ingreso_ancho'] . '</td>'
                . '<td>' . $res[0]['anchoLibre'] . '</td>'
                . '</tr>';
    }
    $html .= '</tbody></table>';
    return $html;
}

/*
 * Formulario idForm = 11 //Formulario de puestos de brigada
 * Funcion que crea el  //Formulario de puestos de brigada
 * @param {int} $idPlanEmergencia corresponde al id del plna de emergencia
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @returns {Undefined}
 */

function formularioPuestoBrigada($idPlanEmergencia, $vocab) {
    $sql = "SELECT `puesto`, `funcion`, `plazoEjecucion` FROM `FormularioPuestoBrigada` WHERE `FKidZonaTrabajo`=" . $idPlanEmergencia . " order by `puesto` ";
    $respuesta = seleccion($sql);


    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<thead><tr style = "text-align:center;">'
            . '<th>' . $vocab['puestos_brigada_funciones'] . '</th>'
            . '<th>' . $vocab['puestos_brigada_plazos_ejecución'] . '</th>'
            . '</tr></thead><tbody>';

    //pintamos el primer sector
    if (count($respuesta) > 0) {
        $puesto = $respuesta[0]['puesto'];
        $html .= '<tr style = "text-align:center;" ><td colspan = "10"><b>' . $respuesta[0]['puesto'] . '</b></td></tr>';
    }
    foreach ($respuesta as $res) {
        if ($res['puesto'] != $puesto) {
            $html .= '<tr  style = "text-align:center;"><td colspan = "10"><b>' . $res['puesto'] . '</b></td></tr>';
            $puesto = $res['puesto'];
        }
        $html .= '<tr style = "text-align:center;">'
                . '<td>' . $res['funcion'] . '</td>'
                . '<td>' . $res['plazoEjecucion'] . '</td>'
                . '</tr>';
    }
    $html .= '</tbody></table>';
    return $html;
}

/*
 * Formulario idForm = 12 //Formulario de zonas de seguridad
 * Funcion que crea el  //Formulario de zonas de seguridad
 * @param {int} $idPlanEmergencia corresponde al id del plna de emergencia
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @returns {Undefined}
 */

function formularioZonaSeguridad($idPlanEmergencia, $vocab) {
    $sql = "SELECT  `id`, `FKidZonaTrabajo`, `Nombre`, `ubicacion`,"
            . " `capacidad`,`observaciones`,`sector` FROM `ZonaSeguridad` WHERE `FKidZonaTrabajo`=$idPlanEmergencia";
    $respuesta = seleccion($sql);
    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<thead><tr style = "text-align:center;">'
            . '<th>' . $vocab['zona_seguridad_nombre'] . '</th>'
            . '<th>' . $vocab['zona_seguridad_ubicacion'] . '</th>'
            . '<th>' . $vocab['zona_seguridad_capacidad'] . '</th>'
            . '<th>' . $vocab['zona_seguridad_observaciones'] . '</th>'
            . '<th>' . $vocab['zona_seguridad_sector'] . '</th>'
            . '</tr></thead><tbody>';
    foreach ($respuesta as $res) {
        $html .= '<tr style = "text-align:center;">'
                . '<td>' . $res['Nombre'] . '</td>'
                . '<td>' . $res['ubicacion'] . '</td>'
                . '<th>' . $res['capacidad'] . '</th>'
                . '<td>' . $res['observaciones'] . '</td>'
                . '<td>' . $res['sector'] . '</td>'
                . '</tr>';
    }
    $html .= '</tbody></table>';
    return $html;
}

/*
 * Formulario idForm = 4 //Formulario de matriz de riesgos
 * Funcion que crea el  //Formulario de matriz de riesgos
 * @param {int} $idPlanEmergencia corresponde al id del plna de emergencia
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @param {MYPDF} $pdf objeto de la tipo MYPDF
 * @returns {Undefined}
 */

function formularioMatriz($idPlanEmergencia, $vocab, $pdf) {
    $sql = "SELECT `probabilidad`, `gravedad`, `consecuenciaAmenaza` FROM `Matriz` WHERE `FKidZonaTrabajo`=" . $idPlanEmergencia;
    $respuesta = seleccion($sql);
    $cantidad = array(
        ['color' => 'Ninguna', 'cantidad' => 0],
        ['color' => 'Verde', 'cantidad' => 0],
        ['color' => 'Amarilla', 'cantidad' => 0],
        ['color' => 'Roja', 'cantidad' => 0]);

    foreach ($respuesta as $res) {
        $valor = $res['probabilidad'] * ($res['gravedad'] + $res['consecuenciaAmenaza']);
        if ($valor <= 3) {
            $cantidad[0]['cantidad'] += 1;
        } else if ($valor > 3 && $valor <= 12) {
            $cantidad[1]['cantidad'] += 1;
        } else if ($valor > 12 && $valor < 24) {
            $cantidad[2]['cantidad'] += 1;
        } else if ($valor >= 24) {
            $cantidad[3]['cantidad'] += 1;
        }
    }

    $i = 0;
    $valores = array();
    $html = "";
    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<thead><tr style = "text-align:center;">'
            . '<th>' . $vocab['tipo_alerta_nombre'] . '</th>'
            . '<th>' . $vocab['tipo_alerta_cantidad'] . '</th>'
            . '<th>' . $vocab['tipo_alerta_porcentaje'] . '</th>'
            //   . '<th>' . $vocab['tipo_alerta_amenaza'] . '</th>'
            . '</tr></thead><tbody>';
    foreach ($cantidad as $res) {
        $valores[] = $res['cantidad'];
        $html .= '<tr style = "text-align:center;">'
                . '<td>' . $res['color'] . '</td>'
                . '<td>' . $res['cantidad'] . '</td>'
                . '<th>' . calcularPorcentajeAmenaza($cantidad[$i]['cantidad'], $cantidad) . '</th>'
                . '</tr>';
        $i = $i + 1;
    }
    $html .= '</tbody></table>';
    $colores = array($vocab["criterio_ninguna"], $vocab["criterio_verde"],
        $vocab["criterio_amarilla"], $vocab["criterio_roja"]);
    //global $datosCabecera;
    $color = JSON_encode($colores);
    $color = str_replace('"', "'", $color);

    $valores[0] = (($valores[0] + $valores[1] + $valores[2] + $valores[3]) == 0) ? 1 : $valores[0];
    $valores = JSON_encode($valores);
    $nombreGrafico = crearGrafico($valores, $color);

    $html .= '<div><p dir="ltr" style="text-align:center"><span style="font-family:Arial; font-size:11pt">&nbsp;<img alt="Gráfico de la matriz de riesgos" width="250px" height = "250px"   src="' . $nombreGrafico . '"/></span></p></div>';
    $pdf->writeHTML($html, true, false, false, false, '');
    unlink($nombreGrafico);
}

/*
 * Funcion que calcula el porcentaje de amenaza para la creacion de un grafico que
 * muestre los riesgos 
 * @param {Array} $cantidadPorTipo array asociativo que tiene la cantidad por tipo
 * (de acuerdo a los valores de los criteros)
 *  * @param {int} $cantidad corresponde a la cantidad total de colores para graficar
 * @returns {Undefined}
 */

function calcularPorcentajeAmenaza($cantidadPorTipo, $cantidad) {
    $cantidadTotal = $cantidad[0]['cantidad'] + $cantidad[1]['cantidad'] + $cantidad[2]['cantidad'] + $cantidad[3]['cantidad'];
    if ($cantidadTotal != 0) {
        return ($cantidadPorTipo / $cantidadTotal) * 100;
    }
    return 1;
}

/*
 * Funcion que manda a llamar a los formularios que pertenecen a un subcapitulo
 * @param {MYPDF} $pdf corresponde a un objeto de la clase MYPDF
 * @param {int} $id corresponde al id del subcapitulo
 * @param {int} $idPlanEmergencia corresponde al id del plan de emergencias
 * @param {Array} $resPlan corresponde a un array asociativo con los registros del 
 * plan de emergencia
 * @param {Array} $resTipoPoblacion corresponde a un array asociativo con los registros del 
 *  tipo de población de un plan de emergencia  
 * @param {Array} $formularios corresponde a un array asociativo con los registros de la tabla Formulario
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @param {int} $idPlanEmergencia cooresponde al id del plan de emergencias
 * @returns {Undefined}
 */

function listarFormularios($id, $formularios, $resPlan, $resTipoPoblacion, $vocab, $idPlanEmergencia, $pdf) {
    //$html = "";
    foreach ($formularios as $form) {
        // $html .=
        formularioSeleccionada($id, $form, $resPlan, $resTipoPoblacion, $vocab, $idPlanEmergencia, $pdf);
    }
    //   return $html;
}

/*
 * Funcion que elige por subcapitulo, los formularios a genera en dicho subcapitulo.
 * @param {MYPDF} $pdf corresponde a un objeto de la clase MYPDF
 * @param {int} $id corresponde al id del subcapitulo
 * @param {int} $idPlanEmergencia corresponde al id del plan de emergencias
 * @param {Array} $resPlan corresponde a un array asociativo con los registros del 
 * plan de emergencia
 * @param {Array} $resTipoPoblacion corresponde a un array asociativo con los registros del 
 *  tipo de población de un plan de emergencia  
 * @param {Array} $formularios corresponde a un array asociativo con los registros de la tabla Formulario
 * @param {Array} $vocab corresponde al vocabulario del sistema
 * @param {int} $idPlanEmergencia cooresponde al id del plan de emergencias
 * @returns {Undefined}
 */

function formularioSeleccionada($id, $form, $resPlan, $resTipoPoblacion, $vocab, $idPlanEmergencia, $pdf) {
    $html = "";
    $cargar = false;
    if ($form['FKidSubcapitulos'] == $id) {
        $idForm = $form['id'];
        $html .= "<p>" . remplazar($form['descripcionArriba']) . "</p>";
        switch ($idForm) {
            case 1:
                $html .= formularioDatosGenerales($resPlan, $vocab);
                break;
            case 2:
                $html = formularioActividades($resTipoPoblacion, $vocab);
                break;
            case 3:
                $html = formularioInstalaciones($resPlan, $vocab);
                break;
            case 4:
                formularioMatriz($idPlanEmergencia, $vocab, $pdf);
                break;
            case 5:
                $html .= '<br><div>' . $vocab["recurso_humano_titulo"] . '</div>';
                $html .= formularioRecursosHumanos($idPlanEmergencia, $vocab);

                $html .= '<br><div>' . $vocab["equipo_moviles"] . $vocab["equipo_moviles_terrestre"] . '</div>';
                $html .= formularioEquipoMovil($idPlanEmergencia, $vocab, "Terrestre");

                $html .= '<br><div>' . $vocab["equipo_moviles"] . $vocab["equipo_moviles_Acuático"] . '</div>';
                $html .= formularioEquipoMovil($idPlanEmergencia, $vocab, "Acuático");

                $html .= '<br><div>' . $vocab["equipo_moviles"] . $vocab["equipo_moviles_Aereo"] . '</div>';
                $html .= formularioEquipoMovil($idPlanEmergencia, $vocab, "Aereo");

                $html .= '<br><div>' . $vocab["instalaciones_titulo"] . '</div>';
                $html .= formularioRecursosInstalaciones($idPlanEmergencia, $vocab);

                $html .= '<br><div>' . $vocab["otros_recursos_Telecomunicacion"] . '</div>';
                $html .= formularioInventarioOtros($idPlanEmergencia, $vocab, "telecomunicaciones");

                $html .= '<br><div>' . $vocab["otros_recursos_equipo_repuestos"] . '</div>';
                $html .= formularioInventarioOtros($idPlanEmergencia, $vocab, "repuestos");

                $html .= '<br><div>' . $vocab["otros_recursos_equipo_repuestosAgua"] . '</div>';
                $html .= formularioInventarioOtros($idPlanEmergencia, $vocab, "recursosAgua");

                $html .= '<br><div>' . $vocab["otros_recursos_Equipo_primeraRespuesta"] . '</div>';
                $html .= formularioInventarioOtros($idPlanEmergencia, $vocab, "EquipoPrimeraRespuesta");

                $html .= '<br><div>' . $vocab["otros_recursos_Señalizacion"] . '</div>';
                $html .= formularioInventarioOtros($idPlanEmergencia, $vocab, "señalizacion");

                $html .= '<br><div>' . $vocab["otros_recursos_sistemas_insendios"] . '</div>';
                $html .= formularioInventarioOtros($idPlanEmergencia, $vocab, "sistemasIncendios");

                $html .= '<br><div>' . $vocab["otros_recursos_equipo_repuestosEnergia"] . '</div>';
                $html .= formularioInventarioOtros($idPlanEmergencia, $vocab, "recursosEnergia");
                break;
            case 6:
                $html .= formularioPeligrosIdentificados($idPlanEmergencia, $vocab);
                break;
            case 7:
                cargarNuevaPaginaHorizontal($pdf);
                $html .= formularioPoblacion($idPlanEmergencia, $vocab);
                $cargar = true;

                break;
            case 8:
                cargarNuevaPaginaHorizontal($pdf);
                $html .= formularioRutaEvacuacion($idPlanEmergencia, $vocab);
                $cargar = true;
                break;
            case 9:
                $html .= formularioBrigadistas($idPlanEmergencia, $vocab);
                break;
            case 10:
                $html .= formularioIngresoAtencionEmergencias($idPlanEmergencia, $vocab);
                $html .= '<br><div></div>';
                $html .= formularioIngresoCuerposSocorro($idPlanEmergencia, $vocab);
                break;
            case 11:
                $html .= formularioPuestoBrigada($idPlanEmergencia, $vocab);
                break;
            case 12:
                $html .= formularioZonaSeguridad($idPlanEmergencia, $vocab);
                break;
        }
        $html .= remplazar($form['descripcionAbajo']);
    }
    // return $html;
    if ($html != "") {
        $pdf->writeHTML($html, true, false, false, false, '');
        if ($cargar == true) {
            cargarNuevaPagina($pdf);
        }
    }
}

/*
 * Funcion que carga una nueva pagina en el pdf y modifica la fuente
 * @param {MYPDF} $pdf corresponde a un objeto de la clase MYPDF
 * @returns {Undefined}
 */

function cargarNuevaPaginaHorizontal($pdf) {
    $pdf->SetFont(PDF_FONT_MONOSPACED, '', 12);
    $pdf->AddPage('L', 'A4');
}

function cargarNuevaPagina($pdf) {
    $pdf->SetFont(PDF_FONT_MONOSPACED, '', 12);
    $pdf->AddPage('P', 'A4');
}

/*
 * Funcion que crea el grafico para mostrar en el pdf
 * @param {Array} $criterios corresponde a los datos que se graficarán
 *  * @param {Array} $colores array con los nombres de los colores que se colocarán
 * como legendas en el gráfico
 * @returns {String} con el nombre de la imagen generada
 */

function crearGrafico($criterios, $colores) {
    $apr = 40;
    $rpr = 40;
    $rj = 50;
    $nsp = 50;

    $criterios = str_replace("'", '"', $criterios);
    $data = JSON_decode($criterios);

    $colores = str_replace("'", '"', $colores);
    $criterios = JSON_decode($colores);
    $legend = JSON_decode($colores);

    $colors = array("#828282", "#5cb85c", "#f0ad4e", "#d9534f");

    $graph = new PieGraph(350, 350);
    $graph->SetShadow();

    $graph->title->Set("Tipos de amenazas");
    $p1 = new PiePlot($data);
    $p1->SetLegends($legend);

    $graph->Add($p1);
    $p1->SetSliceColors($colors);

    $graph->Stroke(_IMG_HANDLER);
    $aleatorio = rand(1000, 9999);
    $fileName = "grafica" . $aleatorio . ".png";
    $graph->img->Stream($fileName);
    return $fileName;
}

//ob_clean();
$return = "Generado";
if (check_permiso($mod4, $act6, $user_rol) && !isset($_GET['visualizarpdf'])) {
    $nombreDoc = $id . "-" . $version . '.pdf';

    $pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'mod/versionesPDF/' . $nombreDoc, 'F');
    $sql_a = "CALL insert_historial('$id','$version','$nombreDoc',@res);";
    $sql_b = "SELECT @res as res;";
    $res = transaccion_verificada($sql_a, $sql_b);
} else if (check_permiso($mod5, $act6, $user_rol)) {
    $nombreDoc = 'planEmergencias' . $random . '.pdf';
    $pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'mod/versionesPDF/' . $nombreDoc, 'F');
}
//ob_clean();
echo $return;

//============================================================+
// END OF FILE
//============================================================+
?>
