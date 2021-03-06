<?php

/**
 * Gestion de l'affichage des saisies
 *
 * @package SPIP\Saisies\Saisies
**/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

// Différentes méthodes pour trouver les saisies
include_spip('inc/saisies_lister');

// Différentes méthodes pour manipuler une liste de saisies
include_spip('inc/saisies_manipuler');

// Les outils pour afficher les saisies et leur vue
include_spip('inc/saisies_afficher');

// Les outils pour l'affichage conditionnelle des saisies
include_spip('inc/saisies_afficher_si_php');

/**
 * Cherche la description des saisies d'un formulaire CVT dont on donne le nom
 *
 * @param string $form Nom du formulaire dont on cherche les saisies
 * @param array $args Tableau d'arguments du formulaire
 * @return array Retourne les saisies du formulaire sinon false
 */
function saisies_chercher_formulaire($form, $args, $je_suis_poste=false) {
	$saisies = array();

	if ($fonction_saisies = charger_fonction('saisies', 'formulaires/'.$form, true)) {
		$saisies = call_user_func_array($fonction_saisies, $args);
	}

	// Si on a toujours un tableau, on passe les saisies dans un pipeline normé comme pour CVT
	if (is_array($saisies)) {
		$saisies = pipeline(
			'formulaire_saisies',
			array(
				'args' => array('form' => $form, 'args' => $args, 'je_suis_poste' => $je_suis_poste),
				'data' => $saisies
			)
		);
	}

	if (!is_array($saisies)) {
		$saisies = false;
	}

	return $saisies;
}

/**
 * Cherche une saisie par son id, son nom ou son chemin et renvoie soit la saisie, soit son chemin
 *
 * @param array $saisies Un tableau décrivant les saisies
 * @param unknown_type $id_ou_nom_ou_chemin L'identifiant ou le nom de la saisie à chercher ou le chemin sous forme d'une liste de clés
 * @param bool $retourner_chemin Indique si on retourne non pas la saisie mais son chemin
 * @return array Retourne soit la saisie, soit son chemin, soit null
 */
function saisies_chercher($saisies, $id_ou_nom_ou_chemin, $retourner_chemin = false) {
	if (is_array($saisies) and $id_ou_nom_ou_chemin) {
		if (is_string($id_ou_nom_ou_chemin)) {
			$nom = $id_ou_nom_ou_chemin;
			// identifiant ? premier caractere @
			$id = ($nom[0] == '@');

			foreach ($saisies as $cle => $saisie) {
				$chemin = array($cle);
				// notre saisie est la bonne ?
				if ($nom == ($id ? $saisie['identifiant'] : $saisie['options']['nom'])) {
					return $retourner_chemin ? $chemin : $saisie;
				// sinon a telle des enfants ? et si c'est le cas, cherchons dedans
				} elseif (isset($saisie['saisies']) and is_array($saisie['saisies']) and $saisie['saisies']
					and ($retour = saisies_chercher($saisie['saisies'], $nom, $retourner_chemin))) {
						return $retourner_chemin ? array_merge($chemin, array('saisies'), $retour) : $retour;
				}
			}
		}
		elseif (is_array($id_ou_nom_ou_chemin)) {
			$chemin = $id_ou_nom_ou_chemin;
			$saisie = $saisies;

			// On vérifie l'existence quand même
			foreach ($chemin as $cle) {
				if (isset($saisie[$cle])) {
					$saisie = $saisie[$cle];
				} else {
					return null;
				}
			}

			// Si c'est une vraie saisie
			if ($saisie['saisie'] and $saisie['options']['nom']) {
				return $retourner_chemin ? $chemin : $saisie;
			}
		}
	}

	return null;
}

/**
 * Génère un nom unique pour un champ d'un formulaire donné
 *
 * @param array $formulaire
 *     Le formulaire à analyser
 * @param string $type_saisie
 *     Le type de champ dont on veut un identifiant
 * @return string
 *     Un nom unique par rapport aux autres champs du formulaire
 */
