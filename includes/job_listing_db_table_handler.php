<?php
    if( !class_exists( "Job_Listing" ) ):
        class Job_Listing{

            protected $data = false;
            
            public static $defaults_args = array(
                "id" => null,
                "street_address" => null,
                "address_line_2" => null,
                "city" => null,
                "state" => null,
                "pincode" => null,
                "country" => null,
                "salary" => null,
                "salary_per" => null,
                "job_description" => null,
                "phone_number" => null,
                "message" => null,
                "branch" => null,
                "internal_reference" => null,
                "select_forms" => null,
                "notification_email" => null,
                "filling_email" => null,
            );

            public function __construct( $id = null ) {
                $this->load_database_table();

                if( !empty( $id ) ){
                    return $this->set_data( $id );
                }                
            }

            protected function load_database_table(){
                global $wpdb;
                require_once ABSPATH . 'wp-admin/includes/upgrade.php';
                $table_name = $wpdb->prefix . 'job_listing_table';
                $sql = "CREATE TABLE $table_name (
                    `id` INT PRIMARY KEY NOT NULL UNIQUE,
                    `street_address` TEXT,
                    `address_line_2` TEXT,
                    `city` TEXT,
                    `state` TEXT,
                    `pincode` TEXT,
                    `country` TEXT,
                    `salary` NUMERIC,
                    `salary_per` TEXT,
                    `job_description` TEXT,
                    `phone_number` TEXT,
                    `message` TEXT,
                    `branch` TEXT,
                    `internal_reference` TEXT,
                    `select_forms` TEXT,
                    `notification_email` TEXT,
                    `filling_email` TEXT
                );";

                maybe_create_table( $table_name, $sql );
            }

            protected function set_data( $id ){
                global $wpdb;
                $table_name = $wpdb->prefix . 'job_listing_table';
                $sql = "SELECT * FROM $table_name WHERE `id` = $id";
                $data = $wpdb->get_row( $sql, ARRAY_A );
                
                $default_args = Job_Listing::$defaults_args;
                $this->data = wp_parse_args( (array) $data, $default_args );
            }

            public static function insert( $req_args ){
                global $wpdb;
                $table_name = $wpdb->prefix . 'job_listing_table';

                $default_args = Job_Listing::$defaults_args;

                $args = wp_parse_args( $req_args, $default_args );

                if( !isset( $args["id"] ) || empty( $args["id"] ) ){
                    return false;
                }

                $wpdb->insert($table_name, $args);
                return $wpdb->insert_id;
            }

            // public function set( $key, $value ){
            //     $data = array();
            //     $data[$key] = $value;
            //     $this->data = wp_parse_args(  $data, $this->data );
            // }

            public function get( $key = null ){
                if( !empty( $key ) && is_string( $key ) ){
                    return  isset( $this->data[$key] ) && !empty( $this->data[$key] ) ? $this->data[$key] : false;
                }

                return isset( $this->data ) && !empty( $this->data ) ? $this->data : false;
            }

        }

        //new Job_Listing_Database_Table_Handler();   
    endif;
     add_action( "wp_head", function(){

    //     //insert new data
    //     $id = Job_Listing::insert(
    //         array(
    //             "id" => 250,
    //             "street_address" => "sagar",
    //         )
    //     );
    //     var_dump( $id );

    //     //get data
        $data = new Job_Listing( 250 );
        pr( $data->get( "state" ) );
        die;


    } );

?>