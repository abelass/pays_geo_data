<?php
/**
 * Déclarations relatives à la base de données
 *
 * @plugin     Donnés géométriques pays
 * @copyright  2018
 * @author     Rainer Müller
 * @licence    GNU/GPL v3
 * @package    SPIP\Pays_geo_data\Installation
 */

if (!defined('_ECRIRE_INC_VERSION'))
	return;

/**
 * Déclaration des objets éditoriaux
 *
 * @pipeline declarer_tables_objets_sql
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */

	function pays_geo_data_declarer_tables_objets_sql($tables) {

	//Ajouter les olonnes lat et lon 'a la table pays.
	$tables['spip_pays']['field']['lat'] = 'double NULL NULL';
	$tables['spip_pays']['field']['lon'] = 'double NULL NULL';
	$tables['spip_pays']['champs_editables'][] = "lat";
	$tables['spip_pays']['champs_editables'][] = "lon";

	return $tables;
}
