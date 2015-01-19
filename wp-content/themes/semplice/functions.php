<?php 
/*
 * functions
 * semplice.theme
 */

#---------------------------------------------------------------------------#
# Wordpress Defaults														#
#---------------------------------------------------------------------------# 

// content width
if (!isset($content_width)) {
	$content_width = 770;
}

// multi language
add_action('after_setup_theme', 'semplice_language');

function semplice_language(){
    load_theme_textdomain('semplice', get_template_directory() . '/languages');
} 
 
// register menus
function register_main_menu() {
    register_nav_menu('main-menu', 'Top Primary Menu');
}

add_action('init','register_main_menu');

// register custom post formats
add_theme_support( 'post-formats', array( 'quote', 'video', 'audio', 'gallery', 'link', 'chat', 'status', 'aside') );

// add post-thumbnail support
add_theme_support('post-thumbnails');

// html5 support for the search form
add_theme_support('html5', array('search-form'));

// only search blog posts
function SearchFilter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}

add_filter('pre_get_posts','SearchFilter');

// remove non ACF custom fields
function remove_custom_meta_boxes() {
	remove_meta_box('postcustom','post','normal');
	remove_meta_box('postcustom','page','normal');
	remove_meta_box('postcustom','work','normal');
}
	
add_action('admin_menu','remove_custom_meta_boxes');

// add svg to allowed file upload type
function cc_mime_types($mime_types){
	$mime_types['svg'] = 'image/svg+xml';
	return $mime_types;
}

add_filter( 'upload_mimes', 'cc_mime_types' );

// semplice grid
require get_template_directory() . '/includes/grid.php';

// shortcodes
require get_template_directory() . '/includes/shortcodes.php';

// blog lightbox
if(!is_admin()) {
	add_filter('the_content', 'add_blog_lightbox');

	function add_blog_lightbox ($content) {

		// global post
		global $post;
		
		if($post->post_type === 'post') {
		
			// search for image links
			$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
			
			// replace with new link that contains the lightbox rel
			$replacement = '<a$1data-rel="lightbox" href=$2$3.$4$5$6>';

			$content = preg_replace($pattern, $replacement, $content);
			
		}
		
		return $content;
	}
}

#---------------------------------------------------------------------------#
# Advabced Custom Fields config												#
#---------------------------------------------------------------------------# 

// include equiped acf only if its not already installed
if( !class_exists('acf') ) {

	// define acf lite
    define( 'ACF_LITE' , true );
	
	// include acf core
	require get_template_directory() . '/includes/acf/advanced-custom-fields/acf.php';
	
	// is gallery plugin active?
	if(!function_exists('acfgp_register_fields')) {
		require get_template_directory() . '/includes/acf/add-ons/acf-gallery/acf-gallery.php';
	}

	// is options page plugin active?
	if(!class_exists('acf_options_page_plugin')) {
		require get_template_directory() . '/includes/acf/add-ons/acf-options-page/acf-options-page.php';
	}
}

// register custom ACF fields
function semplice_acf_fields()
{
	require get_template_directory() . '/includes/acf/fields/content_editor.php';
	require get_template_directory() . '/includes/acf/fields/custom_modules.php';
	require get_template_directory() . '/includes/acf/fields/font.php';
}

add_action('acf/register_fields', 'semplice_acf_fields');

// theme options page
function my_acf_options_page_settings( $settings )
{
	$settings['title'] = 'Semplice';
	$settings['pages'] = array('General Settings', 'Basic Styling', 'Typography', 'Advanced Styling', 'Thumb Hover', 'Social Networks', 'About Semplice');
 
	return $settings;
}

add_filter('acf/options_page/settings', 'my_acf_options_page_settings');

// include semplice acf filegroups
if(!get_field('dev', 'options')) {
	require get_template_directory() . '/includes/acf/export.php';
}

#---------------------------------------------------------------------------#
# Enqueue Admin Scripts and Styles											#
#---------------------------------------------------------------------------# 

