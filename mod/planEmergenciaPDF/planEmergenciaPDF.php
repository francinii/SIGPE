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
$sql = "(SELECT  id, nombreZonaTrabajo FROM ZonaTrabajo where id =" . $id . ")";
$sqlPlan = "(SELECT `id`, `FKidZonaTrabajo`, `revisadoPor`, `codigoZonaTrabajo`, `actividad`, `direccion`, `personaContactoGeneral`, `numeroTelefono`, `numeroFax`, `notificaciones`, `categoriaNFPA`, `usoInstalaciones`, `horarioJornada`, `seguridadInstitucional`, `servicioConsegeria`, `personalAdministrativo`, `personalAcademico`, `presenciaEstudiantil`, `instalacionesDensidadOcupacion`, `instalacionesAreaConstruccion`, `instalacionesInstalaciones`, `instalacionesCaracteristicasZona`, `instalacionesTopografia`, `instalacionesNivelTerreno`, `instalacionesColindates`, `elementosConstructivosTipoConstruccion`, `elementosConstructivosAntiguedad`, `elementosConstructivosCimientos`, `elementosConstructivosEstructura`, `elementosConstructivosParedes`, `elementosConstructivosEntrepiso`, `elementosConstructivosTecho`, `elementosConstructivosCielos`, `elementosConstructivosPisos`, `elementosConstructivosAreaParqueo`, `elementosConstructivosSistemaAguaPotable`, `elementosConstructivosAlcantarilladoSanitario`, `elementosConstructivosAlcantarilladoPluvial`, `elementosConstructivosSistemaElectrico`, `elementosConstructivosSistemaTelefonico`, `elementosConstructivosOtros` FROM `PlanEmergencia` where FKidZonaTrabajo =" . $id . ")";
$sqlCapitulos = "(SELECT  id, descripcion, orden,titulo,isActivo FROM Capitulo ORDER BY orden)";


$res = seleccion($sql);
$resPlan = seleccion($sqlPlan);
$rescapitulos = seleccion($sqlCapitulos);
global $datosCabecera;
$dirImages = "images/";
$centroTrabajo = $res[0]["nombreZonaTrabajo"];
$logoUNA = $dirImages . "logo_una.jpg";
$logoCentro = "logoCentro";
$codigo = $resPlan[0]['codigoZonaTrabajo'];
$revisadoPor = $resPlan[0]['revisadoPor'];

$datosCabecera = array(
    "centroTrabajo" => $centroTrabajo,
    "logoUNA" => $logoUNA,
    "logoCentro" => $logoCentro,
    "codigo" => $codigo,
    "revisado" => $revisadoPor);

class MYPDF extends TCPDF {

    public function Header() {
        global $datosCabecera;
        $html = '<table id ="table_header" cellspacing="0" cellpadding="1" border="1" >'
                . '<tr style = "text-align:center;">'
                . '<td rowspan="2"><img src= "' . $datosCabecera['logoUNA'] . '" width="60" height="60" ></td>'
                . '<td >' . $datosCabecera['centroTrabajo'] . '</td>'
                . '<td rowspan="2"><img src= "' . $datosCabecera['logoUNA'] . '" width="60" height="60" ></td>'
                . '<td><b>Código</b> ' . $datosCabecera['codigo'] . '</td>'
                . '</tr>'
                . '<tr style = "text-align:center;">'
                . '<td >Plan de preparativos de respuesta ante emergencias</td>'
                . '<td><b>Revisado por:</b><br>' . $datosCabecera['revisado'] . '</td>'
                . '</tr>'
                . '<tr style = "text-align:center;">'
              
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
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
portada($pdf);
capitulos($pdf, $rescapitulos);

function capitulos($pdf, $capitulos) {
    cargarNuevaPagina($pdf);
   // $html = '<div style = "height: 250px;"><div>';
    foreach ($capitulos as $cap) {
        $html .= '<div><h1><b>' . $cap['titulo']  .'</b></h1>';
        $html .= $cap['descripcion'] . '</div>';
        $html .=  subCapitulos($pdf, $cap['id']);
    }

    $pdf->writeHTML($html, true, false, true, false, '');
}

function subCapitulos($pdf, $id) {
    $sql = "(SELECT  id, descripcion, orden,titulo,isActivo FROM SubCapitulo where FKidCapitulo = $id ORDER BY orden)";
    $subcapitulos = seleccion($sql);
    foreach ($subcapitulos as $sub) {        
        $html .= '<div><h2><b>' . $sub['titulo'] .'</b></h2>' ;
        $html .= $sub['descripcion'] . '</div>';
    }

   return $html;
}

function portada($pdf) {
    global $datosCabecera;
    cargarNuevaPagina($pdf);
    $html = '<div style = "height: 100px;"><div>
        <div>
        <span align="left">
            <img src= "' . $datosCabecera['logoUNA'] . '"  width="100" height="100" >
        </span> 
        <span align="right">
            <img src= "' . $datosCabecera['logoUNA'] . '"  width="100" height="100" >
        </span>
        </div>
        <div style = "text-align:center;">
            <h1>PLAN DE PREPARATIVOS DE RESPUESTA ANTE EMERGENCIAS</h1>
            <h1>' . $datosCabecera["centroTrabajo"] . ' <h1>
            <h1>   UNIVERSIDAD NACIONAL DE COSTA RICA <h1>
             <img src= "' . $datosCabecera['logoUNA'] . '" width="100" height="100" >
            <h1>' . $datosCabecera["centroTrabajo"] . ' <h1>
            <h1>   Fecha <h1>
        </div>';

    $pdf->writeHTML($html, true, false, true, false, '');
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