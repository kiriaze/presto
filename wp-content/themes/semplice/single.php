<?php 
/*
 * blog single
 * semplice.theme
 */
?>
<?php get_header(); # inlude header ?>
<section id="blog" class="fade-content">
	<?php get_template_part('partials/blog-search'); ?>
	<?php get_template_part('partials/blog-archives'); ?>
	<?php get_template_part('partials/blog-loop'); ?>
	<section id="comment">
		<div class="container">
			<div class="row">
				<div class="comment span8 offset2">
					<?php comments_template(); ?>
				</div>
			</div>
		</div>
	</section>
</section>
<?php get_footer(); # inlude footer ?>
