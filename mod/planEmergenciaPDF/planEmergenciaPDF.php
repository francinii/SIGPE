<?php

//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */
include("../login/check.php");
include("../../functions.php");
$vocab = $mySessionController->getVar("vocab");
$user_rol = $mySessionController->getVar("rol");
include_once('../../lib/tcpdf/examples/tcpdf_include.php');

$id = $_GET['idCentro'];
$sqlPlan = "(SELECT `id`, `FKidZonaTrabajo`, `revisadoPor`, `codigoZonaTrabajo`, `actividad`, `direccion`, `personaContactoGeneral`, `numeroTelefono`, `numeroFax`, `correo`, `categoriaNFPA`, `usoInstalaciones`, `horarioJornada`, `seguridadInstitucional`, `servicioConsegeria`, `personalAdministrativo`, `personalAcademico`, `presenciaEstudiantil`, `instalacionesDensidadOcupacion`, `instalacionesAreaConstruccion`, `instalacionesInstalaciones`, `instalacionesCaracteristicasZona`, `instalacionesTopografia`, `instalacionesNivelTerreno`, `instalacionesColindates`, `elementosConstructivosTipoConstruccion`, `elementosConstructivosAntiguedad`, `elementosConstructivosCimientos`, `elementosConstructivosEstructura`, `elementosConstructivosParedes`, `elementosConstructivosEntrepiso`, `elementosConstructivosTecho`, `elementosConstructivosCielos`, `elementosConstructivosPisos`, `elementosConstructivosAreaParqueo`, `elementosConstructivosSistemaAguaPotable`, `elementosConstructivosAlcantarilladoSanitario`, `elementosConstructivosAlcantarilladoPluvial`, `elementosConstructivosSistemaElectrico`, `elementosConstructivosSistemaTelefonico`, `elementosConstructivosOtros` FROM `PlanEmergencia` where FKidZonaTrabajo =" . $id . ")";
$sqlCapitulos = "(SELECT  id, descripcion, orden,titulo,isActivo FROM Capitulo ORDER BY orden)";


$sqlZonas = "(SELECT  id, nombreZonaTrabajo, logo FROM ZonaTrabajo where id =" . $id . ")";
$zonas = seleccion($sqlZonas);

$sql = "(SELECT  id, FKidSubcapitulos FROM Formulario)";
$formularios = seleccion($sql);

$sql = "(SELECT  tipoPoblacion, descripcion, total, representacionDe FROM TipoPoblacion)";
$resTipoPoblacion = seleccion($sql);


$sql = "SELECT  `id` FROM `PlanEmergencia`  WHERE `FKidZonaTrabajo`=" . $id;
$resid = seleccion($sql);

if (count($resid) > 0) {
    $idPlanEmergencia = $resid[0]['id'];
}


//$res = seleccion($sql);
$resPlan = seleccion($sqlPlan);
$rescapitulos = seleccion($sqlCapitulos);
global $datosCabecera;
$dirImages = "img/";
$centroTrabajo = $zonas[0]["nombreZonaTrabajo"];
$logoUNA = $dirImages . "logo_una.jpg";
$logoCentro = $dirImages . "imgPlanes/" . $zonas[0]["logo"];
$logoCIEUNA = $dirImages . "logo_cieuna.png";
$codigo = $resPlan[0]['codigoZonaTrabajo'];
$revisadoPor = $resPlan[0]['revisadoPor'];

$datosCabecera = array(
    "centroTrabajo" => $centroTrabajo,
    "logoUNA" => $logoUNA,
    "logoCIEUNA" => $logoCIEUNA,
    "logoCentro" => $logoCentro,
    "codigo" => $codigo,
    "revisado" => $revisadoPor);

class MYPDF extends TCPDF {

