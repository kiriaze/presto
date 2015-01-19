<?php 
/*
 * header
 * semplice.theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, maximum-scale=1.0" />
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<title><?php bloginfo('name'); ?><?php wp_title('&rsaquo;'); ?></title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		<link type="text/css" rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/css/reset.css">
		<?php 
		
			// webfonts function
			include('content-editor/webfonts.php');
		
			// get fontset object
			function get_fontset_object($fontset_id) {
				if(!empty($fontset_id) && $fontset_id !== 'default') {
					// load the selected fontset
					$fontset_object = get_post($fontset_id);
				} elseif(get_field('custom_fontset', 'options')) {
					// load fontset defined in theme options if defined
					$fontset_object = get_field('custom_fontset', 'options');
				} else {
					// load open sans
					$fontset_object = false;
				}
				
				return $fontset_object;
			}
		
			if(get_post_type($post->ID) === 'work' || get_field('use_semplice') === 'active') {
				
				// get fontset id
				$fontset_id = get_post_meta( get_the_ID(), 'semplice_ce_fontset', true );
				
				// get fontset object
				$fontset_object = get_fontset_object($fontset_id);
				
				// include webfonts
				webfonts($fontset_object, true);
				
			} else if(get_field('use_semplice') === 'coverslider') {
			
				// get fontset id
				$fontset_id = get_field('custom_fontset_coverslider');
				
				// get fontset object
				$fontset_object = get_fontset_object($fontset_id);
				
				// include webfonts
				webfonts($fontset_object, true);
			
			} else {
			
				$fontset_object = get_field('custom_fontset', 'options');
				
				// include webfonts
				webfonts($fontset_object, false);
			}
			
			
		
		?>
		<link type="text/css" rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
		<style type="text/css"><?php require_once('includes/custom_css.php'); # require custom-css ?></style>
		<?php if(get_field('favicon', 'options')) : ?>
			<link rel="shortcut icon" href="<?php echo get_field('favicon', 'options'); ?>">
		<?php endif; ?>
		<?php if(get_field('google_analytics', 'options')) : ?>
			<?php echo (get_field('google_analytics', 'options')); ?>
        <?php endif; ?>
        <script type="text/javascript">
			window.onunload = function(){};
		</script>
		<?php wp_head(); # include wordpress header ?>
		<!-- Facebook -->
		<meta property="og:title" content="<?php bloginfo('name'); ?><?php wp_title('&rsaquo;'); ?>" />
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
		<?php if(get_field('share_desc')) : ?>
			<meta itemprop="go:description" property="og:description" content="<?php echo get_field('share_desc'); ?>" />
		<?php elseif(get_post_type($post->ID) === 'post') :  ?>
			<meta itemprop="go:description" property="og:description" content="<?php echo strip_tags(substr(get_the_content(), 0, 100)) . ' ...'; ?>" />
		<?php endif ?>
		<?php if(get_field('share_image')) : ?>
			<meta property="og:image" content="<?php echo get_field('share_image'); ?>" />
		<?php else : ?>
			<meta property="og:image" content="<?php echo get_field('share_image', 'options'); ?>" />
		<?php endif ?>
   
		<!-- bottom admin bar -->
		<style>html{margin-top:0px!important;}#wpadminbar{top:auto!important;bottom:0;}}</style>
	</head>
	<body <?php body_class(); ?>>
		<?php if(get_post_type($post->ID) === 'work' || get_field('use_semplice') === 'coverslider') : ?>
		<div id="project-panel-header">
			<?php 
				// project panel
				global $tn_transition;
				$tn_transition = 'data-project-panel="true"';
				get_template_part('partials/project', 'panel');
			?>
		</div>
		<?php endif; ?>
		<?php
		
			// get custom navbar post object
			if(get_field('custom_navbar_coverslider') && get_field('use_semplice') === 'coverslider') {
				$custom_navbar = get_field('custom_navbar_coverslider');
			} else if(get_field('custom_navbar')) {
				$custom_navbar = get_field('custom_navbar');
			} else if(get_field('so_custom_navbar', 'options')) {
				$custom_navbar = get_field('so_custom_navbar', 'options');
			} else {
				$custom_navbar = false;
			}
			
			// header visibility
			$header_visibility = get_field('cover_visibility');
			
			// padding
			$padding = '';
			
			// sticky
			$is_sticky = '';
			
			// dropdown menu font size
			$menu_font_size = '';
			
			// centered navbar
			$center_nav = '';
			
			// menu font weight
			$menu_font_weight = 'regular';
			
			// get content of post object
			if($custom_navbar) {
				
				$post = $custom_navbar;
				setup_postdata($post);
				
				// menu style
				$menu_style = get_field('menu_style');
				
				// centered navbar
				if(isset($menu_style) && $menu_style === 'normal' && get_field('navbar_fluid') === 'enabled' && get_field('navbar_alignment') === 'center') {
					$center_nav = 'fluid-nav-center';
				}

				if(get_field('dropdown_menu_fontsize')) {
					$menu_font_size = get_field('dropdown_menu_fontsize');
				}
				
				// font weight
				if(get_field('menu_font_weight')) {
					$menu_font_weight = get_field('menu_font_weight');
				} 
				
				// fluid navbar
				$is_fluid = get_field('navbar_fluid');
				
				if(get_field('sticky_navbar') === 'normal') {
					$is_sticky = 'class="non-sticky-nav"';
				}
				
				// padding
				if(get_field('navbar_padding') && get_field('navbar_padding') === 'fourty') {
					$padding = "fourty";
				} else {
					$padding = "twenty";
				}
				
				// show transparent navbars only on custom headers
				if($header_visibility === 'visible') {
					if(filter_var(get_field('navbar_transparent'), FILTER_VALIDATE_BOOLEAN) === TRUE) {
						$navbar_class = 'class="transparent" data-transparent-bar="true" data-navbar-opacity="' . get_field('navbar_bar_bg_opacity') . '"';
					} else {
						$navbar_class = 'class="navbar" data-navbar-opacity="' . get_field('navbar_bar_bg_opacity') . '"';
					}
				} else {
					$navbar_class = 'class="navbar" data-navbar-opacity="' . get_field('navbar_bar_bg_opacity') . '"';
				}
				// get logo type
				switch(get_field('logo_format')) {
					// text logo
					case 'text':
						if(get_field('textlogo_font_weight') != 'bold') {
							$font_weight = get_field('textlogo_font_weight');
						} else {
							$font_weight = 'bold';
						}
						$logo = '<h1 class="' . $font_weight . '"><nobr><a id="logo" href="' . home_url() . '">' . get_bloginfo('blog-title') . '</a></nobr></h1>';
					break;
					
					//image logo
					case 'image':
						$logo_img = wp_get_attachment_image_src(get_field('logo_img_upload'), 'full');
						$logo = '<a id="logo" class="has-logo" href="' . home_url() . '" title="' . get_bloginfo('blog-title') . '"><img class="logo-image" src="' . $logo_img[0] . '" width="' . $logo_img[1] . '" height="' . $logo[2] . '" alt="' . get_bloginfo('blog-title') . '" /></a>';
					break;
					
					//svg logo
					case 'svg':
						$logo = '<a id="logo" data-logo-height="' . get_field('logo_svg_height') . '" class="has-logo" href="' . home_url() . '" title="' . get_bloginfo('blog-title') . '">' . get_field('logo_svg_code') . '</a>';
					default;
				}
				wp_reset_postdata();
			} else {
				// default navbar
				$navbar_class = 'class="navbar" data-navbar-opacity="1"';
			}

			// default logo
			$default_logo = '<a id="logo" data-logo-height="23" class="has-logo" href="' . home_url() . '" title="' . get_bloginfo('blog-title') . '">' . setIcon('logo') . '</a>';
		
			$container = '<div class="container">';
			$fluid_container = '<div class="fluid-container">';
			$row = '<div class="row">';
			$close_tags = '</div></div>';
			
			// menu elements
			$menu_elements = '';
			
			// controls and nav
			$controls = '';
			$nav = '';
			
			if(isset($menu_style) && $menu_style === 'normal') {
			
				// diplay menu
				$nav .= '<nav class="standard ' . $menu_font_weight . '">' . wp_nav_menu( array( 'container' => '', 'theme_location' => 'main-menu',  'echo' => 0 ) ) . '</nav>';
				
				// display burger icon for responsive
				$controls .= '
					<a class="menu menu-responsive">
						<span class="open">' . setIcon('menu') . '</span>
						<span class="close">' . setIcon('close') . '</span>
					</a>
				';
				
			} else {
				
				// display burger icon
				$controls .= '
					<a class="menu">
						<span class="open">' . setIcon('menu') . '</span>
						<span class="close">' . setIcon('close') . '</span>
					</a>
				';
				
			}
			
			if(get_post_type($post->ID) === 'work' || get_field('use_semplice') === 'coverslider') {
				$controls .= '
					<a class="project-panel-button menu-icon">
						<span>' . setIcon('project-panel') . '</span>
					</a>
				';
			}
			
			if(get_post_type($post->ID) === 'post' && !is_search()) {
				$controls .= '
					<a class="search-button menu-icon">
						<span class="search-open">' . setIcon('search_small') . '</span>
					</a>
				';
			}
			
			if(get_post_type($post->ID) === 'post') {
					$controls .= '
						<a class="archives-button menu-icon">
							<span class="archives-open">' . setIcon('archives') . '</span>
						</a>
					';
			}
		
			$navbar_html = '';
			
			if(isset($is_fluid) && $is_fluid === 'enabled') {
			
				$navbar_html .= $fluid_container;
			
				$navbar_html .= '<div class="logo fluid-logo  ' . $padding . '">';
				
				// display the logo
				if($custom_navbar) {
					$navbar_html .= $logo;
				} else {
					$navbar_html .= $default_logo;
				}
				
				// close fluid logo
				$navbar_html .= '</div>';
				
				$navbar_html .= '<div class="fluid-menu ' . $center_nav . '">';
				
				$navbar_html .= $nav;
							
				$navbar_html .= '<div class="controls">' . $controls . '</div>';
				
				// close fluid elements
				$navbar_html .= '</div>';
				
				// close fluid container
				$navbar_html .= '</div>';
				
			} else {
				
				$navbar_html .= $container . $row;
				
				$navbar_html .= '<div class="span12 navbar-inner">';
				
				$navbar_html .= '<div class="logo ' . $padding . '">';
				
				// display the logo
				if($custom_navbar) {
					$navbar_html .= $logo;
				} else {
					$navbar_html .= $default_logo;
				}
				
				// close logo div
				$navbar_html .= '</div>';
				
				$navbar_html .= '<div class="nav-wrapper">';
				
				$navbar_html .= $nav;
							
				$navbar_html .= '<div class="controls">' . $controls . '</div>';
				
				// close logo and menu span
				$navbar_html .= '</div></div>';
				
				// menu elements
				$navbar_html .= $close_tags;
				
			}
			
		?>
		<header <?php echo $is_sticky; ?>>
			<div id="navbar-bg" <?php echo $navbar_class; ?>><!-- header bar background --></div>
			<div id="navbar">
			<?php
				// output navbar html
				echo $navbar_html;
			?>
			</div>
		</header>
		<div id="fullscreen-menu">
			<div class="menu-inner">
				<nav class="<?php echo $menu_font_size . ' ' . $menu_font_weight; ?>">
					<?php wp_nav_menu( array( 'container' => '', 'theme_location' => 'main-menu' ) ); ?>
				</nav>
				<div class="follow-links">
					<ul>
						<?php get_template_part('partials/social-links'); # include social links ?>
					</ul>
				</div>
			</div>
		</div>
		<div id="wrapper">
			<div id="content">