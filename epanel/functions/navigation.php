<div class="pagination">
	<div class="row">
		<div class="col-md-12">
			<?php
				$total_pages = $GLOBALS['wp_query']->max_num_pages;  
				$big = 999999999; // need an unlikely integer
				
				if ( $total_pages > 1 )
				{
					$current_page = max(1, get_query_var('paged'));  
					$nav_args = array(
							'base' 			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' 		=> '/page/%#%',  
							'current' 		=> $current_page,  
							'total'			=> $total_pages,
							'show_all'     	=> false,
							'end_size'     	=> 2,
							'mid_size'     	=> 4,
							'prev_text' 	=> '&lsaquo; Prev',  
							'next_text' 	=> 'Next &rsaquo;',
							'type' 			=> 'list' 
						);
						 
					echo paginate_links( $nav_args );  
				}
			?>
		</div>
	</div>
</div>