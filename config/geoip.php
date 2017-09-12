<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Service
	|--------------------------------------------------------------------------
	|
	| Current only supports 'maxmind'.
	|
	*/

	'service' => 'maxmind',

	/*
	|--------------------------------------------------------------------------
	| Services settings
	|--------------------------------------------------------------------------
	|
	| Service specific settings.
	|
	*/

	'maxmind' => array(
		'type'          => env('GEOIP_DRIVER', 'database'), // database or web_service
		'user_id'       => env('GEOIP_USER_ID'),
		'license_key'   => env('GEOIP_LICENSE_KEY'),
		'database_path' => storage_path('app/geoip.mmdb'),
		'update_url'    => 'https://www.maxmind.com/app/geoip_download?edition_id=GeoIP2-City&date=20140923&suffix=tar.gz&license_key=Ny45YCAGWTR7',
	),

	/*
	|--------------------------------------------------------------------------
	| Default Location
	|--------------------------------------------------------------------------
	|
	| Return when a location is not found.
	|
	*/

	'default_location' => array (
		"ip"           => "127.0.0.0",
		"isoCode"      => "US",
		"country"      => "United States",
		"city"         => "New Haven",
		"state"        => "CT",
		"postal_code"  => "06510",
		"lat"          => 41.31,
		"lon"          => -72.92,
		"timezone"     => "America/New_York",
		"continent"    => "NA",
	),

);