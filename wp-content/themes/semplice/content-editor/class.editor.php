<?php
/*
 * Class - content
 * semplice.theme
 * 
 */ 
 
class editor {
	
	// vars
	public $id;
	public $ccId;
	public $rom;
	public $column_id;
	public $edit_mode;
	public $parent_id;
	public $content_type;
	public $remove_gutter;
	public $is_fluid;
	public $add_column_foot;
	public $fontset_id;
	public $template_id;
	public $template_type;
	public $module_id;
	public $is_column_content;
	
	function __construct() {
		
		// get the id
		$this->id = isset($_POST['id']) ? $_POST['id'] : '';
		
		// get the content container id
		$this->ccId = isset($_POST['ccId']) ? $_POST['ccId'] : '';
		
		// get the rom
		$this->rom = isset($_POST['rom']) ? $_POST['rom'] : '';
		
		// get the column id
		$this->column_id = isset($_POST['column_id']) ? $_POST['column_id'] : '';
		
		// get edit mode
		$this->edit_mode = isset($_POST['edit_mode']) ? $_POST['edit_mode'] : '';
		
		// get the parent id
		$this->parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : '';
		
		// get is column content
		$this->is_column_content = isset($_POST['is_column_content']) ? $_POST['is_column_content'] : '';
		
		// get the field type
		$this->content_type = isset($_POST['content_type']) ? $_POST['content_type'] : '';
		
		// add column foot
		$this->add_column_foot = '</div></div></div><div class="row"><div class="span12"><div class="cc-hr"></div></div></div></div>';
		
		// get the parent id
		$this->fontset_id = isset($_POST['fontset_id']) ? $_POST['fontset_id'] : '';
		
		// get the template id
		$this->template_id = isset($_POST['template_id']) ? $_POST['template_id'] : '';
		
		// get the template type
		$this->template_type = isset($_POST['template_type']) ? $_POST['template_type'] : '';
	}

	// get options
	function get_option($type, $title, $name, $default, $val, $values) {
	
		// option head
		if(isset($values['cols'])) {
			echo '<div class="two-col-option">';
		}
		
		// special option
		if(isset($values['special-option'])) {
			$option_class = $values['special-option'];
		} else {
			$option_class = '';
		}
		
		echo '<div class="option-wrapper ' . $option_class . '"><div class="option-left"><div class="option"><h4>' . $title . '</h4></div></div><div class="option-right"><div class="option">';
		
		// select
		if($type === 'select') {
		
			// set default value
			if(!isset($values['options'][$name])) {
				$values['options'][$name] = $default;
			}

			// output field
			echo '<div class="ce-select-box big-box"><select name="' . $name . '" class="' . $values['options_class'] . ' select-box" data-content-id="' . $values['id'] . '">';
			
			// output options
			$this->select($val, $values['options'][$name]);
			
			// footer
			echo '</select></div>';
		
		// multiple select
		} else if($type === 'multiple-select') {
			
			// set default value
			if(!isset($values['options'][$name])) {
				$values['options'][$name] = $default;
			}

			// output field
			echo '<div class="ce-multi-select-box"><select name="' . $name . '" class="' . $values['options_class'] . ' multiple-select-box" data-content-id="' . $values['id'] . '" size="5" multiple>';
			
			// output options
			$this->select($val, $values['options'][$name]);
			
			// footer
			echo '</select></div>';
			
		} else if($type === 'color') {
			if(!isset($values['options'][$name])) {
				$values['options'][$name] = $default;
			}
			echo '<div class="wp-color"><input type="text" value="' . $values['options'][$name] . '" class="color-picker ' . $values['options_class'] . '" data-default-color="' . $default . '" name="' . $name . '" /></div>';
		} else if($type === 'text') {
			if(!isset($values['options'][$name])) {
				$values['options'][$name] = $default;
			}
			echo '<input type="text" value="' . $values['options'][$name] . '" class="' . $values['options_class'] . '" name="' . $name . '" />';
		} else if($type === 'video') {
			if(!isset($values['options']['video-filename'])) {
				$values['options']['video-filename'] = 'Upload Video';
			}
			echo 
				'<div class="media-upload-box video-upload-box">
					<a class="media-upload semplice-button video-upload" data-content-id="' . $values['id'] . '" data-upload-type="video">' . $values['options']['video-filename'] . '</a><a class="remove-video remove-media" data-content-id="' . $values['id'] . '" data-media="video"></a>
					<div class="clear"></div>
					<input type="text" name="' . $name . '" class="is-content is-video media-field-margin" value="' . $values['options'][$name] . '">
					<input type="hidden" name="video-filename" class="' . $values['options_class'] . '" value="' . $values['options']['video-filename'] . '">
				</div>';
		} else if($type === 'image-option') {

			if(!isset($values['options']['image-filename'])) {
				$values['options']['image-filename'] = 'Upload Image';
			}
			
			if(!isset($values['options']['img'])) {
				$values['options']['img'] = '';
			}

			echo 
				'<div class="media-upload-box image-option-upload-box">
					<a class="media-upload semplice-button image-upload" data-content-id="' . $values['id'] . '" data-upload-type="image">' . $values['options']['image-filename'] . '</a><a class="remove-image remove-media" data-content-id="' . $values['id'] . '" data-media="image"></a>
					<div class="clear"></div>
					<input type="hidden" name="img" class="' . $values['options_class'] . ' is-image" value="' . $values['options']['img'] . '">
					<input type="hidden" name="image-filename" class="' . $values['options_class'] . '" value="' . $values['options']['image-filename'] . '">
				</div>';
		} else if($type === 'audio') {
			if(!isset($values['options']['audio-filename'])) {
				$values['options']['audio-filename'] = 'Upload Audio';
			}
			echo 
				'<div class="media-upload-box video-upload-box">
					<a class="media-upload semplice-button audio-upload" data-content-id="' . $values['id'] . '" data-upload-type="audio">' . $values['options']['audio-filename'] . '</a><a class="remove-video remove-media" data-content-id="' . $values['id'] . '" data-media="audio"></a>
					<div class="clear"></div>
					<input type="text" name="' . $name . '" class="is-content is-audio media-field-margin" value="' . $values['options'][$name] . '">
					<input type="hidden" name="audio-filename" class="' . $values['options_class'] . '" value="' . $values['options']['audio-filename'] . '">
				</div>';
		}
		
		// option footer
		echo '</div></div></div>';
		
		if(isset($values['cols'])) {
			echo '</div>';
		}
	}
	
