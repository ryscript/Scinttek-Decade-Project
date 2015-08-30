<div class="clearfix post-info">

	<?php if( is_single() ) { ?>
	
		<div class="entry-utility">
			<span class="cat-links">This entry was posted in <?php echo get_the_category_list( ', ' ) ?></span>
			<span class="meta-sep"> / </span>
			<span class="author vcard">by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>
			<span class="meta-sep"> / </span>
			<span class="bookmark-links"><?php echo __( 'Bookmark the <a href="'. esc_url( get_permalink() ) .'" title="Permalink to '. esc_attr( get_the_title() ) .'" rel="bookmark">permalink</a>.', THEME_DOMAIN ); ?></span>
			<?php edit_post_link( __(' { Edit }', THEME_DOMAIN), '<span class="small">', '</span>' ); ?>
		</div>
		
	<?php } else { ?>
	
		<div class="entry-utility">
			<span class="cat-links">Posted in <?php echo get_the_category_list( ', ' ) ?></span>
			<span class="meta-sep"> / </span>
			<span class="author vcard">by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>
			<span class="meta-sep"> / </span>
			<span class="comments-link"> <?php comments_popup_link(__('comment (0)', THEME_DOMAIN), __('comment (1)', THEME_DOMAIN), __('comments (%)', THEME_DOMAIN)); ?> </span>
			<?php edit_post_link( __('{ Edit }', THEME_DOMAIN), '<span class="small">', '</span>' ); ?>
		</div>
		
	<?php } ?>
	
</div>