function saisies_generer_nom($formulaire, $type_saisie) {
	$champs = saisies_lister_champs($formulaire);

	// Tant que type_numero existe, on incrémente le compteur
	$compteur = 1;
	while (array_search($type_saisie.'_'.$compteur, $champs) !== false) {
		$compteur++;
	}

	// On a alors un compteur unique pour ce formulaire
	return $type_saisie.'_'.$compteur;
}

/**
 * Crée un identifiant Unique
 * pour toutes les saisies donnees qui n'en ont pas
 *
 * @param Array $saisies Tableau de saisies
 * @param Bool $regenerer Régénère un nouvel identifiant pour toutes les saisies ?
 * @return Array Tableau de saisies complété des identifiants
 */
function saisies_identifier($saisies, $regenerer = false) {
	if (!is_array($saisies)) {
		return array();
	}

	foreach ($saisies as $k => $saisie) {
		if ($k !== 'options') {
			$saisies[$k] = saisie_identifier($saisie, $regenerer);
		}
	}

	return $saisies;
}

/**
 * Crée un identifiant Unique
 * pour la saisie donnee si elle n'en a pas
 * (et pour ses sous saisies éventuels)
 *
 * @param Array $saisie Tableau d'une saisie
 * @param Bool $regenerer Régénère un nouvel identifiant pour la saisie ?
 * @return Array Tableau de la saisie complété de l'identifiant
**/
function saisie_identifier($saisie, $regenerer = false) {
	if (!isset($saisie['identifiant']) or !$saisie['identifiant']) {
		$saisie['identifiant'] = uniqid('@');
	} elseif ($regenerer) {
		$saisie['identifiant'] = uniqid('@');
	}
	if (isset($saisie['saisies']) and is_array($saisie['saisies'])) {
		$saisie['saisies'] = saisies_identifier($saisie['saisies'], $regenerer);
	}

	return $saisie;
}


/**
 * Supprimer récursivement les identifiants d'un tableau de saisie
 * Seul usage probable : pour les test uniaires
 * pour la saisie donnee si elle n'en a pas
 * (et pour ses sous saisies éventuels)
 *
 * @param Array $saisie Tableau d'une saisie
 * @return Array Tableau de la saisie sans les identifiant
**/
function saisies_supprimer_identifiants($saisies) {
	unset($saisies['identifiant']);
	foreach ($saisies as $cle => $valeur) {
		if (is_array($valeur)) {
			$saisies[$cle] = saisies_supprimer_identifiants($valeur);
		}
	}
	return $saisies;
}




/**
 * Vérifier tout un formulaire tel que décrit avec les Saisies
 *
 * @param array $formulaire Le contenu d'un formulaire décrit dans un tableau de Saisies
 * @param bool $saisies_masquees_nulles Si TRUE, les saisies masquées selon afficher_si ne seront pas verifiées, leur valeur étant forcée a NULL. Cette valeur NULL est transmise à traiter (via set_request).
 * @param array &$erreurs_fichiers pour les saisies de type fichiers, un tableau qui va stocker champs par champs, puis fichier par fichier, les erreurs de chaque fichier, pour pouvoir ensuite éventuellement supprimer les fichiers erronées de $_FILES
 * @return array Retourne un tableau d'erreurs
 */
