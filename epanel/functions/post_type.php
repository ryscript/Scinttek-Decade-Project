<?php
/*
 * @desc Register new post type
 * @author Ryan Sutana
 */	

add_action( 'init', 'register_posts_types' );
/*
 * @desc	Regsiter member post_types for Members
 */
function register_posts_types() {
	global $theme_domain;

	
	// Member Number
	$args = array(
		'label' => __( 'Member Categories', $theme_domain ),
		'labels' => array(
			'name' => __( 'Member Categories', $theme_domain ),
			'singular_name' => __( 'Member Category', $theme_domain ),
			'search_items' => __( 'Search Member Category', $theme_domain ),
			'popular_items' => __( 'Popular Member Categories', $theme_domain ),
			'all_items' => __( 'All Member Categories', $theme_domain ),
			'parent_item' => __( 'Parent Member Category', $theme_domain ),
			'edit_item' => __( 'Edit Member Category', $theme_domain ),
			'update_item' => __( 'Update Member Category', $theme_domain ),
			'add_new_item' => __( 'Add New Member Category', $theme_domain ),
			'new_item_name' => __( 'New Member Category', $theme_domain ),
			'separate_items_with_commas' => __( 'Separate categories with commas', $theme_domain ),
			'add_or_remove_items' => __( 'Add or remove categories', $theme_domain ),
			'choose_from_most_used' => __( 'Choose from most used categories', $theme_domain )
			),
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'hierarchical' => true,
		'update_count_callback' => '_update_post_term_count',
		'rewrite' => array(
			'slug' => 'member_category',
			'hierarchical' => true,
			),
		'query_var' => true
	);
	register_taxonomy( 'member_category', 'member', $args );
	
	// register posttype for our member
	register_post_type( 'member',
		array(
			'labels' => array(
				'name' 					=> __( 'Members' ),
				'singular_name' 		=> __( 'Member' ),
				'add_new' 				=> __( 'Add New' ),
				'add_new_item' 			=> __( 'Add New Member' ),
				'edit_item' 			=> __( 'Edit Member' ),
				'new_item' 				=> __( 'Add New Member' ),
				'view_item' 			=> __( 'View Member' ),
				'search_items' 			=> __( 'Search Member' ),
				'not_found' 			=> __( 'No member found' ),
				'not_found_in_trash' 	=> __( 'No member found in trash' )
			),
			'public' 				=> true,
			'supports' 				=> array( 'title', 'editor', 'thumbnail' ),
			'hierarchical' 			=> true,
			'rewrite' 				=> array( "slug" => "member" ),
			'menu_position' 		=> 80
		)
	);
}