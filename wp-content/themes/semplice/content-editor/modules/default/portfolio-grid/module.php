<?php

/*
	Portfolio Grid Module
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
	
	// title visibility
	$title_visibility = array(
		'visible' => 'Show both title and category', 
		'visible_title' => 'Show title and hide category',
		'hidden' => 'Hide both'
	);
	
	// remove Gutter
	$remove_gutter = array('no' => 'No', 'yes' => 'Yes');
	
	// category args
	$category_args = array(
		'hide_empty' => 0
	);
	
	// categories
	$categories = get_categories($category_args);
	
	// category select
	$category_select = array('show_all' => 'Show All');

	if($categories) {
		foreach($categories as $category) {
			$category_select[$category->slug] = $category->name;
		}
	}

	// show fullscreen
	$fluid = array('no' => 'No', 'yes' => 'Yes');
	
	// fwt
	$fwt = array('no' => 'No', 'yes' => 'Yes');
	
	// options
	$this->get_option('multiple-select', 'Select Categories', 'categories', 'show_all', $category_select, $values);
	
	// options
	$this->get_option('select', 'Thumbnail Project Title Visibility', 'title-visibility', 'visible', $title_visibility, $values);
	
	// options		
	$this->get_option('color', 'Project Title Color', 'title-color', '#000000', '', $values);
	
	// options		
	$this->get_option('color', 'Project Category Color', 'category-color', '#999999', '', $values);
	
	// options
	$this->get_option('select', 'Fluid Grid Layout', 'fluid', 'no', $fluid, $values);
	
	// options
	$this->get_option('select', 'Remove Gutter', 'remove-gutter', 'no', $remove_gutter, $values);
	
	// options
	$this->get_option('select', 'Full Width Thumbnails', 'fwt', 'no', $fwt, $values);
	
	// close options
	if($values['content_type'] !== 'column-content-audio') {
		echo '</div></div>';
	} else {
		echo '</div>';
	}
	
	// edit foot
	$this->edit_foot($values);
		
} else {

	// output
	$e = '';

	// is fluid?
	$values['has_container'] = false;

	// cs header
	$this->view_head($values);

	// categories
	$categories = $values['options']['categories'];

	if(empty($categories) || $categories[0] === 'show_all') {
		$categories = '';
	} elseif(!empty($categories)) {
		$categories = implode(', ', $values['options']['categories']);
	}
	
	// hidden shortcode
	$e .= '<div class="thumbs-content">[thumbnails categories="' . $categories . '" masonryid="' . $values['id'] . '" styles="' . implode(', ', $values['styles']) . '" titlevisibility="' . $values['options']['title-visibility'] . '" titlecolor="' . $values['options']['title-color'] . '" categorycolor="' . $values['options']['category-color'] . '" fluid="' . $values['options']['fluid'] . '" removegutter="' . $values['options']['remove-gutter'] . '" fwt="' . $values['options']['fwt'] . '"][/thumbnails]</div>';
	
	// live view shortcode
	$e .= '<div class="container"><div class="row"><div class="span12"><div class="thumbnails-edit"><div class="is-thumbnails"></div></div></div></div></div>';
	
	// display paragraph
	echo $e;
	
	//cs footer
	$this->view_foot($values);
}