function saisies_verifier($formulaire, $saisies_masquees_nulles = true, &$erreurs_fichiers = array()) {
	include_spip('inc/verifier');
	$erreurs = array();
	$verif_fonction = charger_fonction('verifier', 'inc', true);

	if ($saisies_masquees_nulles) {
		$formulaire = saisies_verifier_afficher_si($formulaire);
	}

	$saisies = saisies_lister_par_nom($formulaire);
	foreach ($saisies as $saisie) {
		$obligatoire = isset($saisie['options']['obligatoire']) ? $saisie['options']['obligatoire'] : '';
		$champ = $saisie['options']['nom'];
		$file = (($saisie['saisie'] == 'input' and isset($saisie['options']['type']) and $saisie['options']['type'] == 'file') or $saisie['saisie'] == 'fichiers');
		if (isset($saisie['verifier']) and $saisie['verifier']) {
			$verifier = $saisie['verifier'];
		} else {
			$verifier = false;
		}

		// Cas de la saisie 'fichiers':
		if ($file) {
			$infos_fichiers_precedents = _request('cvtupload_fichiers_precedents');
			if (isset($infos_fichiers_precedents[$champ])) { // si on a déjà envoyé des infos avants
				$valeur = $_FILES[$champ]; // on ne met pas true, car il faudra aussi vérifier les nouveaux fichiers du même champ qui viennent d'être envoyés.
			}
			elseif (isset($_FILES[$champ]['error'])) {//si jamais on a déja envoyé quelque chose dans le précédent envoi = ok
				$valeur = null; //On considère que par défaut on a envoyé aucun fichiers

				// Si c'est un champ unique
				if (!is_array($_FILES[$champ]['error']) and $_FILES[$champ]['error'] != 4) {
					$valeur = $_FILES[$champ];
				}
				elseif (is_array($_FILES[$champ]['error'])) {
					foreach ($_FILES[$champ]['error'] as $err) {
						if ($err != 4) {
							//Si un seul fichier a été envoyé, même avec une erreur,
							// on considère que le critère obligatoire est rempli.
							// Il faudrait que verifier/fichiers.php vérifier les autres types d'erreurs.
							// Voir http://php.net/manual/fr/features.file-upload.errors.php
							$valeur = $_FILES[$champ];
							break;
						}
					}
				}
			}
			elseif (!isset($_FILES[$champ])) {
				$valeur = null;
			}
		}
		// Tout type de saisie, sauf fichiers
		else {
			$valeur = saisies_request($champ);
			// Filtrer les tableaux. Ex d'application:
			// - saisie date/heure qui envoi des input texte en tableau > il faut pas que les champs envoyés soient vides
			// - saisie destintaire, qui pourrait avoir une première option vide
			if (is_array($valeur)) {
				$valeur = array_filter($valeur);
			}
		}
		// On regarde d'abord si le champ est obligatoire
		if (
			$obligatoire
			and $obligatoire != 'non'
			and (
				($file and $valeur==null)
				or (!$file and (
					is_null($valeur)
					or (is_string($valeur) and trim($valeur) == '')
					or (is_array($valeur) and count($valeur) == 0)
				))
			)
		) {
			$erreurs[$champ] =
				(isset($saisie['options']['erreur_obligatoire']) and $saisie['options']['erreur_obligatoire'])
				? $saisie['options']['erreur_obligatoire']
				: _T('info_obligatoire');
		}

		// On continue seulement si ya pas d'erreur d'obligation et qu'il y a une demande de verif
		if ((!isset($erreurs[$champ]) or !$erreurs[$champ]) and is_array($verifier) and $verif_fonction) {
			// Si on fait une vérification de type fichiers, il n'y a pas vraiment de normalisation, mais un retour d'erreur fichiers par fichiers
			if ($verifier['type'] == 'fichiers') {
				$normaliser = array();
			} else {
				$normaliser = null;
			}

			// Si le champ n'est pas valide par rapport au test demandé, on ajoute l'erreur
			$options = isset($verifier['options']) ? $verifier['options'] : array();
			if ($erreur_eventuelle = $verif_fonction($valeur, $verifier['type'], $options, $normaliser)) {
				$erreurs[$champ] = $erreur_eventuelle;

				if ($verifier['type'] == 'fichiers') { // Pour les vérification/saisies de type fichiers, ajouter les erreurs détaillées par fichiers dans le tableau des erreurs détaillées par fichier
					$erreurs_fichiers[$champ] = $normaliser;
					if (isset($saisies[$champ]['options']['obligatoire'])) {
						$erreurs[$champ].= "<br />"._T('saisies:fichier_erreur_explication_renvoi_pas_alternative');
					} else {
						$erreurs[$champ].= "<br />"._T('saisies:fichier_erreur_explication_renvoi_alternative');
						}
				}

			}
			// S'il n'y a pas d'erreur et que la variable de normalisation a été remplie, on l'injecte dans le POST
			elseif (!is_null($normaliser) and $verifier['type'] != 'fichiers') {
			// Si le nom du champ est un tableau indexé, il faut parser !
				if (preg_match('/([\w]+)((\[[\w]+\])+)/', $champ, $separe)) {//même regexp que plus haut, sur mêmes variables. Mais je (Maïeul) préfére faire une duplication car c'est vraiment un code éloigné. Des fois qu'un futur commit changerait la valeur de $separe entre les deux...
					$nom_champ_principal = $separe[1];
					$champ_principal  = _request($nom_champ_principal);
					$enfant = &$champ_principal;
					preg_match_all('/\[([\w]+)\]/', $separe[2], $index);
					// On va chercher au fond du tableau
					foreach ($index[1] as $cle) {
						$enfant = &$enfant[$cle];
					}
					// Une fois descendu tout en bas, on normalise
					$enfant = $normaliser;
					// Et on reinjecte le tout
					set_request($nom_champ_principal,$champ_principal);
				} else {
					// Sinon la valeur est juste celle du nom
					set_request($champ, $normaliser);
				}
			}
		}
	}
	// Vérifier que les valeurs postées sont acceptables, à savoir par exemple que pour un select, ce soit ce qu'on a proposé.
	if (isset($formulaire['options']['verifier_valeurs_acceptables'])
		and $formulaire['options']['verifier_valeurs_acceptables']
	) {
		$erreurs = saisies_verifier_valeurs_acceptables($saisies, $erreurs);
	}

	// Last but not least, on passe nos résultats à un pipeline
	$erreurs = pipeline(
		'saisies_verifier',
		array(
			'args'=>array(
				'formulaire' => $formulaire,
				'saisies' => $saisies,
				'erreurs_fichiers' => $erreurs_fichiers,
			),
			'data' => $erreurs
		)
	);

	return $erreurs;
}

