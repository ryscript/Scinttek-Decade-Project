<div class="col-md-4">
	<aside>	
		
		<?php if ( is_active_sidebar( 'primary' ) ) : ?>
			<?php dynamic_sidebar( 'primary' ); ?>
		<?php else: ?>
			
			<div class="widget">
				<div class="widget-wrap">
					<h4>No widgets added</h4>
					<p>This is the <em>Primary Sidebar Widget Area</em>. You can modify this widget area by going to the <a href="<?php echo admin_url('widgets.php'); ?>" >widget settings</a> page.</p>
				</div>
			</div>
		<?php endif; ?>

	</aside>
</div>