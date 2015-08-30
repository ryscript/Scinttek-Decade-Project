<?php

class WPThemeAddons extends WPTheme{

	function theme_init() 
	{
		remove_action( 'wp_head', 'wp_generator' ); 					// remove generator meta
		add_filter( 'the_content_more_link', 'remove_more_jump_link' ); // remove more-link jumper
		add_filter( 'wp_nav_menu', 'do_shortcode' );
		add_filter( 'widget_text', 'do_shortcode' );					// enable shortcode in widget

		add_action( 'init', array( $this, 'init' ) );						// initialize theme styles and scripts on wordpress init
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_theme_styles_scripts' ) );
		add_action( 'after_setup_theme', array( $this, 'rs_theme_setup' ) );
		
		/* Flush rewrite rules for custom post types. */
		add_action( 'after_switch_theme', 'flush_rewrite_rules' );
	}
	
	function rs_theme_setup() {
		// load theme languages
		load_theme_textdomain( THEME_DOMAIN, get_template_directory() . '/languages' );
	}
	
	function init()
	{		
		// localize wp-ajax
		wp_enqueue_script( 'rsclean-request-script', get_stylesheet_directory_uri() . '/assets/js/theme-ajax.js', array( 'jquery' ) );
		wp_localize_script( 'rsclean-request-script', 'theme_ajax', array(
			'url'		=> admin_url( 'admin-ajax.php' ),
			'site_url' 	=> get_bloginfo('url'),
			'theme_url' => get_bloginfo('template_directory')
		) );
		
		// bootstrap scripts
		wp_register_script( 'rs-bootstrap_script', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '3.3.4', true );
		wp_register_script( 'rs-bootstrap_ie10_fix_script', get_stylesheet_directory_uri() . '/assets/js/ie10-viewport-bug-workaround.js', array('jquery'), '3.3.4', true );
		
		// register scripts and styles
		wp_register_script( 'rs-modernizr_scripts', get_stylesheet_directory_uri() . '/assets/js/modernizr.foundation.js', array('jquery'), '1.0', true );
		wp_register_script( 'rs-fancybox_script', get_stylesheet_directory_uri() . '/assets/js/jquery.fancybox.pack.js', array('jquery'), '1.51', true );
		wp_register_script( 'rs-fancybox_media_script', get_stylesheet_directory_uri() . '/assets/js/jquery.fancybox-media.js', array('jquery'), '1.51', true );
		
		// retina
		wp_register_script( 'rs-retina_script', get_stylesheet_directory_uri() . '/assets/js/retina.js', array('jquery'), '1.0.0', true );

		// theme scripts
		wp_register_script( 'rs-theme_script', get_stylesheet_directory_uri() . '/assets/js/rs-scripts.js', array('jquery'), '1.0', true );
		
		
		// bootstrap styles
		wp_register_style( 'rs-bootstrap_style', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', false, '3.3.4', 'all' );
		wp_register_style( 'rs-bootstrap_theme_style', get_stylesheet_directory_uri() . '/assets/css/bootstrap-theme.min.css', false, '3.3.4', 'all' );
		wp_register_style( 'rs-reset_style', get_stylesheet_directory_uri() . '/assets/css/reset.css', false, '3.3.4', 'all' );
		wp_register_style( 'rs-shortcode_style', get_stylesheet_directory_uri() . '/assets/css/shortcodes.css', false, '3.3.4', 'all' );
		
		// fancybox
		wp_register_style( 'rs-fancybox_style', get_stylesheet_directory_uri() . '/assets/css/jquery.fancybox.css', false, '1.51', 'all' );
	
		// options style
		wp_register_style( 'rs-options_style', get_stylesheet_directory_uri() . '/assets/css/options.css', false, '1.0', 'all' );
	}

	function enqueue_theme_styles_scripts()
	{	
		if ( is_singular() ) 
			wp_enqueue_script( 'comment-reply' );
		
		// bootstrap scripts
		wp_enqueue_script( 'rs-bootstrap_script' );
		wp_enqueue_script( 'rs-bootstrap_ie10_fix_script' );
		
		// register scripts and styles
		wp_enqueue_script( 'rs-modernizr_scripts' );
		wp_enqueue_script( 'rs-fancybox_script' );
		wp_enqueue_script( 'rs-fancybox_media_script' );
		
		// retina
		wp_enqueue_script( 'rs-retina_script' );

		// theme scripts
		wp_enqueue_script( 'rs-theme_script' );
		

		// bootstrap styles
		wp_enqueue_style( 'rs-bootstrap_style' );
		wp_enqueue_style( 'rs-bootstrap_theme_style' );
		wp_enqueue_style( 'rs-reset_style' );
		wp_enqueue_style( 'rs-shortcode_style' );
		

		// fancybox
		wp_enqueue_style( 'rs-fancybox_style' );
		
		// site options
		wp_enqueue_style( 'rs-options_style' );
	}

}

?>