    public function Header() {
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
                . '<td><b>Página </b>' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages() . '</td>'
                . '</tr>'
                . '</table>'
                . '<div style = "height: 250px;"></div>';
        $this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
    }

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//Modificar la informacion del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Francini Corrales Garro & Danny Valerio Ramírez');
$pdf->SetTitle('Plan de emergencias');
$pdf->SetSubject('Plan de emergencias');
$pdf->SetKeywords('Plan, PDF, emergencias, CIEUNA, UNA');
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// Modificar margenes del documento
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + PDF_MARGIN_HEADER, PDF_MARGIN_RIGHT);
// 
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$font = array(PDF_FONT_MONOSPACED, '', 9);
$pdf->SetHeaderFont($font);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->setPrintFooter(false);

//Modifica la unidad con la que el documento trabaja (modificado para trabajar en mm)
$pdf->setPageUnit(PDF_UNIT);

//Llamada de las funciones que crean el pdf
//Portada del documento
portada($pdf);

//Creación de los capítulos del documento
capitulos($pdf, $rescapitulos, $resPlan, $resTipoPoblacion, $formularios, $vocab, $idPlanEmergencia);

//Creación de la tabla de contenidos
tablaContenidos($pdf);

function tablaContenidos($pdf) {
    $pdf->setPrintHeader(false);
// add a new page for TOC
    $pdf->addTOCPage();
// write the TOC title and/or other elements on the TOC page
    $pdf->SetFont(PDF_FONT_MONOSPACED, 'B', 16);
    $pdf->MultiCell(0, 0, 'Tabla de contenido', 0, 'L', 0, 1, '', '', true, 0);
    $pdf->Ln();

    //$pdf->SetFont(PDF_FONT_MONOSPACED, '', 10);
// define styles for various bookmark levels
    $bookmark_templates = array();
    /*
     * The key of the $bookmark_templates array represent the bookmark level (from 0 to n).
     * The following templates will be replaced with proper content:
     *     #TOC_DESCRIPTION#    this will be replaced with the bookmark description;
     *     #TOC_PAGE_NUMBER#    this will be replaced with page number.
     *
     * NOTES:
     *     If you want to align the page number on the right you have to use a monospaced font like courier, otherwise you can left align using any font type.
     *     The following is just an example, you can get various styles by combining various HTML elements.
     */
// A monospaced font for the page number is mandatory to get the right alignment

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
// add other bookmark level templates here ...
// add table of content at page 1
// (check the example n. 45 for a text-only TOC
    $pdf->addHTMLTOC(2, 'Indice', $bookmark_templates, true, 'B', array(128, 0, 0));

// end of TOC page
    $pdf->endTOCPage();
}

function capitulos($pdf, $capitulos, $resPlan, $resTipoPoblacion, $formularios, $vocab, $idPlanEmergencia) {
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + PDF_MARGIN_HEADER, PDF_MARGIN_RIGHT);
    //Empieza a mostrar el header
    $pdf->setPrintHeader(true);
    // $html = '<div style = "height: 250px;"><div>';
    foreach ($capitulos as $cap) {
        cargarNuevaPagina($pdf);
        $pdf->Bookmark($cap['orden'] . ". " . $cap['titulo'], 0, 0, '', 'B', array(0, 64, 128));
        // $pdf->Cell(0, 10, $cap['orden'] . ". " . $cap['titulo'], 0, 1, 'L');
        $html = '<h2><b>' . $cap['orden'] . ". " . $cap['titulo'] . '</b></h2>';
        $html .= $cap['descripcion'];
        $pdf->writeHTML($html, true, false, true, false, '');
        subCapitulos($pdf, $cap['id'], $cap['orden'], $resPlan, $resTipoPoblacion, $formularios, $vocab, $idPlanEmergencia);
    }
}

