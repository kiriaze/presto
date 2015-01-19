<?php

/*
	Gallery Module
	Made by: Semplicelabs
*/

if($this->edit_mode) {
	
	// edit head
	$this->edit_head($values);
	
	//image scale
	$img_scale = array(
		'none' => 'None',
		'full_width' => 'Full Width'
	);
	
	// auto play
	$autoplay = array(
		'true' => 'On',
		'false' => 'Off'
	);
	
	if(!$values['in_column'] && $this->edit_mode !== 'single-edit') {
		// options head
		echo '<div class="row"><div class="span12 options">';
	} else {
		echo '<div class="options">';
	}

	// options
	$this->get_option('select', 'Image Scale', 'img-scale', 'none', $img_scale, $values);
	
	// options
	$this->get_option('select', 'Autoplay', 'autoplay', 'true', $autoplay, $values);
	
	// options
	$this->get_option('text', 'Autoplay timeout between images (in ms)', 'timeout', '4000', $autoplay, $values);
	
	// close options
	if($values['content_type'] !== 'column-content-gallery') {
		echo '</div></div>';
	} else {
		echo '</div>';
	}
	
	// output
	$e = '';
	
	// content area
	$e .= '
		<div class="edit-elements">
			<ul data-gallery-id="' . $values['id'] . '" class="gallery-images">';
			
			if($content) {
				$images = explode(',', $content);
				foreach($images as $image) {
					$thumbnail = wp_get_attachment_image_src($image, 'thumbnail');
					$e .= '<li id="' . $image . '">';
					$e .= '<a class="remove-gallery-image"></a><img src="' . $thumbnail[0] . '" alt="gallery-image" />';
					$e .= '</li>';
				}
			}
			
			$e .= '
			</ul>
			
			<script type="text/javascript">
				(function ($) {
					$(document).ready(function () {
						/* start sortable */
						$("[data-gallery-id=' . $values['id'] . ']").sortable({
							update: function(event, ui) {
							
								/* get array of ids */
								var sortIDs = $("[data-gallery-id=' . $values['id'] . '] li").map(function () { return this.id; }).get();
								
								/* append ids to val */
								$("#' . $values['id'] . '").find("input[name=gallery]").val(sortIDs);
							}
						});
						/* remove items */
						$("#' . $values['id'] . '").find(".remove-gallery-image").click(function() {
				
							$(this).parent().transition({ opacity: 0 }, 400, "ease", function() {
							
								/* remove item */
								var removeItem = $(this).attr("id");
							
								/* remove from DOM */
								$(this).remove();
								
								/* get array of ids */
								var sortIDs = $("[data-gallery-id=' . $values['id'] . '] li").map(function () { return this.id; }).get();
								
								/* append ids to val */
								$("#' . $values['id'] . '").find("input[name=gallery]").val(sortIDs);
								
							}); 
						
						});
					});
				})(jQuery); 
			</script>
			
			<div class="media-upload-box">
				<a class="media-upload semplice-button image-upload" data-content-id="' . $values['id'] . '" data-upload-type="gallery">Upload image</a><a class="remove-image remove-media" data-content-id="' . $values['id'] . '" data-media="image"></a>
				<div class="clear"></div>
				<input type="hidden" name="gallery" class="is-content is-image" value="' . $content . '">
			</div>
		</div>
	';
	
	// display paragraph
	echo $e;
	
	// edit foot
	$this->edit_foot($values);
		
} else {

	$scale = $values['options']['img-scale'];
		
	$e = '';
	
	if($scale === 'full_width') {
		// output image container
		$values['has_container'] = false;
		$this->view_head($values);
		$e = slider($content, $values);
		echo $e;
		$this->view_foot($values);
	} elseif(!$values['in_column']) {
		// output image container
		$this->view_head($values);
		$e .= '<div class="span12">';
		$e .= slider($content, $values);
		$e .= '</div>';
		echo $e;
		$this->view_foot($values);
	} else {
		// output image container
		$this->view_head($values);
		$e .= slider($content, $values);
		echo $e;
		$this->view_foot($values);
	}

}

// get slider for gallery
function slider($content, $values) {
			
	$output = '';
	
	$images = explode(',', $content);
	
	// preview image
	$preview = wp_get_attachment_image_src($images[0], 'full');
	
	if($images) { 
		$output .= '<div class="slider-wrapper">';
		$output .= '<div class="is-gallery"></div>';
		$output .= '<div class="gallery-preview"><img src="' . $preview[0] . '" /></div>';
		$output .= '[cegallery id="slider-' . str_replace('#', '', $values['id']) . '" data_timeout="' . $values['options']['timeout'] . '" data_autoplay="' . $values['options']['autoplay'] . '" images="' . $content . '"][/cegallery]';
		$output .= '</div>';
	}
	
	return $output;
}
