<?php

/*
 * custom modules
 * semplice.theme
 */

// load ce shortcodes
function ce_module_shortcodes() {

	$modules_dir = get_template_directory() . '/content-editor/modules/custom';

	$cdir = scandir($modules_dir);
	
	foreach ($cdir as $key => $module) {
		if (!in_array($module,array(".",".."))) {
			if (is_dir($modules_dir . DIRECTORY_SEPARATOR . $module)){

				// shortcode
				$shortcode = $modules_dir . '/' . $module . '/' . 'shortcode.php';

				//include shortcode
				if(file_exists($shortcode)) {
					require $shortcode;
				}
			}
		}
	}
}

ce_module_shortcodes();

// ce shortcode whitelist
if(is_admin()) {	

	add_filter('ce_shortcodes', 'ce_shortcode_whitelist', 0, 2);

	function ce_shortcode_whitelist($content, $post_id) {
		
		// modules array
		$modules_array = json_decode(get_post_meta( $post_id, 'semplice_ce_modules', true));
	
		// whitelist
		$ce_shortcode_whitelist = array();

		if(isset($modules_array)) {
			foreach($modules_array as $module) {
				$ce_shortcode_whitelist[] = 'ce_' . $module;
			}
		}

		global $shortcode_tags;
		
		foreach($shortcode_tags as $tag => $func) {
			if(!in_array($tag, $ce_shortcode_whitelist)) {
				remove_shortcode($tag);
			}
		}

		/* Return the post content. */
		return $content;
	}
}	

// modules json
function modules_to_json() {

	$modules_dir = get_template_directory() . '/content-editor/modules/custom';

	$cdir = scandir($modules_dir);
	
	$modules_json = array();
	
	foreach ($cdir as $key => $module) {
		if (!in_array($module,array(".",".."))) {
			if (is_dir($modules_dir . DIRECTORY_SEPARATOR . $module)) {
			
				// get json
				$json = file_get_contents($modules_dir . '/' . $module . '/info.json');
				$json = json_decode($json,true);
				
				// push module metas to array
				$modules_json[$module] = $json;
			}
		}
	}
	
	if(!empty($modules_json)) {
	
		// json encode modules array
		$modules_array = json_encode($modules_json);
		
		// update json
		update_field('installed_modules', $modules_array, 'options');
		
	} else {
		update_field('installed_modules', false, 'options');
	}
	
}

// list modules
function list_modules($is_ce, $is_column, $parent_id, $column_id) {

	// define modules dir
	$modules_array = json_decode(get_field('installed_modules', 'options'), true);
	
	// output
	$output = '';
	
	if(!empty($modules_array)) {
	
		// show installed message
		if(!$is_ce) {
			$output = '
				<div class="acf-semplice-desc">
				<h1>Installed Modules</h1><p>This are the modules you have currently installed</p>
				</div>
			';
		}
	
		foreach ($modules_array as $key => $module) {
		
			// addon name
			$module_slug = strtolower($module['name']);
			
			// active status			
			$status = 'active';
			$active_toggle_button = 'Deactivate';
			$active_toggle = 'inactive';
			
			// is active?
			if($module['status'] !== 'active') {
				$status = 'inactive';
				$active_toggle_button = 'Activate';
				$active_toggle = 'active';
			}
			
			// output
			if(!$is_ce) {
			
				// preview image
				$preview_image = get_template_directory_uri() . '/content-editor/modules/custom/' . $module_slug . '/screenshot.png';
				
				$output .= '
					<div class="installed-module ' . $status . '">
						<a class="deactivate-module" data-module-id="' . $module_slug . '" data-module-status="' . $active_toggle . '">' . $active_toggle_button . '</a>
						<div class="thumbnail">
							<img src="' . $preview_image . '">
						</div>
						<div class="meta">
							<h4>
								' . $module['name'] . '
								<br />
								<span>by Semplicelabs</span>
							</h4>
						</div>
					</div>
				';
				
			} else {
				
				// only show module in ce if active
				if($module['status'] === 'active') {
				
					// preview image
					$preview_image = get_template_directory_uri() . '/content-editor/modules/custom/' . $module_slug . '/screenshot_ce.png';
				
					// is column?
					if($is_column) {
						$content = 'column-content';
						$mc_ids = 'data-content-id="' . $parent_id . '" data-column-id="' . $column_id . '"';
					} else {
						$content = 'content';
						$mc_ids = '';
					}
					
					// temporary output
					$temp_output = '
						<li class="module module-' . $status . '-ce">
							<a class="add-' . $content . '" data-module-id="' . $module_slug . '" data-content-type="custom-module" style="background-image: url(' . $preview_image . ');" ' . $mc_ids . '></a>
						</li>
					';
					
					// is in column?
					if($is_column) {
						// is the module multi column compatible?
						if($module['mc_compatible']) {
							$output .= $temp_output;
						}
					} else {
						$output .= $temp_output;
					}
				}
			}
		}
	} else {
		if(!$is_ce) {
			$output = '<div class="acf-semplice-desc"><h4 class="no-modules">You have no modules installed.</h4></div>';
		} else {
			$output = '<h5 class="no-modules">You have no modules installed.<br />Please visit the Theme Options to install modules.</h5>';
		}
	}

	return $output;
}

// deativate module
function module_status($module, $status) {
		
	// json file
	$json_file = get_template_directory() . '/content-editor/modules/custom/' . $module . '/info.json';
	
	// open json file
	$json = file_get_contents($json_file);
	$json = json_decode($json, true);
	var_dump($json);

	// set status to inactive
	$json['status'] = $status;

	$new_json = json_encode($json);
	file_put_contents($json_file, $new_json);
	
}

// modules upload ajax
if(is_admin()) {
	function semplice_modules_upload() {
		if (isset($_REQUEST)) {
			// include content editor
			require get_template_directory() . '/content-editor/modules_upload.php';
		}
		// stop script here after ajax request
		die();
	}
}

add_action( 'wp_ajax_semplice_modules_upload', 'semplice_modules_upload' );
?>