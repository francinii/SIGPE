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


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Francini Corrales Garro & Danny Valerio Ramírez');
$pdf->SetTitle('Plan de emergencias');
$pdf->SetSubject('Plan de emergencias');
$pdf->SetKeywords('Plan, PDF, emergencias, CIEUNA, UNA');

//$pdf->SetHeaderData();
// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$font = array('times', '', 10);
$pdf->SetHeaderFont($font);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//
//// set some language-dependent strings (optional)
////if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
////    require_once(dirname(__FILE__) . '/lang/eng.php');
////    $pdf->setLanguageArray($l);
////}
//
//// ---------------------------------------------------------
$pdf->setPrintFooter(false);
portada($pdf);
capitulos($pdf, $rescapitulos, $resPlan, $resTipoPoblacion, $formularios);
tablaContenidos($pdf);

function tablaContenidos($pdf) {
// add a new page for TOC
    $pdf->addTOCPage();
// write the TOC title and/or other elements on the TOC page
    $pdf->SetFont('times', 'B', 16);
    $pdf->MultiCell(0, 0, 'Tabla de contenido', 0, 'C', 0, 1, '', '', true, 0);
    $pdf->Ln();
    $pdf->SetFont('helvetica', '', 10);
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
    $bookmark_templates[0] = '<table border="0" cellpadding="0" cellspacing="0"><tr><td width="155mm"><span style="font-family:times;font-weight:bold;font-size:12pt;color:black;">#TOC_DESCRIPTION#</span></td><td width="25mm"><span style="font-family:courier;font-weight:bold;font-size:12pt;color:black;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';
    $bookmark_templates[1] = '<table border="0" cellpadding="0" cellspacing="0"><tr><td width="5mm">&nbsp;</td><td width="150mm"><span style="font-family:times;font-size:11pt;color:black;">#TOC_DESCRIPTION#</span></td><td width="25mm"><span style="font-family:courier;font-weight:bold;font-size:11pt;color:black;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';
    $bookmark_templates[2] = '<table border="0" cellpadding="0" cellspacing="0"><tr><td width="10mm">&nbsp;</td><td width="145mm"><span style="font-family:times;font-size:10pt;color:#666666;"><i>#TOC_DESCRIPTION#</i></span></td><td width="25mm"><span style="font-family:courier;font-weight:bold;font-size:10pt;color:#666666;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';
// add other bookmark level templates here ...
// add table of content at page 1
// (check the example n. 45 for a text-only TOC
    $pdf->addHTMLTOC(2, 'Indice', $bookmark_templates, true, 'B', array(128, 0, 0));

// end of TOC page
    $pdf->endTOCPage();
}

function capitulos($pdf, $capitulos, $resPlan, $resTipoPoblacion, $formularios) {
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
        subCapitulos($pdf, $cap['id'], $cap['orden'], $resPlan, $resTipoPoblacion, $formularios);
    }
}

function subCapitulos($pdf, $id, $ordenCapitulo, $resPlan, $resTipoPoblacion, $formularios) {
    $sql = "(SELECT  id, descripcion, orden,titulo,isActivo FROM SubCapitulo where FKidCapitulo = $id ORDER BY orden)";
    $subcapitulos = seleccion($sql);
    foreach ($subcapitulos as $sub) {
        $pdf->Bookmark($ordenCapitulo . "." . $sub['orden'] . " " . $sub['titulo'], 1, 0, '', '', array(128, 0, 0));

//        $pdf->Cell(0, 10, $ordenCapitulo . "." . $sub['orden'] . " " . $sub['titulo'], 0, 1, 'L');
        $html = '<h3><b>' . $ordenCapitulo . "." . $sub['orden'] . " " . $sub['titulo'] . '</b></h3>';
        $html .= $sub['descripcion'];
        $pdf->writeHTML($html, true, false, true, false, '');
        $html = listarFormularios($sub['id'], $formularios, $resPlan, $resTipoPoblacion);
        // $html .= '<div></div>';
        $pdf->writeHTML($html, true, false, true, false, '');
    }
}