	// select boxes
	function select($arr, $active_key) {

		if(is_array($arr)) {
			// is multiselect?
			if(is_array($active_key)) {
				foreach( $arr as $key => $value ) {
					if(in_array($key, $active_key)) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
					echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
				}
			} else {
				foreach( $arr as $key => $value ) {
					if($key === $active_key) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
					echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
				}
			}
		}
	}
	
	// options seperator
	function option_seperator() {
		echo '<div class="hr"></div>';
	}
	
	// title seperator
	function title_seperator($title) {
		echo '<div class="title-seperator">' . $title . '</div>';
	}
	
	// container styles
	function container_styles($styles) {

		$css = '';

		if(!empty($styles['padding-top']) && $styles['padding-top'] !== '0px') {
			$css .= 'padding-top: ' . $styles['padding-top'] . ';';
		}
		if(!empty($styles['padding-bottom']) && $styles['padding-bottom'] !== '0px') {
			$css .= 'padding-bottom: ' . $styles['padding-bottom'] . ';';
		}
		if(!empty($styles['padding-right']) && $styles['padding-right'] !== '0px') {
			$css .= 'padding-right: ' . $styles['padding-right'] . ';';
		}
		if(!empty($styles['padding-left']) && $styles['padding-left'] !== '0px') {
			$css .= 'padding-left: ' . $styles['padding-left'] . ';';
		}
		if(!empty($styles['background-image'])) {			
			$css .= 'background-image: url(' . $styles['background-image'] . ');';
			$css .= 'background-repeat: ' . $styles['background-repeat'] . ';';
			if(!empty($styles['background-size']) && $styles['background-size'] === 'cover') {
				$css .= 'background-size: cover;';	
			} else if(!empty($styles['background-repeat']) && $styles['background-repeat'] !== 'no-repeat') {
				$css .= 'background-size: auto !important;';
			}
			if(!empty($styles['background-position'])) {
				$css .= 'background-position: ' . $styles['background-position'] . ';';
			} else {
				$css .= 'background-position: top center;';
			}
		}
		if(preg_match('/^#[a-f0-9]{6}$/i', $styles['background-color'])) {
			$has_color = true;
		} 
		if(!empty($has_color) && $has_color === true) {
			$css .= 'background-color: ' . $styles['background-color'] . ';';
		} else {
			$css .= 'background-color: transparent;';
		}
		
		// fwt border bottom
		if(!empty($styles['border-bottom'])) {
			$css .= 'border-color: ' . $styles['border-bottom'] . ' !important;';
		} 

		return $css;
	}
	
