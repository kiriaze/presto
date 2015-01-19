<?php

/*
	Audio Module
	Made by: Semplicelabs
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
	
	// options
	
	$values['options']['audio_url'] = $content;
	
	$this->get_option('audio', 'Upload Audio File (or link to file)', 'audio_url', '', '', $values);
	
	echo '<div class="clear"></div>';
	
	// close options
	if($values['content_type'] !== 'column-content-audio') {
		echo '</div></div>';
	} else {
		echo '</div>';
	}
	
	// display paragraph
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
	
	// get the audio url
	$audio_url = $content;
	
	// video extension
	$audio_ext = $audio_url;
	
	// get the string length
	$length = strlen($audio_ext);
	
	// extension length
	$ext = 3;
	
	// start with the last 3 chars
	$start = $length - $ext;
	
	// get the video extension
	$audio_ext = substr($audio_ext, $start ,$ext);
	
	if($audio_ext === 'ogg') {
		$audio_ext = 'ogg';
	} elseif ($audio_ext === 'mp3') {
		$audio_ext = 'mpeg';
	} elseif ($audio_ext === 'wav') {
		$audio_ext = 'wav';
	}
	
	// upload, link or embed
	$e .= '<div class="audio-edit"><div class="is-audio"></div></div>';
	$e .= '<div class="live-audio audio-container" style="width: 100%; max-width: 100%">';
	$e .= '[ceaudio src="' . $content . '" type="audio/' . $audio_ext . '"][/ceaudio]';
	$e .= '</div>';
	
	if($values['has_container']) {
		$e .= '</div>';
	}
	
	echo $e;
	
	// cs footer
	$this->view_foot($values);

}
