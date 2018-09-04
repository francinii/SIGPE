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
$sql = "(SELECT  id, nombreZonaTrabajo FROM ZonaTrabajo where id =".$id .")";
// Extend the TCPDF class to create custom Header and Footer
$res = seleccion($sql); 
global $datosCabecera;
$dirImages= "images/";
$centroTrabajo = $res[0]["nombreZonaTrabajo"];
$logoUNA = $dirImages."logo_una.jpg";
$logoCentro = "logoCentro";
$codigo = "";
$revisadoPor = "";
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
                . '<td rowspan="3"><img src= "' . $datosCabecera['logoUNA'] . '" width="100" height="100" ></td>'
                . '<td >' . $datosCabecera['centroTrabajo'] . '</td>'
                . '<td rowspan="3"><img src= "' . $datosCabecera['logoUNA'] . '" width="100" height="100" ></td>'
                . '<td>Codigo ' . $datosCabecera['codigo'] . '</td>'
                . '</tr>'
                . '<tr style = "text-align:center;">'
                . '<td rowspan="2">Plan de preparativos de respuesta ante emergencias</td>'
                . '<td>Revisado por: ' . $datosCabecera['revisado'] . '</td>'
                . '</tr>'
                . '<tr style = "text-align:center;">'
                . '<td>Pagina</td>'
                . '</tr>'
                . '</table>';
      
        $this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
    }


    // Page footer
    public function Footer() {
//        // Position at 15 mm from bottom
//        $this->SetY(-15);
//        // Set font
//        $this->SetFont('helvetica', 'I', 8);
//        // Page number
//        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
//    
    }

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Francini Corrales Garro & Danny Valerio Ramírez');
$pdf->SetTitle('TCPDF Example 003');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

//$pdf->SetHeaderData();
// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// set font
$pdf->SetFont('times', 'BI', 12);

// add a page
$pdf->AddPage();



// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+