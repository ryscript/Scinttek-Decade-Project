<?php

/**
 * This contains all theme page hooks
 */
 
/**
 * Function hook to add in 
 * rstheme_before_page_post hook
 *--------------------------------------*/
add_action( 'rstheme_before_page_post', 'rstheme_page_breadcrumbs', 10 );
/*
 * Add breadcrumbs before page post
 */
function rstheme_page_breadcrumbs() {
	get_theme_template_part( 'page', 'breadcrumb', '/templates/page' );
}


/**
 * Function hook to add in
 * rstheme_single_page_summary hook
 *--------------------------------------*/
add_action( 'rstheme_single_page_summary', 'rstheme_single_page_title', 10 );
/*
 * Add single page title
 */
function rstheme_single_page_title() {
	get_theme_template_part( 'page', 'title', '/templates/page' );
}


add_action( 'rstheme_single_page_summary', 'rstheme_single_page_meta', 20 );
/*
 * Add single page title
 */
function rstheme_single_page_meta() {
	get_theme_template_part( 'page', 'meta', '/templates/page' );
}

add_action( 'rstheme_single_page_summary', 'rstheme_single_page_content', 30 );
/*
 * Add single page content
 */
function rstheme_single_page_content() {
	get_theme_template_part( 'page', 'content', '/templates/page' );
}


add_action( 'rstheme_after_page_post', 'rstheme_single_page_comments', 10 );
/*
 * Add them comments after page post
 */
function rstheme_single_page_comments() {
	get_theme_template_part( 'page', 'comment', '/templates/page' );
}

/**
 * Function hook to add in 
 * rstheme_after_page_post hook
 *--------------------------------------*/
add_action( 'rstheme_after_page_post', 'rstheme_single_page_edit', 20 );
function rstheme_single_page_edit() {
	get_theme_template_part( 'edit-entry' );
}