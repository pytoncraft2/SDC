<?php

/**
 * Gestion de l'affichage conditionnelle des saisies.
 * Partie spécifique php
 *
 * @package SPIP\Saisies\Afficher_si_php
**/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

include_spip('inc/saisies_afficher_si_commun');

/**
 * Traitement des saisies ayant l'option `afficher_si`.
 *
 * Lorsque qu'on affiche les saisies avec `#VOIR_SAISIES`,
 * si des saisies ont l'option `afficher_si`
 * et ni l'option `afficher_si_avec_post` ni l'option globale `poster_afficher_si`,
 * et que leurs conditions d'affichage ne sont pas remplies,
 * alors elles sont retirées du tableau de saisies.
 *
 * Cette fonction sert aussi lors de la vérification des saisies avec saisies_verifier().
 * À ce moment là, les saisies vérifiant ces critères sont retirées de _request
 * (on passe leur valeur à NULL).
 *
 * @param array      $saisies
 *                            Tableau de descriptions de saisies
 * @param array|null $env
 *                            Tableau d'environnement transmis dans inclure/voir_saisies.html,
 *                            NULL si on doit rechercher dans _request (pour saisies_verifier()).
 *
 * @return array
 *               Tableau de descriptions de saisies
 */
function saisies_verifier_afficher_si($saisies, $env = null) {
	// eviter une erreur par maladresse d'appel :)
	if (!is_array($saisies)) {
		return array();
	}

	foreach ($saisies as $cle => $saisie) {
		if (
			isset($saisie['options']['afficher_si'])
			and empty($saisies['options']['poster_afficher_si']) // option globale
			and empty($saisie['options']['afficher_si_avec_post']) // option de la saisie
		) {
			$condition = $saisie['options']['afficher_si'];
			// Est-ce uniquement au remplissage?
			if (isset($saisie['options']['afficher_si_remplissage_uniquement'])
				and $saisie['options']['afficher_si_remplissage_uniquement']=='on'){
				$remplissage_uniquement = true;
			} else {
				$remplissage_uniquement = false;
			}

			// On transforme en une condition PHP valide
			$ok = saisies_evaluer_afficher_si($condition, $env, saisies_lister_par_nom($saisies));
			if (!$ok) {
				if ($remplissage_uniquement == false or is_null($env)) {
					unset($saisies[$cle]);
				}
				if (is_null($env)) {
					if ($saisie['saisie'] == 'explication') {
						unset($saisies[$cle]);
					} else {
						saisies_set_request_null_recursivement($saisie);
					}
				}
			}
		}
		if (isset($saisies[$cle]['saisies'])) {
			// S'il s'agit d'un fieldset ou equivalent, verifier les sous-saisies
			$saisies[$cle]['saisies'] = saisies_verifier_afficher_si($saisies[$cle]['saisies'], $env);
		}
	}
	return $saisies;
}



/**
 * Pose un set_request null sur une saisie et toute ses sous-saisies.
 * Utiliser notamment pour annuler toutes les sous saisies d'un fieldeset
 * si le fieldset est masquée à cause d'un afficher_si.
 * @param array $saisie
**/
function saisies_set_request_null_recursivement($saisie) {
	// Attention, tout champ peut être un sous-tableau !
	saisies_set_request($saisie['options']['nom'], null);
	
	if (isset($saisie['saisies'])) {
		foreach ($saisie['saisies'] as $sous_saisie) {
			saisies_set_request_null_recursivement($sous_saisie);
		}
	}
}

/**
 * Récupère la valeur d'un champ à tester avec afficher_si
 * Si le champ est de type @config:xx@, alors prend la valeur de la config
 * sinon en _request() ou en $env["valeurs"]
 * @param string $champ: le champ
 * @param null|array $env
 * @param array $saisies_par_nom
 *   Les saisies déjà classées par nom de champ
 * @return  la valeur du champ ou de la config
 **/
