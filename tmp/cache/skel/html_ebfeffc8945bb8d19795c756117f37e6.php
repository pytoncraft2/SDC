<?php

/*
 * Squelette : squelettes/contact.html
 * Date :      Sun, 07 Feb 2021 04:24:21 GMT
 * Compile :   Sun, 07 Feb 2021 04:29:24 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette squelettes/contact.html
// Temps de compilation total: 2.907 ms
//

function html_ebfeffc8945bb8d19795c756117f37e6($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<!DOCTYPE html>
<html lang="fr" >

<head>
' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/head') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'squelettes/contact.html\',\'html_ebfeffc8945bb8d19795c756117f37e6\',\'\',5,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
</head>


<body>
        <header>

                <div class="headE">SCOUTS DU CAMEROUN</div>
                <div class="triH"></div>
                <div class="triH2"></div>
        </header>
<h2 class="Bienvenue">' .
interdire_scripts(supprimer_numero(typo(@$Pile[0]['titre']), "TYPO", $connect, $Pile[0])) .
' </h2>
	<div class="center-imagev2">
	<div class="logoAcc">' .
filtrer('image_graver',filtrer('image_reduire',
((!is_array($l = quete_logo('id_syndic', 'ON', "'0'",'', 0))) ? '':
 ("<img class=\"spip_logo spip_logos\" alt=\"\" src=\"$l[0]\"" . $l[2] .  ($l[1] ? " onmouseover=\"this.src='$l[1]'\" onmouseout=\"this.src='$l[0]'\"" : "") . ' />')),'224','96')) .
'</div>
	</div>

' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/navigation') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'squelettes/contact.html\',\'html_ebfeffc8945bb8d19795c756117f37e6\',\'\',21,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>' .
'

	<div class="section">


		<article>

                        <h3>Où sommes nous ?</h3>
			<div class="centrerMap">
				<div class="blockMap">
        <div id="map">

     <!-- Ici s\'affichera la carte -->
 </div>
	</div>
			</div>

        <!-- Fichiers Javascript -->
        <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
 <script>


var villes = {
 "Paris": { "lat": 3.8667, "lon": 11.5167 },
};







            // On initialise la latitude et la longitude de Paris (centre de la carte)
            var lat = 3.8667;
            var lon = 11.5167;
            var macarte = null;
            // Fonction d\'initialisation de la carte
            function initMap() {
                // Créer l\'objet "macarte" et l\'insèrer dans l\'élément HTML qui a l\'ID "map"
                macarte = L.map(\'map\').setView([lat, lon], 11);
                // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
                L.tileLayer(\'https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png\', {
                    // Il est toujours bien de laisser le lien vers la source des données
                    attribution: \'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>\',
                    minZoom: 1,
                    maxZoom: 20
                }).addTo(macarte);
            }
            window.onload = function(){
  // Fonction d\'initialisation qui s\'exécute lorsque le DOM est chargé
  initMap(); 
            };

function initMap() {
 // Créer l\'objet "macarte" et l\'insèrer dans l\'élément HTML qui a l\'ID "map"
 macarte = L.map(\'map\').setView([lat, lon], 11);
 // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
 L.tileLayer(\'https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png\', {
  // Il est toujours bien de laisser le lien vers la source des données
  attribution: \'données © OpenStreetMap/ODbL - rendu OSM France\',
  minZoom: 1,
  maxZoom: 20
 }).addTo(macarte);
 // Nous parcourons la liste des villes
 for (ville in villes) {
  var marker = L.marker([villes[ville].lat, villes[ville].lon]).addTo(macarte);
 }                
}

        </script>

                        <h3>Des Questions ?</h3>
                        <h3>Contactez-nous !</h3>

                        <div class="formulaire">
                                <form>
                                        
                                        <p><input type="text"  placeholder="Prénom"></p>
                                        <p><input type="text"  placeholder="Noms"></p>
                                        <p><input type="email"  placeholder="E-mail"></p>
                                        <p><input type="tel"  placeholder="Téléphone"></p>
                                        <p><textarea  placeholder="Votre message"></textarea></p>



                                </form>

                        </div>
                </article> 

        </div>


' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/scroll') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'squelettes/contact.html\',\'html_ebfeffc8945bb8d19795c756117f37e6\',\'\',114,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
                                        
' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/footer') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'squelettes/contact.html\',\'html_ebfeffc8945bb8d19795c756117f37e6\',\'\',116,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
</body>
</html>
');

	return analyse_resultat_skel('html_ebfeffc8945bb8d19795c756117f37e6', $Cache, $page, 'squelettes/contact.html');
}
?>