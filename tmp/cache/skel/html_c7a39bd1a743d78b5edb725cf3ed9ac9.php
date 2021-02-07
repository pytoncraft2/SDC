<?php

/*
 * Squelette : squelettes/inclure/scroll.html
 * Date :      Sat, 02 Jan 2021 03:47:21 GMT
 * Compile :   Sun, 07 Feb 2021 04:14:40 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette squelettes/inclure/scroll.html
// Temps de compilation total: 0.208 ms
//

function html_c7a39bd1a743d78b5edb725cf3ed9ac9($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = '<div class="buttonsScroll">
	<div class="Up" id="slideTop"><span class="lnr lnr-chevron-up"></span></div>
	<div class="Up" onclick="toTop()"><span class="lnr lnr-arrow-up-circle"></span></div>
	<div class="Up" id="slideBottom"><span class="lnr lnr-chevron-down"></span></div>
</div>
	<script>

    const buttonRight = document.getElementById(\'slideTop\');
    const buttonLeft = document.getElementById(\'slideBottom\');

    buttonRight.onclick = function () {
      document.querySelector(\'html\').scrollTop -= 600;
    };
    buttonLeft.onclick = function () {
      document.querySelector(\'html\').scrollTop += 600;
    };

function toTop() {

window.scrollTo(0, 0);
}

	</script>
';

	return analyse_resultat_skel('html_c7a39bd1a743d78b5edb725cf3ed9ac9', $Cache, $page, 'squelettes/inclure/scroll.html');
}
?>