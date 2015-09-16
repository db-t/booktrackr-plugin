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



// Load the book controller on init, to make sure that the wp-api plugin is loaded already.
add_action('init', function() {
	require_once 'class-wp-rest-books-controller.php';

	$_GET = stripslashes_deep( $_GET );
	$_POST = stripslashes_deep( $_POST );
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
	'taxonomies' => array('post_tag'),
	'rewrite' => false,
	'query_var' => false,
	'delete_with_user' => true,
	'show_in_rest' => true,
	'rest_base' => 'books',
	'rest_controller_class' => 'WP_REST_Books_Controller',
	'supports' => array( 'title', 'comments', 'editor', 'thumbnail', 'custom-fields' ),
) );

register_taxonomy( 'genre', 'book', array(
	'hierarchical' => false,
	'query_var' => 'genre',
	'rewrite' => false,
	'public' => true,
	'show_ui' => false,
	'show_admin_column' => false,
	'show_in_rest' => true,
	'rest_base' => 'genre',
	'rest_controller_class' => 'WP_REST_Terms_Controller',
) );

// Make sure cross origin requests are allowed.
// this is more insecure than you would typically use
// in a production environment.

add_filter( 'rest_pre_serve_request', function() {
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
		header( "Access-Control-Allow-Origin: *" );
		header( "Access-Control-Allow-Headers: Authorization,Content-Type,Content-Disposition" );
	}
}, 20); // We use a 20 so that this overrides the origin in the wp-api plugin which only works against self.

