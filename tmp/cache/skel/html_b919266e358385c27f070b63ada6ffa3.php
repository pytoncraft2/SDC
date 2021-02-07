<?php

/*
 * Squelette : squelettes/inclure/navigation.html
 * Date :      Sun, 07 Feb 2021 04:21:02 GMT
 * Compile :   Sun, 07 Feb 2021 04:22:28 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette squelettes/inclure/navigation.html
// Temps de compilation total: 0.218 ms
//

function html_b919266e358385c27f070b63ada6ffa3($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = '
	        <nav id="nav" draggable="true" >

                        <div class="contenus">
				<div id="openMenu">Menu</div>

                                <!--version ordi-->

                                <div class="navOrdi">

                                <a class="e1" href="https://lesscoutsducameroun.sytes.net"><i class="fas fa-home"></i><span class="x"> Acceuil</span></a>

                                <a class="e1" href="https://lesscoutsducameroun.sytes.net/spip.php?article1"><i class="fas fa-users"></i><span class="x"> Notre équipe</span></a>
                                <a class="e1" href="https://lesscoutsducameroun.sytes.net/spip.php?article2"><i class="fas fa-tasks"></i><span class="x"> Nos projets</span></a>
                                <a class="e1" href="https://lesscoutsducameroun.sytes.net/spip.php?article4"><i class="fas fa-layer-group"></i><span class="x"> Les Groupes</span></a>
                                <a class="e1" href="https://lesscoutsducameroun.sytes.net/spip.php?article3"><i class="fas fa-globe-africa"></i><span class="x"> L\'association</span></a>
<a class="e1" href="https://lesscoutsducameroun.sytes.net/jeux.html"><i id="JeuxAnimation" class="fas fa-dice"></i><span class="x"> Jeux</span></a>
<a class="e1" href="https://lesscoutsducameroun.sytes.net/spip.php?page=contact"><i class="fas fa-address-card"></i><span class="x"> Contacts</span></a>



                                </div>

<!--version portable-->

 
                </nav>	
			<div id="quit"></div>
';

	return analyse_resultat_skel('html_b919266e358385c27f070b63ada6ffa3', $Cache, $page, 'squelettes/inclure/navigation.html');
}
?>