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

// Fix the fact that Magic quotes is on by default and BREAKS THE FREAKING OAUTH PLUGIN. WTF.
add_action('init', function() {
	$_GET = stripslashes_deep( $_GET );
});

register_post_type( 'book', array(
	'labels' => array(
		'name'          => __( 'Books', 'booktrackr' ),
		'singular_name' => __( 'Book',  'booktrackr' ),
	),
	'public' => false,
	'capability_type' => 'post',
	'map_meta_cap' => true,
	'hierarchical' => false,
	'rewrite' => false,
	'query_var' => false,
	'delete_with_user' => true,
	'show_in_rest' => true,
	'rest_base' => 'books',
	'rest_controller_class' => 'WP_REST_Posts_Controller',
	'supports' => array( 'title', 'comments', 'editor', 'featured_image' ),
) );

// Make sure cross origin requests are allowed.
// this is more insecure than you would typically use
// in a production environment.

add_filter( 'rest_pre_serve_request', function() {
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
		header( "Access-Control-Allow-Origin: *" );
		header( "Access-Control-Allow-Headers: Authorization,Content-Type" );
	}
}, 20); // We use a 20 so that this overrides the origin in the wp-api plugin which only works against self.
