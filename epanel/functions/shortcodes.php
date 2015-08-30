<?php
	/*
	 * @desc	These lists all of themes shortcodes
	 */
	
	// Add button to visual editor
	add_action('init', 'add_shortcode_button');
	function add_shortcode_button(){
	
		if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') ) {  
			add_filter( 'mce_external_plugins', 'add_shortcode_plugin' );  
			add_filter( 'mce_buttons_3', 'register_shortcode_button' );  
		}  	
	
	}
	
	function register_shortcode_button( $buttons ) {
		array_push( $buttons, "column" , "separator");
		array_push( $buttons, "accordion", "tab", "toggle_box", "price_item", "separator" );
		array_push( $buttons, "testimonial", "message_box", "button", "separator" );
		array_push( $buttons, "youtube", "vimeo", "frame", "social", "separator" );
		array_push( $buttons, "list", "quote", "dropcap", "separator" );
		array_push( $buttons, "divider", "space", "separator" );

		return $buttons;
	}
	
	function add_shortcode_plugin( $plugin_array ) {  
		$plugin_array['column'] = THEME_URI . '/assets/js/shortcode/column.js';  
		$plugin_array['accordion'] = THEME_URI . '/assets/js/shortcode/accordion.js';  
		$plugin_array['toggle_box'] = THEME_URI . '/assets/js/shortcode/toggle-box.js';  
		$plugin_array['tab'] = THEME_URI . '/assets/js/shortcode/tab.js';  
		$plugin_array['price_item'] = THEME_URI . '/assets/js/shortcode/price-item.js';  
		$plugin_array['testimonial'] = THEME_URI . '/assets/js/shortcode/testimonial.js'; 
		$plugin_array['message_box'] = THEME_URI . '/assets/js/shortcode/message-box.js';  
		$plugin_array['button'] = THEME_URI . '/assets/js/shortcode/button.js';  
	    $plugin_array['youtube'] = THEME_URI . '/assets/js/shortcode/youtube.js';  
	    $plugin_array['vimeo'] = THEME_URI . '/assets/js/shortcode/vimeo.js';  
		$plugin_array['frame'] = THEME_URI . '/assets/js/shortcode/frame.js';  
		$plugin_array['social'] = THEME_URI . '/assets/js/shortcode/social.js';  
	    $plugin_array['list'] = THEME_URI . '/assets/js/shortcode/list.js';  
		$plugin_array['quote'] = THEME_URI . '/assets/js/shortcode/quote.js';  
		$plugin_array['divider'] = THEME_URI . '/assets/js/shortcode/divider.js';  
		$plugin_array['dropcap'] = THEME_URI . '/assets/js/shortcode/dropcap.js';  
		$plugin_array['space'] = THEME_URI . '/assets/js/shortcode/space.js';  
	   
	  
	  return $plugin_array;  
	}
	
	// shortcode for column
	add_shortcode('column', 'rs_column_shortcode');
	function rs_column_shortcode( $atts, $content = null ){
	
		extract( shortcode_atts(array("col" => '1/1', "last" => '' ), $atts) );
		
		if( $last )
			$last = 'last';
		
		switch( $col ){
			case '1/1':
				return '<div class="shortcode1-1 '. $last .'">' . do_shortcode($content) . '</div>';
			case '1/2':
				return '<div class="shortcode1-2 '. $last .'">' . do_shortcode($content) . '</div>';
			case '1/3':
				return '<div class="shortcode1-3 '. $last .'">' . do_shortcode($content) . '</div>';
			case '1/4':
				return '<div class="shortcode1-4 '. $last .'">' . do_shortcode($content) . '</div>';
			case '1/5':
				return '<div class="shortcode1-5 '. $last .'">' . do_shortcode($content) . '</div>';
			case '2/3':
				return '<div class="shortcode2-3 '. $last .'">' . do_shortcode($content) . '</div>';
			case '2/5':
				return '<div class="shortcode2-5 '. $last .'">' . do_shortcode($content) . '</div>';
			case '3/4':
				return '<div class="shortcode3-4 '. $last .'">' . do_shortcode($content) . '</div>';
			case '3/5':
				return '<div class="shortcode3-5 '. $last .'">' . do_shortcode($content) . '</div>';
			case '4/5':
				return '<div class="shortcode4-5 '. $last .'">' . do_shortcode($content) . '</div>';
			default : 
		}			
	}
	
	
	// shortcode for column
	add_shortcode('clear', 'rs_clear_column_shortcode');
	function rs_clear_column_shortcode( $atts ) {
		return '<div class="clear"></div>';
	}
	
	
	// shortcode for accordion
	add_shortcode( 'accordion', 'rs_accordion_shortcode' );
	function rs_accordion_shortcode( $atts, $content = null ){
		
		$accordion = '';
		$accordion .= '<ul class="rs-accordion list-unstyled">';
			$accordion .= do_shortcode($content);
		$accordion .= "</ul>";
		
		return $accordion;
	}
	
	add_shortcode( 'acc_item', 'rs_acc_item_shortcode' );
	function rs_acc_item_shortcode( $atts, $content = null ){

		extract( shortcode_atts(array("title" => ''), $atts) );
		
		$acc_item = "";
		$acc_item .= "<li class='rs-divider'>";
			$acc_item .= "<h2 class='accordion-title'>$title</h2>";
			$acc_item .= "<div class='accordion-content'>" . do_shortcode($content) . "</div>";
		$acc_item .= "</li>";

		return $acc_item;
	}
	
	// shortcode for roundabout
	add_shortcode( 'roundabout', 'rs_roundabout_shortcode' );
	function rs_roundabout_shortcode( $atts, $content = null ){
		
		$roundabout = '';
		$roundabout .= '<ul id="rs-roundabout" class="rs-roundabout list-unstyled">';
			$roundabout .= do_shortcode($content);
		$roundabout .= "</ul>";
		
		return $roundabout;
	}
	
	add_shortcode( 'rnd_item', 'rnd_item_shortcode' );
	function rnd_item_shortcode( $atts, $content = null ){

		extract( shortcode_atts(array("title" => ''), $atts) );
		
		$acc_item = "";
		$acc_item .= "<li>";
			$acc_item .= "<div class='rbt-content'>";
				$acc_item .= "<h4 class='rbt-title'>$title</h4>";
			$acc_item .= "</div>";
			$acc_item .= "<figure>". do_shortcode( $content ) . "</figure>";
		$acc_item .= "</li>";

		return $acc_item;
	}
	
	
	// shortcode for toggle box
	add_shortcode( 'toggle_box', 'rsl_toggle_box_shortcode' );
	function rsl_toggle_box_shortcode( $atts, $content = null ){
	
		$toggle_box = '<ul class="rs-toggle-box list-unstyled">';
		$toggle_box = $toggle_box . do_shortcode($content);
		$toggle_box = $toggle_box . "</ul>";
		return $toggle_box;
	}
	
	
	add_shortcode( 'toggle_item', 'rs_toggle_item_shortcode' );
	function rs_toggle_item_shortcode( $atts, $content = null ){
	
		extract( shortcode_atts(array("title" => '', "active" => 'false'), $atts) );

		$active = ( $active == "true" )? " active": '';
		
		$toggle_item = '';
		$toggle_item .= "<li class='rs-divider" . $active . "'>";
		$toggle_item .= "<h2 class='toggle-box-title'>";
		$toggle_item .= $title; 
		$toggle_item .= "</h2>";
		$toggle_item .= "<div class='toggle-box-content" . $active . "'>" . do_shortcode($content) . "</div>";
		$toggle_item .= "</li>";
	
	
		return $toggle_item;
	}
	
	// shortcode for tab
	$gdl_tab_array = array();
	
	add_shortcode( 'tab', 'rs_tab_shortcode' );
	function rs_tab_shortcode( $atts, $content = null ){

		global $gdl_tab_array;
		$gdl_tab_array = array();
		
		do_shortcode($content);
		
		$num = sizeOf($gdl_tab_array);
		
		$tab = '';
		$tab .= '<div class="rs-tab">';
			$tab .= "<ul class='rs-tab-title list-unstyled'>";
				for($i=0; $i<$num; $i++){
					$active = ( $i == 0 )? 'active':'';
					$tab_id = str_replace(' ', '-', $gdl_tab_array[$i]["title"]);
					
					$tab .= '<li><a data-tab="tab-' . $i  . '" class="gdl-title ';
					$tab .= $active . '" >' . $gdl_tab_array[$i]["title"] . '</a></li>';
				}				
			$tab = $tab . "</ul><div class='clear'></div>";
			
			$tab = $tab . "<ul class='rs-tab-content list-unstyled'>";
				for( $i=0; $i<$num; $i++ ){
					$active = ( $i == 0 )? 'active':'';
					$tab_id = str_replace(' ', '-', $gdl_tab_array[$i]["title"]);

					$tab .= '<li data-tab="tab-' . $i . '" class="';
					$tab .= $active . '" >' . $gdl_tab_array[$i]["content"] . '</li>';
				}
			$tab .= "</ul>";
		$tab .= "</div>";

		return $tab;
	}
	
	add_shortcode( 'tab_item', 'rsl_tab_item_shortcode' );
	function rsl_tab_item_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(array("title" => ''), $atts) );
		
		global $gdl_tab_array;

		$gdl_tab_array[] = array("title" => $title , "content" => do_shortcode($content));
	}
	
	
	// shortcode for divider
	add_shortcode( 'divider', 'rs_divider_shortcode' );
	function rs_divider_shortcode( $atts ){
		
		extract( shortcode_atts(array("scroll_text" => ''), $atts) );	
		
		$divider = '';
		$divider .= '<div class="rs-divider"><div class="scroll-top">';	
		$divider .= $scroll_text . '</div></div>';	
		
		return $divider;
	}
	
	// shortcode for youtube
	add_shortcode( 'youtube', 'rs_youtube_shortcode' );
	function rs_youtube_shortcode( $atts, $content = null ){
	
		extract( shortcode_atts(array("height" => '', "width" => ''), $atts) );
		
		preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $content, $id);
		
		$youtube = '';
		$youtube = '<div class="flex-video" style="max-width:' . $width . 'px;" >';
		$youtube .= '<iframe src="http://www.youtube.com/embed/' . $id[1] . '?wmode=transparent" width="' . $width . '" height="' . $height . '" ></iframe>';
		$youtube .= '</div>';
		
		return $youtube;
	}
	
	// shortcode for vimeo
	add_shortcode( 'vimeo', 'rs_vimeo_shortcode' );
	function rs_vimeo_shortcode( $atts, $content = null ){
	
		extract( shortcode_atts(array("height" => '', "width" => ''), $atts) );
	
		preg_match('/http:\/\/vimeo.com\/(\d+)$/', $content, $id);
		
		$vimeo = '';
		$vimeo = '<div class="flex-video" style="max-width:' . $width . 'px;" >';
		$vimeo .= '<iframe src="http://player.vimeo.com/video/' . $id[1] . '?title=0&amp;byline=0&amp;portrait=0" width="' . $width . '" height="' . $height . '" ></iframe>';
		$vimeo .= '</div>';
		
		return $vimeo;
	}
	
	// shortcode for space
	add_shortcode( 'space', 'rs_space_shortcode' );
	function rs_space_shortcode( $atts ){
		
		extract( shortcode_atts(array("height" => '20'), $atts) );	
		
		return "<div class='clear' style='height:" . $height . "px' ></div>";
	}
	
	add_shortcode( 'quote', 'gdl_quote_shortcode' );
	function gdl_quote_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(array("align" => 'center', 'color'=>'#6f6f6f'), $atts) );	
		
		return '<blockquote class="' . $align . '" style="color:' . $color . '"><p>' . $content . '</p></blockquote>';
	}
	
	add_shortcode( 'dropcap', 'rs_dropcap_shortcode' );
	function rs_dropcap_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(array("type" => '', "color" => '#222', "background"=> ''), $atts) );	
		
		return '<div class="dropcap ' . $type . '" style="color:'. $color .'; background-color:' . $background . ';">' . $content . '</div>';
	}
	
	// shortcode for button
	add_shortcode( 'button', 'rs_button_shortcode' );
	function rs_button_shortcode( $atts, $content = null ){
	
		extract( shortcode_atts(array("color" => '', "background" => '', "class" => '', "src"=> '#', 'target'=>'_self'), $atts) );	
		
		$button_border = '';
		if( ! empty( $background )){
			$button_border = '#' .$background;
		}
		
		return '<a href="' . $src . '" target="' . $target . '" class="btn ' . $class . '" style="color:' . $color . '; background-color:' . $background . '; border-color:' . $button_border . '; ">' . $content . '</a>';
	}
	
	add_shortcode( 'box', 'rs_box_shortcode' );
	function rs_box_shortcode( $atts, $content = null ) {
		extract( shortcode_atts(array("class" => '', "id" => ''), $atts ) );	
		
		return '<div class="'. $class .'" id="'. $id .'">'. do_shortcode( $content ) .'</div>';
	}
	
	add_shortcode( 'list', 'rs_list_shortcode' );
	function rs_list_shortcode( $atts, $content = null ){
	
		extract( shortcode_atts(array("type" => ''), $atts) );
		
		return '<div class="list '. $type .' ">'. do_shortcode( $content ) .'</div>';
	}
	
	add_shortcode( 'testimonial', 'rs_testimonial_shortcode' );
	function rs_testimonial_shortcode( $atts ){
	
		extract( shortcode_atts(array("title" => ''), $atts) );
		
		$posts = get_posts(array('post_type' => 'testimonial', 'name'=>$title, 'numberposts'=> 1));
		
		$testimonial = '<div class="testimonial-content">';
		$testimonial = $testimonial . '<div class="testimonial-icon"></div>';
		$testimonial = $testimonial . $posts[0]->post_content;
		$testimonial = $testimonial . '</div>';
			
		$testimonial = $testimonial . '<div class="testimonial-author gdl-divider">';
		$testimonial = $testimonial . '<span class="testimonial-author-name">' . $posts[0]->post_title . ', </span>';
		$testimonial = $testimonial . '<span class="testimonial-author-position">'; 
		$testimonial = $testimonial . get_post_meta($posts[0]->ID, 'testimonial-option-author-position', true);
		$testimonial = $testimonial . '</span>';
		$testimonial = $testimonial . '</div>';
		
		return $testimonial;
	}
	
	add_shortcode( 'message_box', 'rs_message_box_shortcode' );
	function rs_message_box_shortcode( $atts, $content = null ){
	
		extract( shortcode_atts(array("title"=>'', "color"=>'red'), $atts) );
		
		$message_box = '';
		$message_box =  '<div class="message-box-wrapper ' . $color . '">';
		$message_box .= '<div class="message-box-title">' . $title . '</div>';
		$message_box .= '<div class="message-box-content">' . $content . '</div>';
		$message_box .= '</div>';
	
		return $message_box;
	}
	
	add_shortcode( 'social', 'rs_social_shortcode' );
	function rs_social_shortcode( $atts, $content = null){
		
		extract( shortcode_atts(array("type"=>''), $atts) );
		
		$social_icon = '';
		$social_icon .= '<div class="shortcode-icon">';
			$social_icon .= '<a href="'. $content .'"><img src="'. get_template_directory_uri() .'/images/icons/'. $type .'.png" alt="'. $type .'" /></a>';
		$social_icon .= '</div>';

		return $social_icon;
	}
	
	add_shortcode( 'frame', 'rs_frame_shortcode' );
	function rs_frame_shortcode( $atts ){
	
		extract( shortcode_atts(array("src"=>'#', "width"=>'auto', "height"=>'auto', "title"=>'', 'align'=>'none', 'lightbox'=>'on'), $atts) );
		
		$width = ( $width == "auto" )? "auto": $width.'px';
		$height = ( $height == "auto" )? "auto": $height.'px';
	
		$frame = "<img src='" . $src . "' style='width:" . $width . "; height:" . $height . ";' alt='' />";
	
		if( $lightbox == 'on' ){
			
			$frame = "<a href='" . $src . "' data-rel='prettyPhoto'  title='" . $title . "' >" . $frame . "</a>";
			
		}
		
		$frame = "<div class='gdl-image-frame shortcode-image-" . $align . "' style='max-width: 100%; float: " . $align . "; width: " . $width . "; height: " . $height . "; '>" . $frame . "</div>";
		
		return $frame;
	}
	
	
	add_shortcode( 'code', 'rs_hilighter_shortcode' );
	function rs_hilighter_shortcode( $atts, $content = null){
		
		extract( shortcode_atts(array("item_number"=>'6', "category"=>'all'), $atts) );
	
		$hilighter = '';
		$hilighter = "<div class='rs-code'>";
			$hilighter .= $content;
		$hilighter .= "</div>";
		
		return $hilighter;
	}
	
	add_shortcode( 'price-item', 'rs_price_item_shortcode' );
	function rs_price_item_shortcode( $atts ){
		
		extract( shortcode_atts(array( "item_number" => '6', "category" => 'all' ), $atts) );
	
		$price_item = '<div class="rs-price-item">';
		$price_posts = get_posts(array('post_type' => 'price_table', 'price-table-category' => $category, 
			'numberposts'=>$item_number));
		foreach($price_posts as $price_post){
			$best_price = get_post_meta( $price_post->ID, 'price_table_best_price', true );
			$best_price = ($best_price == 'Yes')? 'active': '';
			
			$price_item = $price_item . '<div class="percent-column1-' . $item_number . ' rs-divider">';
				$price_item = $price_item . '<div class="price-item ' . $best_price . '">';
					$price_item = $price_item . '<div class="price-tag">' . get_post_meta( $price_post->ID, 'price_table_tag', true ) . '</div>';
					$price_item = $price_item . '<div class="price-title">' . $price_post->post_title . '</div>';
					
					$price_item = $price_item . '<div class="price-content">';
						$price_item = $price_item . do_shortcode( $price_post->post_content );
					$price_item = $price_item . '</div>';
					
					$price_url = get_post_meta( $price_post->ID, 'price_table_button_url', true );
					if( ! empty($price_url) ) {
						$price_item = $price_item . '<div class="price-button">';
							$price_item = $price_item . '<a class="rs-button" href="' . $price_url . '">Read More</a>';
						$price_item = $price_item . '</div>';
					}
				$price_item = $price_item . '</div>';
			$price_item = $price_item . '</div>';
			
		}
		$price_item = $price_item . "<div class='clear'></div>";	
		$price_item = $price_item . '</div>';
		
		return $price_item;	
	}
	
	add_shortcode( 'hr', 'rs_hr_shortcode' );
	function rs_hr_shortcode( $atts ) {
		return '<div class="hr"></div>';
	}
	
	add_shortcode( 'text_center', 'rs_text_center_shortcode' );
	function rs_text_center_shortcode( $atts, $content = NULL ) {
		return '<div class="text-center">'. do_shortcode( $content ) .'</div>';
	}	
?>