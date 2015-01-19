<?php

/*
	Image Module
	Made by: Semplicelabs
*/

if($this->edit_mode) {

	// edit head
	$this->edit_head($values);

	// output
	$e = '';

	//image scale
	$img_scale = array(
		'none' => 'None',
		'full_width' => 'Full Width'
	);

	//image align
	$img_align = array(
		'left' => 'Left',
		'center' => 'Center',
		'right' => 'Right'
	); 

	// exclude from responsive scaling
	$resp_exclude = array(
		'no' => 'No',
		'yes' => 'Yes'
	);
	
	$lightbox = array(
		'no' => 'No',
		'yes' => 'Yes'
	);

	// img link target
	$img_link_target = array(
		'_blank' => 'Open link in a new tab',
		'_self' => 'Open link in the same window'
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
	$this->get_option('select', 'Image Align', 'img-align', 'left', $img_align, $values);
	
	// options
	$this->get_option('select', 'Open in Lightbox on Click', 'lightbox', 'no', $lightbox, $values);
	
	// options
	$this->get_option('text', 'Image Link', 'img-link', '', '', $values);

	// options
	$this->get_option('select', 'Image Link Target', 'img-link-target', '_blank', $img_link_target, $values);

	// options
	$this->get_option('select', 'Exclude from Responsive Scaling', 'responsive-exclude', 'no', $resp_exclude, $values);

	// close options
	if($values['content_type'] !== 'column-content-img') {
		echo '</div></div>';
	} else {
		echo '</div>';
	}

	// image id
	$image = wp_get_attachment_image_src($content, 'full');

	// default filenames
	if(!isset($values['options']['image-filename'])) {
		$values['options']['image-filename'] = 'Upload Image';
	}
	
	// content area
	$e .= '
		<div class="edit-elements">
			<div class="media-upload-box">
				<a class="media-upload semplice-button image-upload" data-content-id="' . $values['id'] . '" data-upload-type="image">' . $values['options']['image-filename'] . '</a><a class="remove-image remove-media" data-content-id="' . $values['id'] . '" data-media="image"></a>
				<div class="clear"></div>
				<img class="image image-preview" src="' . $image[0] . '">
				<input type="hidden" name="img" class="is-content is-image" value="' . $content . '">
				<input type="hidden" name="image-filename" class="is-option" value="' . $values['options']['image-filename'] . '">
			</div>
		</div>
	';

	// display paragraph
	echo $e;

	// edit foot
	$this->edit_foot($values);
		
} else {

	$image_link = $values['options']['img-link'];
	$scale = $values['options']['img-scale'];
	$align = $values['options']['img-align'];
	$has_neg_margin = '';
	$neg_margin = '';

	$e = '';
			
	if($image_link) {
		$image_link = 'data_is_image_link="true" data_link_target="' . $values['options']['img-link-target'] . '" data_image_link="' . $image_link . '"';
	}

	// image id
	$image = wp_get_attachment_image_src($content, 'full');

	// image attechment id
	$attachment_id = get_post($content);

	// image alt
	$image_alt = get_post_meta($attachment_id->ID, '_wp_attachment_image_alt', true);

	// exclude from responsive scaling
	$scaling = $values['options']['responsive-exclude'];

	if(!$image_alt) {
		$image_alt = $attachment_id->post_title;
	}

	if($scale === 'full_width' && !$values['in_column']) {
		// set has_container to false
		$values['has_container'] = false;
		// output image container
		$this->view_head($values);
		$e .= '<div class="image full">';
		$e .= do_shortcode('[ceimage class="ce-image" id="' . $content . '" alt="' . $image_alt . '" ' . $image_link . ' lightbox="' . $values['options']['lightbox'] . '"][/ceimage]');
		$e .= '[ceimage class="live-image" id="' . $content . '" alt="' . $image_alt . '" ' . $image_link . '][/ceimage]';
		$e .= '</div>';
	} elseif (!$values['in_column']) {
		if($image[1] >= 1170) {
			$has_neg_margin = 'has-neg-margin';
			$neg_margin = 'style="margin-left: -' . ($image[1] - 1170) / 2 . 'px;"';
		}
		// output image container
		$this->view_head($values);
		$e .= '<div class="span12 image ' . $scaling . ' ' . $align . ' ' . $has_neg_margin . '">';
		$e .= do_shortcode('[ceimage class="ce-image" ' . $neg_margin . ' id="' . $content . '" alt="' . $image_alt . '" ' . $image_link . ' lightbox="' . $values['options']['lightbox'] . '"][/ceimage]');
		$e .= '[ceimage class="live-image" ' . $neg_margin . ' id="' . $content . '" alt="' . $image_alt . '" ' . $image_link . ' lightbox="' . $values['options']['lightbox'] . '"][/ceimage]';
		$e .= '</div>';
	} else {
		// output image container
		$this->view_head($values);
		if($scale === 'full_width') {
			$col_img_scale = 'column-img-full';
		} else {
			$col_img_scale = $scaling;
		}
		$e .= '<div class="column-image ' . $col_img_scale . ' ' . $align . '">';
		$e .= do_shortcode('[ceimage class="ce-image" id="' . $content . '" alt="' . $image_alt . '" ' . $image_link . ' lightbox="' . $values['options']['lightbox'] . '"][/ceimage]');
		$e .= '[ceimage class="live-image" id="' . $content . '" alt="' . $image_alt . '" ' . $image_link . ' lightbox="' . $values['options']['lightbox'] . '"][/ceimage]';
		$e .= '</div>';
	}

	// output
	echo $e;

	// footer
	$this->view_foot($values);

}