	// horizontal rule styles
	function hr_styles($values) {
		
		$css = '';
		
		if($values['options']['height']) {
			$css .= 'height:' . $values['options']['height'] . ';';
		}
		if($values['options']['margin_top']) {
			$css .= 'margin-top:' . $values['options']['margin_top'] . ';';
		}
		if($values['options']['margin_bottom']) {
			$css .= 'margin-bottom:' . $values['options']['margin_bottom'] . ';';
		}
		if($values['options']['color']) {
			$css .= 'background-color:' . $values['options']['color'] . ';';
		}
		
		return $css;
	}

	function styles($values) {
		// include the legendary atts
		include('styles.php');
	}

	function custom_fontset() {
		if($this->edit_mode === 'custom-fontset') {
			$post_object = get_post($this->fontset_id);
			include('webfonts.php');
			webfonts($post_object, true);
		}
	}
	
	function load_template() {

		// is edit mode load template?
		if($this->edit_mode === 'load-template') {
			
			if($this->template_type !== 'object') {
			
				// include the template file
				include('templates/custom/' . $this->template_id . '/template.php');
				
			} else {
			
				// object
				$template = array();
				
				// output content
				remove_filter('the_content', 'wpautop');
				
				// get content			
				$template_content = get_post_meta( $this->template_id, 'semplice_ce_content', true );
				
				// apply the ce shortcodes whitelist
				$content_output = apply_filters('ce_shortcodes', $template_content, $this->template_id);
				
				// applay the_content filter
				$content_output = apply_filters('the_content', $template_content);

				// get rom		
				$template_rom = get_post_meta( $this->template_id, 'semplice_ce_rom', true );
				
				// get branding	
				$template_branding = get_post_meta( $this->template_id, 'semplice_ce_branding', true );
				
				// get modules
				$template_modules = get_post_meta( $this->template_id, 'semplice_ce_modules', true );
				
				$template['html']		= $content_output;
				$template['rom']		= $template_rom;
				$template['branding']	= $template_branding;
				$template['modules']	= $template_modules;
				
				echo json_encode($template);
				
				// reset postdata
				wp_reset_postdata();
			}
			
		}
		
	}
	
	// set custom module id
	function custom_module_id($id, $values) {
		echo '<input type="hidden" class="' . $values['cm_class'] . '" value="' . $id . '" name="custom_module">';
	}
	
	// custom modules
	function load_module($content, $values, $content_type) {

		// define standard modules
		$standard_modules = array(
			'content-p' 				=> 'paragraph',
			'column-content-p' 			=> 'paragraph',
			'content-img' 				=> 'image',
			'column-content-img' 		=> 'image',
			'content-gallery' 			=> 'gallery',
			'column-content-gallery' 	=> 'gallery',
			'content-video' 			=> 'video',
			'column-content-video'		=> 'video',
			'content-audio' 			=> 'audio',
			'column-content-audio' 		=> 'audio',
			'content-oembed' 			=> 'oembed',
			'column-content-oembed' 	=> 'oembed',
			'content-spacer'			=> 'spacer',
			'column-content-spacer'		=> 'spacer',
			'content-thumbnails' 		=> 'portfolio-grid',
			'column-content-thumbnails' => 'portfolio-grid',
			'multi-column'				=> 'multi-column',
			'add-column'				=> 'multi-column'
		);

		// get module
		if($content_type !== 'custom-module') {
			foreach($standard_modules as $module_type => $module) {
				if($module_type === $content_type) {
					
					// get module id
					$module_id = $module;
					
					// include module
					include('modules/default/' . $module_id . '/module.php');
				}
			}
		} else {
			// if new multi column content
			if($this->is_column_content) {
				$module_id = $this->rom['columns'][$this->column_id]['#' . $this->id]['custom_module'];
			// if edit in multi column
			} elseif($values['in_column']) {
				$module_id = $values['module_id'];
			// non multi column
			} else {
				$module_id = $this->rom['custom_module'];
			}
			
			if(file_exists(get_template_directory() . '/content-editor/modules/custom/' . $module_id . '/module.php')) {
				// include module
				include('modules/custom/' . $module_id . '/module.php');
			} else {
				// module not found
				echo 'ModuleNotFound';
			}
			
		}
	}

