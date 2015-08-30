<?php

/**
 * This contains all theme page hooks
 */

 
/**
 * Function hook to add in 
 * rstheme_before_single_post hook
 *--------------------------------------*/
add_action( 'rstheme_before_single_post', 'rstheme_single_breadcrumbs', 10 );
function rstheme_single_breadcrumbs() {
	get_theme_template_part( 'post', 'breadcrumb', '/templates/post' );
}


/**
 * Function hook to add in 
 * rstheme_before_single_summary hook
 *--------------------------------------*/
add_action( 'rstheme_before_single_summary', 'rstheme_single_post_title', 10 );
/*
 * Add single psot title
 */
function rstheme_single_post_title() {
	get_theme_template_part( 'post', 'title', '/templates/post' );
}


add_action( 'rstheme_before_single_summary', 'rstheme_single_post_image', 20 );
/*
 * Add single page meta
 */
function rstheme_single_post_image() {	
	get_theme_template_part( 'post', 'featured-image', '/templates/post' );
}


add_action( 'rstheme_before_single_summary', 'rstheme_single_post_meta', 30 );
/*
 * Add single page meta
 */
function rstheme_single_post_meta() {
	get_theme_template_part( 'post', 'meta', '/templates/post' );
}


add_action( 'rstheme_before_single_summary', 'rstheme_single_post_content', 40 );
/*
 * Add single page content
 */
function rstheme_single_post_content() {
	get_theme_template_part( 'post', 'content', '/templates/post' );
}


/**
 * Function hook to add in 
 * rstheme_after_single_post hook
 *--------------------------------------*/
add_action( 'rstheme_after_single_post', 'rstheme_single_post_navigation', 10 );
/*
 * Add single post navigation
 */
function rstheme_single_post_navigation() {
	get_theme_template_part( 'post', 'navigation', '/templates/post' );
}

add_action( 'rstheme_after_single_post', 'rstheme_single_post_tags', 20 );
/*
 * Add single post tags
 */
function rstheme_single_post_tags() {
	get_theme_template_part( 'post', 'tag', '/templates/post' );
}

add_action( 'rstheme_after_single_post', 'rstheme_single_post_comments', 30 );
/*
 * Add single post comments
 */
function rstheme_single_post_comments() {
	get_theme_template_part( 'post', 'comment', '/templates/post' );
}