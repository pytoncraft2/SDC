<?php

/*
 * Squelette : ../plugins/auto/saisies/v3.43.0/prive/style_prive_plugin_saisies.html
 * Date :      Sun, 07 Feb 2021 04:24:21 GMT
 * Compile :   Sun, 07 Feb 2021 04:37:31 GMT
 * Boucles :   _saisies
 */ 

function BOUCLE_saisieshtml_f6f01a41314a7f6c86bc39bf64cb16f8(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['sourcemode'] = 'table';

	$command['source'] = array(saisies_lister_disponibles('saisies',''));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_saisies';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur",
		".cle",
		"icone");
		$command['orderby'] = array();
		$command['where'] = 
			array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('../plugins/auto/saisies/v3.43.0/prive/style_prive_plugin_saisies.html','html_f6f01a41314a7f6c86bc39bf64cb16f8','_saisies',19,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
.navigation_avec_icones .bando2_saisie_' .
interdire_scripts(safehtml($Pile[$SP]['cle'])) .
' { ' .
(($t1 = strval(interdire_scripts(extraire_attribut(filtrer('image_graver', filtrer('image_reduire',safehtml((isset($Pile[$SP]['icone'])?$Pile[$SP]['icone']:(@$Pile[0]['icone']))),'16')),'src'))))!=='' ?
		('background-image: url(' . $t1 . ');') :
		'') .
' }
');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_saisies @ ../plugins/auto/saisies/v3.43.0/prive/style_prive_plugin_saisies.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette ../plugins/auto/saisies/v3.43.0/prive/style_prive_plugin_saisies.html
// Temps de compilation total: 3.415 ms
//

function html_f6f01a41314a7f6c86bc39bf64cb16f8($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<'.'?php header("X-Spip-Cache: 360000"); ?'.'>'.'<'.'?php header("Cache-Control: max-age=360000"); ?'.'>'.'<'.'?php header("X-Spip-Statique: oui"); ?'.'>' .
'<'.'?php header(' . _q('Content-Type: text/css; charset=iso-8859-15') . '); ?'.'>' .
'<'.'?php header(' . _q('Vary: Accept-Encoding') . '); ?'.'>#wysiwyg .saisie_fieldset .champ {font-size: 1em;}

body.saisies_doc {
	background-color: #efefef;
}
' .
(($t1 = BOUCLE_saisieshtml_f6f01a41314a7f6c86bc39bf64cb16f8($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		('
' . $t1 . '
') :
		'') .
'
');

	return analyse_resultat_skel('html_f6f01a41314a7f6c86bc39bf64cb16f8', $Cache, $page, '../plugins/auto/saisies/v3.43.0/prive/style_prive_plugin_saisies.html');
}
?>