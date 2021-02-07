<?php

/*
 * Squelette : ../plugins-dist/revisions/prive/style_prive_plugin_revisions.html
 * Date :      Sun, 07 Feb 2021 04:24:20 GMT
 * Compile :   Sun, 07 Feb 2021 04:37:31 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../plugins-dist/revisions/prive/style_prive_plugin_revisions.html
// Temps de compilation total: 2.953 ms
//

function html_81ee9f4ab7926a28b4aa1b7cf6560b3c($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'
' .
'<'.'?php header("X-Spip-Cache: 360000"); ?'.'>'.'<'.'?php header("Cache-Control: max-age=360000"); ?'.'>'.'<'.'?php header("X-Spip-Statique: oui"); ?'.'>' .
'<'.'?php header(' . _q('Content-Type: text/css; charset=iso-8859-15') . '); ?'.'>' .
'<'.'?php header(' . _q('Vary: Accept-Encoding') . '); ?'.'>' .
vide($Pile['vars'][$_zzz=(string)'claire'] = (	'#' .
	interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'couleur_claire', null), 'edf3fe'),true)))) .
vide($Pile['vars'][$_zzz=(string)'foncee'] = (	'#' .
	interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'couleur_foncee', null), '3874b0'),true)))) .
vide($Pile['vars'][$_zzz=(string)'left'] = interdire_scripts(choixsiegal(entites_html(table_valeur(@$Pile[0], (string)'ltr', null),true),'left','left','right'))) .
vide($Pile['vars'][$_zzz=(string)'right'] = interdire_scripts(choixsiegal(entites_html(table_valeur(@$Pile[0], (string)'ltr', null),true),'left','right','left'))) .
vide($Pile['vars'][$_zzz=(string)'rtl'] = interdire_scripts(choixsiegal(entites_html(table_valeur(@$Pile[0], (string)'ltr', null),true),'left','','_rtl'))) .
'/* * Comparaison d articles */
.diff-para-deplace { background: #e8e8ff; }
.diff-para-ajoute { background: #d0ffc0; color: #000; }
.diff-para-supprime { background: #ffd0c0; color: #904040; text-decoration: line-through; }
p>.diff-para-deplace,p>.diff-para-ajoute,p>.diff-para-supprime {display:block;}

.diff-deplace { background: #e8e8ff; }
.diff-ajoute { background: #d0ffc0; }
.diff-supprime { background: #ffd0c0; color: #802020; text-decoration: line-through; }
.diff-para-deplace .diff-ajoute { background: #b8ffb8; border: 1px solid #808080; }
.diff-para-deplace .diff-supprime { background: #ffb8b8; border: 1px solid #808080; }
.diff-para-deplace .diff-deplace { background: #b8b8ff; border: 1px solid #808080; }

/* liste de versions */
.liste-objets.versions tr > .type {width:30px;}
.liste-objets.versions tr > .diff {width:30px;}
.liste-objets.versions blockquote {margin-left:0;margin-right:0;}
.liste-objets.versions .caption {background-image:url(' .
interdire_scripts(chemin_image('revision-24.png')) .
');padding-' .
table_valeur($Pile["vars"], (string)'left', null) .
':30px;background-position:' .
table_valeur($Pile["vars"], (string)'left', null) .
' center;}

.revision #wysiwyg .contenu_id_rubrique {display:none;}
.revision #wysiwyg .jointure {display:block;margin:1em 0;}
.revision #wysiwyg .jointure .label {display:block;font-weight:bold;}


.formulaire_reviser .editer_id_version .choix {margin: 0 -5px;}
.formulaire_reviser table.spip.diff-versions {font-size: 0.85em;width: 100%;max-width: 100%;}
.formulaire_reviser table,.formulaire_reviser table tr,.formulaire_reviser table td {border-left:0;border-right:0;}
.formulaire_reviser table .version,.formulaire_reviser table .diff {padding:0;}
.fiche_objet_diff .hd {border-bottom:1px solid #ddd;}');

	return analyse_resultat_skel('html_81ee9f4ab7926a28b4aa1b7cf6560b3c', $Cache, $page, '../plugins-dist/revisions/prive/style_prive_plugin_revisions.html');
}
?>