function portada($pdf) {
    $pdf->setPrintHeader(false);
    global $datosCabecera;
    cargarNuevaPagina($pdf);
    $logo = '<img src= "' . $datosCabecera['logoUNA'] . '"  width="100" height="100" >';
    $logo2 = '<img src= "' . $datosCabecera['logoCIEUNA'] . '"  width="100" height="100" >';
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

function formularioDatosGenerales($resPlan) {
    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<tr style = "text-align:center;">'
            . '<td>Nombre del centro de trabajo</td>'
            . '<td>' . $resPlan[0]['actividad'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Actividad</td>'
            . '<td>' . $resPlan[0]['actividad'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Direccion</td>'
            . '<td>' . $resPlan[0]['direccion'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Persona de contacto general</td>'
            . '<td>' . $resPlan[0]['personaContactoGeneral'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Números de teléfono:</td>'
            . '<td>' . $resPlan[0]['numeroTelefono'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Números de fax:</td>'
            . '<td>' . $resPlan[0]['numeroFax'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Correo electrónico para notificaciones:</td>'
            . '<td>' . $resPlan[0]['correo'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Categoría NFPA :</td>'
            . '<td>' . $resPlan[0]['categoriaNFPA'] . '</td>'
            . '</tr>'
            . '<tr >'
            . '<td>Uso principal de las instalaciones::</td>'
            . '<td>' . $resPlan[0]['usoInstalaciones'] . '</td>'
            . '</tr>'
            . '<tr >'
            . '<td>Horarios o Jornadas:</td>'
            . '<td>' . $resPlan[0]['horarioJornada'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Seguridad Institucional:</td>'
            . '<td>' . $resPlan[0]['seguridadInstitucional'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Servicio de Conserjería:</td>'
            . '<td>' . $resPlan[0]['servicioConsegeria'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Personal Administrativo:</td>'
            . '<td>' . $resPlan[0]['personalAdministrativo'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Personal Académico:</td>'
            . '<td>' . $resPlan[0]['personalAcademico'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Presencia Estudiantil:</td>'
            . '<td>' . $resPlan[0]['presenciaEstudiantil'] . '</td>'
            . '</tr>'
            . '</table>';
    return $html;
}

function formularioActividades($resTipoPoblacion) {
    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<thead><tr style = "text-align:center;">'
            . '<th>Tipo de población</th>'
            . '<th>Descripción</th>'
            . '<th>Total aproximado</th>'
            . '<th>Representación de persona con discapacidad identificadas (detalle tipo de discapacidad)</th>'
            . '</tr></thead>';
    foreach ($resTipoPoblacion as $res) {
        $html .= '<tbody>'
                . '<tr>'
                . '<td>' . $res['tipoPoblacion'] . '</td>'
                . '<td>' . $res['descripcion'] . '</td>'
                . '<td>' . $res['total'] . '</td>'
                . '<td>' . $res['representacionDe'] . '</td>'
                . '</tr>'
                . '</tbody>';
    }
    $html .= '</table>';
    return $html;
}

function formularioInstalaciones($resPlan) {
    $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
            . '<tr style = "text-align:center;">'
            . '<td>Densidad de ocupación:</td>'
            . '<td>' . $resPlan[0]['instalacionesDensidadOcupacion'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Área de construcción</td>'
            . '<td>' . $resPlan[0]['instalacionesAreaConstruccion'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Instalaciones:</td>'
            . '<td>' . $resPlan[0]['instalacionesInstalaciones'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Características de la zona</td>'
            . '<td>' . $resPlan[0]['instalacionesCaracteristicasZona'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Topografía</td>'
            . '<td>' . $resPlan[0]['instalacionesTopografia'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Nivel del terreno:</td>'
            . '<td>' . $resPlan[0]['instalacionesNivelTerreno'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Colindantes:</td>'
            . '<td>' . $resPlan[0]['instalacionesColindates'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td colspan = "2"><b>Elementos constructivos</b></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Tipo de construcción:</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosTipoConstruccion'] . '</td>'
            . '</tr>'
            . '<tr >'
            . '<td>Antigüedad:</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosAntiguedad'] . '</td>'
            . '</tr>'
            . '<tr >'
            . '<td>Cimientos:</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosCimientos'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Estructura:</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosEstructura'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Paredes:</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosParedes'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Entrepiso:</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosEntrepiso'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Techo:</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosTecho'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Cielos:</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosCielos'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Pisos:</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosPisos'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Área de parqueo:</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosSistemaAguaPotable'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Sistema de agua potable:</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosSistemaAguaPotable'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Sistema de alcantarillado sanitario:</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosAlcantarilladoSanitario'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Sistema de alcantarillado pluvial:</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosAlcantarilladoPluvial'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Sistema eléctrico:</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosSistemaElectrico'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Sistema telefónico:</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosSistemaTelefonico'] . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Otros:</td>'
            . '<td>' . $resPlan[0]['elementosConstructivosOtros'] . '</td>'
            . '</tr>'
            . '</table>';
    return $html;
}

function listarFormularios($id, $formularios, $resPlan, $resTipoPoblacion) {
    $html = "";
    foreach ($formularios as $form) {
        $html .= formularioSeleccionada($id, $form, $resPlan, $resTipoPoblacion);
    }
    return $html;
}

function formularioSeleccionada($id, $form, $resPlan, $resTipoPoblacion) {
     $html = "";
    if ($form['FKidSubcapitulos'] == $id) {
        $idForm = $form['id'];       
        if ($idForm == 1) {
            $html = formularioDatosGenerales($resPlan);
            $html .= '<div></div>';
        } else if ($idForm == 2) {
            $html = formularioActividades($resTipoPoblacion);
            $html .= '<div></div>';
        } else if ($idForm == 3) {
            $html = formularioInstalaciones($resPlan);
            //  $html .= '<div></div>';
        }
    }
    return $html;
}

function cargarNuevaPagina($pdf) {
    $pdf->SetFont('times', '', 12);
    $pdf->AddPage();
}

// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('planEmergencias.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