	function edit_head($values) {
		
		// single edit class
		$single_edit_class = '';
		
		// is new or edit		
		if($this->edit_mode === 'new' || $this->edit_mode === 'single-edit' || $values['in_column']) {
			if($this->edit_mode === 'single-edit') {
				$single_edit_class = "single-edit-cc";
			}
			echo '<div id="' . $values['id'] . '" class="' . $values['content_type'] . ' ' . $single_edit_class . '" data-sort="1">';
		}

		if(!$values['in_column']) {
			echo '
				<div class="container edit-content fadein">';
				// sticky atts
				if($values['content_type'] === 'multi-column') {
					echo '
						<div class="sticky-mc-atts">
							<ul>
								<li><a class="save-mc" data-content-id="' . $this->id . '" data-content-type="' . $this->content_type . '"></a></li>
								<li><a class="add-column" data-content-id="' . $this->id . '">Add New Column</a></li>
							</ul>
						</div>
					';
				}
			echo '
					<div class="row">
						<div class="span12">
							<div class="atts-holder">
			';
		} else {
			echo '
				<div class="edit-content fadein column-content in-edit-mode" data-content-id="' . $values['id'] . '" data-content-type="' . $values['content_type'] . '" data-in-column="' . str_replace('#', '', $values['column_id']) . '">
					<div class="atts-holder">
			';
		}
		
		$this->styles($values);
		
		if(!$values['in_column']) {
			echo '
							</div>
						</div>
					</div>
			';
		} else {
			echo '
					</div>
			';

		}
	}

	function edit_foot($values) {
		// is new or edit
		if($this->edit_mode !== 'edit' || $values['in_column']) {
			echo '</div>';
		}
		echo '</div>';
	}
	
	function view_head($values) {
		
		// single edit popup
		$single_edit_popup = '';
		
		if($values['in_column']) {
			$column_pre = 'column-';
		}
		
		if(isset($values['single_edit_content_id'])) {
			$single_edit = 'data-single-edit-content-id="' . str_replace('#', '', $values['single_edit_content_id']) . '" data-single-edit-column-id="' . $values['single_edit_column_id'] . '" data-single-edit-content-type="' . $values['single_edit_content_type'] . '"';
			$single_edit_popup = '
				<div class="single-edit">
					<ul>
						<li><a class="edit-single" ' . $single_edit . '>Single Edit</a></li>
						<li><a class="edit-column">Column Edit</a></li>
					</ul>
				</div>
			';
		}
		
		// content container class
		if($this->content_type === 'multi-column') {
			$cc_class = 'mc-sub-content-container';
		} else {
			$cc_class = 'content-container';
		}

		// is custom module?
		if($values['module_id']) {
			$custom_module = 'data-modules-array="' . $values['module_id'] . '"';
		} else {
			$custom_module = '';
		}
		
		// get css output
		$e = '<div class="' . $cc_class . '" style="' . $this->container_styles($values['styles']) . '" data-content-id="' . $this->id . '" data-content-type="' . $this->content_type . '" ' . $custom_module . '>';
		$e .= $single_edit_popup;
		
		// has container?
		if($values['has_container']) {
			$e .= '<div class="container">';
			$e .= '<div class="row">';
		}
		
		// output
		echo $e;
	}
	
	function view_foot($values) {
		$e = '</div>';
		// has container?
		if($values['has_container']) {
			$e .= '</div>';
			$e .= '</div>';
		}

		//output
		echo $e;
	}
	
	// row header
	function row_header($styles, $options, $remove_gutter, $is_fluid) {

		// output
		$e = '';
	
		// inner background
		$inner_background = '';
	
		// get css output
		$e  = '<div class="mc-content-container" style="' . $this->container_styles($styles) . '" data-content-id="' . $this->id . '" data-content-type="' . $this->content_type . '">';
		
		// has inner background?
		if($options['row-inner-background']) {
			$inner_background = 'style="background-color: ' . $options['row-inner-background'] . ';"';
		}

		// check if layout is fluid or non-fluid
		if($is_fluid) {
			$container_class = '';
			// if gutter, center masonry
			if(!$remove_gutter) {
				$fit_width = 'isFitWidth: true';
				$masonry = '.masonry-full-inner';
				$container_class = 'class="masonry-full"';
			}
		} else {
			$container_class = 'class="container"';
		}

		$e .= '<div id="masonry-' . $this->id . '" ' . $container_class . ' ' . $inner_background . '>';
		
		// open masonry inner
		if($is_fluid && !$remove_gutter) {
			// masonry inner
			$e .= '<div class="masonry-full-inner">';
		}
		
		if($remove_gutter) {
			$e .= '<div class="no-gutter-grid-sizer"></div>';
			$e .= '<div class="no-gutter-gutter-sizer"></div>';
		} else {
			$e .= '<div class="row"><div class="grid-sizer"></div>';
			$e .= '<div class="gutter-sizer"></div>';
		}
		
		// output
		echo $e;
	}
	
