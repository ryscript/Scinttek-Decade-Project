<ul class="breadcrumb">
	<?php if(function_exists('bcn_display')) { bcn_display(); } 
		else { ?>
			<li><span>You Are Here: </span></li>
			<li><a href="<?php bloginfo('url'); ?>"><?php _e('Home', THEME_DOMAIN) ?></a></li>
			
			<?php if( is_tag() ) { ?>
				<li><span><?php _e('Posts Tagged &quot; <strong>', THEME_DOMAIN) . single_tag_title() . _e('</strong> &quot;'); ?></span></li>
			<?php } elseif (is_day()) { ?>
				<li><span><?php _e('Posts made in', THEME_DOMAIN) ?> <?php the_time('F jS, Y'); ?></span></li>
			<?php } elseif (is_month()) { ?>
				<li><span><?php _e('Posts made in', THEME_DOMAIN) ?> <?php the_time('F, Y'); ?></span></li>
			<?php } elseif (is_year()) { ?>
				<li><span><?php _e('Posts made in', THEME_DOMAIN) ?> <?php the_time('Y'); ?></span></li>
			<?php } elseif (is_search()) { ?>
				<li><span><?php _e('Search results for', THEME_DOMAIN) ?> <?php the_search_query() ?></span></li>
			<?php } elseif (is_single()) { ?>
				<?php
					$category = get_the_category();
					if( !empty($category) ) { 
						$catlink = get_category_link( $category[0]->cat_ID );
						echo '<li><a href="'.$catlink.'">'.$category[0]->cat_name.'</a></li>';
					};
					
					echo '<li class="current"><span>'.get_the_title().'</span></li>';
				?>
			<?php } elseif (is_category()) { ?>
				<li><span><?php single_cat_title(); ?></span></li>
			<?php } elseif (is_author()) { ?>
				<?php global $wp_query;
					  $curauth = $wp_query->get_queried_object(); ?>
				<li><span><?php _e('Posts by ', THEME_DOMAIN); echo ' ', $curauth->nickname; ?></span></li>
			<?php } elseif (is_page()) { ?>
				<li><span><?php the_title(); ?></span></li>
			<?php } elseif (is_404()) { ?>
				<li><span>Error 404</span></li>
			<?php }; ?>
	<?php }; ?>
</ul> 
<!-- end #breadcrumbs -->