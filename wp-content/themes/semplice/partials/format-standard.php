<?php if (has_post_thumbnail( $post->ID ) ) : ?>
	<?php 
	
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
		
		// neg margin
		$has_neg_margin = false;
		$neg_margin = false;
		
		if($image[1] >= 1170) {
			$has_neg_margin = 'has-neg-margin';
			$neg_margin = 'style="margin-left: -' . ($image[1] - 1170) / 2 . 'px;"';
		}

	?>
	<div class="row">
		<div class="span12 featured">
	   		<?php if(!is_single()) : ?><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php endif; ?><img src="<?php echo $image[0]; ?>" class="<?php echo $has_neg_margin; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="Featured Image" <?php echo $neg_margin; ?> /><?php if(!is_single()) : ?></a><?php endif; ?>
		</div>
	</div>
<?php endif; ?>
<div id="post" <?php post_class('row'); ?>>
	<div class="span8 offset2">
		<div class="post-heading <?php if(trim(get_the_content()) === "") : echo 'no-content'; endif; ?>">
			<p><a href="<?php the_permalink(); ?>"><?php echo get_the_date('F d, Y'); ?></a> - <?php comments_popup_link(__('No Comments!', 'semplice'), __('1 comment.', 'semplice'), __('% comments', 'semplice')); ?></p>
			<h2 class="<?php if(get_field('skinoptions_heading_fontsize', 'options')) : echo get_Field('skinoptions_heading_fontsize', 'options'); endif; ?> <?php if(get_field('skinoptions_heading_weight', 'options')) : echo get_field('skinoptions_heading_weight', 'options'); else : echo 'bold'; endif; ?> <?php echo get_field('skinoptions_heading_align', 'options'); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</div>
		<div class="wysiwyg no-meta <?php font_sizes(); ?>">
			<?php the_content(__('Read more', 'semplice')); ?>
			<?php if(is_single() ) : ?>
				<?php get_template_part('partials/blog-metas'); ?>
			<?php endif; ?>
		</div>
	</div>
</div>	