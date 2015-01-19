<?php
/*
 * Custom Fontset 2.0
 * semplice.theme
 */

// custom fontset
function webfonts($custom_fontset, $is_ce) {

	// global post
	global $post;
	
	// output
	$font_output = '';
	
	// weights array
	$weight_arr = array(
		'light',
		'light_italic',
		'regular',
		'regular_italic',
		'semibold',
		'semibold_italic',
		'bold',
		'bold_italic',
		'custom_one',
		'custom_one_italic'
	);
	
	// weights for default open sans
	$weight_arr_def = array(
		'light'				=> '300',
		'regular'			=> '400',
		'semibold'			=> '600',
		'bold'				=> '700',
		'custom_one'		=> '800',
	);

	// classes array
	$classes = array();
	
	// get css classes
	if($is_ce) {
		$classes['ce'] = '.wysiwyg-ce h1, .wysiwyg-ce h2, .wysiwyg-ce h3, .wysiwyg-ce h4, .wysiwyg-ce h5, .wysiwyg-ce h6, #semplice h1, #semplice h2, #semplice h3, #semplice h4, #semplice h5, #semplice h6';
	} else {
		// css classes
		$classes['standard'] = '.wysiwyg h1, .wysiwyg h2, .wysiwyg h3, .wysiwyg h4, .wysiwyg h5, .wysiwyg h6';
	}
	
	if($custom_fontset) {
		
		$post = $custom_fontset;
		setup_postdata($post);
		
		$type = get_field('type');
		
		$font_output = '';
		
		$embed_code = get_field('embed_code');
		
		$search = array ('/\<link/');
		$id = array ('<link data-fontset-id="ce-fontset"');
		$embed_code = preg_replace($search, $id, $embed_code);

		if($type === 'service') {
			$font_output .= $embed_code;
		} else {
			$font_output .= '<style id="ce-fontset" type="text/css">';
			$font_output .= get_field('css_code');
			$font_output .= '</style>';
		}
		
		// define the weight classes
		$font_output .= '<style id="ce-fontset" type="text/css">';
		
		function get_fonts($weight, $is_body_font, $is_ce, $classes) {
		
			// font css
			$font_css = '';

			$options = get_field($weight);
		
			// is the font name a double name like on clound.typography?
			if(strpos($options['font_name'],',') !== false) {
				$font_name = explode(',', $options['font_name']);
				$font_name = '"' . $font_name['0'] . '", "' . $font_name['1'] . '"';
			} else {
				$font_name = '"' . $options['font_name'] . '"';
			}

			if($options['font_name']) {
				if($options['use_font_weight'] === 'yes') {
					$font_weight = 'font-weight: ' . preg_replace('/fw/', '', $options['font_weight']) . ';';
				} else {
					$font_weight = 'font-weight: normal;';
				}
				if(isset($options['font_style']) && $options['font_style'] === 'italic') {
					$font_style = 'font-style: italic;';
				} else {
					$font_style = 'font-style: normal;';
				}
				if($options['category'] === 'sans-serif') {
					$category = 'Helvetica, Arial, sans-serif';
				} else {
					$category = 'Georgia, Times New Roman, serif';
				}
				if($is_ce && is_admin()) {
					/* show only in content editor */
					$ce_pre_body = '#semplice';
				} else {
					$ce_pre_body = 'body, textarea, input';
				}
				if($is_body_font) {
					$font_css = $ce_pre_body . ' { font-family: ' . $font_name . ', ' . $category . ' !important; ' . $font_style  . ' ' . $font_weight . '}';
					$font_css .= '.' . $weight . ' { font-family: ' . $font_name . ', ' . $category . ' !important; ' . $font_style  . ' ' . $font_weight . ' }';
				} elseif($is_ce && $weight === 'bold') {
					$font_css = '.' . $weight . ', ' . $classes['ce'] . ' { font-family: ' . $font_name . ', ' . $category . '; ' . $font_style  . ' ' . $font_weight . ' }';	
				} elseif(!$is_ce && $weight === get_field('so_headings_font_weight', 'options')) {
					$font_css = '.' . $weight . ', ' . $classes['standard'] . ' { font-family: ' . $font_name . ', ' . $category . '; ' . $font_style  . ' ' . $font_weight . ' }';	
				} else {
					$font_css = '.' . $weight . ' { font-family: ' . $font_name . ', ' . $category . ' !important; ' . $font_style  . ' ' . $font_weight . ' }';
				}
			}
			return $font_css;
		}

		// get fonts
		foreach($weight_arr as $weight) {
			if($weight === get_field('body_font')) {
				$font_output .= get_fonts($weight, true, $is_ce, $classes);
			} else {
				$font_output .= get_fonts($weight, false, $is_ce, $classes);
			}
			
		}
		
		// close custom fontset style
		$font_output .= '</style>';
		
		wp_reset_postdata();
	} else {

		// default open sans and playfair display
		$font_output .= '<link data-fontset-id="ce-fontset" href="http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic" rel="stylesheet" type="text/css">';
		$font_output .= '<link data-fontset-id="ce-fontset" href="http://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic" rel="stylesheet" type="text/css">';
		$font_output .= '<style id="ce-fontset" type="text/css">';
		$font_output .= '.light,.light_italic{font-family:"Open Sans", Arial, sans-serif;font-weight:300;}.regular,.regular_italic{font-family:"Open Sans", Arial, sans-serif;font-weight:400;}.semibold,.semibold_italic{font-family:"Open Sans", Arial, sans-serif;font-weight:600;}.bold,.bold_italic,strong,b{font-family:"Open Sans", Arial, sans-serif;font-weight:700;}.custom_one,.custom_one_italic{font-family:"Libre Baskerville", Georgia, serif;font-weight:400;}';
		$font_output .= '.light_italic, .regular_italic, .semibold_italic, .bold_italic, .custom_one_italic {font-style:italic}';
		
		// headings weight
		if($is_ce) {
			$font_output .= $classes['ce'] . ' { font-weight: 700; }';		
		}elseif(!$is_ce && get_field('so_headings_font_weight', 'options')) {
			foreach($weight_arr_def as $weight => $weight_css) {
				if($weight === get_field('so_headings_font_weight', 'options')) {
					$font_output .= $classes['standard'] . ' { font-weight: ' . $weight_css . '; }';
				}
			}
		} else {
			$font_output .= $classes['standard'] . ' { font-weight: 700; }';
		}
		
		$font_output .= '</style>';
	}

	echo $font_output;
}


?>