<?php

/*
 * Squelette : ../prive/squelettes/navigation/dist.html
 * Date :      Thu, 05 Nov 2020 10:50:01 GMT
 * Compile :   Sun, 07 Feb 2021 04:37:36 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../prive/squelettes/navigation/dist.html
// Temps de compilation total: 2.897 ms
//

function html_f8df831bb93ba3e16996f41a32b897ec($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
(($t1 = strval(interdire_scripts(((match(entites_html(table_valeur(@$Pile[0], (string)'exec', null),true),'configurer_')) ?' ' :''))))!=='' ?
		($t1 . (	'
' .
	
'<'.'?php echo recuperer_fond( ' . argumenter_squelette('prive/squelettes/navigation/configurer') . ', array_merge('.var_export($Pile[0],1).',array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'../prive/squelettes/navigation/dist.html\',\'html_f8df831bb93ba3e16996f41a32b897ec\',\'\',2,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
')) :
		'') .
'
' .
vide($Pile['vars'][$_zzz=(string)'objet_exec'] = interdire_scripts(trouver_objet_exec(entites_html(table_valeur(@$Pile[0], (string)'exec', null),true)))) .
((table_valeur($Pile["vars"], (string)'objet_exec', null))  ?
		(' ' . (	'
	' .
	vide($Pile['vars'][$_zzz=(string)'f'] = (table_valeur(table_valeur($Pile["vars"], (string)'objet_exec', null),'edition') ? 'objet_edit':'objet')) .
	
'<'.'?php echo recuperer_fond( ' . argumenter_squelette((	'prive/echafaudage/navigation/' .
		table_valeur($Pile["vars"], (string)'f', null))) . ', array_merge('.var_export($Pile[0],1).',array(\'objet\' => ' . argumenter_squelette(table_valeur(table_valeur($Pile["vars"], (string)'objet_exec', null),'type')) . ',
	\'id_objet\' => ' . argumenter_squelette(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)table_valeur(table_valeur($Pile["vars"], (string)'objet_exec', null),'id_table_objet'), null),true))) . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'../prive/squelettes/navigation/dist.html\',\'html_f8df831bb93ba3e16996f41a32b897ec\',\'\',5,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
')) :
		''));

	return analyse_resultat_skel('html_f8df831bb93ba3e16996f41a32b897ec', $Cache, $page, '../prive/squelettes/navigation/dist.html');
}
?>