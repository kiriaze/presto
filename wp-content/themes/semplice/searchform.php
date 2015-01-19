<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo setIcon('search_big'); ?></span>
		<?php if(!is_search()) : ?><span class="close-search"><a class="search-close"><?php echo setIcon('close'); ?></a></span><?php endif; ?>
		<input type="search" class="search-field light" placeholder="<?php echo __('Search and hit enter', 'semplice'); ?>" value="" name="s" title="Search for:" />
	</label>
</form>