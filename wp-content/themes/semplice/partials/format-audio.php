<div class="row">
        <?php
        	/* upload, link or embed */
        	if(get_field('audiotype') === 'audio' || get_field('audiotype') === 'link') :
				$audioType = get_field('audiotype');
        		?>
        		<div class="featured span12">
	             	<audio preload="none" style="width: 100%">
						<?php if(get_field($audioType . '_mp3')) : ?><source src="<?php echo get_field($audioType . '_mp3'); ?>" type="audio/mpeg"><?php endif; ?>
						<?php if(get_field($audioType . '_ogg')) : ?><source src="<?php echo get_field($audioType . '_ogg'); ?>" type="audio/ogg"><?php endif; ?>
						<p>If you are reading this, it is because your browser does not support the HTML5 audio element.</p>
					</audio>
				</div>
        		<?php
			elseif(get_field('audiotype') === 'embed') :
        		?>
        		<div class="featured span12">
        		<?php
					$oembed = '[embed]' . get_field('audio_embed') . '[/embed]';
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
			<h2 class="<?php if(get_field('skinoptions_heading_fontsize', 'options')) : echo get_Field('skinoptions_heading_fontsize', 'options'); endif; ?> <?php if(get_field('skinoptions_heading_weight', 'options')) : echo get_field('skinoptions_heading_weight', 'options'); else : echo 'bold'; endif; ?> <?php echo get_field('skinoptions_heading_align', 'options'); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</div>
		<div class="wysiwyg no-meta <?php font_sizes(); ?>">
			<?php the_content(); ?>
			<?php if(is_single() ) : ?>
				<?php get_template_part('partials/blog-metas'); ?>
			<?php endif; ?>
		</div>
	</div>
</div>