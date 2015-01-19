<?php

/*
 * Video Module
 * Made by Semplicelabs
 */

if($this->edit_mode) {
	
	// output
	$e = '';

	// edit head
	$this->edit_head($values);
	
	if(!$values['in_column'] && $this->edit_mode !== 'single-edit') {
		// options head
		echo '<div class="row"><div class="span12 options">';
	} else {
		echo '<div class="options">';
	}
	
	$transparent_controls = array(
		'non_transparent' => 'No',
		'transparent'  => 'Yes'
	);
	
	// options
	
	$values['options']['video_url'] = $content;

	$this->get_option('video', 'Upload Video (or link to file, only self hosted)', 'video_url', '', '', $values);
	
	$this->get_option('image-option', 'Upload Poster Image (not required)', 'img', '', '', $values);
	
	$this->get_option('select', 'Use Transparent Controls', 'transparent_controls', 'no', $transparent_controls, $values);
		
	echo '<div class="clear"></div>';
	
	// close options
	if($values['content_type'] !== 'column-content-video') {
		echo '</div></div>';
	} else {
		echo '</div>';
	}
	
	// output
	echo $e;

	// edit foot
	$this->edit_foot($values);
		
} else {

	// output
	$e = '';
	
	$this->view_head($values);

	if($values['has_container']) {
		$e = '<div class="span12">';
	}
	
	// get the video url
	$video_url = $content;
	
	// video extension
	$video_ext = $video_url;
	
	// get the string length
	$length = strlen($video_ext);
	
	// extension length
	$ext = 3;
	
	// start with the last 3 chars
	$start = $length - $ext;
	
	// get the video extension
	$video_ext = substr($video_ext, $start ,$ext);
	
	if($video_ext === 'ogv') {
		$video_ext = 'ogg';
	} elseif ($video_ext === 'ebm') {
		$video_ext = 'webm';
	}
	
	// transparent controls
	$transparent_controls = '';
	
	if($values['options']['transparent_controls'] === 'transparent') {
		$transparent_controls = 'transparent-controls';
	}
	
	// upload, link or embed
	$e .= '<div class="video-edit"><div class="is-video"></div></div>';
	$e .= '<div class="live-video ' . $transparent_controls . '" style="width: 100%; max-width: 100%">';
	$e .= '[cevideo src="' . $content . '" type="video/' . $video_ext . '" poster="' . $values['options']['img'] . '" controls="' . $values['options']['transparent_controls'] . '"][/cevideo]';
	$e .= '</div>';
	
	if($values['has_container']) {
		$e .= '</div>';
	}
	
	echo $e;
	
	// cs footer
	$this->view_foot($values);

}
