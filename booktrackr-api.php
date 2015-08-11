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
	'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes', 'custom-fields', 'comments' ),
) );

register_post_type( 'book_highlight', array(
	'labels' => array(
		'name'          => __( 'Highlights', 'booktrackr' ),
		'singular_name' => __( 'Book',  'booktrackr' ),
	),
	'public' => false,
	'capability_type' => 'post',
	'map_meta_cap' => true,
	'hierarchical' => true,
	'rewrite' => false,
	'query_var' => false,
	'delete_with_user' => true,
	'supports' => array( 'title', 'editor', 'author', 'page-attributes', 'custom-fields', 'comments' ),
) );

register_post_type( 'book_review', array(
	'labels' => array(
		'name'          => __( 'Books', 'booktrackr' ),
		'singular_name' => __( 'Book',  'booktrackr' ),
	),
	'public' => false,
	'capability_type' => 'post',
	'map_meta_cap' => true,
	'hierarchical' => true,
	'rewrite' => false,
	'query_var' => false,
	'delete_with_user' => true,
	'supports' => array( 'title', 'editor', 'author', 'page-attributes', 'custom-fields', 'comments' ),
) );