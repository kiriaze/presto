<div class="row">
        <?php
        	/* upload, link or embed */
        	if(get_field('videotype') === 'video' OR get_field('videotype') === 'link') :
				$videoType = get_field('videotype');
        		?>
        		<div class="featured featured-video span12">
	             	<video style="max-width: 100%;" id="videopost-<?php echo $post->ID; ?>" preload="none" poster="<?php echo get_field('video_poster'); ?>">
						<?php if(get_field($videoType . '_mp4')) : ?><source src="<?php echo get_field($videoType . '_mp4'); ?>" type="video/mp4"><?php endif; ?>
						<?php if(get_field($videoType . '_ogv')) : ?><source src="<?php echo get_field($videoType . '_ogv'); ?>" type="video/ogg"><?php endif; ?>
						<p>If you are reading this, it is because your browser does not support the HTML5 video element.</p>
					</video>
				</div>
        		<?php
			elseif(get_field('videotype') === 'embed') :
        		?>
        		<div class="featured responsive-video span12">
				<?php
					$oembed = '[embed]' . get_field('video_embed') . '[/embed]';
        			$oembed = apply_filters('the_content', $oembed);
					echo $oembed;
				?>
        		</div>
        		<?php
			endif;
        ?>
</div>
<div id="post" <?php post_class('row'); ?>>
	<div class="span8 offset2">
		<div class="post-heading <?php if(trim(get_the_content()) === "") : echo 'no-content'; endif; ?>">
			<p><a href="<?php the_permalink(); ?>"><?php echo get_the_date('F d, Y'); ?></a> - <?php comments_popup_link(__('No Comments!', 'semplice'), __('1 comment.', 'semplice'), __('% comments', 'semplice')); ?></p>
			<h2 class="<?php if(get_field('skinoptions_heading_fontsize', 'options')) : echo get_Field('skinoptions_heading_fontsize', 'options'); endif; ?> <?php if(get_field('skinoptions_heading_weight', 'options')) : echo get_field('skinoptions_heading_weight', 'options'); else : echo 'bold'; endif; ?> <?php if( !is_single() ) : echo 'videopost-heading'; endif; ?> <?php echo get_field('skinoptions_heading_align', 'options'); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</div>
		<div class="wysiwyg no-meta <?php font_sizes(); ?>">
			<?php the_content(); ?>
			<?php if(is_single() ) : ?>
				<?php get_template_part('partials/blog-metas'); ?>
			<?php endif; ?>
		</div>
	</div>
</div>