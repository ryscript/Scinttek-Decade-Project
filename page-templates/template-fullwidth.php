<?php
/*
Template Name: Full Width
*/

get_header(); ?>

	<?php
		/**
		 * rstheme_before_page_content hook
		 */
		do_action( 'rstheme_before_page_content' );
	?>
	
	<!--content-->
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

				<?php while(have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php
							/**
							 * rstheme_single_page_summary hook
							 * @hooked rstheme_single_page_title - 10
							 * @hooked rstheme_single_page_meta - 20
							 * @hooked rstheme_single_page_content - 30
							 */
							do_action( 'rstheme_single_page_summary' );
						?>
					</article>
				
				<?php endwhile; ?>
				
				<?php
					/**
					 * rstheme_after_page_post hook
					 * @hooked	rstheme_single_page_comments - 10
					 */
					do_action( 'rstheme_after_page_post' );
				?>
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