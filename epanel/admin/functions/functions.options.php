<?php

add_action( 'init', 'of_options' );

if ( ! function_exists('of_options') )
{
	function of_options()
	{
		// Pull all the categories into an array
		$options_categories = array();  
		$options_categories_obj = get_categories();
		$options_pages[''] = 'Select a category:';
		foreach ($options_categories_obj as $category) {
			$options_categories[$category->cat_ID] = $category->cat_name;
		}
		
		// Pull all the pages into an array
		$options_pages = array();  
		$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
		$options_pages[''] = 'Select a page:';
		foreach ($options_pages_obj as $page) {
			$options_pages[$page->ID] = $page->post_title;
		}
		
		// Pull all the pages into an array
		$options_posts = array();  
		$options_posts_obj = get_posts('orderby=post_date');
		$options_posts[''] = 'Select a post:';
		foreach ($options_posts_obj as $post) {
			$options_posts[$post->ID] = $post->post_title;
		}
		
		$of_blog_layout = array(
			"1"	=> "1",
			"2" => "2"
		);
	
		//Testing 
		$of_options_select = array( "one", "two", "three", "four", "five" ); 
		$of_options_radio = array( "one" => "One", "two" => "Two", "three" => "Three", "four" => "Four", "five" => "Five" );
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = STYLESHEETPATH. '/images/patterns/'; 				// change this to where you store your bg images
		$bg_images_url = get_bloginfo('template_url').'/images/patterns/'; 	// change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post");
		$email_to = get_option('admin_email');


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;

$of_options = array();
$short_name = 'rsclean_';

	
	// heading General Settings
	$of_options[] = array( 
		"name" => "General Settings",
		"type" => "heading"
	);

		$of_options[] = array(
			"name" => "Hello there!",
			"desc" => "",
			"id" => "introduction",
			"std" => "<h3 style=\"margin: 0 0 10px;\">Thank you for buying this theme</h3>
				Thank you for using this theme. It only takes a few minutes to work through the configuration and be up and running.",
			"icon" => true,
			"type" => "info"
		);

		$of_options[] = array(
			"name" => "Logo",
			"desc" => "Add the URL to link to your logo, or upload a file from your computer.",
			"id" => $short_name."logo",
			"std" => get_template_directory_uri() ."/assets/images/logo.png",
			"type" => "upload"
		);
			
		$of_options[] = array( 
			"name" => "Custom Favicon",
			"desc" => "A favicon is a 16x16 pixel icon that represents your site.",
			"id" => $short_name."favicon",
			"std" => get_template_directory_uri() ."/favicon.ico",
			"type" => "upload"
		);
		
		$of_options[] = array(
			"name" => "Analytics",
			"desc" => "",
			"id" => "introduction",
			"std" => "<h3 style=\"margin: 0 0 10px;\">Analytics</h3>
				Add or update site analytics or additional tracking code here.",
			"icon" => true,
			"type" => "info"
		);
			$of_options[] = array( 
				"name" => "Google Analytics",
				"desc" => "Paste your Google Analytics (or other) tracking code here.",
				"id" => $short_name."ga_code",
				"std" => "",
				"type" => "textarea"
			);
			
		$of_options[] = array(
			"name" => "Background Settings",
			"desc" => "",
			"id" => "introduction",
			"std" => "<h3 style=\"margin: 0 0 10px;\">Background Settings</h3>
				Update site background and color here.",
			"icon" => true,
			"type" => "info"
		);
		
		$of_options[] = array(
			"name" => "Background Image",
			"desc" => "Add the URL to link to your logo, or upload a file from your computer.",
			"id" => $short_name."background_image",
			"std" => get_template_directory_uri() ."/assets/images/bg.jpg",
			"type" => "upload"
		);
		
		$of_options[] = array(
			"name" 	=> "Background Color",
			"desc" 	=> "Add the URL to link to your logo, or upload a file from your computer.",
			"id" 	=> $short_name."background_color",
			"std" => "#220000",
			"type" => "color"
		);	
		
	
	// Homepage
	$of_options[] = array( 
		"name" => "Homepage",
		"type" => "heading"
	);
	
		
	// Blog
	$of_options[] = array( 
		"name" => "Blog",
		"type" => "heading"
	);		

		$of_options[] = array(  
			"name" 	=> "Enable Comment in Posts",
			"desc" 	=> "If check it will display comment form in posts.",
			"id" 	=> $short_name."enable_postcomment",
			"std" 	=> '1',
			"type" 	=> "switch"
		);
		$of_options[] = array(  
			"name" 	=> "Enable Post Meta",
			"desc" 	=> "If check it will display post meta.",
			"id" 	=> $short_name."enable_postmeta",
			"std" 	=> '1',
			"type" 	=> "switch"
		);
		$of_options[] = array(  
			"name" 	=> "Enable Post Breadcrumb",
			"desc" 	=> "If check it will display post Breadcrumb.",
			"id" 	=> $short_name."enable_postbreadcrumb",
			"std" 	=> '1',
			"type" 	=> "switch"
		);
		$of_options[] = array(  
			"name" 	=> "Enable Comment in Pages",
			"desc" 	=> "If check it will display comment form in pages.",
			"id" 	=> $short_name."enable_pagecomment",
			"std" 	=> '1',
			"type" 	=> "switch"
		);
		$of_options[] = array(  
			"name" 	=> "Enable Page Meta",
			"desc" 	=> "If check it will display page meta.",
			"id" 	=> $short_name."enable_pagemeta",
			"std" 	=> '1',
			"type" 	=> "switch"
		);
		$of_options[] = array(  
			"name" 	=> "Enable Page Breadcrumb",
			"desc" 	=> "If check it will display page Breadcrumb.",
			"id" 	=> $short_name."enable_pagebreadcrumb",
			"std" 	=> '1',
			"type" 	=> "switch"
		);
		
	
	// Backup
	$of_options[] = array( 
		"name" => "Social Profiles",
		"type" => "heading"
	);
		$of_options[] = array( 
			"name" => "Facebook Username",
			"desc" => "",
			"id" => $short_name."facebook_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Twitter Username",
			"desc" => "",
			"id" => $short_name."twitter_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Pinterest Username",
			"desc" => "",
			"id" => $short_name."pinterest_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Linkedin URL",
			"desc" => "",
			"id" => $short_name."linkedin_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Instagram Username",
			"desc" => "",
			"id" => $short_name."instagram_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Google Plus URL",
			"desc" => "",
			"id" => $short_name."google_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Flickr Username",
			"desc" => "",
			"id" => $short_name."flickr_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Youtube Username",
			"desc" => "",
			"id" => $short_name."youtube_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Vimeo Username",
			"desc" => "",
			"id" => $short_name."vimeo_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Digg Username",
			"desc" => "",
			"id" => $short_name."digg_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Dribble Username",
			"desc" => "",
			"id" => $short_name."dribble_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Tumblr URL",
			"desc" => "",
			"id" => $short_name."tumblr_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "RSS URL",
			"desc" => "",
			"id" => $short_name."feedburner_id",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Email URL",
			"id" => $short_name."email_url",
			"desc" => "",
			"std" => "",
			"type" => "text"
		);
		
	
	// Footer
	$of_options[] = array( 
		"name" => "Footer",
		"type" => "heading"
	);
		
		$of_options[] = array( 
			"name" => "Footer text",
			"desc" => "Enter footer text ex. copyright description",
			"id" => $short_name."footer_text",
			"std" => 'Copyright 2012. Powered by <a href="http://wordpress.org/">Wordpress</a>.',
			"type" => "textarea"
		);
			
	// Backup
	$of_options[] = array( 
		"name" => "Backup Options",
		"type" => "heading"
	);

		$of_options[] = array( 
			"name" => "Backup and Restore Options",
			"id" => "of_backup",
			"std" => "",
			"type" => "backup",
			"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
		);
		$of_options[] = array( 
			"name" => "Transfer Theme Options Data",
			"id" => "of_transfer",
			"std" => "",
			"type" => "transfer",
			"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
		);
		
	}
}
?>