/**
 * Vérifier que les valeurs postées sont acceptables,
 * c'est-à-dire qu'elles ont été proposées lors de la conception de la saisie.
 * Typiquement pour une saisie radio, vérifier que les gens n'ont pas postée une autre fleur.
 * @param $saisies array tableau général des saisies, déjà aplati, classé par nom de champ
 * @param $erreurs array tableau des erreurs
 * @return array table des erreurs modifiés
**/
function saisies_verifier_valeurs_acceptables($saisies, $erreurs) {
	foreach ($saisies as $saisie => $description) {
		$type = $description['saisie'];

		// Pas la peine de vérifier si par ailleurs il y a déjà une erreur
		if (isset($erreurs[$saisie])) {
			continue;
		}
		//Il n'y a rien à vérifier sur une description / fieldset
		if (in_array($description['saisie'], array('explication','fieldset'))) {
			continue;
		}
		if (include_spip("saisies/$type")) {
			$f = $type.'_valeurs_acceptables';
			if (function_exists($f)) {
				$valeur = saisies_request($saisie);
				if (!$f($valeur, $description)) {
					$erreurs[$saisie] = _T("saisies:erreur_valeur_inacceptable");
					spip_log("Tentative de poste de valeur innaceptable pour $saisie de type $type. Valeur postée : ".print_r(_request($saisie), true), "saisies"._LOG_AVERTISSEMENT);
				}
			} else {
				spip_log("Pas de fonction de vérification pour la saisie $saisie de type $type", "saisies"._LOG_INFO);
			}
		} else {
			spip_log("Pas de fonction de vérification pour la saisie $saisie de type $type", "saisies"._LOG_INFO);
		}
	}
	return $erreurs;
}

