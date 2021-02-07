<?php
// Code de controle pour le plugin 'Couteau Suisse' : 2 pipeline(s) actif(s)

# Copie du code utilise en eval() pour le pipeline 'pre_description_outil($flux)'
include_spip('outils/ecran_securite');
include_spip('outils/sommaire');
include_spip('outils/couleurs');
include_spip('outils/sessions_anonymes');
if($id=="autobr"){if(defined("_SPIP30000")) $texte=str_replace("@BALISES@",cs_balises_traitees("autobr"),$texte);
		$texte=str_replace(array("@ARTICLES@","@RUBRIQUES@","@FORUMS@"),
			array(cs_raccourcis_presents(array("article/texte", "article/descriptif", "article/chapo"),"%<alinea>%"), cs_raccourcis_presents(array("rubrique/texte"),"%<alinea>%"), cs_raccourcis_presents(array("forum/texte"),"%<alinea>%")), $texte);
}
if($id=="webmestres")
		$texte=str_replace(array("@_CS_LISTE_WEBMESTRES@","@_CS_LISTE_ADMINS@"),get_liste_administrateurs(),$texte);
if($id=="forum_lgrmaxi"){if(!defined("_SPIP30000")) $texte=str_replace("'forum_lgrmini'","'forum_lgrmini' disabled='disabled' value='10'", $texte);
		if(defined("_DIR_PLUGIN_COMMENTS")) $texte.="\n\n<spanred>".couteauprive_T("forum_lgrmaxi_comment")."</span>";
//		include_spip("comments_options");
//		$mini=(defined("_FORUM_LONGUEUR_MINI") && defined("_SPIP30000"))?_FORUM_LONGUEUR_MINI:10;
//		$maxi=defined("_FORUM_LONGUEUR_MAXI")?_FORUM_LONGUEUR_MAXI:0;
//		$texte.="\n\n".couteauprive_T("forum_lgrmaxi_actu", array("mini"=>$mini, "maxi"=>$maxi?$maxi:"&infin;"));
}
if($id=="masquer"){include_spip("lib/masquer/distant_pipelines_masquer_pipelines");
	$texte=str_replace(array("@_RUB@","@_ART@"),
		array((function_exists("masquer_liste_rubriques") && $x=masquer_liste_rubriques(true))?"[->rub".join("], [->rub", $x)."]":couteauprive_T("variable_vide"),
			(function_exists("masquer_liste_articles") && $x=masquer_liste_articles(true))?"[->art".join("], [->art", $x)."]":couteauprive_T("variable_vide"))
	,$texte); }
if($id=="auteur_forum") $texte=str_replace(array("@_CS_FORUM_NOM@","@_CS_FORUM_EMAIL@"),
	array(preg_replace(',:$,',"",_T("forum:forum_votre_nom")),preg_replace(',:$,',"",_T("forum:forum_votre_email"))),$texte);
if($id=="taches_cron")
		$texte=str_replace("@_CS_CRON@","\n@puce@ ".trim(recuperer_fond("fonds/taches_cron")) ,$texte);
if($id=="ecran_securite") $flux["non"] = !1 || !$flux["actif"];
if($id=="cs_comportement"){$tmp=(!0||!$flux["actif"]||defined("_CS_SPIP_OPTIONS_OK"))?"":"<spanred>"._T("couteauprive:cs_spip_options_erreur")."</span>";
$texte=str_replace(
	array("@_CS_FILE_OPTIONS_ERR@","@_CS_DIR_TMP@","@_CS_DIR_LOG@","@_CS_FILE_OPTIONS@"),
	array($tmp,cs_root_canonicalize(_DIR_TMP),cs_root_canonicalize(defined("_DIR_LOG")?_DIR_LOG:_DIR_TMP),show_file_options()),
	$texte);
}
if($id=="spip_log")
	$texte=str_replace(array("@DIR_LOG@","@SPIP_OPTIONS@"),
	array("<code>".cs_root_canonicalize(_DIR_LOG)."</code>",!defined("_CS_SPIP_OPTIONS_OK")?"<br/>"._T("couteauprive:detail_spip_options2"):""),$texte);
if($id=="test_i18n") $texte.=_T("Lorem_ipsum_dolor");
if($id=="en_travaux") $texte=str_replace(array("@_CS_TRAVAUX_TITRE@","@_CS_NOM_SITE@"),
	array("["._T("info_travaux_titre")."]","[".$GLOBALS["meta"]["nom_site"]."]"),$texte);
if($id=="titres_typo")
		$texte=str_replace("@_CS_FONTS@",join(" - ",get_liste_fonts()),$texte);
if($id=="visiteurs_connectes") if($GLOBALS["meta"]["activer_statistiques"]!="oui")
		$texte.="\n\n<spanred>"._T("couteauprive:visiteurs_connectes:inactif")."</span>";
if($id=="timezone")
		$texte=str_replace("@_CS_TZ@","<b>".(!(function_exists("date_default_timezone_get") && date_default_timezone_get())?"<span style=\"color: red;\">??</span>":@date_default_timezone_get())."</b> (PHP ".phpversion().")",$texte);
if($id=="liens_internes") $texte=str_replace("@_DOMAINE@",url_de_base(),$texte);
if($id=="autorisations")
$texte=str_replace(array("@_CS_DIR_TMP@","@_CS_DIR_LOG@"), array(cs_root_canonicalize(_DIR_CS_TMP), cs_root_canonicalize(defined("_DIR_LOG")?_DIR_LOG:_DIR_TMP)), $texte);
function_exists('ecran_securite_pre_description_outil')?$flux=ecran_securite_pre_description_outil($flux):cs_deferr('ecran_securite_pre_description_outil');
function_exists('sommaire_description_outil')?$flux=sommaire_description_outil($flux):cs_deferr('sommaire_description_outil');
function_exists('couleurs_pre_description_outil')?$flux=couleurs_pre_description_outil($flux):cs_deferr('couleurs_pre_description_outil');
function_exists('sessions_anonymes_pre_description_outil')?$flux=sessions_anonymes_pre_description_outil($flux):cs_deferr('sessions_anonymes_pre_description_outil');

# Copie du code utilise en eval() pour le pipeline 'fichier_distant($flux)'
include_spip('outils/ecran_securite');
// rajeunissement pour SPIP3 (2e appel du pipeline)
if($flux["outil"]=="maj_auto" && isset($flux["texte"]) && strpos($flux["fichier_distant"],"action/charger_plugin.php")!==false)
	$flux["texte"] = str_replace(array("'icon'","include_spip('inc/install');"), array("'logo'", "if(_request('cs_retour')) return array('nom'=>\$retour, 'suite'=>\$suite, 'fichier'=>\$fichier, 'tmp'=>\$status['tmpname']);\n\tinclude_spip('inc/install');"), $flux["texte"]);
function_exists('ecran_securite_fichier_distant')?$flux=ecran_securite_fichier_distant($flux):cs_deferr('ecran_securite_fichier_distant');
?>