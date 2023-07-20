<?php
/**
 * Plugin Name: Simplers API Customize
 * Description: Customize API for simplers.
 * Version: 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

class CustomTableCreator
{
    private $table_name;
    private $wpdb;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = $wpdb->prefix . 'job_ref';
    }

    public function create_table()
    {
        $table_name = $this->wpdb->prefix . 'job_ref';
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`jobid` INT,
			`title` TEXT,
			`job_category` TEXT,
			`job_type` TEXT,
			`job_street_address` TEXT,
			`job_street_address_2` TEXT,
			`job_city` TEXT,
			`job_state` TEXT,
			`job_postalcode` TEXT,
			`job_country` TEXT,
			`job_salary` TEXT,
			`job_salary_perday` TEXT,
			`job_description` TEXT,
			`job_display_phone_number` TEXT,
			`job_display_message` TEXT,
			`job_branch` TEXT,
			`job_Internal_reference` TEXT,
			`job_forms_completed` TEXT,
			`job_notifications_email` TEXT,
			`job_filing_email` TEXT
		);";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public function register_activation_hook()
    {
        register_activation_hook(__FILE__, array($this, 'create_table'));
    }
}

//$custom_table_creator = new CustomTableCreator();
//$custom_table_creator->register_activation_hook();


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
			require_once(plugin_dir_path(__FILE__) . 'includes/settings.php');
            require_once(plugin_dir_path(__FILE__) . 'includes/wp_rest_job_listing_Controller.php');
            require_once(plugin_dir_path(__FILE__) . 'includes/job_listing_db_table_handler.php');
		}
	}	
}
$BCV_Post = new SAC_Customize();