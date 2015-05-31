<?php

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

define( 'MWAWSAPI_VERSION', '0.1 alpha' );

$mwawsIP = dirname( __FILE__ );

include_once( "$mwawsIP/api/MWS3_API.php" );

global $wgExtensionCredits;

$wgExtensionCredits['s3creds'][] = array(
	'path' => __FILE__,
	'name' => 'SMWAskAPI',
	'version' => SMWASKAPI_VERSION,
	'author' => array( '[Muhammad Ahsan Ali]' ),
	'url' => 'https://github.com/ahsanali/mwawsCredsAPI/',
	'description' => 'API for fetching aws credentials'
);