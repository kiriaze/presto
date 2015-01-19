<?php 
/*
 * single page
 * semplice.theme
 */
?>
<?php get_header(); # inlude header ?>

<?php if ( post_password_required() ) { ?>
 
	<div class="container">
		<div class="row">
			<div class="span12">
				<?php echo get_the_password_form(); ?>
			</div>
		</div>
	</div>
 
<?php } else { ?>

	<?php if(get_field('use_semplice') !== 'active' && get_field('use_semplice') !== 'coverslider') : ?>
	
		<section id="page-content" class="fade-content">
			<div id="post" class="container">
				<?php if (has_post_thumbnail( $post->ID ) ) : ?>
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
					<div class="row">
						<div class="span12 featured">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="Featured Image"  /></a>
						</div>
					</div>
				<?php endif; ?>
				<div class="row">
					<div class="span8 offset2">
						<div class="post-heading">
							<p><a href="<?php the_permalink(); ?>"><?php echo get_the_date('F d, Y'); ?></a> &middot; <?php comments_popup_link(__('No Comments!', 'semplice'), __('1 comment.', 'semplice'), __('% comments', 'semplice')); ?></p>
					<h2 class="<?php if(get_field('skinoptions_heading_weight', 'options')) : echo get_field('skinoptions_heading_weight', 'options'); else : echo 'bold'; endif; ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</div>
						<div class="wysiwyg <?php font_sizes(); ?>">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	
	<?php elseif(get_field('use_semplice') === 'active') : ?>
		
		<?php if(get_field('cover_visibility') === 'visible') : ?>
		<?php get_template_part('partials/fullscreen-cover'); ?>
		<?php endif; ?>
		
		<!-- content fade -->
		<div class="fade-content">
			<?php
				// Remove wpautop
				remove_filter('the_content', 'wpautop');
				
				// get content			
				$content = get_post_meta( get_the_ID(), 'semplice_ce_content', true );
				
				// output content
				$output = apply_filters('the_content', $content);

				echo $output;
				
				// reset postdata
				wp_reset_postdata();
			?>
			<script>
				(function($) {
					$(document).ready(function () {
						$('.ce-image').each(function(){ var parentTag = $(this).parent().get(0).tagName; if(parentTag == 'A') { $(this).parent().remove(); } else { $(this).remove(); }});
						$('.single-edit').remove();
						$(".slider").each(function() {
							sliderId = $(this).attr('id');
							$('#' + sliderId).responsiveSlides({
								auto: $(this).data('autoplay'),
								pager: false,
								nav: true,
								speed: 500,
								timeout: $(this).data('timeout'),
								namespace: 'slider'
							});
						});
						
					});
				})(jQuery);
			</script>
		</div>	
		<?php if(get_field('share_visibility') === 'visible') : ?>
			<div class="share-box fade-content">
				<div class="container">
					<?php get_template_part('partials/share'); ?>
				</div>
			</div>
		<?php endif; ?>
	
	<?php elseif(get_field('use_semplice') === 'coverslider') : ?>
		
		<?php get_template_part('partials/cover_slider'); # include cover slider ?>
		
	<?php endif; ?>

<?php } ?>
<?php get_footer(); # inlude footer ?>