<?php
/**
 * Fichier gérant les importations en base de donnée.
 *
 * @plugin     Donnés géométriques continents
 * @copyright  2018
 * @author     Rainer Müller
 * @licence    GNU/GPL
 * @package    SPIP\Continents_geo_data\Base
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Ajoute les donnes geométriques aux continents.
 */
function peupler_pays_geo() {
	include_spip('gisgeom_fonctions');

	// Les sources
	$points = json_decode(
		file_get_contents(__DIR__ . '/../data/countries.json', TRUE),
		TRUE);
	$polygons_medium = json_decode(
		file_get_contents(__DIR__ . '/../data/polygons-medium-resolution.json', TRUE),
		TRUE);
	$polygons_high = json_decode(
		file_get_contents(__DIR__ . '/../data/polygons-high-resolution.json', TRUE),
		TRUE);

	// Compiler un tableau code_iso_alpha2 => latlon
	$points_code = [];
	foreach ($points AS $values) {
		$points_code[$values['cca2']] = $values['latlng'];
	}

	// Compiler un tableau code_iso_alpha2 => polygon
	$polygons_high_code = [];
	foreach ($polygons_high AS $values) {
		$polygons_high_code[$values['properties']['iso_a2']] = $values['geometry'];
	}

	// Actualiser les pays avec les points et polygons.
	foreach($polygons_medium['features'] AS $values) {
		$code_iso_a2 = $values['properties']['iso_a2'];
		list($lat, $lon) = $points_code[$code_iso_a2];

		$wkt = FALSE;
		if (isset($values['geometry'])) {
			$wkt = json_to_wkt(json_encode($values['geometry']));

		}
		elseif (isset($polygons_high_code[$code_iso_a2])) {
			$wkt = json_to_wkt(json_encode($polygons_high_code[$code_iso_a2]));
		}

		$set = array(
			'lat' => $lat,
			'lon' => $lon,
		);

		if ($wkt and $geo = sql_getfetsel("GeomFromText('$wkt')")) {
			$set['geo'] = $geo;
		}

		sql_updateq('spip_pays', $set, 'code LIKE ' . sql_quote($code_iso_a2));
	}
}