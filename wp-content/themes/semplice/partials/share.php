<?php

// is blog?
if(get_post_type($post->ID) === 'post') {
	$share_options = 'options';
} else {
	$share_options = '';
}

// Buttons
if(get_field('share_box_style', $share_options) !== 'icons') : ?>
	<div class="row">
		<div class="<?php if(get_post_type($post->ID) === 'work' || get_post_type($post->ID) === 'page') : echo 'span12'; else : echo 'span8'; endif; ?>">
			<div class="semplice-share first">
				<div class="text">Facebook</div>
				<div class="button button-facebook">
					<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank">Share on Facebook</a>
				</div>
			</div>
			<div class="semplice-share">
				<div class="text">Twitter</div>
				<div class="button button-twitter">
					<a href="http://twitter.com/intent/tweet?text=<?php echo str_replace(' ', '%20', get_the_title()); ?> <?php the_permalink(); ?>" target="_blank">Share on Twitter</a>
				</div>
			</div>
			<div class="semplice-share">
				<div class="text">Google+</div>
				<div class="button button-gplusone">
					<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank">Share on Google+</a>
				</div>
			</div>
		</div>
	</div>
<?php else : ?>
	<div class="row">
		<div class="<?php if(get_post_type($post->ID) === 'work' || get_post_type($post->ID) === 'page') : echo 'span12'; else : echo 'span8'; endif; ?>">
			<div class="share-icons-wrapper">
				<p class="<?php if(get_field('share_text_font_weight', $share_options)) : echo get_field('share_text_font_weight', $share_options); else : echo 'regular'; endif; ?>">Share on</p>
				<div class="semplice-share-icons first">
					<div class="share-icon icon-facebook">
						<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><?php echo setIcon('facebook'); ?></a>
					</div>
				</div>
				<div class="semplice-share-icons">
					<div class="share-icon icon-twitter">
						<a href="http://twitter.com/intent/tweet?text=<?php echo str_replace(' ', '%20', get_the_title()); ?> <?php the_permalink(); ?>" target="_blank"><?php echo setIcon('twitter'); ?></a>
					</div>
				</div>
				<div class="semplice-share-icons">
					<div class="share-icon icon-gplusone">
						<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><?php echo setIcon('gplusone'); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>