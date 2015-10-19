<?php
/*
 * @desc Register new post type
 * @author Ryan Sutana
 */	

add_action( 'init', 'register_posts_types' );
/*
 * @desc	Regsiter product post_types for testimonial
 */
function register_posts_types() {
	global $theme_domain;

	/*
	// register posttype for our testimonial
	register_post_type( 'testimonial',
		array(
			'labels' => array(
				'name' 					=> __( 'Testimonial' ),
				'singular_name' 		=> __( 'Testimonial' ),
				'add_new' 				=> __( 'Add New' ),
				'add_new_item' 			=> __( 'Add New Testimonial' ),
				'edit_item' 			=> __( 'Edit Testimonial' ),
				'new_item' 				=> __( 'Add New Testimonial' ),
				'view_item' 			=> __( 'View Testimonial' ),
				'search_items' 			=> __( 'Search Testimonial' ),
				'not_found' 			=> __( 'No testimonial found' ),
				'not_found_in_trash' 	=> __( 'No testimonial found in trash' )
			),
			'public' 				=> true,
			'supports' 				=> array( 'title', 'editor', 'thumbnail' ),
			'hierarchical' 			=> true,
			'rewrite' 				=> array( "slug" => "testimonial" ),
			'menu_position' 		=> 80
		)
	);
	
	// register posttype for our feature
	register_post_type( 'feature',
		array(
			'labels' => array(
				'name' 					=> __( 'Features' ),
				'singular_name' 		=> __( 'Feature' ),
				'add_new' 				=> __( 'Add New' ),
				'add_new_item' 			=> __( 'Add New Feature' ),
				'edit_item' 			=> __( 'Edit Feature' ),
				'new_item' 				=> __( 'Add New Feature' ),
				'view_item' 			=> __( 'View Feature' ),
				'search_items' 			=> __( 'Search Feature' ),
				'not_found' 			=> __( 'No feature found' ),
				'not_found_in_trash' 	=> __( 'No feature found in trash' )
			),
			'public' 				=> true,
			'supports' 				=> array( 'title', 'editor', 'thumbnail' ),
			'hierarchical' 			=> true,
			'rewrite' 				=> array( "slug" => "feature" ),
			'menu_position' 		=> 80
		)
	);
	
	*/
}