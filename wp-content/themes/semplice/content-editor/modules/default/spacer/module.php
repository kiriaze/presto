<?php

/*
	Spacer Module
	Made by: Semplicelabs
*/

if($this->edit_mode) {
	
	// edit head
	$this->edit_head($values);
	
	if(!$values['in_column'] && $this->edit_mode !== 'single-edit') {
		// options head
		echo '<div class="row"><div class="span12 options">';
	} else {
		echo '<div class="options">';
	}
	
	$width = array(
		'content_width' => 'Content Width',
		'full_width' => 'Full Width'
	);
	
	// options		
	$this->get_option('text', 'Height (0px to just show the margin)', 'height', '1px', '', $values);

	// options		
	$this->get_option('select', 'Width', 'width', 'content_width', $width, $values);
	
	// options		
	$this->get_option('color', 'Color', 'color', '#ffffff', '', $values);
	
	// options		
	$this->get_option('text', 'Margin Top', 'margin_top', '64px', '', $values);
	
	// options		
	$this->get_option('text', 'Margin Bottom', 'margin_bottom', '64px', '', $values);

	// close options
	if($values['content_type'] !== 'column-content-spacer') {
		echo '</div></div>';
	} else {
		echo '</div>';
	}
	
	// edit foot
	$this->edit_foot($values);
		
} else {

	if($values['options']['width'] === 'content_width' && !$values['in_column']) {
		$this->view_head($values);
		$e = '<div class="spacer span12" style="' . $this->hr_styles($values) . '"><!-- Horizontal Rule --></div>';
		echo $e;
		$this->view_foot($values);
	} else {
		$values['has_container'] = false;
		$this->view_head($values);
		$e  = '<div class="hr-container" style="">';
		$e .= '<div class="spacer spacer-full-width" style="' . $this->hr_styles($values) . '"><!-- Horizontal Rule --></div>';
		$e .= '</div>';
		echo $e;
		$this->view_foot($values);
	}
}
