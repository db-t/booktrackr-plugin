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
}
