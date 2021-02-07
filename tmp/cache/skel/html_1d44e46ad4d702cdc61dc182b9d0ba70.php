<?php

/*
 * Squelette : squelettes/inclure/head.html
 * Date :      Sun, 07 Feb 2021 04:21:02 GMT
 * Compile :   Sun, 07 Feb 2021 04:22:28 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette squelettes/inclure/head.html
// Temps de compilation total: 1.870 ms
//

function html_1d44e46ad4d702cdc61dc182b9d0ba70($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
        <title>' .
interdire_scripts(textebrut(typo($GLOBALS['meta']['nom_site'], "TYPO", $connect, $Pile[0]))) .
(($t1 = strval(interdire_scripts(textebrut(typo($GLOBALS['meta']['slogan_site'], "TYPO", $connect, $Pile[0])))))!=='' ?
		(' - ' . $t1) :
		'') .
'</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta name="msapplication-TileColor" content="#2b722b">

' .
(($t1 = strval(find_in_path('TeamBalance.png')))!=='' ?
		('<link rel="icon" type="image/png" href="' . $t1 . (	'" />
' .
	(($t2 = strval(find_in_path('favicon.ico')))!=='' ?
			('<link rel="shortcut icon" type="image/x-icon" href="' . $t2 . '" />') :
			''))) :
		'') .
'
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />


<meta name="description" content="La Team-Balance vous fait découvir le scoutisme à travers leurs nombreux projets réalisé dans l\'association des scouts du Cameroun ! Jeux" />
<meta name="Robots" content="all"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#085004">

' .
(($t1 = strval(direction_css(find_in_path('css/nouveau.css'))))!=='' ?
		('<link rel="stylesheet" href="' . $t1 . '" type="text/css" />') :
		'') .
'

<script src="https://kit.fontawesome.com/924df22c95.js" crossorigin="anonymous"></script>

' .
(($t1 = strval(find_in_path('js/script.js')))!=='' ?
		('<script src="' . $t1 . '" type="text/javascript"></script>') :
		'') .
'
');

	return analyse_resultat_skel('html_1d44e46ad4d702cdc61dc182b9d0ba70', $Cache, $page, 'squelettes/inclure/head.html');
}
?>