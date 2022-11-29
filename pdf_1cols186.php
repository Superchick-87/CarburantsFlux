<?php
$ville = $_GET['ville'];
echo $ville;
include (dirname(__FILE__).'/includes/ddc.php');
function read($csv){
		    $file = fopen($csv, 'r');
		    while (!feof($file) ) {
		        $line[] = fgetcsv($file, 1024);
		    }
		    fclose($file);
		    return $line;
		}
		$csv = dirname(__FILE__).'/datas/prix_'.$ville.'.csv';
		$csv = read($csv);

//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
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
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('TCPDF-master/tcpdf.php');

// create new PDF document
$pageLayout = array(46.5,186); //  or array($height, $width) 
$pdf = new TCPDF('F', 'mm', $pageLayout, true, 'UTF-8', false);
// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicolas Peyrebrune');
$pdf->SetTitle('Infographie Résultats');
$pdf->SetSubject('Infographie');
$pdf->SetKeywords('Infographie, SUDOUEST, sport, classements, match');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(0,0,0,0);
// $pdf->SetPaddings(0,0,0,0);

// set auto page breaks
// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(FALSE,0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/fra.php')) {
    require_once(dirname(__FILE__).'/lang/fra.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// add a page
$pdf->AddPage();
// get esternal file content
// $utf8text = file_get_contents('TCPDF-master/examples/data/utf8test.txt', false);

$border=0;
// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// $fontname = TCPDF_FONTS::addTTFfont('/TCPDF-master/fonts/ArialNarrowItalic.ttf', 'TrueTypeUnicode', '', 96);
// $pdf->SetFont($fontname, '', 14, '', false);
	/*----------  Font  ----------*/
	$pdf->ImageSVG('images/Fond_186.svg',0,0,46.5,186,'','','', $border,false);


$echelle=0.5;
function saut($n){
	$y = '';
	if ($n == 0 || $n == 1){
		$y = 40.7;
		return $y;
	}
	if ($n == 2 || $n == 3){
		$y = 45.5;
		return $y;
	}
	if ($n == 4 || $n == 5){
		$y = 49.8;
		return $y;
	}
	if ($n == 6 || $n == 7){
		$y = 53.9;
		return $y;
	}
	if ($n == 8){
		$y = 58.2;
		return $y;
	}
	if ($n == 9){
		$y = 62.8;
		return $y;
	}
};


$fitbox='R';	

for ($n=0; $n<count($csv); $n++) {
	$pdf->SetTextColor(0,0,0,100);
	$pdf->setCellPaddings(0,0,0,0);
	$pdf->SetFont('arial','', 9);
	$pdf->SetXY(6.9,(saut($n)+(10*$n)));
	$pdf->Cell(39.6,'', $csv[$n][1],  $border, 0, 'L', 0, '', 1, false, '', 'M');
	
	$pdf->SetTextColor(0,0,0,0);
	if ($n == 0 || $n == 1){
		$pdf->SetTextColor(0,0,0,100);
	}else {};
	
	$pdf->SetFont('arialb','', 9);
	$pdf->SetXY(7.5,((saut($n)+(10*$n))+3.8));
	$pdf->Cell(28.5,'', $csv[$n][2],  $border, 0, 'L', 0, '', 1, false, '', 'M');

	$pdf->SetXY(36,((saut($n)+(10*$n))+3.8));
	$pdf->Cell(10,'', $csv[$n][3],  $border, 0, 'R', 0, '', 1, false, '', 'M');

// Image method signature:
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
$pdf->Image('images/logos/'.ddc($csv[$n][2]).'.png', 0, ((saut($n)+(10*$n))+1.4), 6.5, 10, 'PNG', '', '', false, 300, 'M', false, false, 0,'B', false, false);
};
// close and output PDF document
// $pdf->Output('example_011.pdf', 'I');
// $pdf->Output('ProductionPdf/EuroClassement_'.$datePdf.'.pdf','F');
$pdf->Output('ProductionPdf/Infog_Carburants_'.$ville.'.pdf','F');

//============================================================+
// END OF FILE
//============================================================+