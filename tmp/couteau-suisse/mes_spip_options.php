<?php
// Code d'inclusion pour le plugin 'Couteau Suisse'
isset($GLOBALS['cs_spip_options'])?$GLOBALS['cs_spip_options']++:$GLOBALS['cs_spip_options']=1;
function autoriser_c_configurer($faire,$type,$id,$qui,$opt) {
	return function_exists('autoriser_cs_configurer_dist')
	?autoriser_cs_configurer_dist($faire, $type, $id, $qui, $opt):true; }
?>