<?php
//============================================================+
// File name   : example_002.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 002 for TCPDF class
//               Removing Header and Footer
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
 * @abstract TCPDF - Example: Removing Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');

// create new PDF document
// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pageLayout = array(147.5, 120); //  or array($height, $width) 
$pdf = new TCPDF('p', 'mm', $pageLayout, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 002');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(0,0,0);
// set auto page breaks
// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE,0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
 $border=1;

// $style6 = 'color' => array(0, 128, 0);
// set font
$pdf->SetFont('times', 'BI', 20);

// add a page
$pdf->AddPage();

// $pdf->ImageSVG('examples/images/Rugby.svg',0,30,147,80,'','','', $border,true);

// $pdf->SetTextColor(0, 100, 0, 0);



// set some text to print
$txt = <<<EOD
TCPDF Example 002
Default page header and footer are disabled using setPrintHeader() and setPrintFooter() methods.
EOD;

// print a block of text using Write()
$pdf->SetTextColor(0, 100, 0, 0);
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);


// Circle and ellipse
// $style6 = array('color' => array(0,100, 0,0));
// // $pdf->RoundedRect(40, 55, 40, 30, 8.0, '0101', 'F', $style6, array(0, 200, 200));
// $pdf->Circle(10,60,3,0,360, 'F', $style6,array(0,100, 0,0));
// $pdf->Text(5, 63, 'Curve examples');

$html = <<<EOF
<div style="width:566px;height:100px; display:flex; justify-content: space-between;">
	<span style="justify-content: flex-start;">
		
			<img id="logoGauche" style="height:50px;" class="logoGauche" src="images/Agen.svg">
			<span id="EquipeGauche" class="equipeA">Agen</span>
		
	</span>
	<span style="justify-content: flex-end;">
		
			<span class="equipeB">Bordeaux</span>
			<img style="height:50px;" src="images/Agen.svg">
		
	</span>
</div>
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output();

//============================================================+
// END OF FILE
//============================================================+
