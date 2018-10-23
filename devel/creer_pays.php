<?php
//header("Content-Type: text/json; charset=utf-8");
$polygones = json_decode(file_get_contents('../data/polygons-high-resolution.json'), TRUE);

foreach($polygones['features'] AS $feature){
	$code_iso_a2 = $feature['properties']['iso_a2'];
	$country = [
		"type" => "FeatureCollection",
		"features" => [
			$feature
		]
	];

	$fp = fopen("../data/countries/$code_iso_a2.geojson", 'w') or die("Unable to open file!");
	fwrite($fp, json_encode($country, JSON_UNESCAPED_UNICODE));
	fclose($fp);
}

