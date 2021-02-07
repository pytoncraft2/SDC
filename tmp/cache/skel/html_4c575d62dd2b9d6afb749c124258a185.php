<?php

/*
 * Squelette : ../prive/style_prive.css.html
 * Date :      Thu, 05 Nov 2020 10:50:03 GMT
 * Compile :   Sun, 07 Feb 2021 04:37:30 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../prive/style_prive.css.html
// Temps de compilation total: 2.028 ms
//

function html_4c575d62dd2b9d6afb749c124258a185($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'
' .
'<'.'?php header("X-Spip-Cache: 360000"); ?'.'>'.'<'.'?php header("Cache-Control: max-age=360000"); ?'.'>'.'<'.'?php header("X-Spip-Statique: oui"); ?'.'>' .
'<'.'?php header(' . _q('Content-Type: text/css; charset=iso-8859-15') . '); ?'.'>' .
'<'.'?php header(' . _q('Vary: Accept-Encoding') . '); ?'.'>' .
vide($Pile['vars'][$_zzz=(string)'fond'] = substr(find_in_theme('style_prive.css.html'),strlen((defined('_DIR_RACINE')?constant('_DIR_RACINE'):'')),intval('-5'))) .
'
' .
recuperer_fond( table_valeur($Pile["vars"], (string)'fond', null) , array_merge($Pile[0],array()), array('compil'=>array('../prive/style_prive.css.html','html_4c575d62dd2b9d6afb749c124258a185','',2,$GLOBALS['spip_lang'])), _request('connect')));

	return analyse_resultat_skel('html_4c575d62dd2b9d6afb749c124258a185', $Cache, $page, '../prive/style_prive.css.html');
}
?>