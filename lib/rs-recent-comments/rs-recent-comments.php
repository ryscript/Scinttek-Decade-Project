<?php

class RS_Recent_Comments extends WP_Widget {

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
			'title'			=> 'Recent Comments',
			'post_count'	=> '5'
		);

		$widget_ops = array(
			'classname'   => 'rs-recent-comments',
			'description' => __( 'Displays recent comment with author attached in it.', THEME_DOMAIN ),
		);

		$control_ops = array(
			'id_base' => 'rs-recent-comments',
			'width'   => 240,
			'height'  => 300,
		);

		$this->WP_Widget( 'rs-recent-comments', __( 'RS Recent Comments', THEME_DOMAIN ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $before_widget;
		?>
		
		<div class="recent-comments">
		
			<?php if( !empty( $instance['title'] ) ): ?>
				<h3 class="widget-title"><?php _e( $instance['title'], THEME_DOMAIN ); ?></h3>
			<?php endif; ?>

			<ul class="comments list-unstyled">
				<?php
					$args = array(
					   'status' => 'approve',
					);

					// The Query
					$comments_query = new WP_Comment_Query;
					$comments = $comments_query->query( $args );

					// Comment Loop
					if ( $comments ) {
						foreach ( $comments as $comment ) {
							?>
								<li class="comment-item">
									<div class="row">
										<div class="col-xs-3 col-sm-2 col-md-3">
											<figure>
												<?php echo get_avatar( $comment->user_id, 68 ); ?>
											</figure>
										</div>
										<div class="col-xs-9 col-sm-10 col-md-9">
											<div class="comment-body">
												<?php echo esc_attr( $comment->comment_content ); ?>
												
												<div class="author-url">
													<a href="<?php echo esc_url( $comment->comment_author_url ); ?>">
														<?php echo esc_url( $comment->comment_author_url ); ?>
													</a>
												</div>
											</div>
										</div>
									</div>
								</li>
							<?php
						}
					} else {
						echo '<p>No comments found.</p>';
					}
				?>
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
		if( is_active_widget( false, false, 'rs-recent-comments', true ) ) {
			wp_enqueue_style( 'RS_Recent_Comments_style', get_template_directory_uri().'/lib/rs-recent-comments/rs-recent-comments.css', false, '1.0.0', 'all' );
		}
	}
	
}

/* enable embeed style */
add_action( 'wp_enqueue_scripts', array('RS_Recent_Comments', 'enqueue_assets' ) );