<?php

/*
 * Squelette : squelettes/article.html
 * Date :      Wed, 06 Jan 2021 03:14:35 GMT
 * Compile :   Sun, 07 Feb 2021 04:14:58 GMT
 * Boucles :   _ariane, _article, _principale
 */ 

function BOUCLE_arianehtml_acfb689da8b7f0df9e71fabce85f186f(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!($id_rubrique = intval($Pile[$SP]['id_rubrique'])))
		return '';
	include_spip('inc/rubriques');
	$hierarchie = calcul_hierarchie_in($id_rubrique,true);
	if (!$hierarchie) return "";
	
	if (!isset($command['table'])) {
		$command['table'] = 'rubriques';
		$command['id'] = '_ariane';
		$command['from'] = array('rubriques' => 'spip_rubriques');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("rubriques.id_rubrique",
		"rubriques.titre",
		"rubriques.lang");
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['orderby'] = array("FIELD(rubriques.id_rubrique, $hierarchie)");
	$command['where'] = 
			array(
			array('IN', 'rubriques.id_rubrique', "($hierarchie)"));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/article.html','html_acfb689da8b7f0df9e71fabce85f186f','_ariane',27,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
' <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAANCAYAAABy6+R8AAAABmJLR0QA/wD/AP+gvaeTAAAAxUlEQVQokWNgQAL/9zOwfDzG585AADAhcz4y8+sx/GPc8emwQDHRmhiZ/zMzMDAw/Gf83/PhCH8lUZpQDGBgaMOlEacmJI0VJGmCamxH18iCzHn1lV+Q5f//ezA+P+dXBmbGfwyMjAyp/88wzGE0YXiDoennLzZJMYE3Sui2/f/PsBOmgSjn/f/PsFPA9qMH0X76/ZcZQwNeTc8/8+8UsX+HoQFD07//TL8ZGBgYXn4W3Kzh+QirBgxwf74Cx9VtilWE1AEA+vFAvFE5IesAAAAASUVORK5CYII="><a href="' .
vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_rubrique'], 'rubrique', '', '', true))) .
'">' .
interdire_scripts(couper(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0]),'80')) .
'</a>');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_ariane @ squelettes/article.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_articlehtml_acfb689da8b7f0df9e71fabce85f186f(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = '_article';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.titre",
		"articles.id_article",
		"articles.texte",
		"articles.id_rubrique",
		"articles.lang");
		$command['orderby'] = array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('=', 'articles.id_article', sql_quote($Pile[$SP]['id_article'], '','bigint(21) NOT NULL AUTO_INCREMENT')));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/article.html','html_acfb689da8b7f0df9e71fabce85f186f','_article',11,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
        <header>

                <div class="headE">SCOUTS DU CAMEROUN</div>
                <div class="triH"></div>
                <div class="triH2"></div>
        </header>
<h2 class="Bienvenue">' .
interdire_scripts(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])) .
' </h2>
	<div class="center-imagev2">
	<div class="logoAcc">' .
filtrer('image_graver',filtrer('image_reduire',
((!is_array($l = quete_logo('id_article', 'ON', $Pile[$SP]['id_article'],'', 0))) ? '':
 ("<img class=\"spip_logo spip_logos\" alt=\"\" src=\"$l[0]\"" . $l[2] .  ($l[1] ? " onmouseover=\"this.src='$l[1]'\" onmouseout=\"this.src='$l[0]'\"" : "") . ' />')),'200','200')) .
'</div>
	</div>

' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/navigation') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'squelettes/article.html\',\'html_acfb689da8b7f0df9e71fabce85f186f\',\'\',23,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>

<div class="zoneArticle">
	<div  class="section">
                        <div class="arbo"><a href="' .
spip_htmlspecialchars(sinon($GLOBALS['meta']['adresse_site'],'.')) .
'/">' .
_T('public|spip|ecrire:accueil_site') .
'</a>' .
BOUCLE_arianehtml_acfb689da8b7f0df9e71fabce85f186f($Cache, $Pile, $doublons, $Numrows, $SP) .
(($t1 = strval(interdire_scripts(couper(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0]),'80'))))!=='' ?
		(' <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAANCAYAAABy6+R8AAAABmJLR0QA/wD/AP+gvaeTAAAAxUlEQVQokWNgQAL/9zOwfDzG585AADAhcz4y8+sx/GPc8emwQDHRmhiZ/zMzMDAw/Gf83/PhCH8lUZpQDGBgaMOlEacmJI0VJGmCamxH18iCzHn1lV+Q5f//ezA+P+dXBmbGfwyMjAyp/88wzGE0YXiDoennLzZJMYE3Sui2/f/PsBOmgSjn/f/PsFPA9qMH0X76/ZcZQwNeTc8/8+8UsX+HoQFD07//TL8ZGBgYXn4W3Kzh+QirBgxwf74Cx9VtilWE1AEA+vFAvFE5IesAAAAASUVORK5CYII="> <strong class="on">' . $t1 . '</strong>') :
		'') .
'</div>






		<article>
<p>' .
interdire_scripts(propre($Pile[$SP]['texte'], $connect, $Pile[0])) .
'</p>
		</article>
	</div>
</div>
' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/scroll') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'squelettes/article.html\',\'html_acfb689da8b7f0df9e71fabce85f186f\',\'\',39,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_article @ squelettes/article.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_principalehtml_acfb689da8b7f0df9e71fabce85f186f(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = '_principale';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.id_article",
		"articles.lang",
		"articles.titre");
		$command['orderby'] = array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('=', 'articles.id_article', sql_quote(@$Pile[0]['id_article'], '','bigint(21) NOT NULL AUTO_INCREMENT')));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/article.html','html_acfb689da8b7f0df9e71fabce85f186f','_principale',1,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
<!DOCTYPE html>
<html lang="fr" >

<head>
' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/head') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'squelettes/article.html\',\'html_acfb689da8b7f0df9e71fabce85f186f\',\'\',6,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
</head>


<body>
' .
BOUCLE_articlehtml_acfb689da8b7f0df9e71fabce85f186f($Cache, $Pile, $doublons, $Numrows, $SP) .
'

                                        
' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/footer') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'squelettes/article.html\',\'html_acfb689da8b7f0df9e71fabce85f186f\',\'\',43,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
</body>
</html>
');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_principale @ squelettes/article.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette squelettes/article.html
// Temps de compilation total: 19.517 ms
//

function html_acfb689da8b7f0df9e71fabce85f186f($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
BOUCLE_principalehtml_acfb689da8b7f0df9e71fabce85f186f($Cache, $Pile, $doublons, $Numrows, $SP) .
'
');

	return analyse_resultat_skel('html_acfb689da8b7f0df9e71fabce85f186f', $Cache, $page, 'squelettes/article.html');
}
?>