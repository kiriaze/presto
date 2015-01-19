<?php
/*
 * ce index
 * semplice.theme
 * 
 */
 
// get default fontset id
$fontset_object = get_field('custom_fontset', 'options'); 

if($fontset_object) {
	$fontset_id = $fontset_object->ID;
} else {
	$fontset_id = 'default';
}

// get branding
$styles = json_decode(get_post_meta( get_the_ID(), 'semplice_ce_branding', true ), true);

// select boxes
function select($arr, $active_key) {
	echo $active_key;
	if( is_array($arr) )
	{
		foreach( $arr as $key => $value )
		{
			if($key === $active_key) {
				$selected = 'selected';
			} else {
				$selected = '';
			}
			echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
		}
	}
}

?>
<script type="text/javascript">
	/* set default fontset */
	var default_fontset = '<?php echo $fontset_id; ?>';
	var post_id = '<?php echo get_the_ID(); ?>';
</script>
<?php
	// adder
	require get_template_directory() . '/content-editor/partials/adder.php';
	
	// dialogs
	require get_template_directory() . '/content-editor/partials/dialogs.php';
?>