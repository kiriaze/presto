<?php
/*
 * content editor meta boxes
 * semplice.theme
 */

add_filter( 'rwmb_meta_boxes', 'semplice_register_meta_boxes' );

function semplice_register_meta_boxes( $meta_boxes )
{

	$prefix = 'semplice_';

	// 1st meta box
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id' => 'smp_ce_mb',
		
		'title' => __( 'Semplice Content Editor Meta Boxes', 'rwmb' ),

		'pages' => array( 'work', 'page' ),

		'context' => 'normal',

		'priority' => 'high',

		'autosave' => true,

		'fields' => array(
			// Rom
			array(
				'name' 	=> __( 'Rom', 'rwmb' ),
				'id'   	=> "{$prefix}ce_rom",
				'type' 	=> 'textarea',
				'input_class' => 'rom',
				'cols' 	=> 20,
				'rows' 	=> 3,
			),
			// HTML Content
			array(
				'name' 	=> __( 'Content', 'rwmb' ),
				'id'   	=> "{$prefix}ce_content",
				'type' 	=> 'textarea',
				'input_class' => 'semplice-content',
				'cols' 	=> 20,
				'rows' 	=> 3,
			),
			// Branding
			array(
				'name' 	=> __( 'Branding', 'rwmb' ),
				'id'   	=> "{$prefix}ce_branding",
				'type' 	=> 'textarea',
				'input_class' => 'branding',
				'cols' 	=> 20,
				'rows' 	=> 3,
			),
			// Stats
			array(
				'name' 	=> __( 'Statistics', 'rwmb' ),
				'id'   	=> "{$prefix}ce_stats",
				'type' 	=> 'textarea',
				'input_class' => 'stats',
				'cols' 	=> 20,
				'rows' 	=> 3,
			),
			// Fontset
			array(
				'name'  => __( 'Fontset', 'rwmb' ),
				'id'    => "{$prefix}ce_fontset",
				'input_class' => 'fontset',
				'type'  => 'text',
			),
			// Modules
			array(
				'name' 	=> __( 'Modules', 'rwmb' ),
				'id'   	=> "{$prefix}ce_modules",
				'type' 	=> 'textarea',
				'input_class' => 'modules',
				'cols' 	=> 20,
				'rows' 	=> 3,
			),
		)
	);
	
	return $meta_boxes;
}


