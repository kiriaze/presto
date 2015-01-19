<div id="post" <?php post_class('row'); ?>>
	<div class="span8 offset2">
		<div class="quote-container light_italic">
			<?php the_content(); ?>
		</div>
		<div class="wysiwyg no-meta <?php if(is_single() ) : echo 'single-quote'; endif; ?> <?php font_sizes(); ?>">
			<p class="quote"><?php the_title(); ?>, <a href="<?php the_permalink(); ?>">#</a></p>
			<?php if(is_single() ) : ?>
				<?php get_template_part('partials/blog-metas'); ?>
			<?php endif; ?>
		</div>
	</div>
</div>