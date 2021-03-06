<?php
#-----------------------------------------------------#
#  Plugin  : Couteau Suisse - Licence : GPL           #
#  Auteur  : Patrice Vanneufville, 2007               #
#  Contact : patrice¡.!vanneufville¡@!laposte¡.!net   #
#  Infos : https://contrib.spip.net/?article2166      #
#-----------------------------------------------------#
if(!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/actions');

function exec_cs_boite_rss_dist() {
	cs_minipres();
	// Constantes distantes
	include_spip('cout_define');
	if(defined('_CS_PAS_DE_DISTANT')) { ajax_retour(_T('couteauprive:version_distante_off')); return; }
	$p = '';
	// on cherche le flux rss toutes les _CS_RSS_UPDATE minutes
	$force = _request('force')=='oui';
	if(!$force) {
		$lastmodified = @file_exists(_CS_TMP_RSS)?@filemtime(_CS_TMP_RSS):0;
		if(time()-$lastmodified < _CS_RSS_UPDATE) lire_fichier(_CS_TMP_RSS, $p);
	}
	if(strlen($p)) { ajax_retour($p); return; }
	include_spip('inc/filtres');
	include_spip('action/editer_site');
	include_spip('inc/xml');
	$r = spip_xml_load(_CS_RSS_SOURCE);
	$c = function_exists('spip_xml_match_nodes')?spip_xml_match_nodes(',^item$,', $r, $r2)
		:count($r2 = !is_array($r)?array():reset($r=reset($r=reset($r=reset($r)))));
	if($c) {
		$r3 = &$r2['item'];
		$c = count($r3); $p='';
		for($i=0; $i<min($c, _CS_RSS_COUNT); $i++) {
		 $l = $r3[$i]['link'][0];
		 $d = affdate_court(date('Y-m-d', strtotime($r3[$i]['pubDate'][0])));
		 $t = str_replace('&amp;', '&', htmlentities($r3[$i]['title'][0], ENT_NOQUOTES, "UTF-8"));
		 $t = preg_replace(',\s*&#8364;(&brvbar;)?,', '&nbsp;(&hellip;)', $t);
		 $t = preg_replace(',^(.*?):,', "&bull; <a href='$l' class='spip_out' target='_cout'>$1</a> <i>($d)</i><br/>", $t);
			 $p .= "<li>$t</li>";
		}
	} else {
		// pour cs_lien()
		include_spip('couteau_suisse_fonctions');
		$p = '<span style="color: red;">'._T('couteauprive:erreur:probleme', array('pb'=>cs_lien(_CS_RSS_SOURCE,_T('couteauprive:erreur:distant')))).'</span>';
	}
	$du = affdate_heure(date('Y-m-d H:i:s',time()));
	$p = '<ul>'.$p
		.'</ul><p class="rss-small"><b>'
		._T('couteauprive:rss_edition')."</b><br/>$du</p>"
		.'<p style="text-align:right"><a href="'
		.generer_url_ecrire('admin_couteau_suisse','var_mode=calcul', true).'" onclick="'
		."javascipt:jQuery('div.cs_boite_rss').children().css('opacity', 0.5).parent().load('".generer_url_ecrire('cs_boite_rss', 'force=oui', true).'\');return false;">'
		._T('couteauprive:rss_actualiser').'</a> | <a href="'
		._CS_RSS_SOURCE.'">'
		._T('couteauprive:rss_source').'</a></p>';
	if($c) ecrire_fichier(_CS_TMP_RSS, $p);
	
	ajax_retour($p);
}

?>