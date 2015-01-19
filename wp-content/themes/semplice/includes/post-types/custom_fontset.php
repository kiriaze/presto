<?php
/*
 * custom fontset post type
 * semplice.theme
 */

add_action( 'init', 'smp_register_custom_fontset' );

function smp_register_custom_fontset() {
	$labels = array(
		'name' => __('Custom Fontsets', 'semplice'),
		'singular_name' => __('Custom Fontset', 'semplice'),
		'add_new' => __('Add New', 'semplice'),
		'add_new_item' => __('Add New Custom Fontset', 'semplice'),
		'edit_item' => __('Edit Custom Fontset', 'semplice'),
		'new_item' => __('Add New', 'semplice'),
		'view_item' => __('View Custom Fontset', 'semplice'),
		'search_items' => __('Search Fontsets', 'semplice'),
		'not_found' => __('No custom fontset found', 'semplice'),
		'not_found_in_trash' => __('No custom fontset found in trash', 'semplice'),
		'parent_item_colon' => __('Parent custom fontset:', 'semplice'),
		'menu_name' => __('Custom Fontsets', 'semplice'),
	);
	$args = array(
		'labels' => $labels,
		'menu_icon' => '',
		'hierarchical' => false,
		'description' => __('Add your custom fontsets for the semplice theme here..', 'semplice'),
		'supports' => array( 'title', 'author', 'thumbnail', 'custom-fields'),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => false,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
	);
	register_post_type( 'custom_fontset', $args );
} 
?>