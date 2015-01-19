<?php
/*
 * shortcodes
 * semplice.theme
 */

// image shortcode
function ceimage_func($atts) {

	//vars
	$e = '';
	$image_link = '';
	$neg_margin = '';

	// attributes
	extract( shortcode_atts(
		array(
			'id'					=> '',
			'class'					=> '',
			'alt'					=> '',
			'data_is_image_link' 	=> '',
			'data_image_link' 		=> '',
			'data_link_target' 		=> '',
			'style'					=> '',
			'lightbox'				=> '',
		), $atts )
	);

	// is lightbox?
	$lightbox = filter_var($lightbox, FILTER_VALIDATE_BOOLEAN);
	
	// get image src
	$image_src = wp_get_attachment_image_src($id, 'full');

	// has neg margin?
	if(isset($style)) {
		$neg_margin = 'style="' . $style . '"';
	}
	
	// has image link?
	if($lightbox) {
		$e .= '<a data-rel="lightbox" class="' . $class . '" href="' . $image_src[0] . '">';
		$e .= '<img class="' . $class . '" src="' . $image_src[0] . '" alt="' . $alt . '" ' . $neg_margin . ' />';
		$e .= '</a>';
	} elseif(!empty($data_image_link)) {
		// target = self?
		if($data_link_target === '_self') {
			$link_class = 'ce-image-link';
		} else {
			$link_class = 'extern';
		}
		
		$e .= '<a class="' . $link_class . '" href="' . $data_image_link . '" target="' . $data_link_target . '">';
		$e .= '<img class="' . $class . '" src="' . $image_src[0] . '" alt="' . $alt . '" ' . $neg_margin . ' />';
		$e .= '</a>';
	} else {
		$e .= '<img class="' . $class . '" src="' . $image_src[0] . '" alt="' . $alt . '" ' . $neg_margin . ' />';
	}

	
	
	return $e;
}

// video shortcode
function cevideo_func($options) {

	// vars
	$poster = '';
		
	// poster image
	if(isset($options['poster'])) {
	
		// get image src
		$poster_src = wp_get_attachment_image_src($options['poster'], 'full');
	
		$poster = 'poster="' . $poster_src[0] . '"';
	}
	
	// output
	$e = '';

	$e .= '<video class="video" style="max-width: 100%;" preload="none" ' . $poster . '>';
	$e .= '<source src="' . $options['src'] . '" type="' . $options['type'] . '">';
	$e .= '<p>If you are reading this, it is because your browser does not support the HTML5 video element.</p>';
	$e .= '</video>';

	return $e;
}

// audio shortcode
function ceaudio_func($options) {

	//output
	$e = '';

	$e .= '<audio class="audio" style="max-width: 100%;" preload="none">';
	$e .= '<source src="' . $options['src'] . '" type="' . $options['type'] . '">';
	$e .= '<p>If you are reading this, it is because your browser does not support the HTML5 audio element.</p>';
	$e .= '</audio>';
	
	return $e;
}

// Gallery
function cegallery_func($options) {

	//output
	$e = '';

	$e .= '<ul class="slider" id="' . $options['id'] . '" data-timeout="' . $options['data_timeout'] . '" data-autoplay="' . $options['data_autoplay'] . '">';
	
	$images = explode(',', $options['images']);
	
	foreach($images as $image) {
	
		$img = wp_get_attachment_image_src($image, 'full');
		
		$e .= '<li>';
		$e .= '<img src="' . $img[0] . '" alt="gallery-image" />';
		$e .= '</li>';
	}
	
	$e .= '</ul>';
	
	return $e;
}

// Thumbnails Shortcode
function thumbnails_func($options){
	require get_template_directory() . '/includes/thumbnails.php';
	return $e;
}

add_shortcode( 'thumbnails', 'thumbnails_func' );
add_shortcode( 'ceimage', 'ceimage_func' );
add_shortcode( 'cevideo', 'cevideo_func' );
add_shortcode( 'ceaudio', 'ceaudio_func' );
add_shortcode( 'cegallery', 'cegallery_func' );

?>