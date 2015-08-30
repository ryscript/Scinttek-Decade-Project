<div class="mb20 featured-image">
	<figure>
		<?php
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			
			$attr = array(
				'class'	=> "blog-attachment-media",
				'alt'	=> trim(strip_tags( get_the_title() )),
				'title'	=> trim(strip_tags( get_the_title() ))
			);
			echo '<a href="'. $post_thumbnail_url .'" data-rel="fancybox">' . get_the_post_thumbnail( get_the_ID(), apply_filters( 'single_post_large_thumbnail_size', 'full' ), $attr ) . '</a>';
		?>
	</figure>
	
	<?php do_action( 'rstheme_before_single_after_thumbnail', get_the_ID() ); ?>
</div>