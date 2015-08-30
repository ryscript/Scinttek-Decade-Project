<?php

class RS_Tabs extends WP_Widget {

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
			'title'			=> 'RS Tabs'
		);

		$widget_ops = array(
			'classname'   => 'rs-tabs',
			'description' => __( 'Displays latest posts, comments and tags.', THEME_DOMAIN ),
		);

		$control_ops = array(
			'id_base' => 'rs-tabs',
			'width'   => 240,
			'height'  => 300,
		);

		$this->WP_Widget( 'rs-tabs', __( 'RS Tabs', THEME_DOMAIN ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $before_widget;
		?>
		
		<div class="rs-tabs-wrapper">
			<?php if( !empty( $instance['title'] ) ): ?>
				<h3 class="widget-title"><?php _e( $instance['title'], THEME_DOMAIN ); ?></h3>
			<?php endif; ?>
			
			<ul class="tabs list-unstyled clearfix">
				<li><a href="#tab-popular">Popular</a></li>
				<li><a href="#tab-recent">Recent</a></li>
			</ul>
			<div id="tab-popular" class="scroll-content">
				<ul class="tab-popular list-unstyled">
					<?php
						$args = array(
							'post_type'  => 'post',
							'post_count' => 5,
							'meta_key'   => '_post_view',
							'orderby'    => 'meta_value_num',
							'order'      => 'DESC'
						);
						
						$popular_query = new WP_Query( $args );
						
						if( $popular_query ) {
							while( $popular_query->have_posts() ) { $popular_query->the_post();
								?>
									<li>
										<div class="row">
											<div class="col-xs-3 col-sm-3 col-md-3">
												<figure>
													<?php
														$attr = array(
															'class'	=> "blog-attachment-media",
															'alt'	=> trim(strip_tags( get_the_title() )),
															'title'	=> trim(strip_tags( get_the_title() ))
														);
														echo get_the_post_thumbnail( get_the_ID(), apply_filters( 'popular_post_thumbnail_size', 'thumbnail' ), $attr );
													?>
												</figure>
											</div>
											<div class="col-xs-9 col-sm-9 col-md-9">
												<h4 class="popular-title mt0">
													<a href="<?php esc_url( the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
														<?php echo rs_truncate( get_the_title(), 50 ); ?>
													</a>
												</h4>
												
												<div class="views">
													<span class="post-views"><?php echo get_post_views(); ?></span>
												</div>
											</div>
										</div>
									</li>
								<?php
							}
							
							/* Restore original Post Data */
							wp_reset_postdata();
						}
					?>
				</ul>
				
			</div>
			<div id="tab-recent" class="scroll-content">
				<ul class="tab-recent list-unstyled">
					<?php
						$args = array(
							'post_type'  => 'post',
							'post_count' => 5
						);
						
						$recent_query = new WP_Query( $args );
						
						if( $recent_query ) {
							while( $recent_query->have_posts() ) { $recent_query->the_post();
								?>
									<li>
										<div class="row">
											<div class="col-xs-3 col-sm-3 col-md-3">
												<figure>
													<?php
														$attr = array(
															'class'	=> "blog-attachment-media",
															'alt'	=> trim(strip_tags( get_the_title() )),
															'title'	=> trim(strip_tags( get_the_title() ))
														);
														echo get_the_post_thumbnail( get_the_ID(), apply_filters( 'recent_post_thumbnail_size', 'thumbnail' ), $attr );
													?>
												</figure>
											</div>
											<div class="col-xs-9 col-sm-9 col-md-9">
												<h4 class="recent-title mt0">
													<a href="<?php esc_url( the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
														<?php echo rs_truncate( get_the_title(), 50 ); ?>
													</a>
												</h4>
												
												<div class="date">
													<span class="date-posted"><?php the_time('F j, Y'); ?></span>
												</div>
											</div>
										</div>
											
									</li>
								<?php
							}
							
							/* Restore original Post Data */
							wp_reset_postdata();
						}
					?>
				</ul>
			</div>
		</div>
		<?php

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$new_instance['title']			= $new_instance['title'];
		
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
		</div>
		<?php
	}
		
	function enqueue_assets() {
		if( is_active_widget( false, false, 'rs-tabs', true ) ) {
			wp_enqueue_style( 'rs_tabs_style', get_template_directory_uri().'/lib/rs-tabs/rs-tabs.css', false, '1.0.0', 'all' );
			
			wp_enqueue_script( 'rs_tabs_script', get_template_directory_uri().'/lib/rs-tabs/rs-tabs.js', array('jquery'), '1.0' );
		}
	}
	
}

/* enable embeed style */
add_action( 'wp_enqueue_scripts', array('RS_Tabs', 'enqueue_assets' ) );

?>