<?php

// initiate WPTheme class
$rs_theme = new WPTheme();

class WPTheme {

	function start($v)
	{
		global $data; // Do not remove this line
		
		$this->theme_constants($v);
		$this->theme_supports($v);
		$this->load_functions($v);	
		$this->create_sidebar($v);		
		add_action( 'init', array(&$this, 'init'));

		if( @is_admin ){
			require_once (ADMIN_PATH . 'index.php');		// Admin Interfaces 
		}	
	}

	function init()
	{
		register_nav_menus(
			array(
				'primary-menu' 	=> __( 'Primary Menu' ),
				'footer-menu' 	=> __( 'Footer Menu' )
			)
		);
	}
	
	function create_sidebar()
	{
		if ( function_exists('register_sidebar') ) {
			register_sidebar(array(
				'name' => __( 'Primary', THEME_DOMAIN ),
				'id' => 'primary',
				'description' => __( 'This sidebar serve as your default sidebar and use if you did\'t set one yet.', THEME_DOMAIN ),
				'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			));
			
			register_sidebar(array(
				'name' => __( 'Footer One', THEME_DOMAIN ),
				'id' => 'footer-1',
				'description' => __( 'This sidebar serve as your default sidebar and use if you did\'t set one yet.', THEME_DOMAIN ),
				'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			));
			
			register_sidebar(array(
				'name' => __( 'Footer Two', THEME_DOMAIN ),
				'id' => 'footer-2',
				'description' => __( 'This sidebar serve as your default sidebar and use if you did\'t set one yet.', THEME_DOMAIN ),
				'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			));
			
			register_sidebar(array(
				'name' => __( 'Footer Three', THEME_DOMAIN ),
				'id' => 'footer-3',
				'description' => __( 'This sidebar serve as your default sidebar and use if you did\'t set one yet.', THEME_DOMAIN ),
				'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			));
		}
	}
	
	function theme_constants($v)
	{
		#-----------------------------------------------------------------
		# Default theme variables and information
		#-----------------------------------------------------------------
		$themeInfo            =  wp_get_theme(); // TEMPLATEPATH . '/style.css'
		$themeName            = trim($themeInfo['Title']);
		$themeAuthor          = trim($themeInfo['Author']);
		$themeAuthor_URI      = trim($themeInfo['AuthorURI']);
		$themeVersion         = trim($themeInfo['Version']);
		$themeShortname       = sanitize_title($themeName . '_');

		define('THEME_DOMAIN', 'rs-responsive');
		define('THEME_NAME', $v['theme']);
		define('THEME_SLUG', $v['slug']);
		define('THEME_VERSION', $v['version']); 
		define('THEME_DIR', get_template_directory());
		define('THEME_URI', get_template_directory_uri());	
		define('THEME_FRAMEWORK_DIR', get_template_directory().'/epanel/'); 
		define('THEME_FRAMEWORK_URI', get_template_directory_uri().'/epanel/'); 		
		define('ADMIN_PATH', get_template_directory().'/epanel/admin/');
		define('ADMIN_DIR', get_template_directory_uri() . '/epanel/admin/');		
		
		define( 'BREADCRUMBS', THEME_FRAMEWORK_DIR.'/functions/breadcrumb.php' );	// use include( BREADCRUMBS ) to include to site post, pages and etc.
		define( 'POST_INFO', THEME_FRAMEWORK_DIR.'/functions/post_info.php' );		// use include( POST_INFO ) to include to site post, pages and etc.
		define( 'NAVIGATION', THEME_FRAMEWORK_DIR.'/functions/navigation.php' );	// use include( NAVIGATION ) to include to site post, pages and etc.
	}

	// Add support for featured images
	function theme_supports()
	{
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'title-tag' );
	}
	
	function load_functions()
	{
		if( ! is_admin() ) {		
			require_once( THEME_FRAMEWORK_DIR.'/functions/theme_addons.php' ); 
			$AUThemeAddons = new WPThemeAddons();
			$AUThemeAddons->theme_init();
		}
		
		// include theme hooks
		include_once( THEME_FRAMEWORK_DIR.'functions/theme_single_page_action_hook.php' );
		include_once( THEME_FRAMEWORK_DIR.'functions/theme_single_post_action_hook.php' );
		include_once( THEME_FRAMEWORK_DIR.'functions/theme_single_page_filter_hook.php' );
		include_once( THEME_FRAMEWORK_DIR.'functions/theme_single_post_filter_hook.php' );
		
		include_once( THEME_FRAMEWORK_DIR.'functions/theme_functions.php' );
		include_once( THEME_FRAMEWORK_DIR.'functions/theme_filters.php' );
		include_once( THEME_FRAMEWORK_DIR.'functions/theme_nav_walker.php' );
		include_once( THEME_FRAMEWORK_DIR.'functions/theme_actions.php' );
		
		// comment callback
		include_once( THEME_FRAMEWORK_DIR.'functions/comment.php' );
		
		include_once( THEME_FRAMEWORK_DIR.'functions/theme_ajax.php' );
		include_once( THEME_FRAMEWORK_DIR.'functions/shortcodes.php' );
		
		// include theme widgets
		include_once( THEME_DIR.'/lib/widgets.php' );	

		// include custom post type and metas
		include_once( THEME_FRAMEWORK_DIR.'functions/post_type.php' );
		include_once( THEME_DIR.'/lib/metabox/init.php' );
	}

}
