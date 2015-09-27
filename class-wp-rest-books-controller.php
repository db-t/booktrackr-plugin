<?php

class WP_REST_Books_Controller extends WP_REST_Posts_Controller {

	/**
	 * Get the Book's schema, conforming to JSON Schema
	 *
	 * This is a modification to make sure that we are returning raw values, to avoid double encoding issues.
	 *
	 * @return array
	 */
	public function get_item_schema() {

		$schema = parent::get_item_schema();

		$fields = array('title', 'guid', 'content');

		foreach ($fields as $field) {
			$schema['properties'][$field]['properties']['raw']['context'][] = 'view';
			unset($schema['properties'][$field]['properties']['rendered']);
		}

		return $schema;
	}

	/**
	 * Prepare links for the request.
	 *
	 * @param WP_Post $post Post object.
	 * @return array Links for the given post.
	 */
	protected function prepare_links( $post ) {
		$links = parent::prepare_links( $post );

		$base = '/wp/v2/' . $this->get_post_type_base( $this->post_type );

		// We're manually adding this, because we're going to create our own meta endpoint.
		$links['http://v2.wp-api.org/meta'] = array(
			'href' => rest_url( trailingslashit( $base ) . $post->ID . '/meta' ),
			'embeddable' => true,
		);

		return $links;
	}
}
