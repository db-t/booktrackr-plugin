<?php
/*
Plugin Name: BookTrackr API
Plugin URI:  http://github.com/db-t/booktrackr-api
Description: The API extension for the booktrackr app
Version:     0.1
Author:      Drew Butler
Author URI:  http://dbtlr.com
Text Domain: booktrackr
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( version_compare(phpversion(), '5.4.0', '<' ) ) {
	error_log( 'BookTrackr API requires a minimum PHP version of 5.4.', E_ERROR );
}

if ( ! defined( 'JSON_API_VERSION' ) ) {
	error_log( 'BookTrackr API requires the REST JSON API plugin be loaded.', E_ERROR );
}