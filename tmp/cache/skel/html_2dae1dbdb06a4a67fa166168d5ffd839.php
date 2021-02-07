<?php

/*
 * Squelette : squelettes/inclure/footer.html
 * Date :      Sat, 02 Jan 2021 00:36:10 GMT
 * Compile :   Sun, 07 Feb 2021 04:14:40 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette squelettes/inclure/footer.html
// Temps de compilation total: 2.474 ms
//

function html_2dae1dbdb06a4a67fa166168d5ffd839($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<footer>
                                                                        
                                                                         
        <div class="legal">©2020 Team-Balance - Scouts du Cameroun
                <a rel="contents" href="' .
interdire_scripts(generer_url_public('plan', '')) .
'" class="first" title="Plan du site"><span class="lnr lnr-layers"></span></a>' .
(($t1 = strval(interdire_scripts(invalideur_session($Cache, ((table_valeur($GLOBALS["visiteur_session"], (string)'id_auteur', null)) ?'' :' ')))))!=='' ?
		('
                ' . $t1 . (	' <a href="' .
	interdire_scripts(parametre_url(generer_url_public('login', ''),'url',self())) .
	'" rel="nofollow" class=\'login_modal\' title="Se connecter"><span class="lnr lnr-enter"></span></a>')) :
		'') .
(($t1 = strval(invalideur_session($Cache, ((function_exists("autoriser")||include_spip("inc/autoriser"))&&autoriser('ecrire')?" ":""))))!=='' ?
		('
                ' . $t1 . (	' <a href="' .
	(defined('_DIR_RESTREINT_ABS')?constant('_DIR_RESTREINT_ABS'):'') .
	'" title="Ecrire"><span class="lnr lnr-pencil"></span></a>')) :
		'') .
(($t1 = strval(interdire_scripts(invalideur_session($Cache, ((table_valeur($GLOBALS["visiteur_session"], (string)'id_auteur', null)) ?' ' :'')))))!=='' ?
		('
                ' . $t1 . (	' <a href="' .
	executer_balise_dynamique('URL_LOGOUT',
	array(),
	array('squelettes/inclure/footer.html','html_2dae1dbdb06a4a67fa166168d5ffd839','',3,$GLOBALS['spip_lang'])) .
	'" rel="nofollow" title="Se deconnecter"><span class="lnr lnr-exit"></span></a>')) :
		'') .
' 
                <a rel="nofollow" href="' .
interdire_scripts(generer_url_public('contact', '')) .
'" title="Contacts"><span class="lnr lnr-map-marker"></span></a>
	</div>

</footer>                                                                
');

	return analyse_resultat_skel('html_2dae1dbdb06a4a67fa166168d5ffd839', $Cache, $page, 'squelettes/inclure/footer.html');
}
?>