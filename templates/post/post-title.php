<?php

$title = '';
$hide_title = get_post_meta( get_the_ID(), '_cmb_hide_title', true );

if( $hide_title != 'on' ) {
	?>
		<header>
			<h2 itemprop="headline" class="entry-title">
				<?php the_title(); ?>
			</h2>
		</header>
	<?php
}