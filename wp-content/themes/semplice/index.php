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
	<?php get_template_part('partials/blog-loop'); ?>
	<?php get_template_part('partials/blog-pagination'); ?>
</section>
<?php get_footer(); # inlude footer ?>