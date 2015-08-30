<?php 

/**
 * @desc	remove readmore jump
 */
function remove_more_jump_link( $link ) 
{
	$offset = strpos( $link, '#more-' );
	
	if( $offset )
		$end = strpos( $link, '"', $offset );
	
	if( $end )
		$link = substr_replace( $link, '', $offset, $end-$offset );
	
	return $link;
}


/**
 * @desc	Truncate text
 * @param 	$text Text to truncate
 * @param 	$amount	Amount of text to display
 */
function rs_truncate( $excerpt, $amount = 100 ) {
	$dot = '';
	if( strlen( $excerpt ) > $amount )
		$dot = '...';
	else
		$dot = '';
	
	return substr( $excerpt, 0, strrpos(substr($excerpt, 0, $amount), ' ') ) . $dot;
}


/*
 * @desc	Check if the current post has one or more images attached
 * @return 	TRUE on success otherwise false on failure or if it only single image or less
 */
function has_images_attached( $post_id = null ) {
	if( empty( $post_id ) ) 
		return;

	$args = array(
		'post_type' 		=> 'attachment',
		'post_mime_type' 	=> 'image',
		'post_parent' 		=> $post_id,
		'posts_per_page' 	=> -1,
	);

	$images_attached = get_posts( $args );
	$post_count = count( $images_attached );
	
	if( $post_count )
		return true;
		
	return false;
}



/**
 * Get and include template files.
 *
 * @param mixed $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return void
 */
function get_theme_template( $template_name, $args = array(), $template_path = 'templates', $default_path = '' ) {
	if ( $args && is_array( $args ) ) {
		extract( $args );
	}
	include( locate_theme_template( $template_name, $template_path, $default_path ) );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *		yourtheme		/	$template_path	/	$template_name
 *		yourtheme		/	$template_name
 *		$default_path	/	$template_name
 *
 * @param string $template_name
 * @param string $template_path (default: 'templates')
 * @param string|bool $default_path (default: '') False to not load a default
 * @return string
 */
function locate_theme_template( $template_name, $template_path = 'templates', $default_path = '' ) {
	// Look within passed path within the theme - this is priority
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);

	// Get default template
	if ( ! $template && $default_path !== false ) {
		$default_path = $default_path ? $default_path : get_stylesheet_directory_uri() . '/templates/';
		if ( file_exists( trailingslashit( $default_path ) . $template_name ) ) {
			$template = trailingslashit( $default_path ) . $template_name;
		}
	}

	// Return what we found
	return apply_filters( 'rstheme_locate_template', $template, $template_name, $template_path );
}

/**
 * Get template part (for templates in loops).
 *
 * @param string $slug
 * @param string $name (default: '')
 * @param string $template_path (default: 'templates')
 * @param string|bool $default_path (default: '') False to not load a default
 */
function get_theme_template_part( $slug, $name = '', $template_path = 'templates', $default_path = '' ) {
	$template = '';

	if ( $name ) {
		$template = locate_theme_template( "{$slug}-{$name}.php", $template_path, $default_path );
	}

	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/templates/slug.php
	if ( ! $template ) {
		$template = locate_theme_template( "{$slug}.php", $template_path, $default_path );
	}

	if ( $template ) {
		load_template( $template, false );
	}
}