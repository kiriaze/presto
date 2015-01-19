<?php

	// slider body
	echo '<div id="cover-slider">';

	// get cover slider covers
	$covers = get_field('cover_slider');

	// anchors
	$anchors = array();
	
	if($covers) {

		// output slides
		foreach($covers as $post) {
			
			// setup postdata
			setup_postdata($post);
			
			// get post and look if there is a fullscreen cover
			if(get_field('cover_visibility') === 'visible') {
				
				// fill anchor
				$anchor[] = $post->post_name;

				// vp title
				if(get_field('vp_button_title')) {
					$vp_title = get_field('vp_button_title');
				} elseif(get_field('vp_button_title', 'options')) {
					$vp_title = get_field('vp_button_title', 'options');
				} else {
					$vp_title = 'View Project';
				}
				
				// font weight
				if(get_field('vp_button_font_weight', 'options')) {
					$font_weight = get_field('vp_button_font_weight', 'options');
				} else {
					$font_weight = 'regular';
				}
				
				// slide and link open
				echo '<div class="section" data-anchor="' . $post->post_name . '">';

				echo '<div class="view-project vp-' . $post->ID . ' ' . $font_weight . '"><a href="' . get_the_permalink() . '">' . $vp_title . '</a></div>';
				
				// fullscreen cover
				get_template_part('partials/fullscreen-cover');
				
				// slide and link close
				echo '</div>';
			}
		}
		
		// reset postdata
		wp_reset_postdata();
	}

	// slider close
	echo '</div>';

?>

<script type="text/javascript">
	(function($) {
		$(document).ready( function() {
			$('#cover-slider').fullpage({
				anchors: <?php echo json_encode($anchor); ?>,
				navigation: true,
				navigationPosition: 'right',
				animateAnchor: false,
				scrollingSpeed: 900,
				afterRender: function() {
					$(".cover-video video").mediaelementplayer({
						success: function (mediaElement, domObject) {
							// call the play method
							mediaElement.play();
						}
					});
				}
			});
		});
	})(jQuery); 
</script>
