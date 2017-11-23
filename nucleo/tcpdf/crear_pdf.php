<?php
#include("../sesion.php");
	$usuarios_sesion						="PHPSESSID";
	session_name($usuarios_sesion);
	session_start();
	session_cache_limiter('nocache,private');	


//============================================================+
// File name   : example_021.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 021 for TCPDF class
//               WriteHTML text flow
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
 * @abstract TCPDF - Example: WriteHTML text flow.
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
#$html=$_RECUEST[""];
	require_once('tcpdf_include.php');
#include('nucleo/tcpdf/tcpdf_include.php');

// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
/*
echo "<pre>";
print_r($_SESSION);
echo "/<pre>";
*/
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('SolesGPS :: EVIGRA');
	#$pdf->SetTitle($_SESSION["pdf"]["title"]);
	#$pdf->SetTitle('algo');
	#$pdf->SetSubject($_SESSION["pdf"]["subject"]);
	#$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
	
// set default header data
	#$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 021', PDF_HEADER_STRING);
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $_SESSION["pdf"]["title"], $_SESSION["pdf"]["subject"]);

// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
#	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
#	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
	$pdf->SetHeaderMargin(15);   #MARGEN SUPERIOR
	
	$PDF_MARGIN_TOP=28;		# MARGEN SUPERIOR DE CONTENIDO	
	$pdf->SetMargins(PDF_MARGIN_LEFT, $PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	
	$pdf->SetFooterMargin(15);

// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
/*
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
*/
// ---------------------------------------------------------

// set font
	$pdf->SetFont('helvetica', '', 9);
#$nueva="ALGO";
// add a page
	$pdf->AddPage();

// create some HTML content
#echo $_SESSION["html"];
	$html = $_SESSION["pdf"]["template"];
#echo $html;
// output the HTML content
	$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
	$pdf->lastPage();

//Close and output PDF document
	$pdf->Output('example_021.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