	// row footer
	function row_footer($remove_gutter, $is_fluid) {
		
		// masonry container
		$masonry = '';
		
		// masonry prefix
		$pre = '';
		
		// fit width
		$fit_width = '';
		
		// check if layout is fluid or non-fluid
		if($is_fluid && !$remove_gutter) {
			$fit_width = 'isFitWidth: true';
			$masonry = ' .masonry-full-inner';
		}
		
		// output
		$e = '';
		
		// is masrony layout mode?
		if($remove_gutter) {
			$pre = 'no-gutter-';
			$e .= '</div>';
		} else {
			$e .= '</div></div>';
		}
		
		// close masonry inner
		if($is_fluid && !$remove_gutter) {
			$e .= '</div>';	
		}
		
		// javascript
		$e .= '
		<script type="text/javascript">
			(function ($) {
				$(document).ready(function () {
					/* init masonry */
					var $container = $("#masonry-' . $this->id . $masonry . '");
					$container.imagesLoaded( function() {
						$container.masonry({
							itemSelector: ".masonry-item",
							columnWidth: ".' . $pre . 'grid-sizer",
							gutter: ".' . $pre . 'gutter-sizer",
							transitionDuration: 0,
							isResizable: true,
							' . $fit_width . '
						});
					});
				});
			})(jQuery);
		</script>
		';
		
		$e .= '</div>';
		
		// output
		echo $e;
	}
	
	// paragraph edit
	function mc_edit($values) {
		
		// edit head
		$this->edit_head($values);

		// remove Gutter
		$remove_gutter = array('no' => 'No', 'yes' => 'Yes');
		
		// show fullscreen
		$show_fullscreen = array('no' => 'No', 'yes' => 'Yes');
		
		// sticky atts
		echo '<div class="sticky-atts-beginn"></div>';
		
		// options
		$this->get_option('select', 'Remove Gutter', 'remove-gutter', 'no', $remove_gutter, $values);
		
		// seperator
		$this->option_seperator();
		
		// options
		$this->get_option('select', 'Fluid Layout', 'show-fullscreen', 'no', $show_fullscreen, $values);
		
		// seperator
		$this->option_seperator();
		
		// row inner background
		$this->get_option('color', 'Row Inner Background', 'row-inner-background', 'transparent', false, $values);
		
		// content area
		echo '
			<div class="row">
				<div class="span12">
					<div class="edit-elements">
						<div class="add-column-box">
							<a class="add-column semplice-button" data-content-id="' . $this->id . '">Add New Column</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row"><div class="span12"><div class="hr"></div></div></div>
			<div class="row">
				<div class="span12">
					<div class="columns">';
						
						if($this->edit_mode === 'edit') {

							foreach($this->rom['columns'] as $mc_column_id => $mc_columns) {
								
								// add columns
								$this->add_column(str_replace('#', '', $mc_column_id), str_replace('#', '', $this->id), $mc_columns['options']['column-width']);
								
								foreach($mc_columns as $mc_content_id => $mc_content) {

									// content type index
									$mc_content['content_type'] = isset($mc_content['content_type']) ? $mc_content['content_type'] : '';
									
									// content index
									$mc_content['content'] = isset($mc_content['content']) ? $mc_content['content'] : '';
									
									// custom module
									$mc_content['custom_module'] = isset($mc_content['custom_module']) ? $mc_content['custom_module'] : '';
									
									// values
									$values = array(
										'styles'		=> isset($mc_content['styles']) ? $mc_content['styles'] : '', 
										'options'		=> isset($mc_content['options']) ? $mc_content['options'] : '',
										'style_class'	=> 'is-cc-style', 
										'in_column'		=> true, 
										'id'			=> str_replace('#', '', $mc_content_id),
										'column_id'		=> $mc_column_id,
										'content_type'	=> $mc_content['content_type'],
										'options_class' => 'is-cc-option',
										'cm_class'		=> 'is-cc-custom-module',
										'module_id'		=> $mc_content['custom_module']
									);
									
									// edit module
									if($mc_content['content_type']) {
										$this->load_module(stripslashes($mc_content['content']), $values, $mc_content['content_type']);
									}
									
								}
								
								// show add column footer
								echo $this->add_column_foot;
							}
						}
					echo '
					</div>
				</div>
			</div>
		';
		
		// edit foot
		$this->edit_foot($values);
	}
	
