<?php
/**
 * The template for displaying pages
 * 
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage RS_Theme
 * @since RS Theme 1.0
 */
 
get_header(); ?>

	<?php
		/**
		 * rstheme_before_page_content hook
		 */
		do_action( 'rstheme_before_page_content' );
	?>

	<div class="row">
		<div class="col-md-8">
			
			<section class="section section-content">
				<?php
					/**
					 * rstheme_before_page_post hook
					 * @hooked	rstheme_page_breadcrumbs - 10
					 */
					do_action( 'rstheme_before_page_post' );
				?>
				
				<?php while(have_posts()) : the_post(); ?>
					
					<article itemscope itemtype="http://schema.org/BlogPosting" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
		
		<!--sidebar-->
		<?php get_sidebar(); ?>
	</div>
	
	<?php
		/**
		 * rstheme_after_page_content hook
		 */
		do_action( 'rstheme_after_page_content' );
	?>

<?php get_footer(); ?>