<?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>
		<article class="blog-post">
			<div class="container">
				<?php
					
					/* Post formats that will use the standard post format layout */
					$formats = array('aside', 'chat', 'status', 'link');
					
					if(!get_post_format() || in_array(get_post_format(), $formats)) { 
						get_template_part('partials/format', 'standard');
					} else {
						get_template_part('partials/format', get_post_format());
					}
				?>
			</div>
		</article>
		<?php if(!is_single()) : ?>
			<div class="post-divider search-divider"></div>
		<?php endif; ?>
	<?php endwhile; ?>
<?php else :  ?>
	<?php if(is_search()) : ?>
	<div class="container">
		<div class="row">
			<div class="span12"><p class="no-results"><?php echo __('No results were found. Please try a different search.', 'semplice'); ?></p></div>
		</div>
	</div>
	<?php endif; ?>
<?php endif; ?>