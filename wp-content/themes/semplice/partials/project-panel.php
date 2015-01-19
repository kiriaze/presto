<?php
// project panel transition
global $tn_transition;

?>
<!-- Project Panel -->
<section id="project-panel" class="fade">
	<div class="project-panel">
		<div class="container">
			<div class="row">
				<div class="project-panel-title span11">
					<h3 class="<?php if(get_field('project_panel_title_weight', 'options')) : echo get_field('project_panel_title_weight', 'options'); else : echo 'light'; endif; ?> <?php echo get_field('project_panel_title_font_size', 'options'); ?>"><?php if(get_field('project_panel_title', 'options')) : echo get_field('project_panel_title', 'options'); else : echo __('More selected projects', 'semplice'); endif; ?></h3>
				</div>
				<?php if($tn_transition) : ?>
				<div class="project-panel-close span1">
            		<div class="close-project-panel light"><?php echo setIcon('close_big'); ?></div>
				</div>
				<?php endif; ?>
			</div>
			<div class="row">
        		<div class="project-panel-thumbs">
					<?php

						// Get Projects
						$args = array(
							'posts_per_page' => -1,
							'post_type' => 'work'
						);
						// List Projects
						$query = new WP_Query( $args );
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								$project_panel_thumbnail = wp_get_attachment_image_src(get_field('thumb_nav_thumbnail'), 'full');
								?>
									<div class="project-panel-thumb">
										<a class="project-panel-link" <?php echo $tn_transition; ?> href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<?php if($project_panel_thumbnail) { ?>
												<img alt="project-panel-thumbnail" src="<?php echo $project_panel_thumbnail[0]; ?>" />
											<?php } else { ?>
												<img alt="project-panel-thumbnail" src="<?php echo get_bloginfo('template_directory'); ?>/images/no_thumb-thumb_nav.png" />
											<?php } ?>
											<h3><?php the_title(); ?><br /><span class="regular"><?php the_field('category'); ?></span></h3>
										</a>
									</div>
					<?php     
							}
						} else {
					?>
							<p class="text-center fade">Your Portfolio is empty. You can start adding Items throught your Wordpress admin panel!</p>
					<?php
						}
					?>
        		</div>
			</div>
		</div>
	</div>
</section>
<?php wp_reset_postdata(); ?>