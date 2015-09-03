<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<label class="hidden" for="s"><?php _e('Search:'); ?></label>
	<div class="searchform-wrap">
		<span class="ss-icon">search</span>
		<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="Search" />
	</div>
	<input type="submit" id="searchsubmit" value="GO" />
</form>