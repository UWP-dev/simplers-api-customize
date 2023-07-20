<?php
    if( !class_exists( "Job_Listing" ) ):
        class Job_Listing{

            protected $data = false;

            
            // public static $defaults_args = array(
            //     "id" => null,
            //     "job_ref_id" => null,
            //     "form_sequence" => null,
            //     "form_three" => null,
            //     "job_cpt_id" => null,
            //     "job_category" => null,
            //     "branch" => null,
            //     "sharepoint_email" => null,
            //     "consultant_email" => null,
            //     "branch_phone" => null,
            //     "display_message" => null,
            //     "entry_id" => null,
            //     "date_of_entry" => date("Y-m-d H:i:s"),
            // );

            public function __construct( $id = null ) {
               $this->load_database_table();
            }

            public static function get_default_args(){
                return array(
                    "id" => null,
                    "job_ref_id" => null,
                    "form_sequence" => null,
                    "form_three" => null,
                    "job_cpt_id" => null,
                    "job_category" => null,
                    "branch" => null,
                    "sharepoint_email" => null,
                    "consultant_email" => null,
                    "branch_phone" => null,
                    "display_message" => null,
                    "entry_id" => null,
                    "date_of_entry" => date("Y-m-d H:i:s"),
                );
            }

            public static function get_table_name(){
                return 'sb_job_reference';
            }

            protected function load_database_table(){
                global $wpdb;
                require_once ABSPATH . 'wp-admin/includes/upgrade.php';
                $table_name = Job_Listing::get_table_name();
                $sql = "CREATE TABLE `$table_name` (
                    `id` int(11) NOT NULL,
                    `job_ref_id` varchar(255) NOT NULL,
                    `form_sequence` int(11) DEFAULT NULL,
                    `form_three` varchar(255) DEFAULT NULL,
                    `job_cpt_id` int(11) DEFAULT NULL,
                    `job_category` varchar(255) DEFAULT NULL,
                    `branch` varchar(255) NOT NULL,
                    `sharepoint_email` varchar(255) NOT NULL,
                    `consultant_email` varchar(255) NOT NULL,
                    `branch_phone` varchar(255) NOT NULL,
                    `display_message` text,
                    `entry_id` int(11) DEFAULT NULL,
                    `date_of_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
                  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

                maybe_create_table( $table_name, $sql );
            }

            protected function set_data( $id ){
                global $wpdb;
                $table_name = Job_Listing::get_table_name();
                $sql = "SELECT * FROM $table_name WHERE `id` = $id";
                $data = $wpdb->get_row( $sql, ARRAY_A );
                
                $default_args = Job_Listing::get_default_args();
                $this->data = wp_parse_args( (array) $data, $default_args );
            }

            public static function insert( $req_args ){
                global $wpdb;
                
                $table_name = Job_Listing::get_table_name();
                $default_args = Job_Listing::get_default_args();
                
                $args = wp_parse_args( $req_args, $default_args );
               
                if( !isset( $args["job_ref_id"] ) || empty( $args["job_ref_id"] ) ){
                    return false;
                }

                $wpdb->insert($table_name, $args) ;

                return $wpdb->insert_id;
            }
            
            public function get( $key = null ){
                if( !empty( $key ) && is_string( $key ) ){
                    return  isset( $this->data[$key] ) && !empty( $this->data[$key] ) ? $this->data[$key] : false;
                }

                return isset( $this->data ) && !empty( $this->data ) ? $this->data : false;
            }

        }

    endif;

    new Job_Listing();

    
        // Job_Listing::insert( 
        //     array(
        //         "id" => 3,
        //         "job_ref_id" => 5,
        //         "form_sequence" => "asfafaf",
        //         "form_three" => "Asdasdsad",
        //         "job_cpt_id" => 45,
        //         "job_category" => "asdsadadsad",
        //         "branch" => "Asdsada",
        //         "sharepoint_email" => "asdadsadsad",
        //         "consultant_email" => "asddadads",
        //         "branch_phone" => "789456132",
        //         "display_message" => "asdadsadad",
        //         "entry_id" => 2,
        //     )
        //  );
    
?>