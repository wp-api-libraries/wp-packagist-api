<?php
/**
 * WP Packagist API (https://packagist.org/apidoc)
 *
 * @package WP-Packagist-API
 */

/*
Plugin Name: WP Enerscore API
Plugin URI: https://github.com/wp-api-libraries/wp-packagist-api
Description: Perform API requests to packagist in WordPress.
Author: WP API Libraries
Version: 1.0.0
Text Domain: wp-packagist-api
Author URI: https://wp-api-libraries.com/
GitHub Plugin URI: https://github.com/wp-api-libraries/wp-packagist-api
GitHub Branch: master
*/

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Check if class exists. */
if ( ! class_exists( 'PackagistAPI' ) ) {

	/**
	 * PackagistAPI class.
	 */
	class PackagistAPI {

		 /**
		  * URL to the API.
		  *
		  * @var string
		  */
		private $base_uri = 'https://packagist.org';

		/**
		 * __construct function.
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {
		}

		 /**
		  * Fetch the request from the API.
		  *
		  * @access private
		  * @param mixed $request Request URL.
		  * @return $body Body.
		  */
		private function fetch( $request ) {
			$response = wp_remote_get( $request );
			$code = wp_remote_retrieve_response_code( $response );
			if ( 200 !== $code ) {
				return new WP_Error( 'response-error', sprintf( __( 'Server response code: %d', 'wp-packagist-api' ), $code ) );
			}
			$body = wp_remote_retrieve_body( $response );
			return json_decode( $body );
		}

		/**
		 * Get All Packages.
		 *
		 * @access public
		 * @return Json Array of Packages.
		 */
		public function get_all_packages() {

			$request = $this->base_uri . '/packages/list.json';
			return $this->fetch( $request );

		}

		/**
		 * Get Packages by Organization.
		 *
		 * @access public
		 * @param mixed $org Organization.
		 * @return Json Array of Packages.
		 */
		public function get_packages_by_org( $org ) {

			if ( empty( $org ) ) {
				return new WP_Error( 'required-fields', __( 'Please provide an organization name.', 'wp-packagist-api' ) );
			}

			$request = $this->base_uri . '/packages/list.json?vendor=' . $org ;
			return $this->fetch( $request );
		}

		/**
		 * Get Package by Type.
		 *
		 * @access public
		 * @param mixed $type Type.
		 * @return Json Array of Packages.
		 */
		public function get_packages_by_type( $type ) {

			if ( empty( $type ) ) {
				return new WP_Error( 'required-fields', __( 'Please provide a package type.', 'wp-packagist-api' ) );
			}

			$request = $this->base_uri . '/packages/list.json?type=' . $type ;
			return $this->fetch( $request );

		}

		/**
		 * Search Packages.
		 *
		 * @access public
		 * @param mixed  $query Query.
		 * @param string $tag (default: '') Tag.
		 * @param string $type (default: '') Type.
		 * @return Json Array of Packages.
		 */
		public function search_packages( $query, $tag = '', $type = '' ) {

			if ( empty( $query ) ) {
				return new WP_Error( 'required-fields', __( 'Please provide something to search.', 'wp-packagist-api' ) );
			}

			$request = $this->base_uri . '/search.json?q=' . $query . '&tags=' . $tag . '&type=' . $type;
			return $this->fetch( $request );
		}

		/**
		 * Search Packages by Name.
		 *
		 * @access public
		 * @param mixed $query Query.
		 * @return Json Array of Packages.
		 */
		public function search_packages_by_name( $query ) {

			if ( empty( $query ) ) {
				return new WP_Error( 'required-fields', __( 'Please provide something to search.', 'wp-packagist-api' ) );
			}

			$request = $this->base_uri . '/search.json?q=' . $query ;
			return $this->fetch( $request );

		}

		/**
		 * Search Packages by tag.
		 *
		 * @access public
		 * @param mixed $tag Tag.
		 * @return Json Array of Packages.
		 */
		public function search_packages_by_tag( $tag ) {

			if ( empty( $tag ) ) {
				return new WP_Error( 'required-fields', __( 'Please provide a tag to search.', 'wp-packagist-api' ) );
			}

			$request = $this->base_uri . '/search.json?tags=' . $tag ;
			return $this->fetch( $request );

		}

		/**
		 * Search Packages by Type.
		 *
		 * @access public
		 * @param mixed $type Type.
		 * @return Json Array of Packages.
		 */
		public function search_packages_by_type( $type ) {

			if ( empty( $type ) ) {
				return new WP_Error( 'required-fields', __( 'Please provide a package type to search.', 'wp-packagist-api' ) );
			}

			$request = $this->base_uri . '/search.json?type=' . $type ;
			return $this->fetch( $request );

		}

		/**
		 * Get Package Data.
		 *
		 * @access public
		 * @param mixed $org Organization.
		 * @param mixed $package Package.
		 * @return Package Data.
		 */
		public function get_package_data( $org, $package ) {

			if ( empty( $org ) || empty( $package ) ) {
				return new WP_Error( 'required-fields', __( 'Please provide the required fields.', 'wp-packagist-api' ) );
			}

			$request = $this->base_uri . '/p/' . $org . '/' . $package . '.json';
			return $this->fetch( $request );

		}

		/**
		 * Get Package Data using Fallback Method.
		 *
		 * @access public
		 * @param mixed $org Organization.
		 * @param mixed $package Package.
		 * @return Package Data.
		 */
		public function get_package_data_fallback_method( $org, $package ) {

			if ( empty( $org ) || empty( $package ) ) {
				return new WP_Error( 'required-fields', __( 'Please provide the required fields.', 'wp-packagist-api' ) );
			}

			$request = $this->base_uri . '/packages/' . $org . '/' . $package . '.json';
			return $this->fetch( $request );

		}
	}
}
