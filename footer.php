				<?php global $data; ?>
				
				</div> <!--<div class="wrapper">-->
			</main> <!--<div role="main" id="main">-->
		
		<footer id="footer">
		
			<div class="container">
				<div class="row">
				
					<div class="col-md-6">
						<?php
							$menu_class = 'footer-menu list-unstyled list-inline';
							$main_nav = '';
								
							if ( function_exists('wp_nav_menu') ) {
								$main_nav = wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menu_class, 'echo' => false ) );
							};
							if ($main_nav == '') : ?>
								<ul class="<?php echo $menu_class; ?>">	
									<?php wp_list_pages('sort_column=menu_order&title_li='); ?>
								</ul> <?php
							else :
								echo( $main_nav );
							endif; 
						?>
					</div>
					
					<div class="col-md-6">
						<p class="copyright text-right">
							<?php echo $data['rsclean_footer_text']; ?>
						</p>
					</div>
					
				</div>
			</div>
			
		</footer>
		
		<?php
			/* Always have wp_footer() just before the closing </body>
			 * tag of your theme, or you will break many plugins, which
			 * generally use this hook to reference JavaScript files.
			 */
			
			wp_footer();
			
			echo $data['rsclean_ga_code'];
		?>
		
		<script src="https://apis.google.com/js/platform.js" async defer></script>
	</body>
</html>