/**
 * Trouve le résultat d'une saisie (_request())
 * en tenant compte du fait que la saisie peut être décrit sous forme de sous entrées d'un tableau
 * 
 * @todo Prendre en compte aussi la notation champ/index/index
 * @todo Prendre un arg en plus pour chercher dans un autre tableau que le GET/POST
 * @param string $champ
 * 		Nom du champ de la saisie, y compris avec crochets pour sous entrées
 * @return string|array
 * 		Résultat du _request()
**/
function saisies_request($champ) {
	if (preg_match('/([\w]+)((\[[\w]+\])+)/', $champ, $separe)) {
		$valeur = _request($separe[1]);
		preg_match_all('/\[([\w]+)\]/', $separe[2], $index);
		// On va chercher au fond du tableau
		foreach ($index[1] as $cle) {
			$valeur = isset($valeur[$cle]) ? $valeur[$cle] : null;
		}
	} else {
		// Sinon la valeur est juste celle du champ
		$valeur = _request($champ);
	}
	
	return $valeur;
}

/**
 * Modifie la valeur d'un saisie postée en tenant compte que ça puisse être un tableau
 * 
 * @todo Prendre en compte aussi la notation champ/index/index
 * @todo Prendre un arg en plus pour enregistrer la valeur dans un autre tableau que le GET/POST
 * @param string $nom
 * 		Nom du champ
 * @param $valeur
 * 		Valeur à remplir dans le request
 * @return void
 */
function saisies_set_request($champ, $valeur) {
	// Si on détecte que c'est un tableau[index][index]
	if (preg_match('/([\w]+)((\[[\w]+\])+)/', $champ, $separe)) {
		$nom_champ_principal = $separe[1];
		$champ_principal  = _request($nom_champ_principal);
		$enfant = &$champ_principal;
		
		// On va chercher au fond du tableau
		preg_match_all('/\[([\w]+)\]/', $separe[2], $index);
		foreach ($index[1] as $cle) {
			$enfant = &$enfant[$cle];
		}
		// Une fois descendu tout en bas, on met la valeur
		$enfant = $valeur;
		// Et on reinjecte le tout
		set_request($nom_champ_principal, $champ_principal);
	}
	// Sinon la valeur est juste celle du nom
	else {
		set_request($champ, $valeur);
	}
}

/**
 * Trouve le champ datas ou datas (pour raison historique)
 * parmis les paramètres d'une saisie
 * et le retourne après avoir l'avoir transformé en tableau si besoin
 * @param array $description description de la saisie
 * @bool $disable_choix : si true, supprime les valeurs contenu dans l'option disable_choix des data
 * @return array data
**/
function saisies_trouver_data($description, $disable_choix = false) {
	$options = $description['options'];
	if (isset($options['data'])) {
		$data = $options['data'];
	} elseif (isset($options['datas'])) {
		$data = $options['datas'];
	} else {
		$data = array();//normalement on peut pas mais bon
	}
	$data = saisies_chaine2tableau($data);

	if ($disable_choix == true and isset($options['disable_choix'])) {
		$disable_choix = array_flip(explode(',',$options['disable_choix']));
		$data = array_diff_key($data,$disable_choix);
	}
	return $data;
}

/**
 * Aplatit une description tabulaire en supprimant les sous-groupes.
 * Ex : les data d'une saisie de type select
 *
 * @param array $tab            Le tableau à aplatir
 * @param bool  $montrer_groupe mettre à false pour ne pas montrer le sous-groupe dans les label humain
 *
 * @return array
 */
function saisies_aplatir_tableau($tab, $montrer_groupe = true) {
	$nouveau_tab = array();

	foreach ($tab as $entree => $contenu) {
		if (is_array($contenu)) {
			foreach ($contenu as $cle => $valeur) {
				if ($montrer_groupe) {
					$nouveau_tab[$cle] = _T('saisies:saisies_aplatir_tableau_montrer_groupe', array('valeur' => $valeur, 'groupe' => $entree));
				} else {
					$nouveau_tab[$cle] = $valeur;
				}
			}
		} else {
			$nouveau_tab[$entree] = $contenu;
		}
	}

	return $nouveau_tab;
}

