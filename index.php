<?php 
/**
 * The main template file.
 *
 *
 * @package WordPress
 * @subpackage RS Responsive
 */

get_header(); ?>

	<?php
		/**
		 * rstheme_before_page_content hook
		 */
		do_action( 'rstheme_before_page_content' );
	?>
	
	
		<!-- content -->        	
		<div class="row" role="main">
		
			<div class="col-md-8">
				
				<section class="section section-content">
					<?php get_template_part( 'loop' ); ?>
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