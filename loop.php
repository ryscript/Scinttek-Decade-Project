<?php
global $data;

if ( have_posts() ) : ?>

		<?php while ( have_posts() ) { the_post(); ?>
		
			<article itemscope itemtype="http://schema.org/BlogPosting" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if( has_post_thumbnail() ) { ?>
					<div class="blog-media mb40">
						<?php
							$attr = array(
								'class'	=> "blog-attachment-media",
								'alt'	=> trim(strip_tags( get_the_title() ))
							);
							echo '<a href="'. esc_url( get_permalink() ).'">'.get_the_post_thumbnail( get_the_ID(), 'full', $attr ).'</a>';
						?>
					</div>
				<?php } ?>
				
				<?php
					if( $data['rsclean_enable_postmeta'] )
						include( POST_INFO );
				?>

				<?php do_action( 'rstheme_before_loop_single_summary', get_the_ID(), get_post_type() ); ?>

				<div class="entry">
					<h2 class="entry-title">
						<a href="<?php the_permalink() ?>" title="<?php printf(__('Permanent Link to %s', THEME_DOMAIN), get_the_title()) ?>" rel="bookmark">
							<?php the_title(); ?>
						</a>
					</h2>
				
					<?php the_content( "read more"); ?>
				</div>

				<?php do_action( 'rstheme_after_loop_single_summary', get_the_ID(), get_post_type() ); ?>
			</article>

		<?php } ?>
		
	<?php 
		if(function_exists('wp_paginate')) {
			wp_paginate();
		} else {
			include( NAVIGATION );
		}
	?>
	
<?php else: ?>

	<h2><?php _e( 'No content found', THEME_DOMAIN ); ?></h2>
	<p><?php _e( 'Sorry but we don\'t have enough post yet to dipslay at the moment.', THEME_DOMAIN ); ?></p>
	
<?php endif; ?>