/**
 * Aplatit une description chaînée, en supprimant les sous-groupes.
 * @param string $chaine La chaîne à aplatir
 * @return $chaine
 */
function saisies_aplatir_chaine($chaine) {
	return trim(preg_replace("#(?:^|\n)(\*(?:.*)|/\*)\n#i", "\n", $chaine));
}

/**
 * Transforme une chaine en tableau avec comme principe :
 *
 * - une ligne devient une case
 * - si la ligne est de la forme truc|bidule alors truc est la clé et bidule la valeur
 * - si la ligne commence par * alors on commence un sous-tableau
 * - si la ligne est égale à /*, alors on fini le sous-tableau
 *
 * @param string $chaine Une chaine à transformer
 * @param string $separateur Séparateur utilisé
 * @return array Retourne un tableau PHP
 */
function saisies_chaine2tableau($chaine, $separateur = "\n") {
	if ($chaine and is_string($chaine)) {
		$tableau = array();
		$soustab = false;

		// On découpe d'abord en lignes
		$lignes = explode($separateur, $chaine);
		foreach ($lignes as $i => $ligne) {
			$ligne = trim(trim($ligne), '|');
			// Si ce n'est pas une ligne sans rien
			if ($ligne !== '') {
				// si ca commence par * c'est qu'on va faire un sous tableau
				if (strpos($ligne, '*') === 0) {
					$soustab=true;
					$soustab_cle = _T_ou_typo(substr($ligne, 1), 'multi');
					if (!isset($tableau[$soustab_cle])) {
						$tableau[$soustab_cle] = array();
					}
				} elseif ($ligne == '/*') {//si on finit sous tableau
					$soustab=false;
				} else {
					//sinon c'est une entrée normale
					// Si on trouve un découpage dans la ligne on fait cle|valeur
					if (strpos($ligne, '|') !== false) {
						list($cle,$valeur) = explode('|', $ligne, 2);
						// permettre les traductions de valeurs au passage
						if ($soustab == true) {
							$tableau[$soustab_cle][$cle] = _T_ou_typo($valeur, 'multi');
						} else {
							$tableau[$cle] = _T_ou_typo($valeur, 'multi');
						}
					} else {
						// Sinon on génère la clé
						if ($soustab == true) {
							$tableau[$soustab_cle][$i] = _T_ou_typo($ligne, 'multi');
						} else {
							$tableau[$i] = _T_ou_typo($ligne, 'multi');
						}
					}
				}
			}
		}
		return $tableau;
	}
	elseif (is_array($chaine)) {
		// Si c'est déjà un tableau on lui applique _T_ou_typo (qui fonctionne de manière récursive avant de le renvoyer
		return _T_ou_typo($chaine, 'multi');
	}
	else {
		return array();
	}
}

/**
 * Transforme un tableau en chaine de caractères avec comme principe :
 *
 * - une case de vient une ligne de la chaine
 * - chaque ligne est générée avec la forme cle|valeur
 * - si une entrée du tableau est elle même un tableau, on met une ligne de la forme *clef
 * - pour marquer que l'on quitte un sous-tableau, on met une ligne commencant par /*, sauf si on bascule dans un autre sous-tableau.
 *
 * @param array $tableau Tableau à transformer
 * @return string Texte représentant les données du tableau
 */
function saisies_tableau2chaine($tableau) {
	if ($tableau and is_array($tableau)) {
		$chaine = '';
		$avant_est_tableau = false;

		foreach ($tableau as $cle => $valeur) {
			if (is_array($valeur)) {
				$avant_est_tableau = true;
				$ligne=trim("*$cle");
				$chaine .= "$ligne\n";
				$chaine .= saisies_tableau2chaine($valeur)."\n";
			} else {
				if ($avant_est_tableau == true) {
					$avant_est_tableau = false;
					$chaine.="/*\n";
				}
				$ligne = trim("$cle|$valeur");
				$chaine .= "$ligne\n";
			}
		}
		$chaine = trim($chaine);

		return $chaine;
	}
	elseif (is_string($tableau)) {
		// Si c'est déjà une chaine on la renvoie telle quelle
		return $tableau;
	}
	else {
		return '';
	}
}

