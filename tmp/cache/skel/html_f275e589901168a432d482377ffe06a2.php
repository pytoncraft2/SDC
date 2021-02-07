<?php

/*
 * Squelette : ../plugins/auto/saisies/v3.43.0/saisies.css.html
 * Date :      Sun, 07 Feb 2021 04:24:21 GMT
 * Compile :   Sun, 07 Feb 2021 04:37:30 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../plugins/auto/saisies/v3.43.0/saisies.css.html
// Temps de compilation total: 3.373 ms
//

function html_f275e589901168a432d482377ffe06a2($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<'.'?php header("X-Spip-Cache: 360000"); ?'.'>'.'<'.'?php header("Cache-Control: max-age=360000"); ?'.'>'.'<'.'?php header("X-Spip-Statique: oui"); ?'.'>
' .
'<'.'?php header(' . _q('Content-Type: text/css; charset=utf-8') . '); ?'.'>' .
'<'.'?php header(' . _q('Vary: Accept-Encoding') . '); ?'.'>' .
vide($Pile['vars'][$_zzz=(string)'left'] = choixsiegal(lang_dir(@$Pile[0]['lang'], 'ltr','rtl'),'ltr','left','right')) .
vide($Pile['vars'][$_zzz=(string)'right'] = choixsiegal(lang_dir(@$Pile[0]['lang'], 'ltr','rtl'),'ltr','right','left')) .
vide($Pile['vars'][$_zzz=(string)'fleche'] = choixsiegal(lang_dir(@$Pile[0]['lang'], 'ltr','rtl'),'ltr',find_in_path('images/deplierhaut.gif'),find_in_path('images/deplierhaut_rtl.gif'))) .
'/* Dans l\'espace privé, afficher les labels des vues de Saisies */
#wysiwyg .afficher .label{ display:block; }

/* Correction d\'un bug de navigateur. On l\'ajoute là pour tout le monde, c\'est gentil. https://stackoverflow.com/a/17863685 */
fieldset {
	min-width:0;
}

.fieldset.pliable > fieldset > .legend{
	cursor:pointer;
}

.fieldset.pliable > fieldset > .legend span{
	padding-' .
table_valeur($Pile["vars"], (string)'left', null) .
':15px;
	background:transparent url(' .
find_in_path('images/deplierbas.gif') .
') ' .
(($t1 = strval(table_valeur($Pile["vars"], (string)'left', null)))!=='' ?
		($t1 . ' ') :
		'') .
'center no-repeat;
}

.fieldset.plie > fieldset > .legend span{
	background-image:url(' .
table_valeur($Pile["vars"], (string)'fleche', null) .
');
}
/**/
.editer.saisie_date_jour_mois_annee .choix {
	background-color:transparent;
	float:left;
	padding:0;
	border:0;
}
.saisie_date_jour_mois_annee .choix+.choix {margin-left:1em;}
.saisie_date_jour_mois_annee .choix label{display:block; width:auto;}
.saisie_date_jour_mois_annee .choix .text{width:auto;}

/**/
' .
((find_in_path('prive/style_prive_plugin_bonux.html'))  ?
		(' ' . (	' 
  ' .
	recuperer_fond( 'prive/style_prive_plugin_bonux' , array('ltr' => lang_dir(@$Pile[0]['lang'], 'left','right') ), array('compil'=>array('../plugins/auto/saisies/v3.43.0/saisies.css.html','html_f275e589901168a432d482377ffe06a2','',22,$GLOBALS['spip_lang'])), _request('connect')) .
	'
')) :
		'') .
'

/*' .
'*/
.formulaire_spip li.selecteur_item > label {
	float:none;
}

.formulaire_spip li.selecteur_item div.choix label {
	float:none;
	display:inline;
}

/* avec crayons + formulaire de saisies, éviter un padding à gauche du label */
.formulaire_crayon .editer-groupe .editer { padding-left:10px; }

/* les étapes */
.formulaire_spip .etapes__items {
	list-style: none;
}
.formulaire_spip .etapes__item {
	display: inline-block;
}
.formulaire_spip .etapes__item:not(:first-child):before {
	content: \' → \';
}

/* Pour les saisies grilles, on s\'arrange pour faire défiler si ça dépasse en largeur */
.choix_grille_wrapper {
	overflow-x: auto;
}
');

	return analyse_resultat_skel('html_f275e589901168a432d482377ffe06a2', $Cache, $page, '../plugins/auto/saisies/v3.43.0/saisies.css.html');
}
?>