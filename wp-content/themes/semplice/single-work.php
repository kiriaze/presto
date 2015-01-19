<?php 
/*
 * single work
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
	
	<?php if(get_field('cover_visibility') === 'visible') : ?>
	<?php get_template_part('partials/fullscreen-cover'); ?>
	<?php endif; ?>
	
	<?php if(!isset($_GET['cover-slider'])) : # if cover slider display no content ?>
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
		<div id="project-panel-footer" class="fade-content">
			<?php 
				// quick nav thumb
				$tn_transition = '';
				get_template_part('partials/project', 'panel');
			?>
		</div>
	<?php endif; ?>
	
<?php } ?>

<?php get_footer(); # inlude footer ?>