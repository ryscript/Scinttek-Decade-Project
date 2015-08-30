<?php
/**
 * The Template for displaying 404 page or page not found
 */

get_header(); ?>
	
	<?php
		/**
		 * rstheme_before_page_content hook
		 */
		do_action( 'rstheme_before_page_content' );
	?>
	
	<div class="row">
		
		<div class="col-md-12">
			
			<section class="section section-content">
				<?php
					/**
					 * rstheme_before_page_post hook
					 * @hooked	rstheme_page_breadcrumbs - 10
					 */
					do_action( 'rstheme_before_page_post' );
				?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry">
						<p>Sorry but we can't find the posts you're looking for, perhaps searching will help.</p>
					
						<?php get_search_form(); ?>
					</div>
				</article>
			</section>
		</div>
		
	</div>
	
	<?php
		/**
		 * rstheme_after_page_content hook
		 */
		do_action( 'rstheme_after_page_content' );
	?>

<?php get_footer(); ?>