<?php

/*
 * modules upload
 * semplice.theme
 */

// reload status
$mode = isset($_POST['mode']) ? $_POST['mode'] : '';

// reload status
$module_id = isset($_POST['module_id']) ? $_POST['module_id'] : '';

// reload status
$module_status = isset($_POST['module_status']) ? $_POST['module_status'] : '';
 
// directory separator
$ds = DIRECTORY_SEPARATOR;

// modules directory
$modules_dir = 'modules/custom';

if(!empty($_FILES)) {

	// temp filename
	$temp_file = $_FILES['file']['tmp_name'];
	
	// target path
	$modules_target_dir = dirname( __FILE__ ) . $ds. $modules_dir . $ds;
	
	// module file
	$module_zip =  $modules_target_dir . $_FILES['file']['name'];

	// get extension
	$ext = pathinfo($module_zip, PATHINFO_EXTENSION);
	
	if($ext === 'zip') {
		
		// move upload file to modules/custom
		move_uploaded_file($temp_file, $module_zip);
		
		// create new zip archive instance
		$zip = new ZipArchive;
		
		// open zip
		if ($zip->open($module_zip) === TRUE) {
			
			// get comment
			$comment = $zip->getArchiveComment();

			// check if it's a semplice module
			if($comment === 'semplicelabs') {
			
				// extract zip
				$zip->extractTo($modules_target_dir);

			} 

			// close zip
			$zip->close();
			
		} else {
			echo 'Module installation failed!';
		}
		
		// delete zip
		unlink($module_zip);
		
	} else {
		echo "Please upload a valid module zip file!";
	}
}

if($mode === 'reload') {

	// update modules
	modules_to_json();
	
	// list modules
	echo list_modules(false, false, false, false);
	
} elseif($mode === 'deactivate') {

	// active toggle module
	module_status($module_id, $module_status);
	
	// update modules
	modules_to_json();
	
	// list modules
	echo list_modules(false, false, false, false);

}	



?>  