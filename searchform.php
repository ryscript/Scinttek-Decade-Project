<!-- Postfix action -->
<form method="get" id="searchform" action="<?php  echo home_url(); ?>/">
	<div class="row no-gutter">
		<div class="col-xs-10 col-sm-8 col-md-10">
			<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Enter Search Here" />
		</div>
		<div class="col-xs-2 col-sm-4 col-md-2">
			<div class="text-right">
				<input type="submit" class="search-icon" value="Search" />
			</div>
		</div>
	</div>
</form>