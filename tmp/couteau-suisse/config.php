<?php
// Configuration de controle pour le plugin 'Couteau Suisse'

// Tous les outils et leurs variables
$liste_outils = array(
	// Titres typographiés
	'titres_typographies' => '',
	// Retours de ligne automatiques
	'autobr' => 'alinea3|alinea2|pp_edition_autobr|pp_forum_autobr|pp_vide_autobr',
	// Dossier du squelette
	'dossier_squelettes' => 'dossier_squelettes',
	// Supprime le numéro
	'supprimer_numero' => '',
	// Paragrapher
	'paragrapher2' => 'paragrapher',
	// Force la langue
	'forcer_langue' => '',
	// Liste des webmestres
	'webmestres' => 'webmestres',
	// Balise #INSERT_HEAD
	'insert_head' => '',
	// Balise #INTRODUCTION
	'introduction' => 'lgr_introduction|coupe_descriptif|suite_introduction|lien_introduction|lien_systematique',
	// Type d'interface privée
	'set_options' => 'radio_set_options4',
	// Gestion du JavaScript
	'filtrer_javascript' => 'radio_filtrer_javascript3',
	// Taille des forums
	'forum_lgrmaxi' => 'forum_lgrmini|forum_lgrmaxi',
	// Limites mémoire
	'SPIP_tailles' => 'img_Hmax|img_Wmax|img_Smax|logo_Hmax|logo_Wmax|logo_Smax|doc_Smax|copie_Smax|img_GDmax|img_GDqual',
	// Prévisualisation des articles
	'previsualisation' => '',
	// Masquer du contenu
	'masquer' => 'mot_masquer',
	// Pas de forums anonymes
	'auteur_forum' => 'auteur_forum_nom|auteur_forum_email|auteur_forum_deux',
	// Suivi des forums publics
	'suivi_forums' => 'radio_suivi_forums3',
	// Lutte contre le SPAM
	'spam' => 'spam_mots|spam_ips',
	// Pas de stockage IP
	'no_IP' => '',
	// Pas de verrouillage de fichiers
	'flock' => '',
	// Tâches CRON
	'taches_cron' => 'cron_direct_force|cron_html_bg_force',
	// Ecran de sécurité
	'ecran_securite' => 'ecran_actif|ecran_load',
	// Comportements du Couteau Suisse
	'cs_comportement' => 'log_couteau_suisse|spip_options_on|distant_off|distant_outils_off',
	// SPIP et les logs
	'spip_log' => 'nombre_de_logs|taille_des_logs|dir_log|file_log|file_log_suffix|max_log|log_fileline|log_brut|filtre_gravite|filtre_gravite_trace|log_non',
	// Profiling
	'profiling' => 'req_lentes|boucles_lentes',
	// Traductions manquantes
	'test_i18n' => '',
	// Validateur XML
	'xml' => '',
	// Désactive jQuery
	'f_jQuery' => '',
	// Site en travaux
	'en_travaux' => 'message_travaux|titre_travaux|admin_travaux|avertir_travaux|cache_travaux|prive_travaux',
	// Boîtes privées
	'boites_privees' => 'cs_rss|format_spip|stat_auteurs|qui_webmasters|bp_urls_propres|bp_tri_auteurs',
	// Page des auteurs
	'auteurs' => 'max_auteurs_page|auteurs_tout_voir|auteurs_0|auteurs_1|auteurs_5|auteurs_6|auteurs_n',
	// Version texte
	'verstexte' => '',
	// Orientation des images
	'orientation' => '',
	// Intertitres en image
	'titres_typo' => 'i_taille|i_couleur|i_police|i_largeur|i_hauteur|i_padding|i_align',
	// Découpe en pages et onglets
	'decoupe' => 'balise_decoupe|pp_edition_decoupe|pp_forum_decoupe|pp_vide_decoupe',
	// Sommaire automatique
	'sommaire' => 'prof_sommaire|lgr_sommaire|jolies_ancres|auto_sommaire|balise_sommaire',
	// Désactive les objets flash
	'desactiver_flash' => '',
	// SPIP et les liens… externes
	'SPIP_liens' => 'radio_target_blank3|url_glossaire_externe2|enveloppe_mails',
	// Affiche tout
	'aff_tout' => 'tout_rub|tout_aut',
	// Visiteurs connectés
	'visiteurs_connectes' => '',
	// Blocs multilingues
	'toutmulti' => '',
	// Belles puces
	'pucesli' => 'puceSPIP',
	// Citations bien balisées
	'citations_bb' => '',
	// Décoration
	'decoration' => 'decoration_styles|pp_edition_decoration|pp_forum_decoration|pp_vide_decoration',
	// Tout en couleurs
	'couleurs' => 'couleurs_fonds|set_couleurs|couleurs_perso|pp_edition_couleurs|pp_forum_couleurs|pp_vide_couleurs',
	// Exposants typographiques
	'typo_exposants' => 'expo_bofbof',
	// Guillemets typographiques
	'guillemets' => '',
	// Belles URLs
	'liens_orphelins' => 'liens_interrogation|liens_orphelins|long_url|coupe_url',
	// Filets de Séparation
	'filets_sep' => 'pp_edition_filets_sep|pp_forum_filets_sep|pp_vide_filets_sep',
	// Smileys
	'smileys' => 'pp_edition_smileys|pp_forum_smileys|pp_vide_smileys',
	// Chatons
	'chatons' => 'pp_edition_chatons|pp_forum_chatons|pp_vide_chatons',
	// Glossaire interne
	'glossaire' => 'glossaire_groupes|glossaire_limite|glossaire_js|glossaire_abbr',
	// MailCrypt
	'mailcrypt' => 'balise_email|fonds_demailcrypt|fonds_demailcrypt2',
	// Liens en clair
	'liens_en_clair' => '',
	// Ancres douces
	'soft_scroller' => 'scrollTo|LocalScroll',
	// Jolis Coins
	'jcorner' => 'jcorner_classes|jcorner_plugin',
	// Corrections automatiques
	'insertions' => 'insertions',
	// Modération modérée
	'moderation_moderee' => 'moderation_admin|moderation_redac|moderation_visit',
	// Balises #TITRE_PARENT/OBJET
	'titre_parent' => 'titres_etendus',
	// Balise #SET étendue
	'balise_set' => '',
	// La corbeille
	'corbeille' => 'arret_optimisation',
	// Trousse à balises
	'trousse_balises' => '',
	// Horloge
	'horloge' => '',
	// Décalage horaire
	'timezone' => 'timezone',
	// Mises à jour automatiques
	'maj_auto' => '',
	// Réglage des sélecteurs
	'brouteur' => 'rubrique_brouteur|select_mots_clefs|select_min_auteurs|select_max_auteurs',
	// Largeur d'écran
	'spip_ecran' => 'spip_ecran|tres_large',
	// Message d’alerte
	'alerte_urgence' => 'alerte_message',
	// Sessions anonymes
	'sessions_anonymes' => '',
	// Correction des liens internes
	'liens_internes' => 'multidomaines',
	// Les tris de SPIP
	'tri_articles' => 'tri_articles|tri_perso|tri_groupes|tri_perso_groupes',
	// Allègement de l'interface privée
	'simpl_interface' => '',
	// Bouton « Voir le site public »
	'icone_visiter' => '',
	// Dans la même rubrique
	'meme_rubrique' => 'meme_rubrique',
	// Fonctions d'autorisations
	'autorisations' => 'autorisations_alias|autorisations_debug',
	// Blocs Dépliables
	'blocs' => 'bloc_unique|blocs_cookie|bloc_h4|blocs_couper|blocs_slide|blocs_millisec|pp_edition_blocs|pp_forum_blocs|pp_vide_blocs',
	// SPIP et ses raccourcis…
	'class_spip' => 'racc_hr|puce|racc_h1|racc_h2|racc_g1|racc_g2|racc_i1|racc_i2|ouvre_ref|ferme_ref|ouvre_note|ferme_note|style_p|style_h',
	// Débogueur de développement
	'devdebug' => 'devdebug_mode|devdebug_espace|devdebug_niveau',
	// SPIP et le cache…
	'spip_cache' => 'radio_desactive_cache4|quota_cache|derniere_modif_invalide|duree_cache|duree_cache_mutu|compacte_css|compacte_js|compacte_prive|compacte_tout',
	// Format des URLs
	'type_urls' => 'radio_type_urls3|terminaison_urls_page|separateur_urls_page|terminaison_urls_simple|terminaison_urls_propres|debut_urls_propres|marqueurs_urls_propres|url_max_propres|debut_urls_propres2|marqueurs_urls_propres2|url_max_propres2|terminaison_urls_libres|debut_urls_libres|url_max_libres|url_arbo_minuscules|urls_arbo_sans_type|url_arbo_sep_id|terminaison_urls_arbo|url_max_arbo|terminaison_urls_propres_qs|url_max_propres_qs|terminaison_urls_propres_qs|marqueurs_urls_propres_qs|url_max_propres_qs|spip_script|urls_minuscules|urls_avec_id|urls_avec_id2|urls_id_3_chiffres|urls_id_sauf_rubriques|urls_id_sauf_liste'
);

// Outils actifs
$outils_actifs =
	'introduction';

// Variables actives
$variables_actives =
	'lgr_introduction|coupe_descriptif|suite_introduction|lien_introduction|lien_systematique';

// Valeurs validees en metas
$valeurs_validees = array(
	'lgr_introduction' => 30,
	'coupe_descriptif' => 0,
	'suite_introduction' => '&nbsp;(...)',
	'lien_introduction' => 1,
	'lien_systematique' => 1
);

######## PACK ACTUEL DE CONFIGURATION DU COUTEAU SUISSE #########

// Attention, les surcharges sur les define(), les autorisations spécifiques ou les globales ne sont pas spécifiées ici

$GLOBALS['cs_installer']['Pack 02/01/21'] =	'cs_e43a6232f21d5b62061bb17519a7ce65';
function cs_e43a6232f21d5b62061bb17519a7ce65() { return array(
	// Installation des outils par défaut
	'outils' =>
		'introduction',

	// Installation des variables par défaut
	'variables' => array(
		'lgr_introduction' => 30,
		'coupe_descriptif' => 0,
		'suite_introduction' => '&nbsp;(...)',
		'lien_introduction' => 1,
		'lien_systematique' => 1
	)
);} # Pack 02/01/21 #
?>