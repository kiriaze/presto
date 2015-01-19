<?php 
/*
 * blog index
 * semplice.theme
 */
?>
<?php get_header(); # inlude header ?>
<section id="blog" class="fade-content">
	<?php get_template_part('partials/blog-search'); ?>
	<?php get_template_part('partials/blog-archives'); ?>
	<div class="container">
		<div class="row">
		<div class="span8 offset2 result-header archive-header">	
		    <?php if ( is_month() ) : ?>
		    	<h3 class="light"><?php echo __('Archives for ', 'semplice') . get_the_date( __( 'F Y', 'semplice')); ?></h3>
		    <?php else : ?>
		    	<h3 class="light"><?php echo __('All Posts in ', 'semplice') . single_cat_title( '', false ); ?></h3>
		    <?php endif; ?>
		</div>
	</div>
	</div>
	<?php get_template_part('partials/blog-loop'); ?>
	<?php get_template_part('partials/blog-pagination'); ?>
</section>
<?php get_footer(); # inlude footer ?>