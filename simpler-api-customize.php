<?php
/**
 * Plugin Name: Simplers API Customize
 * Description: Customize API for simplers.
 * Version: 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

if ( ! class_exists( 'SAC_Customize', false ) ) {
	/**
	 * CCN main class.
	 */
	class SAC_Customize {
		
		public function __construct() {
			$this->includes();
			$this->bcv_content_views = new Rest_Simplers_API();
		}
		
		public function includes() {
			require_once 'includes/settings.php';
			require_once 'includes/wp_rest_job_listing_Controller.php';
		}
	}	
}
$BCV_Post = new SAC_Customize();