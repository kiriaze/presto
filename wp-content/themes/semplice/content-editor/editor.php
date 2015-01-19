<?php
/*
 * Content Editor 2.0
 * semplice.theme
 * 
 */

// include content class
include('class.editor.php'); 

// get content type
$content_type = isset($_POST['content_type']) ? $_POST['content_type'] : '';

// get edit mode
$edit_mode = isset($_POST['edit_mode']) ? $_POST['edit_mode'] : ''; 

// post id
$post_id = isset($_POST['post_id']) ? $_POST['post_id'] : ''; 

// is column content?
$is_column_content = isset($_POST['is_column_content']) ? $_POST['is_column_content'] : ''; 
 
// content class
$editor = new editor();

// init content
if($edit_mode === 'new') {
	$editor->rom['content'] = '';
}

// Edit mode
if($edit_mode === 'edit' || $edit_mode === 'new' || $edit_mode === 'single-edit') {
	
	// normal values
	$values = array(
		'styles'		=> isset($editor->rom['styles']) ? $editor->rom['styles'] : '', 
		'style_class'	=> 'is-style', 
		'in_column'		=> false, 
		'id'			=> $editor->id,
		'column_id'		=> $editor->column_id,
		'content_type'	=> $editor->content_type,
		'options'		=> isset($editor->rom['options']) ? $editor->rom['options'] : '',
		'options_class' => 'is-option',
		'cm_class'		=> 'is-custom-module',
	);
	
	if($is_column_content) {
		$values['styles'] = isset($editor->rom['columns'][$editor->column_id]['#' . $editor->id]['styles']) ? $editor->rom['columns'][$editor->column_id]['#' . $editor->id]['styles'] : '';
		$values['style_class'] = 'is-cc-style';
		$values['in_column'] = true;
		$values['options_class'] = 'is-cc-option';
		$values['options'] = isset($editor->rom['columns'][$editor->column_id]['#' . $editor->id]['options']) ? $editor->rom['columns'][$editor->column_id]['#' . $editor->id]['options'] : '';
		$values['cm_class'] = 'is-cc-custom-module';
	}

	// single edit styles and column mode
	if($edit_mode === 'single-edit') {
		$values['styles'] = isset($editor->rom['styles']) ? $editor->rom['styles'] : '';
		$values['style_class'] = 'is-cc-style';
		$values['in_column'] = false;
		$values['options_class'] = 'is-cc-option';
		$values['options'] = isset($editor->rom['options']) ? $editor->rom['options'] : '';
		$values['cm_class'] = 'is-cc-custom-module';
	}
	
	#----------------------------------
	# load edit
	#----------------------------------
	
	if($content_type === 'multi-column') {
		// load multi column
		$editor->mc_edit($values);
	} elseif($content_type === 'add-column') {
		// add column
		$editor->add_column(str_replace('#', '', $editor->id), str_replace('#', '', $editor->parent_id), 'span6');
	} else {
		// load standard edit
		$editor->load_module(stripslashes($editor->rom['content']), $values, $editor->content_type);
	}
	
} elseif ($edit_mode === 'custom-fontset') {
	
	// get custom fontset
	$editor->custom_fontset();
	
} elseif ($edit_mode === 'load-template') {
	
	// load semplice preset
	$editor->load_template();

} elseif ($edit_mode === 'init') {

	function strposOffset($search, $string, $offset)
	{

		$arr = explode($search, $string);

		switch( $offset )
		{
			case $offset == 0:
			return false;
			break;
		
			case $offset > max(array_keys($arr)):
			return false;
			break;

			default:
			return strlen(implode($search, array_slice($arr, 0, $offset)));
		}
	}

	// rom
	$rom = stripslashes_deep(get_post_meta( $post_id, 'semplice_ce_rom', true ));

	// search strings
	$content_start = '{"content":"';
	$content_end = '","styles":{';
	
	// vars
	$offset_start = 0;
	$offset_end = 0;
	
	// offset array
	$offset_arr = array();
	
	// size
	$size = substr_count($rom, $content_start);

	for( $i = 1; $i <= $size; $i++) {
		
		// start and end offset
		$offset_start = strposOffset($content_start, $rom, $i);
		$offset_end = strposOffset($content_end, $rom, $i);
		
		$offset_arr['start'][$i] = $offset_start;
		$offset_arr['length'][$i] = $offset_end - $offset_start;

		if($offset_arr['length'][$i] > 12) {

			$search  = substr($rom, $offset_arr['start'][$i] + 12, $offset_arr['length'][$i] - 12);

			// strip slashes if available to avoid double slashes
			$replace = stripslashes_deep($search);

			// json encode the replace string
			$replace = json_encode($replace);
			
			// cut quotes from the json string
			$replace = substr($replace, 1, -1);
			
			// output
			$rom = str_replace($search, $replace, $rom);
		}
		
	}
	
	// output array
	$json_output = array();
	$json_output['rom'] = $rom;
	
	// get content			
	$content = get_post_meta( $post_id, 'semplice_ce_content', true );
	
	// output in array
	$json_output['html'] = $content;
	
	echo json_encode($json_output);
	
} else {
	
	// normal values
	$view_values = array(
		'has_container'	=> true,
		'id'			=> $editor->id,
		'styles'		=> isset($editor->rom['styles']) ? $editor->rom['styles'] : '',
		'options'		=> isset($editor->rom['options']) ? $editor->rom['options'] : '',
		'in_column'		=> false,
		'module_id'		=> isset($editor->rom['custom_module']) ? $editor->rom['custom_module'] : '',
	);
	
	#----------------------------------
	# load view
	#----------------------------------
	
	if($content_type !== 'multi-column') {
	
		// load standard view
		$editor->load_module(stripslashes($editor->rom['content']), $view_values, $editor->content_type);
	
	} else {

		// load multi column view
		// masonry prefix
		$pre = '';
	
		// remove gutter and fluid layout
		$remove_gutter = filter_var($editor->rom['options']['remove-gutter'], FILTER_VALIDATE_BOOLEAN);
		$is_fluid = filter_var($editor->rom['options']['show-fullscreen'], FILTER_VALIDATE_BOOLEAN);
	
		if($remove_gutter) {
			$pre = 'masonry-';
		}

		// row container head
		$editor->row_header($editor->rom['styles'], $editor->rom['options'], $remove_gutter, $is_fluid );
		
		foreach($editor->rom['columns'] as $mc_column_id => $mc_columns) {
		
			// column width
			$column_width = $mc_columns['options']['column-width'];

			// column div open
			echo '<div class="' . $pre . $column_width . ' masonry-item remove-gutter-' . $remove_gutter . '">';
			
			foreach($mc_columns as $mc_content_id => $mc_content) {
				
				// content type index
				$mc_content['content_type'] = isset($mc_content['content_type']) ? $mc_content['content_type'] : '';
				
				// content index
				$mc_content['content'] = isset($mc_content['content']) ? $mc_content['content'] : '';
				
				// custom module
				$mc_content['custom_module'] = isset($mc_content['custom_module']) ? $mc_content['custom_module'] : '';
				
				// single edit values
				$view_se_values = array( 
					'has_container' 		 	=> false,
					'id'						=> $mc_content_id,
					'options'					=> isset($mc_content['options']) ? $mc_content['options'] : '',
					'styles' 				 	=> isset($mc_content['styles']) ? $mc_content['styles'] : '', 
					'in_column'	 			 	=> true, 
					'single_edit_content_id' 	=> $mc_content_id, 
					'single_edit_column_id'  	=> $mc_column_id, 
					'single_edit_content_type'	=> $mc_content['content_type'],
					'module_id'					=> $mc_content['custom_module']
				);

				#----------------------------------
				# multi column view
				#----------------------------------
				
				if($mc_content['content_type']) {
					$editor->load_module(stripslashes($mc_content['content']), $view_se_values, $mc_content['content_type']);
				}
			}
			
			// column div close
			echo '</div>';
		}
		
		// row container footer
		$editor->row_footer($remove_gutter, $is_fluid);
		
	}
}

