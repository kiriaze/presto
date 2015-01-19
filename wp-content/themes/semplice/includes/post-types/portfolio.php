<?php

#----------------------------------------#
# portfolio custom post type             #
# semplice.theme                         #
#----------------------------------------#

add_action( 'init', 'smp_register_work' );

function smp_register_work() {
	$labels = array(
		'name' => __('Works', 'semplice'),
		'singular_name' => __('Work', 'semplice'),
		'add_new' => __('Add New Work', 'semplice'),
		'add_new_item' => __('Add New Work', 'semplice'),
		'edit_item' => __('Edit Work', 'semplice'),
		'new_item' => __('New Work', 'semplice'),
		'view_item' => __('View Work', 'semplice'),
		'search_items' => __('Search Portfolio', 'semplice'),
		'not_found' => __('No portfolio found', 'semplice'),
		'not_found_in_trash' => __('No portfolio found in Trash', 'semplice'),
		'parent_item_colon' => __('Parent work:', 'semplice'),
		'menu_name' => __('Portfolio', 'semplice'),
	);
	$args = array(
		'labels' => $labels,
		'menu_icon' => '',
		'hierarchical' => false,
		'description' => __('Description for the Post Type work.', 'semplice'),
		'supports' => array( 'title', 'author', 'thumbnail', 'custom-fields'),
		'taxonomies' => array('category'),
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
	register_post_type( 'work', $args );
} 
?>