/**
 * Transforme une valeur en tableau d'élements si ce n'est pas déjà le cas
 *
 * @param mixed $valeur
 * @return array Tableau de valeurs
**/
function saisies_valeur2tableau($valeur, $data=array()) {
	$tableau = array();
	
	if (is_array($valeur)) {
		$tableau = $valeur;
	}
	elseif (strlen($valeur)) {
		$tableau = saisies_chaine2tableau($valeur);
		
		// Si qu'une seule valeur, c'est qu'elle a peut-être un separateur à virgule
		// et a donc une clé 0 dans ce cas la d'ailleurs
		if (count($tableau) == 1 and isset($tableau[0])) {
			$tableau = saisies_chaine2tableau($tableau[0], ',');
		}
	}
	
	// On vérifie la pertinence des valeurs pour s'assurer d'avoir le choix alternatif dans sa clé à part
	if (is_array($data) and $data) {
		foreach ($tableau as $cle => $valeur) {
			if (!in_array($valeur, array_keys($data))) {
				$choix_alternatif = $valeur;
				unset($tableau[$cle]);
				$tableau['choix_alternatif'] = $valeur;
			}
		}
	}
	
	return $tableau;
}

/**
 * Pour les saisies multiples (type checkbox) proposant un choix alternatif,
 * retrouve à partir des data de choix proposés
 * et des valeurs des choix enregistrés
 * le texte enregistré pour le choix alternatif.
 *
 * @param array $data
 * @param array $valeur
 * @return string choix_alternatif
**/
function saisies_trouver_choix_alternatif($data, $valeur) {
	if (!is_array($valeur)) {
		$valeur = saisies_valeur2tableau($valeur);
	}
	if (!is_array($data)) {
		$data = saisies_chaine2tableau($data) ;
	}

	$choix_theorique = array_keys($data);
	$choix_alternatif = array_values(array_diff($valeur, $choix_theorique));
	if (isset($choix_alternatif[0])) {
		return $choix_alternatif[0]; //on suppose que personne ne s'est amusé à proposer deux choix alternatifs
	} else {
		return '';
	}
}

/**
 * Génère une page d'aide listant toutes les saisies et leurs options
 *
 * Retourne le résultat du squelette `inclure/saisies_aide` auquel
 * on a transmis toutes les saisies connues.
 *
 * @return string Code HTML
 */
function saisies_generer_aide() {
	// On a déjà la liste par saisie
	$saisies = saisies_lister_disponibles('saisies',false);

	// On construit une liste par options
	$options = array();
	foreach ($saisies as $type_saisie => $saisie) {
		$options_saisie = saisies_lister_par_nom($saisie['options'], false);
		foreach ($options_saisie as $nom => $option) {
			// Si l'option n'existe pas encore
			if (!isset($options[$nom])) {
				$options[$nom] = _T_ou_typo($option['options']);
			}
			// On ajoute toujours par qui c'est utilisé
			$options[$nom]['utilisee_par'][] = $type_saisie;
		}
		ksort($options_saisie);
		$saisies[$type_saisie]['options'] = $options_saisie;
	}
	ksort($options);

	return recuperer_fond(
		'inclure/saisies_aide',
		array(
			'saisies' => $saisies,
			'options' => $options
		)
	);
}

/**
 * Le tableau de saisies a-t-il une option afficher_si ?
 *
 * @param array $saisies Un tableau de saisies
 * @return boolean
 */
function saisies_afficher_si($saisies) {
	$saisies = saisies_lister_par_nom($saisies, true);

	// Dès qu'il y a au moins une option afficher_si, on l'active
	foreach ($saisies as $saisie) {
		if (isset($saisie['options']['afficher_si'])) {
			return true;
		}
	}

	return false;
}


