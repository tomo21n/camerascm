<?php
// Bootstrap the framework DO NOT edit this
require COREPATH.'bootstrap.php';


Autoloader::add_classes(array(
	// Add classes you want to override here
	// Example: 'View' => APPPATH.'classes/view.php',
));
//Autoloader::add_namespace('EbaySDK', APPPATH.'vendor/dts/ebay-sdk/src/DTS', true);
Autoloader::add_namespace('EbaySDKtrading', VENDORPATH.'dts/ebay-sdk-trading/src/DTS', true);
Autoloader::add_namespace('DTS', VENDORPATH.'dts/ebay-sdk-finding/src/DTS', true);

// Register the autoloader
Autoloader::register();

/**
 * Your environment.  Can be set to any of the following:
 *
 * Fuel::DEVELOPMENT
 * Fuel::TEST
 * Fuel::STAGING
 * Fuel::PRODUCTION
 */
Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : Fuel::DEVELOPMENT);

// Initialize the framework with the config file.
Fuel::init('config.php');