function subCapitulos($pdf, $id, $ordenCapitulo, $resPlan, $resTipoPoblacion, $formularios, $vocab, $idPlanEmergencia) {
    $sql = "(SELECT  id, descripcion, orden,titulo,isActivo FROM SubCapitulo where FKidCapitulo = $id ORDER BY orden)";
    $subcapitulos = seleccion($sql);
    foreach ($subcapitulos as $sub) {
        $pdf->Bookmark($ordenCapitulo . "." . $sub['orden'] . " " . $sub['titulo'], 1, 0, '', '', array(128, 0, 0));

//        $pdf->Cell(0, 10, $ordenCapitulo . "." . $sub['orden'] . " " . $sub['titulo'], 0, 1, 'L');
        $html = '<h3><b>' . $ordenCapitulo . "." . $sub['orden'] . " " . $sub['titulo'] . '</b></h3>';
        $html .= $sub['descripcion'];
        $pdf->writeHTML($html, true, false, true, false, '');
        $html = listarFormularios($sub['id'], $formularios, $resPlan, $resTipoPoblacion, $vocab, $idPlanEmergencia);
        // $html .= '<div></div>';
        $pdf->writeHTML($html, true, false, true, false, '');
    }
}

function portada($pdf) {
    $pdf->setPrintHeader(false);
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    global $datosCabecera;
    cargarNuevaPagina($pdf);
    $logo = '<img src= "' . $datosCabecera['logoUNA'] . '"  width="100" height="100" >';
    $logo2 = '<img style = "margin:right:1000px;" src= "' . $datosCabecera['logoCIEUNA'] . '"width="100" height="100" >';
    $y = $pdf->getY();

    $pdf->writeHTMLCell(150, '', '', $y, $logo, 0, 0, false, true, 'J', true);
    $pdf->writeHTMLCell(30, '', '', '', $logo2, 0, 1, false, true, 'right', true);
//    $html = '<div style = "height: 100px;"><div>
//        <div  style = "background-color:blue;">
//        <span align="right">
//            <img src= "' . $datosCabecera['logoUNA'] . '"  width="100" height="100" >
//        </span> 
//        <span> &nbsp </span>
//        <span align="right">
//            <img src= "' . $datosCabecera['logoUNA'] . '"  width="100" height="100" >
//        </span>
//        </div>';

    $html = '<div style = "text-align:center;">
            <h2>PLAN DE PREPARATIVOS DE RESPUESTA ANTE EMERGENCIAS</h2>
            <h2>' . $datosCabecera["centroTrabajo"] . ' </h2>
            <h2>   UNIVERSIDAD NACIONAL DE COSTA RICA </h2>
             <img src= "' . $datosCabecera['logoCentro'] . '" width="400" height="400" >
            <h2>' . $datosCabecera["centroTrabajo"] . ' </h2>
            <h2>   Fecha </h2>
            <h6 style="border: 1px solid black; padding: 20px; text-align: center;">
            Este documento tiene como objeto cumplir con los requisitos y contenidos que debe
            cumplir un plan de preparativos y respuesta ante emergencias en centros laborales y 
            de ocupación pública. Se basa en la Norma CNE-NA- INTE-DN-01:2014, la cual se sustenta 
            en el artículo 12 de la Ley Nacional de Emergencias y Prevención del Riesgo Nº 8488 y 
            el artículo 4 de la Ley del Benemérito Cuerpo de Bomberos de Costa Rica Nº 8228
            </h6>
        </div>';
    $pdf->writeHTML($html, true, false, true, false, '');
}

//Formulario idForm = 1 Formulario de datos generales
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

//Formulario idForm = 2 Formulario de actividades
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

//Formulario idForm = 3 Formulario de instalaciones
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
            . '<td colspan = "2"><b>' . $res['instalaciones_subTitulo2'] . '</b></td>'
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

