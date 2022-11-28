<?php
function read($csv){
		    $file = fopen($csv, 'r');
		    while (!feof($file) ) {
		        $line[] = fgetcsv($file, 1024);
		    }
		    fclose($file);
		    return $line;
		}
		$csv = dirname(__FILE__).'/datas/prix_Bordeaux.csv';
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

// set font
// $pdf->SetFont('dejavusans', '', 10);


// add a page
$pdf->AddPage();
// get esternal file content
// $utf8text = file_get_contents('TCPDF-master/examples/data/utf8test.txt', false);

$border=0;
// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

/*========================================================
=      Paramètres - Positions des blocs + Styles         =
========================================================*/
// $fontname = TCPDF_FONTS::addTTFfont('/TCPDF-master/fonts/ArialNarrowItalic.ttf', 'TrueTypeUnicode', '', 96);
// $pdf->SetFont($fontname, '', 14, '', false);
	/*----------  Font  ----------*/
	
	$font_C = 'arialb';
	$fontSize_C = 12;

	$font_RDate = 'ariali';
	$fontSize_C = 7;

	$font_R = 'arial';
	$fontSize_R = 9.5;

	$fontSize_titre = 18.7;

	/*----------  Fin Font  ----------*/
	

	/*----------  Style partie résultat  ----------*/
	/**
	 * " D " -> utilisé pour "Domicile"
	 * " E " -> utilisé pour "Extérieur"
	 * " R " -> utilisé pour "Résultats"
	 */
	$equipeD_ListeR= 'style="font-stretch: condensed; letter-spacing: 0px; line-height:10px; width:55px; height:10px; text-align:right;"';
	$equipeE_ListeR= 'style="font-stretch: condensed; letter-spacing: 0px; line-height:10px; width:55px; height:10px; text-align:left;"';
	$espaceurblanc = 'style=" width:1px; height:10px; text-align:center;background-color: white;"';
	$espaceur = 'style=" width:2px; height:10px; text-align:center;"';
	/*----------  Fin Style partie résultat  ----------*/
	$stylerang = 'style="width:22px; text-align:center;"';
	$stylepays = 'style="width:90px; text-align:left;"';
	$stylemedailles = 'style="width:30px; text-align:center;"';
	$styletotal = 'style="width:30px; text-align:center;"';

/*=====  End of Paramètres - Positions des blocs + Styles ======*/


$pdf->ImageSVG('images/Fond.svg',0,0,46.5,186,'','','', $border,false);

/*================================
=            Groupe C            =
================================*/
$logo = 'style=background-color:red;';

	// /*----------  Classements  ----------*/
	
	// create some HTML content
	$pdf->SetFont('arial','', 9);

	// for ($n=0; $n<count($csv); $n++) {
		// $html = 
		// 	'<table style="height:100px;">
		// 		<tr style="padding:0px 0px 0px 0px;">
		// 			<td style="text-align:left; padding:0px 0px 0px 0px; width:25px; height:35px;" rowspan="2"><img style="padding:0px 0px 0px 0px;" src="images/logos/Aldi.png" alt=""></td>
		// 			<td colspan="2">'.$csv[0][1].'</td>
		// 		</tr>
		// 		<tr style="padding:0px 0px 0px 0px;">
		// 			<td>'.$csv[0][2].'</td>
		// 			<td>'.$csv[0][3].'</td>
		// 		</tr>
		// 	</table>';
			$html = $csv[0][1];
		
		// };
		// // TCPDF::writeHTMLCell( $w,  $h,  $x,  $y,  $html = '',  $border,  $ln,  $fill = false,  $reseth = true,  $align = '',  $autopadding = true )
		// $pdf->writeHTMLCell(35,100,2,40, $html, 1, 0, false,true, 'L',true);
		// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
		// $pdf->writeHTML($html, true, 0, false,true, 'L');
// ---------------------------------------------------------
$pdf->setXY(6.5,40);
$pdf->Cell(40,'', 'xxxxxml$html$html$hxxxxmqmmq', 1, 1, 'L', 0, '', 0);

// close and output PDF document
// $pdf->Output('example_011.pdf', 'I');
// $pdf->Output('ProductionPdf/EuroClassement_'.$datePdf.'.pdf','F');
$pdf->Output('ProductionPdf/Infog_Carburants_.pdf','F');

//============================================================+
// END OF FILE
//============================================================+