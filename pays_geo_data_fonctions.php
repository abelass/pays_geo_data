<?php
/**
 * Fonctions utiles au plugin Donnés géométriques pays
 *
 * @plugin     Donnés géométriques pays
 * @copyright  2018
 * @author     Rainer Müller
 * @licence    GNU/GPL v3
 * @package    SPIP\Pays_geo_data\Fonctions
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

function balise_geometry_pays_dist($p) {
	$p->code = '$Pile[$SP][\'geometry_pays\']';
	return $p;
}

/*
 * Un fichier de fonctions permet de définir des éléments
 * systématiquement chargés lors du calcul des squelettes.
 *
 * Il peut par exemple définir des filtres, critères, balises, …
 *
 */
