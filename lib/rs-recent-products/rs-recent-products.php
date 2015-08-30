<?php

class RS_Recent_Products extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var defaults
	 */
	protected $defaults;

	
	/**
	 * Constructor. Set the default widget options and create widget.
	 *
	 * @since 0.1.8
	 */
	function __construct() {

		$this->defaults = array(
			'title'			=> 'Recent Products',
			'post_count'	=> '5'
		);

		$widget_ops = array(
			'classname'   => 'rs-recent-products',
			'description' => __( 'Displays recent project with thumbnails.', THEME_DOMAIN ),
		);

		$control_ops = array(
			'id_base' => 'rs-recent-products',
			'width'   => 240,
			'height'  => 300,
		);

		$this->WP_Widget( 'rs-recent-products', __( 'RS Recent Products', THEME_DOMAIN ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $before_widget;
		?>
		
		<div class="recent-products">
			<?php if( !empty( $instance['title'] ) ): ?>
				<h3 class="widget-title"><?php _e( $instance['title'], THEME_DOMAIN ); ?></h3>
			<?php else : ?>
				<h3 class="widget-title"><?php _e('Recent Products'); ?></h3>
			<?php endif; ?>

				<ul class="products list-unstyled">
					<li class="product-item">
						<div class="row">
							<div class="col-xs-3 col-sm-3 col-md-3">
								<figure>
									<img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/blog-post-image.jpg" alt="" />
								</figure>
							</div>
							<div class="col-xs-9 col-sm-9 col-md-9">
								<h4 class="product-title">Recent Product Sample</h4>
								<p>
									Quickly maximize timely deliverables for real-time schemas.
								</p>
							</div>
						</div>
					</li>
					<li class="product-item">
						<div class="row">
							<div class="col-xs-3 col-sm-3 col-md-3">
								<figure>
									<img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/blog-post-image.jpg" alt="" />
								</figure>
							</div>
							<div class="col-xs-9 col-sm-9 col-md-9">
								<h4 class="product-title">Recent Product Sample</h4>
								<p>
									Quickly maximize timely deliverables for real-time schemas.
								</p>
							</div>
						</div>
					</li>
					<li class="product-item">
						<div class="row">
							<div class="col-xs-3 col-sm-3 col-md-3">
								<figure>
									<img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/blog-post-image.jpg" alt="" />
								</figure>
							</div>
							<div class="col-xs-9 col-sm-9 col-md-9">
								<h4 class="product-title">Recent Product Sample</h4>
								<p>
									Quickly maximize timely deliverables for real-time schemas.
								</p>
							</div>
						</div>
					</li>
				</ul>
			
		</div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$new_instance['title']			= $new_instance['title'];
		$new_instance['post_count'] 	= $new_instance['post_count'];
		
		return $new_instance;
	}

	function form( $instance ) {
		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		?>
		<div class="widget-body">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', THEME_DOMAIN ); ?>:</label>
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'post_count' ); ?>"><?php _e( 'Number of Post', THEME_DOMAIN ); ?>:</label>
				<input type="text" id="<?php echo $this->get_field_id( 'post_count' ); ?>" name="<?php echo $this->get_field_name( 'post_count' ); ?>" value="<?php echo esc_attr( $instance['post_count'] ); ?>" class="widefat" />
				<small>defualt is <strong>5</strong></small>
			</p>
		</div>
		<?php
	}
		
	function enqueue_assets() {
		if( is_active_widget( false, false, 'rs-recent-products', true ) ) {
			wp_enqueue_style( 'RS_Recent_Products_style', get_template_directory_uri().'/lib/rs-recent-products/rs-recent-products.css', false, '1.0.0', 'all' );
		}
	}
	
}

/* enable embeed style */
add_action( 'wp_enqueue_scripts', array('RS_Recent_Products', 'enqueue_assets' ) );