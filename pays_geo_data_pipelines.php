<?php
/**
 * Utilisations de pipelines par Donnés géométriques pays
 *
 * @plugin     Donnés géométriques pays
 * @copyright  2018
 * @author     Rainer Müller
 * @licence    GNU/GPL v3
 * @package    SPIP\Pays_geo_data\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Surcharger les boucles PAYS et celles qui comportent le critère gis
 * pour permettre d'accéder à la valeur du champ geo au format WKT (voir balise #GEOMETRY_PAYS)
 *
 * @param $boucle
 * @return mixed
 */
/*function pays_geo_data_pre_boucle($boucle) {
	if ($boucle->type_requete == 'pays' or in_array('pays', $boucle->jointures)) {
		$boucle->select[]= 'AsText(pays.geo) AS geometry_pays';
	}
	return $boucle;
}*/