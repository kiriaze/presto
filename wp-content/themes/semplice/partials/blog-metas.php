<div class="row meta">
	<div class="span8">
		<p>	
			<span><?php echo __('Published by: ', 'semplice'); ?><?php the_author(); ?><?php if( has_category() ) : echo __(' in</span> ', 'semplice'); the_category(', '); endif; ?>			
		</p>
	</div>
</div>
<div class="share-box share-box-blog">
	<?php if(get_field('share_visibility', 'options') !== 'disabled') : ?>
		<?php get_template_part('partials/share'); ?>
	<?php endif; ?>
</div>