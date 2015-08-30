<?php
	
add_action( 'widgets_init', 'rs_load_widgets' );
/*
 * register thumbnail list widget
 */
function rs_load_widgets(){
	include_once( TEMPLATEPATH . '/lib/rs-tabs/rs-tabs.php' );
	include_once( TEMPLATEPATH . '/lib/rs-social-media/rs-social-media.php' );
	include_once( TEMPLATEPATH . '/lib/rs-recent-products/rs-recent-products.php' );
	include_once( TEMPLATEPATH . '/lib/rs-recent-comments/rs-recent-comments.php' );
	
	register_widget( 'RS_Tabs' );
	register_widget( 'RS_Social_Media' );
	register_widget( 'RS_Recent_Products' );
	register_widget( 'RS_Recent_Comments' );
}