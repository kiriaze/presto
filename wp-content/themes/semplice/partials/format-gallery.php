<?php	
$images = get_field('gallery');

if( $images ): ?>
	<div class="row">
		<div class="span12">
			<div class="slider-wrapper slider-blog">
		        <ul class="slider" id="slider<?php echo $post->ID; ?>">
		            <?php foreach( $images as $image ): ?>
		                <li>
		                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
		                </li>
		            <?php endforeach; ?>
		        </ul>
	        </div>
		</div>
	</div>
	<script type="text/javascript">
		(function ($) {
		    $(document).ready(function () {
		    	$("#slider<?php echo $post->ID; ?>").responsiveSlides({
			        auto: false,
			        pager: false,
			        nav: true,
			        speed: 500,
			        namespace: "slider<?php echo $post->ID; ?>",
				});
		    });
		})(jQuery);
	</script>
<?php endif; ?>

<div id="post" <?php post_class('row'); ?>>
	<div class="span8 offset2">
		<div class="post-heading <?php if(trim(get_the_content()) === "") : echo 'no-content'; endif; ?>">
			<p><a href="<?php the_permalink(); ?>"><?php echo get_the_date('F d, Y'); ?></a> - <?php comments_popup_link(__('No Comments!', 'semplice'), __('1 comment.', 'semplice'), __('% comments', 'semplice')); ?></p>
			<h2 class="<?php if(get_field('skinoptions_heading_fontsize', 'options')) : echo get_Field('skinoptions_heading_fontsize', 'options'); endif; ?> <?php if(get_field('skinoptions_heading_weight', 'options')) : echo get_field('skinoptions_heading_weight', 'options'); else : echo 'bold'; endif; ?> <?php echo get_field('skinoptions_heading_align', 'options'); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</div>
		<?php if(get_field('intro_text')) : ?>
		<?php endif; ?>
		<div class="wysiwyg no-meta gallery-clear gallery <?php font_sizes(); ?>">
			<?php the_content('Read more', 'semplice'); ?>
			<?php if(is_single() ) : ?>
				<?php get_template_part('partials/blog-metas'); ?>
			<?php endif; ?>
		</div>
	</div>
</div>