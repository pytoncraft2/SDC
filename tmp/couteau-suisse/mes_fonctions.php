<?php
// Code d'inclusion pour le plugin 'Couteau Suisse'
isset($GLOBALS['cs_fonctions'])?$GLOBALS['cs_fonctions']++:$GLOBALS['cs_fonctions']=1;
// Ce fichier contient des fonctions toujours compilees dans tmp/couteau-suisse/mes_fonctions.php
if (!defined("_ECRIRE_INC_VERSION")) return;

// compatibilite SPIP < 2.00
if(!defined('_SPIP19300')) {
	// #VAL{x} renvoie 'x' (permet d'appliquer un filtre a une chaine)
	// Attention #VAL{1,2} renvoie '1', indiquer #VAL{'1,2'}
	function balise_VAL($p){
		$p->code = interprete_argument_balise(1,$p);
		if (!strlen($p->code)) $p->code = "''";
		$p->interdire_scripts = false;
		return $p;
	}
	if(!function_exists('oui')) { function oui($code) { return $code?' ':''; } }
	if(!function_exists('non')) { function non($code) { return $code?'':' '; } }
}

function balise_CHR_dist($p) {
	if (($v = interprete_argument_balise(1,$p))!==NULL){
		$p->code = "chr(intval($v))";
		$p->type = 'php';
	}
	return $p;
}

function balise_DEFINED_dist($p) {
	if (($v = interprete_argument_balise(1,$p))!==NULL){
		$p->code = "defined($v)";
		$p->type = 'php';
	}
	return $p;
}

// fonction appelant une liste de fonctions qui permettent de nettoyer un texte original de ses raccourcis indesirables
function cs_introduire($texte) {
	// liste de filtres qui sert a la balise #INTRODUCTION
	if(!is_array($GLOBALS['cs_introduire'])) return $texte;
	$liste = array_unique($GLOBALS['cs_introduire']);
	foreach($liste as $f)
		if (function_exists($f)) $texte = $f($texte);
	return $texte;
}

// Fonction propre() sans paragraphage et sans echapper_html_suspect() (SPIP >= 3.1)
function cs_propre($texte) {
	include_spip('inc/texte');
	return trim(PtoBR(cs_propre_sain($texte)));
}

// Filtre creant un lien <a> sur un texte
// Exemple d'utilisation : [(#EMAIL*|cs_lien{#NOM})]
function cs_lien($lien, $texte='') {
	if(!$lien) return $texte;
	return cs_propre("[{$texte}->{$lien}]");
}

// filtre pour ajouter un <span> autour d'un texte
function cs_span($texte, $attr='') { return "<span $attr>$texte</span>"; }

// raccourci pour afficher le statut d'un auteur
function cs_auteur_statut($row) {
	$puce_statut = charger_fonction('puce_statut', 'inc');
	return $puce_statut(0, $row['statut'], 0, 'auteur');
}

// Controle (basique!) des 3 balises usuelles p|div|span eventuellement coupees
// Attention : simple traitement pour des balises non imbriquees
function cs_safebalises($texte) {
	$texte = trim($texte);
	// ouvre/supprime la premiere balise trouvee fermee (attention aux modeles SPIP)
	if(preg_match(',^(.*)</([a-z]+)>,Ums', $texte, $m) && !preg_match(",<$m[2][ >],", $m[1])) 
		$texte = strlen($m[1])?"<$m[2]>$texte":trim(substr($texte, strlen($m[2])+3));
	// referme/supprime la derniere balise laissee ouverte (attention aux modeles SPIP)
	if(preg_match(',^(.*)[ >]([a-z]+)<,Ums', $rev = strrev($texte), $m) && !preg_match(",>$m[2]/<,", $m[1])) 
		$texte = strrev(strlen($m[1])?">$m[2]/<$rev":trim(substr($rev, strlen($m[2])+2)));
	// balises <p|span|div> a traiter
	foreach(array('span', 'div', 'p') as $b) {
		// ouvrante manquante
		if(($fin = strpos($texte, "</$b>")) !== false)
			if(!preg_match(",<{$b}[ >],", substr($texte, 0, $fin)))
				$texte = "<$b>$texte";
		// fermante manquante
		$texte = strrev($texte);
		if(preg_match(',[ >]'.strrev("<{$b}").',', $texte, $reg)) {
			$fin = strpos(substr($texte, 0, $deb = strpos($texte, $reg[0])), strrev("</$b>"));
			if($fin===false || $fin>$deb) $texte = strrev("</$b>").$texte;
		}
		$texte = strrev($texte);
	}
	return $texte;
}

// fonction de suppression de notes. Utile pour #CS_SOMMAIRE ou #CS_DECOUPE
function cs_supprime_notes($texte) {
	return preg_replace(', *\[\[(.*?)\]\],msS', '', $texte);
}

