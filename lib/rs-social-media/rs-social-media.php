<?php

class RS_Social_Media extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;
	
	/**
	 * Constructor. Set the default widget options and create widget.
	 *
	 * @since 0.1.8
	 */
	function __construct() {

		$this->defaults = array(
			'title' 			=> __('Follow with us:', THEME_DOMAIN), 
		);

		$widget_ops = array(
			'classname' => 'rs-social-media', 
			'description' => __('A widget that display social media icons.', THEME_DOMAIN)
		);

		$control_ops = array(
			'id_base' => 'rs-social-media',
			'width'   => 240,
			'height'  => 300,
		);

		$this->WP_Widget( 'rs-social-media', __( 'RS Social Media', THEME_DOMAIN ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $data;
		
		extract( $args );

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		/* Before widget (defined by themes). */
		echo $before_widget;
		?>
		<div class="rs-social-media">
			
			<?php if( !empty( $instance['title'] ) ) { ?>
				<h3 class="widget-title"><?php _e( $instance['title'], THEME_DOMAIN ); ?></h3>
			<?php } ?>
			
			<div class="social-buttons">
				<ul class="list-unstyled">
					<?php if( ! empty( $data['rsclean_facebook_username'] ) ) { ?>
						<li>
							<a href="https://www.facebook.com/<?php echo $data['rsclean_facebook_username']; ?>" class="facebook">Facebook</a>
						</li>
					<?php } ?>
					
					<?php if( ! empty( $data['rsclean_twitter_username'] ) ) { ?>
						<li>
							<a href="https://www.twitter.com/<?php echo $data['rsclean_twitter_username']; ?>" class="twitter">Facebook</a>
						</li>
					<?php } ?>
					
					<?php if( ! empty( $data['rsclean_pinterest_username'] ) ) { ?>
						<li>
							<a href="https://www.twitter.com/<?php echo $data['rsclean_pinterest_username']; ?>" class="pinterest">Facebook</a>
						</li>
					<?php } ?>
				</ul>
			</div>

		</div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->defaults ); 
		?>

		<div class="widget-body">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', THEME_DOMAIN ); ?>:</label>
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
			</p>
			<p><em>Social media links can only be changed in <a href="<?php echo admin_url( 'admin.php?page=optionsframework' ); ?>">Site Theme</em> under Social Profiles.</p>
		</div>
		<?php
	}
		
	function enqueue_assets() {
		if( is_active_widget( false, false, 'rs-social-media', true ) ) {
			wp_enqueue_style( 'rs-social-media-style', get_template_directory_uri().'/lib/rs-social-media/rs-social-media.css', false, '1.0.0', 'all' );
		}
	}
	
}

/* enable embeed style */
add_action( 'wp_enqueue_scripts', array('RS_Social_Media', 'enqueue_assets' ) );

?>