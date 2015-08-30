<?php 
/**
 * The main template file.
 *
 *
 * @package WordPress
 * @subpackage rsclean
 */
 
get_header(); ?>
	
	<?php
		/**
		 * rstheme_before_archive_content hook
		 */
		do_action( 'rstheme_before_archive_content' );
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
					
				<?php get_template_part( 'loop' ); ?>
			</section>
			
		</div>
		
		<!--sidebar-->
		<?php get_sidebar(); ?>
	</div>
	
	<?php
		/**
		 * rstheme_after_archive_content hook
		 */
		do_action( 'rstheme_after_archive_content' );
	?>

<?php get_footer(); ?>