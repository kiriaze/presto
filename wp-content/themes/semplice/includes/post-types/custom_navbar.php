<?php
/*
 * custom navbar post type
 * semplice.theme
 */

add_action( 'init', 'smp_register_custom_navbar' );

function smp_register_custom_navbar() {
	$labels = array(
		'name' => __('Navbar & Menu', 'semplice'),
		'singular_name' => __('Navbar & Menu', 'semplice'),
		'add_new' => __('Add New', 'semplice'),
		'add_new_item' => __('Add New Navbar & Menu', 'semplice'),
		'edit_item' => __('Edit Navbar & Menu', 'semplice'),
		'new_item' => __('Add New', 'semplice'),
		'view_item' => __('View Navbar & Menu', 'semplice'),
		'search_items' => __('Search Navbars', 'semplice'),
		'not_found' => __('No navbar & menu found', 'semplice'),
		'not_found_in_trash' => __('No navbar & menu found in trash', 'semplice'),
		'parent_item_colon' => __('Parent navbar & menu:', 'semplice'),
		'menu_name' => __('Navbar & Menu', 'semplice'),
	);
	$args = array(
		'labels' => $labels,
		'menu_icon' => '',
		'hierarchical' => false,
		'description' => __('Add your custom navbar & menu for the semplice theme here..', 'semplice'),
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
	register_post_type( 'custom_navbar', $args );
} 
?>