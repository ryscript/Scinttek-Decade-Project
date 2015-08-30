<?php
/**
 * @desc	If you have something to add in add_filter function add it here.
 * @author	Ryan Sutana
 * @uri		http://www.sutanaryan.com/
 */

/* remove gallery inline css */
add_filter( 'use_default_gallery_style', '__return_false' );
add_filter( 'wp_get_attachment_link', 'rs_add_rel_attribute' );
 
add_filter( 'excerpt_length', 'rs_custom_excerpt_length', 999 );
add_filter( 'excerpt_more', 'rs_new_excerpt_more' );
	
/**
 * @desc	Filter 
 */
function rs_add_rel_attribute( $link ) {
	global $post;
	
	return str_replace('<a href', '<a data-rel="fancybox" href', $link);
}


/**
 * @desc	Filter custom post to only display 4o words
 */
function rs_custom_excerpt_length( $length ) {
	return 40;
}

/**
 * @desc	Add readmore in category page
 */
function rs_new_excerpt_more( $more ) {
	global $post;
	
	return '... <a href="'. esc_url( get_permalink($post->ID) ) . '" class="blog-continue-reading">Read more &rarr;</a>';
}

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	// add woocommerce hook

}