	// add column
	function add_column($column_id, $parent_id, $column_width) {

		// col width
		$col_width = array();
		
		for($i=1; $i<=12; $i++) {
			$col_width['span' . $i] = $i . ' Col';
		}
		
		echo '
			<div id="' . $column_id . '" class="column" data-sort="1">
				<div class="container nbp fadein ntp">
					<div class="row">
						<div class="span8 offset1">
							<h5 class="semibold column-title">Column</h5>
						</div>
						<div class="span2">
							<div class="column-sort">
								<a class="column-up" data-content-id="' . $column_id . '"></a>
								<a class="column-down" data-content-id="' . $column_id . '"></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="span10 offset1">
							<div class="column-content-adder adder">
								<ul class="types">
									<li>
										<a class="remove-column" data-content-id="' . $parent_id . '" data-column-id="' . $column_id . '" data-parent-id="' . $parent_id . '"></a>
										<div class="tooltip">
											<div class="tt-arrow"></div>
											<div class="tt-text">Remove</div>
										</div>
									</li>
									<li>
										<a class="add-column-content p" data-content-id="' . $parent_id . '" data-content-type="column-content-p" data-column-id="' . $column_id . '"></a>
										<div class="tooltip">
											<div class="tt-arrow"></div>
											<div class="tt-text">Add Paragraph</div>
										</div>
									</li>
									<li>
										<a class="add-column-content img" data-content-id="' . $parent_id . '" data-content-type="column-content-img" data-column-id="' . $column_id . '"></a>
										<div class="tooltip">
											<div class="tt-arrow"></div>
											<div class="tt-text">Add Image</div>
										</div>
									</li>
									<li>
										<a class="add-column-content gallery" data-content-id="' . $parent_id . '" data-content-type="column-content-gallery" data-column-id="' . $column_id . '"></a>
										<div class="tooltip">
											<div class="tt-arrow"></div>
											<div class="tt-text">Add Gallery</div>
										</div>
									</li>
									<li>
										<a class="add-column-content video" data-content-id="' . $parent_id . '" data-content-type="column-content-video" data-column-id="' . $column_id . '"></a>
										<div class="tooltip">
											<div class="tt-arrow"></div>
											<div class="tt-text">Add Video</div>
										</div>
									</li>
									<li>
										<a class="add-column-content audio" data-content-id="' . $parent_id . '" data-content-type="column-content-audio" data-column-id="' . $column_id . '"></a>
										<div class="tooltip">
											<div class="tt-arrow"></div>
											<div class="tt-text">Add Audio</div>
										</div>
									</li>
									<li>
										<a class="add-column-content oembed" data-content-id="' . $parent_id . '" data-content-type="column-content-oembed" data-column-id="' . $column_id . '"></a>
										<div class="tooltip">
											<div class="tt-arrow"></div>
											<div class="tt-text">Add oEmbed</div>
										</div>
									</li>
									<li>
										<a class="add-column-content spacer" data-content-id="' . $parent_id . '" data-content-type="column-content-spacer" data-column-id="' . $column_id . '"></a>
										<div class="tooltip">
											<div class="tt-arrow"></div>
											<div class="tt-text">Add Spacer</div>
										</div>
									</li>
									<li class="adder-last">
										<div class="set-col-width">
											<h4>Width</h4>';
											if(!isset($column_width)) {
												$column_width = 'span6';
											}
											echo '<div class="ce-select-box col-width-box"><select name="column-width" class="is-option select-box">';
											$this->select($col_width, $column_width);
											echo '</select></div>';
										echo '
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="span10 offset1 column-inner">
		';
		
		// is new or edit
		if($this->edit_mode !== 'edit') {
			// show column foot on new content
			echo $this->add_column_foot;
		}
	}
}
?>