function enqueue_semplice_scripts() {

	// get screen
	$screen = get_current_screen();

	// google webfont
	wp_register_style('google_webfonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic');
	wp_enqueue_style( 'google_webfonts');
	
	if($screen->id === 'semplice_page_acf-options-custom-modules') {
		wp_register_script('dropzone', get_template_directory_uri() . '/js/dropzone.js', false, '1.0.0');
		wp_enqueue_script('dropzone');
	}
	
	// scripts for the content editor
	if($screen->id === 'work' || $screen->id === 'page') {
	
		// masonry
		wp_register_script( 'masonry-custom', get_template_directory_uri() . '/js/masonry.min.js', false, '1.0.0' );
		wp_enqueue_script( 'masonry-custom' );
		
		// jquery transit
		wp_register_script( 'jquery-transit', get_template_directory_uri() . '/js/jquery.transit.js', false, '1.0.0' );
		wp_enqueue_script( 'jquery-transit' );
		
		// media upload
		wp_enqueue_media();
		wp_register_script( 'semplice-media-upload', get_template_directory_uri() . '/content-editor/js/media.upload.js', false, '1.0.0');
		wp_enqueue_script( 'semplice-media-upload' );
		
		// wordpress color picker
		wp_enqueue_style( 'wp-color-picker' );
		// ckeditor
		wp_register_script( 'ckeditor', get_template_directory_uri() . '/content-editor/ckeditor/ckeditor.js', false, '1.0.0' );
		wp_enqueue_script( 'ckeditor' );

		// ckeditor jquery adapter
		wp_register_script( 'ckeditor-jquery-adapter', get_template_directory_uri() . '/content-editor/ckeditor/adapters/jquery.js', false, '1.0.0' );
		wp_enqueue_script( 'ckeditor-jquery-adapter' );
	
		// imagesLoaded
		wp_register_script('jquery-images-loaded', get_template_directory_uri() . '/js/imagesloaded.js', '', '', true);
		wp_enqueue_script('jquery-images-loaded'); 
				
		// semplice-content-editor
		wp_register_script( 'semplice-content-editor', get_template_directory_uri() . '/content-editor/js/editor.js', false, '1.0.0' );
		wp_enqueue_script( 'semplice-content-editor' );
	
		// content editor css
		wp_register_style( 'content-editor', get_template_directory_uri() . '/content-editor/style.css', false, '1.0.0' );
		wp_enqueue_style( 'content-editor' );
		
	}

	// admin css
	wp_register_style( 'semplice-admin-css', get_template_directory_uri() . '/css/admin.css', false, '1.0.0' );
	wp_enqueue_style( 'semplice-admin-css' );

	// admin javascript
	wp_register_script( 'semplice-admin-js', get_template_directory_uri() . '/js/admin.js', false, '1.0.0' );
	wp_enqueue_script( 'semplice-admin-js' );
}

add_action( 'admin_enqueue_scripts', 'enqueue_semplice_scripts' );


#---------------------------------------------------------------------------#
# Enqueue Frontend Scripts and Styles										#
#---------------------------------------------------------------------------# 

function load_custom_frontend_scripts() {
	
	// the core of all evil
	wp_enqueue_script('jquery');

	// mediaelement css
	wp_deregister_style('wp-mediaelement');
	wp_register_style('semplice-mediaelement-css', get_template_directory_uri() . '/css/mediaelement.css', false, '1.0.0');
	wp_enqueue_style('semplice-mediaelement-css');
	
	// minify
	if(get_field('minify', 'options') === 'disabled') {
		// mediaelement
		wp_deregister_script('wp-mediaelement');
		wp_register_script('semplice-mediaelement-js', get_template_directory_uri() . '/js/mediaelement.js', '', '', true);
	    wp_enqueue_script('semplice-mediaelement-js');
	
		// jquery easing
		wp_register_script('jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', '', '', true);
	    wp_enqueue_script('jquery-easing');
	    
	    // jquery transit
	    wp_register_script('jquery-transit', get_template_directory_uri() . '/js/jquery.transit.js', '', '', true);
	    wp_enqueue_script('jquery-transit');

		// nprogress
		wp_register_script('jquery-nprogress', get_template_directory_uri() . '/js/nprogress.js', '', '', true);
	    wp_enqueue_script('jquery-nprogress');
		
		// load images
		wp_register_script('jquery-loadImages', get_template_directory_uri() . '/js/jquery.loadImages.1.1.0.js', '', '', true);
	    wp_enqueue_script('jquery-loadImages');
	
		// imagesLoaded
		wp_register_script('jquery-images-loaded', get_template_directory_uri() . '/js/imagesloaded.js', '', '', true);
		wp_enqueue_script('jquery-images-loaded'); 
		
		// masonry grid
		wp_register_script('jquery-masonry-custom', get_template_directory_uri() . '/js/masonry.min.js', '', '', true);
		wp_enqueue_script('jquery-masonry-custom');

		// Responsive Slides
		wp_register_script('jquery-responsiveslides', get_template_directory_uri() . '/js/responsiveslides.js', '', '', true);
		wp_enqueue_script('jquery-responsiveslides');
		
		wp_register_script('jquery-imagelightbox', get_template_directory_uri() . '/js/imagelightbox.js', '', '', true);
		wp_enqueue_script('jquery-imagelightbox');
		
		// jquery validate
		wp_register_script('jquery-validate', get_template_directory_uri() . '/js/jquery.validate.js', '', '', true);
		wp_enqueue_script('jquery-validate');
		
		// enquire.js
		wp_register_script('jquery-enquire', get_template_directory_uri() . '/js/enquire.js', '', '', true);
	    wp_enqueue_script('jquery-enquire');
		
		// fsvs
		wp_register_script('jquery-fullpage', get_template_directory_uri() . '/js/fullpage.js', '', '', true);
	    wp_enqueue_script('jquery-fullpage');
		
		// Semplice
		wp_register_script('jquery-semplice', get_template_directory_uri() . '/js/semplice.js', '', '', true);
	    wp_enqueue_script('jquery-semplice');
	} else {
		// Semplice
		wp_register_script('semplice-minified-scripts', get_template_directory_uri() . '/js/scripts.min.js', '', '', true);
	    wp_enqueue_script('semplice-minified-scripts');
	}
}

