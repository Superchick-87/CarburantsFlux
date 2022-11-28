<?php
/*Script pour renommer les nom de fichier en Dos De Chameau */

	function ddc($tring){
		//$tring =" afrique-du-sud c'est àô&éè§çïÏîÎ pas écoute AFRIQUE DU SUD";
		$tring = str_replace("("," ",$tring );
		$tring = str_replace(")"," ",$tring );
		$tring = str_replace("!","",$tring );
		$tring = htmlentities($tring, ENT_NOQUOTES, $encoding='utf-8');
		$tring = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $tring);
		$tring = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $tring);
		$tring = preg_replace('#&[^;]+;#', '', $tring);
		$tring = str_replace("-"," ",$tring );
		$tring = mb_strtolower($tring); //oblige la chaine de caractère d'être en bas de casse
		$tring = ucwords($tring);//oglige à mettre une capitale à chaque mot
		$tring = str_replace("'","",$tring );
		$tring = str_replace(" ","",$tring );
		$tring = str_replace("/","",$tring );
		return $tring;
	}
	function makehtml($tring){
		$tring = str_replace("-","</br>&#x2731;",$tring );
		return $tring;
	}
?>