// filtre appliquant les traitements SPIP d'un champ (et eventuellement d'un type d'objet) sur un texte
// (voir la fonction champs_traitements($p) dans : public/references.php)
// => permet d'utiliser les balises etoilees : #TEXTE*|mon_filtre|cs_traitements{TEXTE,articles}
// ce mecanisme est a preferer au traditionnel #TEXTE*|mon_filtre|propre
// cs_traitements() consulte simplement la globale $table_des_traitements et applique le traitement adequat
// $exclusions est une chaine ou un tableau de filtres a exclure du traitement
function cs_traitements($texte, $nom_champ='NULL', $type_objet='NULL', $exclusions=NULL) {
	global $table_des_traitements;
	if(!isset($table_des_traitements[$nom_champ])) return $texte;
	$ps = $table_des_traitements[$nom_champ];
	if(is_array($ps)) $ps = $ps[isset($ps[$type_objet]) ? $type_objet : 0];
	if(!$ps) return $texte;
	// retirer les filtres a exclure
	if($exclusions!==NULL) $ps = str_replace($exclusions, 'cs_noop', $ps);
	// remplacer le placeholder %s par le texte fourni
	eval('$texte=' . str_replace('%s', '$texte', $ps) . ';');
	return $texte;
}
function cs_noop($t='',$a=NULL,$b=NULL,$c=NULL) { return $t; }

// liste des docs sur contrib.spip (outils actifs)
function cs_liste_contribs($coupe = 999, $join = "</li><li>") {
	global $metas_outils;
	$contribs = array();
	foreach($metas_outils as $o=>$v) if(isset($v['contrib']) && isset($v['actif']) && $v['actif'])
		$contribs[] =  '[' . couper(couteauprive_T($o.':nom'), $coupe) . '->' . (is_numeric($v['contrib']) ?_URL_CONTRIB.$v['contrib']:$v['contrib']) . ']';
	sort($contribs);
	return '[{{' . couteauprive_T('docgen') . '}}->' . _URL_CONTRIB . '2166]' 
		. $join . '[{{' . couteauprive_T('docwiki') . '}}->' . _URL_CONTRIB . '2793]'
		. (count($contribs)?$join.join($join, $contribs):'');
}

// renvoie un champ d'un objet en base
function cs_champ_sql($id, $champ='texte', $objet='article') {
	// Utiliser la bonne requete en fonction de la version de SPIP
	if(function_exists('sql_getfetsel')) {
		// SPIP 2.0
		// TODO : fonctions SPIP pour trouver la table et l'id_objet
		if($r = sql_getfetsel($champ, 'spip_'.$objet.'s', 'id_'.$objet.'='.intval($id)))
			return $r;
	} else {
		if($r = spip_query('SELECT '.$champ.' FROM spip_'.$objet.'s WHERE id_'.$objet.'='.intval($id)))
			// s'il existe un champ, on le retourne
			if($row = spip_fetch_array($r)) return $row[$champ];
	}
	// sinon rien !
	return '';
}

// recaler un contenu de fond. Exemple : #FILTRE{cs_impossible}
function cs_impossible($chaine='') { return _T('avis_operation_impossible'); }
@define('_INTRODUCTION_CODE', '@@CS_SUITE@@');

// compatibilite avec SPIP 1.92 et anterieurs
$GLOBALS['cs_couper_intro'] = 'couper_intro';
if (!defined('_SPIP19300')) {
	$GLOBALS['cs_couper_intro'] = 'couper_intro2';
	function couper_intro2($texte, $long, $suite) {
		$texte = couper_intro($texte, $long);
		$i = strpos($texte, '&nbsp;(...)');
		if (strlen($texte) - $i == 11)
			$texte = substr($texte, 0, $i) . _INTRODUCTION_CODE;
		return $texte;
	}
	function objet_type($table_objet){ return preg_replace(',^spip_|s$,', '', $table_objet); }
}

// fonction obsolete sous SPIP 3.0
function chapo_redirigetil2($chapo) { return $chapo && $chapo[0] == '=';	}

// compatibilite avec SPIP 2.0 : la balise a fortement change !! >> TODO
// la fonction couper_intro a disparu.
// voir function filtre_introduction_dist
if (defined('_SPIP19300')) {
	$GLOBALS['cs_couper_intro'] = 'couper_intro3';
	function couper_intro3($texte, $long, $suite) {
		$texte = extraire_multi(preg_replace(",(</?)intro>,i", "\\1intro>", $texte)); // minuscules
		$intro = '';
		while ($fin = strpos($texte, "</intro>")) {
			$zone = substr($texte, 0, $fin);
			$texte = substr($texte, $fin + strlen("</intro>"));
			if ($deb = strpos($zone, "<intro>") OR substr($zone, 0, 7) == "<intro>")
				$zone = substr($zone, $deb + 7);
			$intro .= $zone;
		}
		$texte = nettoyer_raccourcis_typo($intro ? $intro : $texte);
		return PtoBR(traiter_raccourcis(preg_replace(',([|]\s*)+,S', '; ', couper($texte, $long, _INTRODUCTION_CODE))));
	}
}

