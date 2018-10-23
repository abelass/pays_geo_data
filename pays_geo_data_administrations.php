<?php
/**
 * Fichier gérant l'installation et désinstallation du plugin Donnés géométriques pays
 *
 * @plugin     Donnés géométriques pays
 * @copyright  2018
 * @author     Rainer Müller
 * @licence    GNU/GPL v3
 * @package    SPIP\Pays_geo_data\Installation
 */
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Fonction d'installation et de mise à jour du plugin Donnés géométriques pays.
 *
 * Vous pouvez :
 *
 * - créer la structure SQL,
 * - insérer du pre-contenu,
 * - installer des valeurs de configuration,
 * - mettre à jour la structure SQL
 *
 * @param string $nom_meta_base_version
 *        	Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @param string $version_cible
 *        	Version du schéma de données dans ce plugin (déclaré dans paquet.xml)
 * @return void
 */
function pays_geo_data_upgrade($nom_meta_base_version, $version_cible) {
	include_spip('base/upgrade');
	include_spip('base/peupler_pays_geo');

	$maj = array();

	$maj['create'] = array(
		array(
			'maj_tables',
			array(
				'spip_pays',
			)
		),
		array(
			'sql_alter',
			'TABLE spip_pays ADD geo GEOMETRY AFTER lon'
		),
		array(
			'peupler_pays_geo'
		),
		array(
			'sql_alter',
			'TABLE spip_pays CHANGE COLUMN geo geo GEOMETRY NOT NULL'
		),
		array(
			'sql_alter',
			'TABLE spip_pays ADD SPATIAL INDEX (geo)'
		)
	);

	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}

/**
 * Fonction de désinstallation du plugin Donnés géométriques pays.
 *
 * Vous devez :
 *
 * - nettoyer toutes les données ajoutées par le plugin et son utilisation
 * - supprimer les tables et les champs créés par le plugin.
 *
 * @param string $nom_meta_base_version
 *        	Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @return void
 */
function pays_geo_data_vider_tables($nom_meta_base_version) {
	// quelques exemples
	// (que vous pouvez supprimer !)
	// sql_drop_table('spip_xx');
	// sql_drop_table('spip_xx_liens');
	effacer_meta($nom_meta_base_version);
}
