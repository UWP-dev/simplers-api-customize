<?php
    if( !class_exists( "Job_Listing" ) ):
        class Job_Listing{

            protected $data = false;
            
            public static $defaults_args = array(
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
                "date_of_entry" => null,
            );

            public function __construct( $id = null ) {
               // $this->load_database_table();
            }

            protected function set_data( $id ){
                global $wpdb;
                $table_name = $wpdb->prefix . 'job_reference';
                $sql = "SELECT * FROM $table_name WHERE `id` = $id";
                $data = $wpdb->get_row( $sql, ARRAY_A );
                
                $default_args = Job_Listing::$defaults_args;
                $this->data = wp_parse_args( (array) $data, $default_args );
            }

            public static function insert( $req_args ){
                global $wpdb;
                $table_name = $wpdb->prefix . 'job_reference';
                $default_args = Job_Listing::$defaults_args;
                $args = wp_parse_args( $req_args, $default_args );
                if( !isset( $args["jobid"] ) || empty( $args["jobid"] ) ){
                    return false;
                }
                $wpdb->insert($table_name, $args);
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

?>