<?php if( ! is_front_page() ) { ?>
	<header>
		<h2 itemprop="headline" class="page-title">
			<?php echo apply_filters( 'single_page_title', get_the_title() ); ?>
		</h2>
	</header>
<?php } ?>