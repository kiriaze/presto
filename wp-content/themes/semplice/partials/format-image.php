<div id="post" <?php post_class('row'); ?>>
	<div class="span8 offset2">
		<div class="post-heading <?php if(trim(get_the_content()) === "") : echo 'no-content'; endif; ?> format-image">
			<p><a href="<?php the_permalink(); ?>"><?php echo get_the_date('F d, Y'); ?></a> - <?php comments_popup_link(__('No Comments!', 'semplice'), __('1 comment.', 'semplice'), __('% comments', 'semplice')); ?></p>
		</div>
		<div class="wysiwyg no-meta <?php font_sizes(); ?>">
			<?php the_content(__('Read more', 'semplice')); ?>
			<?php if(is_single() ) : ?>
				<?php get_template_part('partials/blog-metas'); ?>
			<?php endif; ?>
		</div>
	</div>
</div>	