add_action('wp_enqueue_scripts', 'load_custom_frontend_scripts');


#---------------------------------------------------------------------------#
# Content Editor															#
#---------------------------------------------------------------------------# 

// Re-define meta box path and URL
define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/includes/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/includes/meta-box' ) );

// Include the meta box script
require_once RWMB_DIR . 'meta-box.php';

// Include content editor meta boxes
require get_template_directory() . '/content-editor/meta_boxes.php';

// content editor ajax
if(is_admin()) {
	function semplice_ce_ajax() {
		if (isset($_REQUEST)) {
			// include content editor
			require get_template_directory() . '/content-editor/editor.php';
		}
		// stop script here after ajax request
		die();
	}
}

add_action( 'wp_ajax_semplice_ce_ajax', 'semplice_ce_ajax' );

#---------------------------------------------------------------------------#
# Body Classes																#
#---------------------------------------------------------------------------# 

add_filter('body_class','semplice_body_classes');

function semplice_body_classes($classes) {
	
	global $post;
	
	if(get_post_type($post->ID) === 'post' || is_search()) {
		$classes[] = 'blog-bg is-blog';
	}
	
	if(get_field('sticky_navbar', 'options') === 'normal') {
		$classes[] = 'is-sticky';
	}
	
	// site transitions
	if(get_field('site_transitions', 'options') === 'disabled') {
		$classes[] = 'no-transitions';
	}
	
	if(get_post_type($post->ID) === 'work') {
		$classes[] = 'is-work';
	}

	// return the $classes array
	return $classes;
}

#---------------------------------------------------------------------------#
# Custom Post Types															#
#---------------------------------------------------------------------------# 

// include portfolio custom post type
require get_template_directory() . '/includes/post-types/portfolio.php';

// include custom navbar post type
require get_template_directory() . '/includes/post-types/custom_navbar.php';

// include custom fontset post type
require get_template_directory() . '/includes/post-types/custom_fontset.php';


#---------------------------------------------------------------------------#
# Mobile Detect																#
#---------------------------------------------------------------------------# 

require get_template_directory() . '/includes/mobile_detect.php';

#---------------------------------------------------------------------------#
# Other Theme specific functions											#
#---------------------------------------------------------------------------# 

// custom font sizes
function font_sizes() {
	
	// font size classes
	$classes = '';
	
	if(get_field('p_font_size', 'options')) {
		$classes .= get_field('p_font_size', 'options') . ' ';
	}
	
	$headings = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
	
	foreach($headings as $heading) {
		if(get_field( $heading . '_font_size', 'options')) {
			$classes .= get_field( $heading . '_font_size', 'options') . ' ';
		}
	}
	
	echo $classes;
}

// semplice svg icons
function setIcon($icon) {
	//include();
	$svg = file_get_contents('images/icons/' . $icon . '.svg', true);
	
	return $svg;
}

// editor style
function semplice_add_editor_styles() {
    add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );
}

add_action( 'init', 'semplice_add_editor_styles' );

// Hook into the 'wp_before_admin_bar_render' action
add_action( 'wp_before_admin_bar_render', 'custom_admin_bar', 999 );

// admin bar icons
function custom_admin_bar() {
	global $wp_admin_bar;

	$args = array(
		'id'     => 'semplice_theme_options',
		'title'  => '<span class="ab-icon"></span><span>Theme Options</span>', 'text_domain',
		'href'   => '/wp-admin/admin.php?page=acf-options-general-settings'
	);
	$wp_admin_bar->add_menu( $args );

}

// custom post type icons
function add_menu_icons_styles() { ?>
	<style>
		#adminmenu .menu-icon-custom_navbar div.wp-menu-image:before {
			content: "\f214";
		}
		#adminmenu .menu-icon-work div.wp-menu-image:before {
			content: "\f128";
		}
		#adminmenu .menu-icon-custom_header div.wp-menu-image:before {
			content: "\f306";
		}
		#adminmenu .menu-icon-custom_fontset div.wp-menu-image:before {
			content: "\f215";
		}
		
		#wpadminbar #wp-admin-bar-semplice_theme_options .ab-icon:before {
			content: "\f111";
			top: 1px;
		}
		#wpadminbar #wp-admin-bar-wpuxss-toolbar-publish-button {
			background: #0074a2 !important;
		}
		#wpadminbar #wp-admin-bar-wpuxss-toolbar-publish-button .ab-icon:before{
			content: "\f147";
			color: white;
			top: -3px;
		}
		<?php
			// hide save button and text area in custom modules install options page
			$screen = get_current_screen();
			
			if($screen->id === 'semplice_page_acf-options-custom-modules') {
				echo '#side-info-column, .field_key-field_545fedbdb8727 { display: none; }';
			}
		?>
	</style>
<?php }

add_action( 'admin_head', 'add_menu_icons_styles' );

?>