function saisies_afficher_si_get_valeur_champ($champ, $env, $saisies_par_nom) {
	$valeur = null;
	$plugin = saisies_afficher_si_evaluer_plugin($champ);
	$config = saisies_afficher_si_get_valeur_config($champ);
	$fichiers = false;
	$est_tabulaire = false;
	
	if (isset($saisies_par_nom[$champ])) {
		$fichiers = $saisies_par_nom[$champ]['saisie'] == 'fichiers';
		$est_tabulaire = saisies_saisie_est_tabulaire($saisies_par_nom[$champ]);
	}
	if ($plugin !== '') {
		$valeur = $plugin;
	} elseif ($config) {
		$valeur = $config;
	} elseif (is_null($env)) {
		// Si le nom du champ est un tableau indexé, il faut parser !
		if (preg_match('/([\w]+)((\[[\w]+\])+)/', $champ, $separe)) {
			$valeur= _request($separe[1]);
			preg_match_all('/\[([\w]+)\]/', $separe[2], $index);
			// On va chercher au fond du tableau
			foreach ($index[1] as $cle) {
				if ($fichiers) {
					$files = isset($_FILES[$valeur[$cle]]) ? $_FILES[$valeur[$cle]]['name'] : array();
					$precedent = _request('cvtupload_fichiers_precedents');
					$precedent = $precedent[$valeur[$cle]];
				} else {
					$valeur = $valeur[$cle];
				}
			}
		} else {
			if ($fichiers) {
				$files = isset($_FILES[$champ]) ? $_FILES[$champ]['name'] : array();
				$precedent = _request('cvtupload_fichiers_precedents');
				$precedent = $precedent[$champ];
			} else {
				$valeur = _request($champ);
			}
		}
	} else {
		$valeur = $env['valeurs'][$champ];
	}
	if ($fichiers) {
		if (!is_array($precedent)) {
			$precedent = array();
		}
		$valeur = array_merge($files, $precedent);
		$valeur = array_filter($valeur);
	}
	
	// On teste si on doit forcer que ce soit un tableau, suivant le type de la saisie
	if ($est_tabulaire) {
		$data = null;
		if (isset($saisies_par_nom[$champ]['options']['data'])) {
			$data = $saisies_par_nom[$champ]['options']['data'];
		} elseif (isset($saisies_par_nom[$champ]['options']['datas'])) {
			$data = $saisies_par_nom[$champ]['options']['datas'];
		}
		$valeur = saisies_valeur2tableau($valeur, $data);
	}
	
	return $valeur;
}


/**
 * Prend un test conditionnel,
 * le sépare en une série de sous-tests de type champ - operateur - valeur
 * remplace chacun de ces sous-tests par son résultat
 * renvoie la chaine transformé
 * @param string $condition
 * @param array|null $env
 *   Tableau d'environnement transmis dans inclure/voir_saisies.html,
 *   NULL si on doit rechercher dans _request (pour saisies_verifier()).
 * @param  array $saisies_par_nom
 *   Les saisies déjà classées par nom de champ
 * @param string|null $no_arobase une valeur à tester là où il devrait y avoir un @@
 * @return string $condition
**/
function saisies_transformer_condition_afficher_si($condition, $env = null, $saisies_par_nom = array(), $no_arobase=null) {
	if ($tests = saisies_parser_condition_afficher_si($condition, $no_arobase)) {
		if (!saisies_afficher_si_verifier_syntaxe($condition, $tests)) {
			spip_log("Afficher_si incorrect. $condition syntaxe_incorrecte", "saisies"._LOG_CRITIQUE);
			return '';
		}
		
		foreach ($tests as $test) {
			$expression = $test[0];
			
			if (!isset($test['booleen'])) {
				if (!$no_arobase) {
					$champ = saisies_afficher_si_get_valeur_champ($test['champ'], $env, $saisies_par_nom);
				} else {
					$champ = $no_arobase;
				}
				
				$total = isset($test['total']) ? $test['total'] : '';
				$operateur = isset($test['operateur']) ? $test['operateur'] : null;
				$negation = isset($test['negation']) ? $test['negation'] : '';
				
				if (isset($test['valeur_numerique'])) {
					$valeur = intval($test['valeur_numerique']);
				} elseif (isset($test['valeur'])) {
					$valeur = $test['valeur'];
				} else {
					$valeur = null;
				}
				
				$test_modifie = saisies_tester_condition_afficher_si($champ, $total, $operateur, $valeur, $negation) ? 'true' : 'false';
				$condition = str_replace($expression, $test_modifie, $condition);
			}
		}
	} else {
		if (!saisies_afficher_si_verifier_syntaxe($condition, $tests)) {
			spip_log("Afficher_si incorrect. $condition syntaxe_incorrecte", "saisies"._LOG_CRITIQUE);
			return '';
		}
	}
	
	return $condition;
}


/**
 * Evalue un afficher_si
 * @param string $condition (déjà checkée en terme de sécurité)
 * @param array|null $env
 *   Tableau d'environnement transmis dans inclure/voir_saisies.html,
 *   NULL si on doit rechercher dans _request (pour saisies_verifier()).
 * @param array $saisies_par_nom
 *   Les saisies déjà classées par nom de champ
 * @param string|null $no_arobase une valeur à tester là où il devrait y avoir un @@
 * @return bool le résultat du test
**/
function saisies_evaluer_afficher_si($condition, $env = null, $saisies_par_nom=array(), $no_arobase=null) {
	$condition = saisies_transformer_condition_afficher_si($condition, $env, $saisies_par_nom, $no_arobase);
	if ($condition) {
		eval('$ok = '.$condition.';');
	} else {
		$ok = true;
	}
	return $ok;
}