function remplace_points_de_suite($texte, $id, $racc, $connect=NULL) {
	// des points de suite bien propres
	defined('_INTRODUCTION_SUITE') || define('_INTRODUCTION_SUITE', '&nbsp;(...)');
	defined('_INTRODUCTION_LIEN') || define('_INTRODUCTION_LIEN', 0);
	defined('_INTRODUCTION_SUITE_SYSTEMATIQUE') || define('_INTRODUCTION_SUITE_SYSTEMATIQUE', 0);
	if (strpos($texte, _INTRODUCTION_CODE) === false) {
		if(!_INTRODUCTION_SUITE_SYSTEMATIQUE) return $texte;
		$texte .= _INTRODUCTION_SUITE;
	}
	$intro_suite = cs_propre(_INTRODUCTION_SUITE);
	// si les points de suite sont cliquables
	if ($id && _INTRODUCTION_LIEN) {
		if(defined('_SPIP19300')) {
			if(!$connect) $connect = true;
			$url = test_espace_prive()
				?generer_url_entite_absolue($id, $racc, '', '', $connect)
				:generer_url_entite($id, $racc, '', '', $connect); //"$racc$id";
		} else $url= $racc.$id;
		$intro_suite = strncmp($intro_suite, '<br />', 6)===0
			?'<br />'.cs_lien($url, substr($intro_suite, 6))
			:'&nbsp;'.cs_lien($url, $intro_suite);
		$intro_suite = inserer_attribut($intro_suite, 'class', extraire_attribut($intro_suite,'class') . ' pts_suite');
	}
	return str_replace(_INTRODUCTION_CODE, $intro_suite, $texte);
}

// lgr>0 : aucun paramètre, donc longueur par défaut
// lgr<0 : paramètre spécifié #INTRODUCTION{longueur}
// lgr=0 : pas possible
// $connect (bases distantes) est pour SPIP>=2.0
function cs_introduction($texte, $descriptif, $lgr, $id, $racc, $connect) {
	defined('_INTRODUCTION_LGR') || define('_INTRODUCTION_LGR', 100);
	defined('_INTRODUCTION_DESCRIPTIF_ENTIER') || define('_INTRODUCTION_DESCRIPTIF_ENTIER', 0);
	// fonction couper_intro
	$couper = $GLOBALS['cs_couper_intro'];
	if (strlen($descriptif))
		# si le descriptif ne contient que des espaces ça produit une intro vide, 
		# c'est une fonctionnalité, pas un bug
		// ici le descriptif est coupé s'il est trop long et si la config le permet
		$texte = propre(
			($lgr<0 && !_INTRODUCTION_DESCRIPTIF_ENTIER)
				?$couper($descriptif, -$lgr, _INTRODUCTION_CODE):$descriptif
		);
	else {
		// pas de maths dans l'intro...
		$texte = preg_replace(',<math>.*</math>,imsU', '', $texte);
		// on coupe proprement...
		$lgr = $lgr>0?round($lgr*_INTRODUCTION_LGR/100):-$lgr;
		$texte = cs_propre(supprimer_tags($couper(cs_introduire($texte), $lgr, _INTRODUCTION_CODE)));
	}
	// si les points de suite ont ete ajoutes
	return remplace_points_de_suite($texte, $id, $racc, $connect);
} // introduction()

if (!function_exists('balise_INTRODUCTION')) {
	// #INTRODUCTION_SPIP (pour tests)
	function balise_INTRODUCTION_SPIP($p) {
		return balise_INTRODUCTION_dist($p);
	}
	include_spip('public/interfaces');
	global $table_des_traitements;
	// INTRODUCTION_SPIP est une INTRODUCTION !
	if (!isset($table_des_traitements['INTRODUCTION_SPIP']))
		$table_des_traitements['INTRODUCTION_SPIP'] = $table_des_traitements['INTRODUCTION'];
	// #INTRODUCTION
	function balise_INTRODUCTION($p) {
		$type = $p->type_requete;
		$_texte = champ_sql('texte', $p);
		$_descriptif =  "''";
		$_id = 0;
		$_lgr = "600";
		switch ($type) {
			case 'articles':
				$_chapo = champ_sql('chapo', $p);
				$_descriptif =  champ_sql('descriptif', $p);
				$_texte = defined('_SPIP30000')
					?"strlen($_descriptif) ? '' : $_chapo . \"\\n\\n\" . $_texte"
					:"(strlen($_descriptif) OR chapo_redirigetil2($_chapo)) ? '' : $_chapo . \"\\n\\n\" . $_texte";
				$_lgr = "500";
				break;
			case 'rubriques':
				$_descriptif =  champ_sql('descriptif', $p);
				break;
			case 'breves':
				$_lgr = "300";
				break;
		}
		// longueur en parametre ?
		if(($v = interprete_argument_balise(1,$p))!==NULL) $_lgr = "-intval($v)" ;
		$_id = champ_sql(id_table_objet($racc = objet_type($type)), $p);
		$p->code = "cs_introduction($_texte, $_descriptif, $_lgr, $_id, '$racc', \$connect)";
		#$p->interdire_scripts = true;
		$p->etoile = '*'; // propre est deja fait dans le calcul de l'intro
		return $p;
	}
	
} //!function_exists('balise_INTRODUCTION') 
else spip_log("Erreur - balise_INTRODUCTION() existe deja et ne peut pas etre surchargee par le Couteau Suisse !");
?>