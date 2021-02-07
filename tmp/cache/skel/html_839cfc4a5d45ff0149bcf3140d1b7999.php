<?php

/*
 * Squelette : ../prive/squelettes/inclure/admin_vider_cache.html
 * Date :      Thu, 05 Nov 2020 10:50:01 GMT
 * Compile :   Sun, 07 Feb 2021 04:37:36 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../prive/squelettes/inclure/admin_vider_cache.html
// Temps de compilation total: 4.360 ms
//

function html_839cfc4a5d45ff0149bcf3140d1b7999($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
(($t1 = strval(invalideur_session($Cache, ((((function_exists("autoriser")||include_spip("inc/autoriser"))&&autoriser('configurer', '_admin_vider')?" ":"")) ?' ' :''))))!=='' ?
		($t1 . (	'
' .
	boite_ouvrir(interdire_scripts(wrap(concat(filtre_balise_img_dist(chemin_image('cache-24.png'),'','cadre-icone'),_T('taille_repertoire_cache')),'<h3>')), 'simple', 'titrem') .
	'<div id="placehoder_taille_cache"><p>&nbsp;</p></div>
	<script type="text/javascript">
		jQuery(function($){
			$(\'#placehoder_taille_cache\').animateLoading().load(\'' .
	invalideur_session($Cache, replace(generer_action_auteur('calculer_taille_cache','skel'),'&amp;','&')) .
	'\');
		});
	</script>
	<noscript>
		<iframe src="' .
	invalideur_session($Cache, generer_action_auteur('calculer_taille_cache','skel')) .
	'" style="width: 100%;height: 3em;overflow: hidden;"></iframe>
	</noscript>

	' .
	vide($Pile['vars'][$_zzz=(string)'cache_inhib'] = interdire_scripts((((((($a = (include_spip('inc/config')?lire_config('cache_inhib',null,false):'')) OR (is_string($a) AND strlen($a))) ? $a : '0') > time(''))) ?' ' :''))) .
	((table_valeur($Pile["vars"], (string)'cache_inhib', null))  ?
			(' ' . (	'
	<div><strong>' .
		_T('public|spip|ecrire:info_cache_desactive') .
		'</strong>
	</div>
	')) :
			'') .
	'

' .
	boite_pied() .
	'
	' .
	(!(table_valeur($Pile["vars"], (string)'cache_inhib', null))  ?
			(' ' . (	'
		' .
		bouton_action(_T('public|spip|ecrire:bouton_cache_desactiver'),invalideur_session($Cache, generer_action_auteur('purger','inhibe_cache',invalideur_session($Cache, self()))),'ajax') .
		'
	')) :
			'') .
	'
	' .
	((table_valeur($Pile["vars"], (string)'cache_inhib', null))  ?
			(' ' . (	'
 		' .
		bouton_action(_T('public|spip|ecrire:bouton_cache_activer'),invalideur_session($Cache, generer_action_auteur('purger','reactive_cache',invalideur_session($Cache, self()))),'ajax') .
		'
	')) :
			'') .
	'
	' .
	bouton_action(_T('public|spip|ecrire:bouton_vider_cache'),invalideur_session($Cache, generer_action_auteur('purger','cache',invalideur_session($Cache, self()))),'ajax') .
	'
' .
	boite_fermer() .
	'
')) :
		'') .
'
');

	return analyse_resultat_skel('html_839cfc4a5d45ff0149bcf3140d1b7999', $Cache, $page, '../prive/squelettes/inclure/admin_vider_cache.html');
}
?>