//Formulario de recurso humano
function formularioRecursosHumanos($idPlanEmergencia, $vocab) {
    //Recursos Humanos
    $sql = "SELECT  `cantidad`, `profesion`, `categorias`, `localizacion`,"
            . " `contacto` FROM `RecursoHumanos` WHERE `FKidPlanEmergencias`=" . $idPlanEmergencia;
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

//Formulario para tabla de equipo movil de tipo aereo acuatico y terrestre
function formularioEquipoMovil($idPlanEmergencia, $vocab, $categoria) {
//Equipo movil
    $sql = "SELECT `cantidad`, `capacidad`, `tipo`, `caracteristicas`,"
            . " `contacto`, `ubicacion`, `categoria` FROM `EquipoMovil` WHERE  `categoria`= '" . $categoria . "' and `FKidPlanEmergencias`=" . $idPlanEmergencia;
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
function formularioRecursosInstalaciones($idPlanEmergencia, $vocab) {
//Recurso de instalaciones
    $sql = "SELECT `tipo`, `cantidad`, `tamaño`, `distribucion`,"
            . " `contacto`, `ubicacion` FROM `RecursoIntalaciones` WHERE `FKidPlanEmergencias`=" . $idPlanEmergencia;
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

//Formulario recursos instalaciones
function formularioInventarioOtros($idPlanEmergencia, $vocab, $categoria) {
//Recursos de telecomunicaciones
    $sql = "SELECT  `cantidad`, `tipo`, `caracteristicas`, `contacto`,"
            . " `ubicacion`,`categoria`,`observaciones` FROM `InventarioOtros` WHERE `FKidPlanEmergencias`=$idPlanEmergencia and `categoria`='$categoria' ";
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

//Formulario de peligros identificados
function formularioPeligrosIdentificados($idPlanEmergencia, $vocab) {
    $sql = "SELECT  `id`, `peligro`, `presente`,`ubicacion`,`recomendacion`, `fecha`, `responsable`, `priorizacion` FROM `IdentificacionPeligro`  WHERE `presente`  = 1 and `FKidPlanEmergencias`=" . $idPlanEmergencia . " order by  priorizacion ASC";
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

//Formulario de poblacion ///Aun falta agregar la LINEA DE SECTORES
function formularioPoblacion($idPlanEmergencia, $vocab) {
    $sql = "SELECT  `nombreOficina`, `capacidadPermanente`, `capacidadTemporal`, `representanteComite`,"
            . " `representanteBrigadaEfectiva`,`representantePrimerosAuxilios`,`telefonoOficina`,`contactoEmergencia`,`telefonoPersonal`,`correoElectronico`"
            . ",`correoElectronico`,`sector` FROM `FormularioPoblacion` WHERE `FKidPlanEmergencias`=" . $idPlanEmergencia . " order by `sector` ";
    $respuesta = seleccion($sql);


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
    foreach ($respuesta as $res) {
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

//Formulario de rutas de evaciocion
function formularioRutaEvacuacion($idPlanEmergencia, $vocab) {
    $sql = "SELECT  `id`, `FKidPlanEmergencias`, `nombreArea`, `personaPermanente`,"
            . " `personaFlotante`,`ruta1`,`distancia1`,`tiempo1`,`ruta2`,`distancia2`,`tiempo2` FROM `RutaEvacuacion` WHERE `FKidPlanEmergencias`=$idPlanEmergencia";
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


//Formulario de rutas de evaciocion
function formularioBrigadistas($idPlanEmergencia, $vocab) {
   $sql = "SELECT  `id`, `FKidPlanEmergencias`, `brigadista`, `puntoPartida`,"
        . " `zonaEvacuar`,`numPersonasEvacuar`,`distancia`,`tiempo` FROM `Brigada` WHERE `FKidPlanEmergencias`=$idPlanEmergencia";
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

//Formulario de rutas de evaciocion
function formularioAtencionEmergencias($idPlanEmergencia, $vocab) {
   $sql = "SELECT  `id`, `FKidPlanEmergencias`, `brigadista`, `puntoPartida`,"
        . " `zonaEvacuar`,`numPersonasEvacuar`,`distancia`,`tiempo` FROM `Brigada` WHERE `FKidPlanEmergencias`=$idPlanEmergencia";
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


function listarFormularios($id, $formularios, $resPlan, $resTipoPoblacion, $vocab, $idPlanEmergencia) {
    $html = "";
    foreach ($formularios as $form) {
        $html .= formularioSeleccionada($id, $form, $resPlan, $resTipoPoblacion, $vocab, $idPlanEmergencia);
    }
    return $html;
}

function formularioSeleccionada($id, $form, $resPlan, $resTipoPoblacion, $vocab, $idPlanEmergencia) {
    $html = "";
    if ($form['FKidSubcapitulos'] == $id) {
        $idForm = $form['id'];
        if ($idForm == 1) {  //Formulario de datos generales
            $html = formularioDatosGenerales($resPlan, $vocab);
            $html .= '<div></div>';
        } else if ($idForm == 2) { //Formulario de actividades
            $html = formularioActividades($resTipoPoblacion, $vocab);
            $html .= '<div></div>';
        } else if ($idForm == 3) { // Formulario de instalaciones
            $html .= formularioInstalaciones($resPlan, $vocab);

            //  $html .= '<div></div>';
        } else if ($idForm == 4) { //Formulario Matriz de riesgos 
            //  $html .= '<div></div>';
        } else if ($idForm == 5) { //Formulario Inventario
            $html .= '<div>' . $vocab["recurso_humano_titulo"] . '</div>';
            $html .= formularioRecursosHumanos($idPlanEmergencia, $vocab);

            $html .= '<div>' . $vocab["recurso_humano_titulo"] . '</div>';
            $html .= formularioEquipoMovil($idPlanEmergencia, $vocab, "Aereo");

            $html .= '<div>' . $vocab["instalaciones_titulo"] . '</div>';
            $html .= formularioRecursosInstalaciones($idPlanEmergencia, $vocab);

            $html .= '<div>' . $vocab["otros_recursos_Telecomunicacion"] . '</div>';
            $html .= formularioInventarioOtros($idPlanEmergencia, $vocab, "telecomunicaciones");

            $html .= '<div>' . $vocab["otros_recursos_equipo_repuestos"] . '</div>';
            $html .= formularioInventarioOtros($idPlanEmergencia, $vocab, "repuestos");

            $html .= '<div>' . $vocab["otros_recursos_equipo_repuestosAgua"] . '</div>';
            $html .= formularioInventarioOtros($idPlanEmergencia, $vocab, "recursosAgua");

            $html .= '<div>' . $vocab["otros_recursos_Equipo_primeraRespuesta"] . '</div>';
            $html .= formularioInventarioOtros($idPlanEmergencia, $vocab, "EquipoPrimeraRespuesta");

            $html .= '<div>' . $vocab["otros_recursos_Señalizacion"] . '</div>';
            $html .= formularioInventarioOtros($idPlanEmergencia, $vocab, "señalizacion");

            $html .= '<div>' . $vocab["otros_recursos_sistemas_insendios"] . '</div>';
            $html .= formularioInventarioOtros($idPlanEmergencia, $vocab, "sistemasIncendios");

            $html .= '<div>' . $vocab["otros_recursos_equipo_repuestosEnergia"] . '</div>';
            $html .= formularioInventarioOtros($idPlanEmergencia, $vocab, "recursosEnergia");
            $html .= '<div></div>';
            //  $html .= '<div></div>';
        } else if ($idForm == 6) { //Formulario Identificacion de peligros
            $html .= formularioPeligrosIdentificados($idPlanEmergencia, $vocab);
            $html .= '<div></div>';
            //  $html .= '<div></div>';
        } else if ($idForm == 7) { //Formulario de población
            $html .= formularioPoblacion($idPlanEmergencia, $vocab);
            $html .= '<div></div>';
        } else if ($idForm == 8) { //Formulario de rutas de evacuación
              $html .= formularioRutaEvacuacion($idPlanEmergencia, $vocab);
              $html .= '<div></div>';
        } else if ($idForm == 9) { //Formulario de brigadistas
            $html .= formularioBrigadistas($idPlanEmergencia, $vocab) ;
              $html .= '<div></div>';
            //  $html .= '<div></div>';
        } else if ($idForm == 10) { //Formulario de ingreso
            //  $html .= '<div></div>';
        } else if ($idForm == 11) { //Formulario de zona de seguridad
            //  $html .= '<div></div>';
        }
    }
    return $html;
}

function cargarNuevaPagina($pdf) {
    $pdf->SetFont(PDF_FONT_MONOSPACED, '', 12);
    $pdf->AddPage();
}

// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('planEmergencias.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
