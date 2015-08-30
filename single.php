<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage RS_Theme
 * @since RS Theme 1.0
 */

get_header(); ?>
	
	<?php
		/**
		 * rstheme_before_single_content hook
		 */
		do_action( 'rstheme_before_single_content' );
	?>
	
	<div class="row">
		<div class="col-md-8">
		
			<section class="section section-content">
				<?php
					/**
					 * rstheme_before_single_post hook
					 * @hooked rstheme_single_breadcrumbs - 10
					 */
					do_action( 'rstheme_before_single_post' );
				?>
				
				<?php while(have_posts()) : the_post(); ?>
					
					<article itemscope itemtype="http://schema.org/BlogPosting" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php
							/**
							 * rstheme_before_single_summary hook
							 * @hooked rstheme_single_post_title - 10
							 * @hooked rstheme_single_post_image - 20
							 * @hooked rstheme_single_post_meta - 30
							 * @hooked rstheme_single_post_content - 40
							 */
							do_action( 'rstheme_before_single_summary' );
						?>
					</article>
						
				<?php endwhile; ?>
				
				<?php
					/**
					 * rstheme_after_single_post hook
					 * @hooked rstheme_single_post_navigation - 10
					 * @hooked rstheme_single_post_tags - 20
					 * @hooked rstheme_single_post_comments -30
					 */
					do_action( 'rstheme_after_single_post' );
				?>
			</section>
			
		</div>
		
		<!--sidebar-->
		<?php get_sidebar(); ?>
	</div>
	
	<?php
		/**
		 * rstheme_after_sigle_content hook
		 */
		do_action( 'rstheme_after_sigle_content' );
	?>

<?php get_footer(); ?>