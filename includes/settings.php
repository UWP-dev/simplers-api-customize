<?php 
defined( 'ABSPATH' ) || exit;


/**
 * The custom_Content_Views Class.
 */
class Rest_Simplers_API {
 
    public function __construct() {
		//add_filter( 'rest_route_for_post', [ $this, 'add_authontication_for_job_listing' ], 10, 2 );
		add_filter( 'register_post_type_args', [ $this, 'job_listing_type_args'], 10, 2 );
    }

	// function add_authontication_for_job_listing( $route, $post ){
	// 	if ( $post->post_type === 'job_listing' ) {
	// 	 	//$api_key = $request->get_header( 'X-API-Key' );
	// 	 	$route = '/wp/v2/job_listing/' . $post->ID;	
	// 	}
		
	// 	return $route;
	// }

	function job_listing_type_args( $args, $post_type ){
		if ( 'job_listing' === $post_type ) {
			$args['show_in_rest'] = true;
	
			// Optionally customize the rest_base or rest_controller_class
			$args['rest_controller_class'] = 'WP_REST_job_listing_Controller';
		}
	
		return $args;
	}
}

function pr( $v ){
	echo "<pre>";
	print_r( $v );
	echo "</pre>";
}



