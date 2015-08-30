<?php

global $data;
	
if( $data['rsclean_enable_postcomment'] ) {
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
}