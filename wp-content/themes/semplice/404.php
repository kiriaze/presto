<?php 
/*
 * 404
 * semplice.theme
 */
?>
<?php get_header(); # inlude header ?>
<section id="not-found">
	<div class="container">
		<div class="row">
			<div class="span12">
				<h2 class="light"><?php echo __('404 - Nothing found', 'semplice'); ?></h2>
				<p><?php echo __('Sorry, the page you requested could not be found.', 'semplice'); ?><br /><?php echo __('Back to the ', 'semplice'); ?><a href="<?php echo home_url(); ?>"><?php echo __('Homepage', 'semplice'); ?></a>.</p>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); # inlude footer ?>